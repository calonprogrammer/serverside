<?php

namespace App\Http\Controllers;

use App\Favorite;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $favorite = Favorite::where('user_id',$request->user_id)->where('property_id',$request->property_id)->first();
        if($favorite != null){
            $favorite->liked = $favorite->liked === 0 ? 1 : 0;
            $favorite->save();
            return response()->json([
                'favorite'=>$favorite
            ]);
        }
        $favorite = new Favorite();
        $favorite->id = Uuid::uuid();
        $favorite->user_id = $request->user_id;
        $favorite->property_id= $request->property_id;
        $favorite->liked = 1;
        $favorite->save();
        return response()->json([
            'favorite'=>$favorite
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        //
    }

    public function getFavorite(Request $request){
        $favorite = Favorite::where('user_id',$request->user_id)->where('property_id',$request->property_id)->first();
        if($favorite->liked == 1){
            return response()->json([
                'favorite'=>true
            ]);
        }else{
            return response()->json([
                'favorite'=>false
            ]);
        }
    }
}
