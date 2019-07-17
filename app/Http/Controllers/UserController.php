<?php

namespace App\Http\Controllers;

use App\Apartement;
use App\Facility;
use App\Favorite;
use App\Notifications\Mail;
use App\Notifications\Phone;
use App\Notifications\ResetPassword;
use App\Premium;
use App\Property;
use App\Report;
use App\Review;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function getGuest(){
        $guest = User::where('type',User::TYPE_GUEST)->paginate(10);
        return response()->json([
            'message'=>'Success',
            'guest'=> $guest],200);
    }

    public function getOwner(){
        $owner= User::where('type',User::TYPE_OWNER)->paginate(10);
        return response()->json([
            'message'=>'Success',
            'owner'=> $owner],200);
    }

    public function emailVerification(){
        $user = JWTAuth::parseToken()->authenticate();
        if(!$user->email_verified_at){
            $user->notify(new Mail($user));
            return response()->json(['message'=>'Please Check your mailbox']);
        }
        return response()->json(['message'=>'Success',
            'value'=>'Email verified']);
    }

    public function phoneVerification(){
        $user = JWTAuth::parseToken()->authenticate();
        if(!$user->phone_verified_at){
            $user->notify(new Phone($user));
            return response()->json(['message'=>'Please Check your mailbox']);
        }
        return response()->json(['message'=>'Success',
            'value'=>'Phone verified']);
    }

    public function resetPassword(Request $request){
        $user = User::find($request->id);
        $newPassword = Str::random();
        $user->password = bcrypt($newPassword);
        $user->save();
        $user->notify(new ResetPassword($user,$newPassword));
        return response()->json(['message'=>'Success',
            'value'=>'Sukses reset Password']);
    }

    public function banUser(Request $request){
        $user = User::find($request->id);
        $user->ban = 1;
        $user->save();
        return response()->json([
            'message'=> 'Success Ban User '.$user->name,
        ]);
    }

    public function searchGuest(Request $request){
        $key = strtolower( $request->key);
        $user = User::where('type',User::TYPE_GUEST);
        $results = $user->where('name',"LIKE","%$key%")->orWhere('email',"LIKE","%$key%")->orWhere('username',"LIKE","%$key%")->get();
        return response($results);
    }

    public function searchOwner(Request $request){
        $key = strtolower( $request->key);
        $user = User::where('type',User::TYPE_OWNER);
        $results = $user->where('name',"LIKE","%$key%")->orWhere('email',"LIKE","%$key%")->orWhere('username',"LIKE","%$key%")->get();
        return response($results);
    }

    public function  getUser(Request $request){
        $user = User::where('id',$request->user_id)->with('favorite','transactionPremium')->first();
        $apartements = Property::with('city','facility','propertiable')
            ->where('user_id',$user->id)
            ->where('propertiable_type','App\Apartement')->paginate(10);
        $kosts = Property::with('city','facility','propertiable')
            ->where('user_id',$user->id)
            ->where('propertiable_type','App\House')->paginate(10);
        return response()->json([
            'user'=>$user,
            'apartements' => $apartements,
            'kosts'=>$kosts
        ],200);
    }

    public function activateEmail(Request $request){
        if (!$request->hasValidSignature()) {
            return ResponseFormat::Format('ok','Link Invalid', null, 401);
        }

        $verifiedUser = User::find($request->user);
        if($verifiedUser->email_verified_at)
            return "Already Active";
        $verifiedUser->email_verified_at = now();
        $verifiedUser->save();
        return "Success";
    }

    public function activatePhone(Request $request){
        if (!$request->hasValidSignature()) {
            return ResponseFormat::Format('ok','Link Invalid', null, 401);
        }

        $verifiedUser = User::find($request->user);
        if($verifiedUser->phone == null){

        }
        if($verifiedUser->phone_verified_at)
            return "Already Active";
        $verifiedUser->phone_verified_at = now();
        $verifiedUser->save();
        return "Success";
    }

    public function getPropertyFavorite(Request $request,$id){
        $user = User::find($id);
        $user->follower = $user->follower;
        return response()->json([
            'user'=>$user,
            'favorite' => $user->favorite,
        ],200);
    }

    public function getAllApartement(Request $request){
        $user = $request->user;
        $apartements = Property::where('user_id',$user->id)->where('propertiable_type','App\Apartement')->with('propertiable','city')->paginate(10);
        return response()->json(['apartements'=>$apartements]);
    }

    public function getAllHouse(Request $request){
        $user = $request->user;
        $kosts = Property::where('user_id',$user->id)->where('propertiable_type','App\House')->with('propertiable','city')->paginate(10);
        return response()->json(['kosts'=>$kosts]);
    }

    public function getOwnerDetail(Request $request){
        $temp = $request->user;
        $user =User::where('id',$temp->id)->with('properties.review','follower')->first();
        $user->premium = $user->premium;
        return response()->json([
            'user'=> $user
        ]);

    }

    public function adminAnalysis(){
        $properties = Property::all();
        $premium = Premium::all();
        $facilities = Facility::all();
        $reviews = Review::all();
        $users = User::where('type','1')->orWhere('type','2')->where('ban','0')->get();
        $reports = Report::all();
        $userPremiums = Transaction::with('user')->where('premium_status','1')->get();
        return response()->json([
            'properties'=>$properties,
            'premiums'=>$premium,
            'facilities'=>$facilities,
            'reviews'=>$reviews,
            'users'=>$users,
            'reports'=>$reports,
            'userPremiums'=>$userPremiums
        ]);
    }
}
