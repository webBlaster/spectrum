<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateImeiRequest;
use Illuminate\Support\Facades\Auth;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Validator;

use App\User;
use App\BlacklistedImei;
use App\AccessCode;
use App\Book;
use App\Http\Resources\AttachedBooksCollection;
use App\Http\Resources\NotificationResourceCollection;
use App\Notification;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Http\Request;

use mikehaertl\tmp\File;
use SoareCostin\FileVault\Facades\FileVault;
use Storage;


class SpectrumApiController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'store', 'downloadBooks');
    }


    public function index()
    {
        return $this->success('You have successfully reached the spectrum API endpoint');
    }

    public function store(Request $request)
    {
        /*  try finding a user with the given imei 
        *  catch model error in case model doesn't exist
        */      $validator = Validator::make($request->all(), [
                    'imei' => 'required'
                ]);
                if($validator->fails())
                {
                    return $this->failed($validator->errors());
                }
                try {
                    // find an imei or create if not found
                    $findOrCreateImei = User::firstOrCreate(['imei' => $request->imei]);
                    
                    // check if imei is found or created
                    if($findOrCreateImei) {

                        // checks if imei isn't blacklisted
                        // $blacklisted = BlacklistedImei::where('imei', $request->imei)->first();
                        if($findOrCreateImei->blackListedImei) {
                            return $this->failed('The requested IMEI is blacklisted');
                        }

                        // check if user has an access code
                        
                        $token = $findOrCreateImei->createToken('Access Token')->accessToken;
                        if (!empty($findOrCreateImei->access_code)) {
                            // What should happen to a user that has an access code already
                            return $this->success('User Imei is confirmed and has a valid code',
                            ['token' => $token, 'expires_in' => '60 minutes', 'user_id'=>$findOrCreateImei->uuid]);
                        } else {
                            // Generate token for user authentication
                            return $this->success('Device Imei successfully Registered',
                                                ['token' => $token, 'expires_in' => '60 minutes', 'user_id'=>$findOrCreateImei->uuid]);
                        }
                        
                    }
            }
            catch(Exception $e) {
                return $e;
                return $this->failed('Query Error: Failed to query the database');
            }    
        
        
        
    }
   
    protected function loginAttempt($attempt) {
        return $attempt + 1;
    }
    
    public function update(Request $request)
    {   
        // $encrpyted = encrypt(1);
        // return decrypt($encrpyted);
        // check if a user is authenticated
        $user = Auth('api')->user();

        // check if the user making a request is the same as the authenticated user
        if ($user->uuid == $request->user_id) {
            // get login attempt from database
            $login_attempt = $user->login_attempt;

            // check if login attempt is less than 5
            if($login_attempt >= 5 && !$user->blackListedImei) {
                BlackListedImei::create(['user_id'=>$user->id, 'imei'=>$user->imei]);
                return $this->failed('Too many login attempts');
                
            } elseif($login_attempt >= 5 && $user->blackListedImei){
                return $this->failed('Too many login attempts');
            } else {
                // validates user's input
                $validator = Validator::make($request->all(), [
                    'first_name' => 'required|max:50',
                    'last_name' => 'required|max:50',
                    'phone' => 'required',
                    'email' => 'email|max:191',
                    'access_code' => 'required'
                ]);
                if($validator->fails())
                {
                    return $this->failed($validator->errors());
                }

                // Ensure the current user can retrieve his/her books

                // check if access code exists
                $confirmAccessCode = AccessCode::where('code', $request->access_code)->first();
                if(!$confirmAccessCode) {
                    $user->update(['login_attempt' => $this->loginAttempt($login_attempt)]);
                    return $this->failed('Invalid Access Code');
                } else {
                    $usageCount = User::where('access_code', $request->access_code);
                    // Checking if the maximum allowed has not been attained
                    if($usageCount->count() >= $confirmAccessCode->max_number_of_users) {
                        // if maximum is attained, check if current user is in the list
                        if($user->access_code == '' || $user->access_code == $request->access_code) {
                            $user->update(['login_attempt' => $this->loginAttempt($login_attempt)]);
                            return $this->failed('Invalid Access Code');
                        }
                        
                    } 
                    // Checking if access code has not expired
                    $present = Carbon::now();

                    if($confirmAccessCode->expires == '') {
                        $expires = $present->addMonths($confirmAccessCode->duration);
                        $confirmAccessCode->update(['expires' => $expires]);
                    }
                    if($confirmAccessCode->expires > $present) {
                        $user->first_name = $request->first_name;
                        $user->last_name = $request->last_name;
                        $user->phone = $request->phone;
                        $user->email = $request->email;
                        $user->login_attempt = 0;
                        $user->updated_at = now();
                        if($user->uuiactivation_dated == null ) {
                            $user->uuiactivation_dated = $present;
                        } 
                        $user->save();
                        $books_id = explode(',', $confirmAccessCode->books_contained);
                        $books = AttachedBooksCollection::collection(Book::find($books_id));
                        return $this->success('Success, see attached books below', $books);
                    } else {
                        return $this->failed('Access Code Expired');
                    }
                    
                }
            }

        } else {
            return $this->failed('wrong authentication token');
        }
   }

    public function downloadBooks($id) {
       $books_id = decrypt($id);
       try {
            $book = Book::findOrFail($books_id);

            FileVault::decryptCopy($book->path . ".enc");

            $name = basename($book->path);
            $contents = Storage::get($book->path);
            $extension = pathinfo($book->path, PATHINFO_EXTENSION);

            $decrypted_book = new File($contents, null, null, null);

            Storage::delete($book->path);

            $decrypted_book->send($name, $extension, true);
        } catch(ErrorException $e) {
            return $this->falied('Error Downloading from server');
        }
    }

    public function streamDownloadImage($path) {
        $headers = array(
            'Content-Disposition:inline',
            'Content-Type:image/jpg'
        );
        
        return response()->file($path, $headers);

    }

    public function notification() {
        $notification = Notification::latest()->get();
        return $this->success('Success', NotificationResourceCollection::collection($notification));
    }
    


   

}
