<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Post;
use App\Tag;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user;
        $posts = null;
        if($user->type == 1){
            $posts = Post::where('role_id','guest')->orWhere('role_id','all')->with('tags')->paginate(8);
        }else if($user->type == 2){
            $posts = Post::where('role_id','owner')->orWhere('role_id','all')->with('tags')->paginate(8);
        }else{
            $posts = Post::with('tags')->paginate(8);
        }
        return response()->json([
            'posts'=>$posts
        ],200);
    }

    public function getPostWithSlug(Request $request){
        $user = $request->user;
        $posts = null;
        if($user->type == 1){
            $posts = Post::where('slug',$request->slug)->with('tags')->first();
        }else if($user->type == 2){
            $posts = Post::where('slug',$request->slug)->with('tags')->first();
        }else{
            $posts = Post::where('slug',$request->slug)->with('tags')->first();
        }
        return response()->json([
            'posts'=>$posts
        ],200);
    }

    public function getFourPost(Request $request){
        $user = $request->user;
        $posts = null;
        if($user->type == 1){
            $posts = Post::where('role_id','guest')
                ->orWhere('role_id','all')->with('tags')->take(4)->get();
        }else if($user->type == 2){
            $posts = Post::where('role_id','owner')
                ->orWhere('role_id','all')->with('tags')->take(4)->get();
        }else{
            $posts = Post::with('tags')->take(4)->get();
        }
        return response()->json([
            'posts'=>$posts
        ],200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $id = Uuid::uuid();
        $post->id = $id;
        $post->title = $request->title;
        $post->slug = str_slug($request->title)."-".$id."-post";
        $post->contents = $request->contents;
        $post->role_id = $request->role;
        $picture_id = $request->picture_id;
        if($picture_id !== null){
            $pictureFilename = $id. '.' . $picture_id->getClientOriginalExtension();
            $destination = '/app/public/image/post/'.$id.'/';
            $picture_id->move(storage_path($destination), $pictureFilename);
            $post->picture_id = 'storage/image/post/'.$id.'/'.$pictureFilename;
        }
        $string = $request->tags;
        $tempTags = explode(",", $string);
        $tags = $tempTags;
        foreach ($tags as $tag){
            $temp= Tag::find($tag);
            $post->tags()->save($temp);
        }
        $post->save();
        return response()->json([
            'message'=>'Success add new Post'
        ]);
    }
    public function getPostWithTag(Request $request,$id){
        $user = $request->user;
        $posts = null;
        if($user->type == 1){
            $posts = Post::where('role_id','guest')->with('tags')
                ->join('detail_post','detail_post.post_id','=','post_id')
                ->where('detail_post.tag_id',$id)->get();
        }else if($user->type == 2){
            $posts = Post::where('role_id','owner')->with('tags')
                ->join('detail_post','detail_post.post_id','=','post_id')
                ->where('detail_post.tag_id',$id)->get();
        }else{
            $posts = Post::where('role_id','all')->with('tags')
                ->join('detail_post','detail_post.post_id','=','post_id')
                ->where('detail_post.tag_id',$id)->get();
        }
        return response()->json([
            'posts'=>$posts
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

    }

    public function deletePost(Request $request){
        Post::where('id',$request->id)->delete();
        return response()->json([
            'message'=>'Success Delete Post'
        ],200);
    }
}
