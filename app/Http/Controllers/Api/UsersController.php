<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use Response;
use Carbon;
use App\Repositories\Backend\Access\User\UserRepository;
use App\Repositories\Backend\User\UserContract;
use App\Repositories\Backend\UserNotification\UserNotificationRepositoryContract;
use App\Http\Transformers\UserTransformer;
use App\Http\Utilities\FileUploads;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use Auth;

class UsersController extends Controller 
{
    protected $userTransformer;
    /**
     * __construct
     * @param UserTransformer                    $userTransformer
     */
    public function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer  = $userTransformer;
        $this->users            = new UserRepository();
    }

    /**
     * Login request
     * 
     * @param Request $request
     * @return type
     */
    public function login(Request $request) 
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        
        $user = Auth::user()->toArray();

        $userData = array_merge($user, ['token' => $token]);

        if($request->get('token'))
        {
            $this->users->setToken((object)$user, $request->get('token'));
        }

        $responseData = $this->userTransformer->transform((object)$userData);

        // if no errors are encountered we can return a JWT
        return response()->json($responseData);
    }

    public function register(Request $request) 
    {
        $postData = $request->all();
        
       if (isset($postData['username']) && $postData['username'] &&
                isset($postData['password']) && $postData['password'] &&
                isset($postData['name']) && $postData['name']
        ) {
            if (isset($postData['email']) && !$this->users->checkEmailAlreadyExist($postData['email'])) 
            {
                return $this->respondInternalError('User\'s Email Already Exist');
            }
            
            if (!$this->users->checkUserNameAlreadyExist($postData['username'])) 
            {
                return $this->respondInternalError('Username Already Exist');
            }

            if($request->get('token'))
            {
                $userInfoByToken = $this->users->getUserByDeviceToken($request->get('token'));

                if(isset($userInfoByToken))
                {
                    $userInfoByToken->user->username = $postData['username'];
                    $userInfoByToken->user->password = bcrypt($postData['password']);
                    $userInfoByToken->user->name = $postData['name'];
                    $userInfoByToken->user->email = $postData['email'];
                    $userInfoByToken->user->save();
                    


                    $credentials = [
                        'email'     => $postData['email'],
                        'password'  => $postData['password']
                    ];

                    try {
                        // verify the credentials and create a token for the user
                        if (! $token = JWTAuth::attempt($credentials)) 
                        {
                            return response()->json(['error' => 'invalid_credentials'], 401);
                        }
                    } catch (JWTException $e) 
                    {
                        // something went wrong
                        return response()->json(['error' => 'could_not_create_token'], 500);
                    }
                        
                    $user = Auth::user()->toArray();

                    $userData = array_merge($user, ['token' => $token]);

                    if($request->get('token'))
                    {
                        $this->users->setToken((object)$user, $request->get('token'));
                    }

                    $responseData = $this->userTransformer->getUserInfo($userData);
                    

                    return $this->ApiSuccessResponse($responseData);
                }
            }
            else
            {
                $user = $this->users->createAppUser($postData);
            }
            //check user is created 
            if ($user) {
                $this->setStatusCode(200);
                
                $credentials = $request->only('username', 'password');
                try {
                    // verify the credentials and create a token for the user
                    if (! $token = JWTAuth::attempt($credentials)) 
                    {
                        return response()->json(['error' => 'invalid_credentials'], 401);
                    }
                } catch (JWTException $e) 
                {
                    // something went wrong
                    return response()->json(['error' => 'could_not_create_token'], 500);
                }
                
                $user = Auth::user()->toArray();

                $userData = array_merge($user, ['token' => $token]);

                if($request->get('token'))
                {
                    $this->users->setToken((object)$user, $request->get('token'));
                }

                $responseData = $this->userTransformer->getUserInfo($userData);
                

                return $this->ApiSuccessResponse($responseData);
            } else {
                return $this->respondInternalError('Invalid Arguments');
            }
        } else {
            return $this->respondInternalError('Invalid Arguments');
        }
    }
    /**
     * Logout request
     * @param  Request $request
     * @return json
     */
    public function logout(Request $request) 
    {
        /*$userId = $request->header('UserId');
        $userToken = $request->header('UserToken');
        $response = $this->users->deleteUserToken($userId, $userToken);
        if ($response) {
            return $this->ApiSuccessResponse(array());
        } else {
            return $this->respondInternalError('Error in Logout');
        }*/
    }

    public function registerAsGuest(Request $request)
    {
        $postData = $request->all();

        $randomName             = 'Guest-'.rand(1111, 9999).'-'.rand(1111, 9999);
        $postData['username']   = $randomName;
        $postData['name']       = $randomName;        
        $postData['password']   = bcrypt(str_random(12));;
        $postData['email']      = $randomName.'@app-test.com';
        

        if(isset($postData['username']) && $postData['username'] &&
                isset($postData['password']) && $postData['password'] &&
                isset($postData['name']) && $postData['name']
        ) 
        {
            $user = $this->users->createAppUser($postData);

            //check user is created 
            if ($user)
            {
                $this->setStatusCode(200);
                
                $credentials = [
                    'email'     => $postData['email'],
                    'password'  => $postData['password']
                ];
                try {
                    // verify the credentials and create a token for the user
                    if (! $token = JWTAuth::attempt($credentials)) 
                    {
                        return response()->json(['error' => 'invalid_credentials'], 401);
                    }
                } catch (JWTException $e) 
                {
                    // something went wrong
                    return response()->json(['error' => 'could_not_create_token'], 500);
                }
                
                $user = Auth::user()->toArray();

                $userData = array_merge($user, ['token' => $token]);

                if($request->get('token'))
                {
                    $this->users->setToken((object)$user, $request->get('token'));
                }

                $responseData = $this->userTransformer->transform((object)$userData);
                return response()->json($responseData);
            } else 
            {
                return $this->respondInternalError('Invalid Arguments');
            }
        }
        else
        {
            return $this->respondInternalError('Invalid Arguments');
        }        
    }

    public function forgotPassword(Request $request)
    {
        if($request->get('email'))
        {
             return $this->ApiSuccessResponse([
                    'mailSend'      => 1,
                    'message'       => 'New Password send on Register Email Id'
            ]);
        }

        return $this->respondInternalError('Invalid Arguments');
    }
}
