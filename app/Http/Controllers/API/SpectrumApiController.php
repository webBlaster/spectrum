<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateImeiRequest;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Validator;

use App\User;
use App\BlacklistedImei;
use App\AccessCode;
use App\Book;
use Dotenv\Regex\Success;
use Illuminate\Http\Request;

class SpectrumApiController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth:api')->only('update');
    }
   public function index()
   {
       //
       return $this->success('success', 'You have successfully reached the spectrum API endpoint');
   }

    public function store(CreateImeiRequest $request)
    {
        /*  try finding a user with the given imei 
        *  catch model error in case model doesn't exist
        */
        try {
                // find an imei or create if not found
                $findOrCreateImei = User::firstOrCreate(['imei' => $request->imei]);
                
                // check if imei is found or created
                if($findOrCreateImei) {

                    // checks if imei isn't blacklisted
                    // $blacklisted = BlacklistedImei::where('imei', $request->imei)->first();
                    if($findOrCreateImei->blackListedImei) {
                        return $this->success('Blocked', 'imei Blacklisted', Response::HTTP_LOCKED);
                    }

                    // check if user has an access code
                    if (!empty($findOrCreateImei->access_code)) {
                        // What should happen to a user that has an access code already
                        return $this->success('Success', 'User Has Valid Code', Response::HTTP_FOUND);
                    } else {
                        // Generate token for user authentication
                        $token = $findOrCreateImei->createToken('Access Token')->accessToken;
                        return response()->json(['token' => $token, 'expires_in' => '60 minutes', 'user_id'=>$findOrCreateImei->id], Response::HTTP_OK);
                    }
                    
                }



                // $checkIfImeiExists = User::where('imei', $request->imei)->first();

                // same as select * from users
                // $checkIfImeiExists = DB::select('select * from users where imei = ? ', [$request->imei]);
                // if($checkIfImeiExists) {
                //     $blacklisted = BlacklistedImei::where('imei', $request->imei)->first();
                //     if($blacklisted) {
                //         return $this->success('imei Blacklisted');
                //     }
                //     if (!empty($checkIfImeiExists->access_code)) {
                //         return response()->json('User Has Valid Code');
                //     } else {
                //         $imeiStatus = 1;
                //     }
                    
                // }
                
                // if ($imeiStatus !== 0) {
                //     return $this->success(['callback'=>'Imei Exist but no user data']);
                // } else {
                //     $user = User::create(['imei'=> $request->imei]);
                //     $token = $user->createToken('Access Token')->accessToken;
                //     return response()->json(['token' => $token, 'expires_in' => '60 minutes'], Response::HTTP_OK);
                // }
                
        }
        catch(Exception $e) {
            // return $e;
            return $this->failed('Query Error', 'error in database query');
        }
        
        
        
        
    }
   
    protected function loginAttempt($attempt) {
        return $attempt + 1;
    }
    
    public function update(Request $request, $id)
    {    
        // check if a user is authenticated
        $user = Auth('api')->user();

        // check if the user making a request is the same as the authenticated user
        if ($user->id == $id) {
            // get login attempt from database
            $login_attempt = $user->login_attempt;

            // check if login attempt is less than 5
            if($login_attempt >= 5 && !$user->blackListedImei) {
                BlackListedImei::create(['user_id'=>$user->id, 'imei'=>$user->imei]);
                return $this->success('error', 'Too many login attempts', Response::HTTP_LOCKED);
                
            } elseif($login_attempt >= 5 && $user->blackListedImei){
                return $this->failed('error', 'Too many login attempts', Response::HTTP_LOCKED);
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
                    return $this->failed('error', $validator->errors(), Response::HTTP_EXPECTATION_FAILED);
                }

                // check if access code exists
                $confirmAccessCode = AccessCode::where('code', $request->access_code)->first();
                if(!$confirmAccessCode) {
                    $user->update(['login_attempt' => $this->loginAttempt($login_attempt)]);
                    return $this->failed('error', 'Invalid Access Code', Response::HTTP_UNPROCESSABLE_ENTITY);
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
                        return $this->success('error', 'Invalid Access Code', Response::HTTP_UNPROCESSABLE_ENTITY);
                    }
                }
            }

        } else {
            return $this->success('Authentication failed', 'wrong authentication token', Response::HTTP_UNAUTHORIZED);
        }
   }


   

}
