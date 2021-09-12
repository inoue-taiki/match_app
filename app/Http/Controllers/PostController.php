<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\Post;
use Auth;

class PostController extends Controller
{
    //トーク画面
    public function post(){

        return view('/users/post');
    }

    //投稿
    public function create(Request $request){

        //$user_id = Auth::id();
        $user_id = 1;
        $post = $request->input('newPost');
        
        $post_images = $request->file('image_path');

        if(isset($post) && isset($post_images)){
            $test = $request->file('image_path')->getClientOriginalName();
            $request->file('image_path')->store('images/','',$test);

            Post::insert([
                'user_id'=>$user_id,
                'post'=>$post,
                'image_path'=>$post_images,
            ]);

            // $image = new Post;
            // $image->user_id=$user_id;
            // $image->image_path=$test;
            // $image->save();
        }
        elseif(isset($post) && !isset($post_images)){
            Post::insert([
                'user_id'=>$user_id,
                'post'=>$post,
            ]);
        }
        elseif(!isset($post) && isset($post_images)){
            $test = $request->file('image_path')->getClientOriginalName();
            $request->file('image_path')->store('images/','',$test);

            $image = new Post;
            $image->user_id=$user_id;
            $image->image_path=$test;
            $image->save();
        }
        else{

        }

        return back();
    }
    
    //投稿一覧ｄｄ
    public function index(){

        $user_id = 1;
        $id = User::find(1)->id;
        

        $posts = Post::where('user_id',$user_id)
               ->orderBy('created_at','desc')
               ->get();
        
      

        $user = \DB::table('users')
              ->where('posts.post',$id)
              ->select('users.*')
              ->leftjoin('posts','users.id','=','posts.post')
              ->get();
        
        

        return view('/users/post',compact('user_id','posts','user'));
    }
}
