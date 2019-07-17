<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UpdateProfileController extends Controller
{
    public function updateProfile(UpdateProfileRequest $request)
    {
//        $id = $request->id;
//        $user = DB::table('users')->where('id', $id)->first();

        $user = JWTAuth::parseToken()->authenticate();
        $image = $request->file('image');
        if($image!= null) {
            $filename = $user->id . '.' . $image->getClientOriginalExtension();
            $destination = '/app/public/image/user/';
            $image->move(storage_path($destination), $filename);
            $user->picture_id = 'storage/image/user/'.$filename;
        }
        $email = $request->email;
        if($email != $user->email){
            $user->email = $email;
            $user->email_verified_at = null;
        }
        $username = $request->username;

        if($username != null){
            if(strcmp($username,$user->username)!= 0){
                $user->username = $username;
            }
        }
        $phone = $request->phone;
        if($phone != null){
            if($user->phone != $phone){
                $user->phone = $phone;
                $user->phone_verified_at = null;
            }
        }
        $user->name = $request->name;
        $user->save();
        return response()->json(['message' => 'Success'], 200);
    }

    public function changePassword(ChangePasswordRequest $request){
        $user = JWTAuth::parseToken()->authenticate();
        //$password = base64_decode($request->password);
        if(Hash::check($request->password,$user->password)){
            $newPassword = base64_decode($request->newPassword);
            $user->password = Hash::make($newPassword);
            $user->save();
            return response()->json(['message'=>'Success'],200);
        }
        return response()->json(['message'=>'Password yang anda masukan salah'],422);
    }
}
