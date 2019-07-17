<?php

namespace App\Http\Controllers;

use App\Follow;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user;
        $following = Follow::where('from_id',$user->id)->with('follower','userFrom')->paginate(10);
        return response()->json([
            'following' => $following
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $follow = Follow::where('from_id',$request->from_id)->where('to_id',$request->to_id)->first();
        if($follow == null){
            $follow = new Follow();
            $follow->id = Uuid::uuid();
            $follow->from_id = $request->from_id;
            $follow->to_id = $request->to_id;
            $follow->save();
            return response()->json([
                'followed'=>$follow
            ]);
        }
        $follow->delete();
        return response()->json([
            'favorite'=>null
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Follow::where('id',$id)->delete();
        return response()->json([
            'messsage' => 'Success Unfollow'
        ]);
    }

    public function getFollow(Request $request){
        $favorite = Follow::where('from_id',$request->from_id)->where('to_id',$request->to_id)->first();
        if($favorite != null){
            return response()->json([
                'followed'=>true
            ]);
        }
        return response()->json([
            'followed'=>false
            ]);
    }

    public function search(Request $request){
        $user = $request->user;
        $following = Follow::where('from_id',$user->id)
            ->join('users','users.id','=','follows.to_id')
            ->where('name','LIKE','%'.$request->key.'%')
            ->with('follower','userFrom')->paginate(10);
        return response()->json([
            'following' => $following,
            'key'=>$request->key
        ]);
    }
}
