<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\GuestStoreRequest;
use App\Http\Requests\LoginGuestRequest;
use App\Http\Requests\LoginOwnerRequest;
use App\Http\Requests\OwnerStoreRequest;
use App\Notifications\Mail;
use App\Notifications\Phone;
use App\User;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function loginGuest(LoginGuestRequest $request){
        $credentials = $request->only('email','phone','password');
        try{
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'message' => 'User not found.'
                ],200);
            }
        }catch (JWTException $e){
            return response()->json([
                'message' => 'Failed to login, please try again.'
            ], 500);
        }
        return response()->json([
            'message' => 'Success',
            'token' => $token
        ]);
    }


    public function loginOwner(LoginOwnerRequest $request){
        $credentials = $request->only('phone','password');
        try{
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'message' => 'User not found.'
                ],200);
            }
        }catch (JWTException $e){
            return response()->json([
                'message' => 'Failed to login, please try again.'
            ], 500);
        }
        return response()->json([
            'message' => 'Success',
            'token' => $token
        ]);
    }

    public function ownerStore(OwnerStoreRequest $request){
        $user = new User();
        $user->id = Uuid::uuid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->ban = 0;
        $password = base64_decode($request->password);
        $user->password = bcrypt($password);
        $user->type = User::TYPE_OWNER;
        $user->picture_id = 'storage/image/user/profile.png';
        $user->save();
        return response()->json(['message'=>'Success']);
    }

    public function guestStore(GuestStoreRequest $request){
        $user = new User();
        $user->id = Uuid::uuid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->ban = 0;
        $password  = base64_decode($request->password);
        $user->password = bcrypt($password);
        $user->type = User::TYPE_GUEST;
        $user->picture_id = 'storage/image/user/profile.png';
        $user->save();
        return response()->json(['message'=>'Success']);
    }


    public function logout(Request $request){
        $token = $request->header('Authorization');
        try {
            JWTAuth::invalidate($token);
            return response()->json([
                'status' => 'Success',
                'message'=> "User successfully logged out."
            ]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                'status' => 'Error',
                'message' => 'Failed to logout, please try again.'
            ], 500);
        }
    }

    public function initial(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        if($user == null){
            return response()->json(['message' =>'Unauthorized'],200);
        }
        if($user->ban == 1){
            return response()->json([
                'message' =>'You have been banned',
                'status' => 'ban'],200);
        }
        $user->follower = $user->follower;
        $user->premium = $user->premium;
        $user->favorite = $user->favorite;
        return response()->json(['message'=>'Authorized' , 'user' => $user],200);
    }
}
