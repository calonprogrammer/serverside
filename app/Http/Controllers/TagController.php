<?php

namespace App\Http\Controllers;

use App\Tag;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getTags(){
        $tags = Tag::all();
        return response()->json([
            'tags'=>$tags]);
    }
    public function store(Request $request){
        $tag = new Tag();
        $tag->id = Uuid::uuid();
        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->save();
        return response()->json([
            'message'=>'Success add new Tag'
        ]);
    }
}
