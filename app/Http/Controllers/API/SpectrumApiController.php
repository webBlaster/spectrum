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
use BadMethodCallException;
use Illuminate\Http\Request;

class SpectrumApiController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth:api')->only('update');
        $this->middleware('ApiKey');
    }
    public function index($apiKey)
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
                        if (!empty($findOrCreateImei->access_code)) {
                            // What should happen to a user that has an access code already
                            return $this->success('User Imei is confirmed and has a valid code');
                        } else {
                            // Generate token for user authentication
                            $token = $findOrCreateImei->createToken('Access Token')->accessToken;
                            return response()->json(['token' => $token, 'expires_in' => '60 minutes', 'user_id'=>$findOrCreateImei->uuid], Response::HTTP_OK);
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
    
    public function update(Request $request, $uuid)
    {    
        // check if a user is authenticated
        $user = Auth('api')->user();

        // check if the user making a request is the same as the authenticated user
        if ($user->uuid == $uuid) {
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

                // check if access code exists
                $confirmAccessCode = AccessCode::where('code', $request->access_code)->first();
                if(!$confirmAccessCode) {
                    $user->update(['login_attempt' => $this->loginAttempt($login_attempt)]);
                    return $this->failed('Invalid Access Code');
                } else {
                    $usageCount = User::where('access_code', '=', $request->access_code)->count();
                    if($usageCount < $confirmAccessCode->max_number_of_users) {
                        // Checking if access code has not expired
                        if($confirmAccessCode->duration > 0) {
                            $user->update([
                                'first_name' => $request->first_name,
                                'last_name' => $request->last_name,
                                'phone' => $request->phone,
                                'email' => $request->email, 
                                'access_code' => $request->access_code
                            ]);
                            // $books_id = implode('', $confirmAccessCode->books_contained);
                            // $books = Book::find($books_id);
                            return $this->success('books attached');
                        }
                    } else {
                        $user->update(['login_attempt' => $this->loginAttempt($login_attempt)]);
                        return $this->failed('Invalid Access Code');
                    }
                }
            }

        } else {
            return $this->failed('wrong authentication token');
        }
   }


   

}
