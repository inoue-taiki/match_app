<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\Post;
use Auth;

use Abraham\TwitterOAuth\TwitterOAuth; //twitter連携

class PostController extends Controller
{
    //トーク画面
    public function post()
    {

        return view('/users/post');
    }

    //投稿
    public function create(Request $request)
    {

        $user = User::all();
        //$user_id = Auth::id();
        $user_id = 1;
        $post = $request->input('newPost');

        $user_name = User::find(1)->name;

        $post_images = $request->file('image_path');

        if (isset($post) && isset($post_images)) {
            $test = $request->file('image_path')->getClientOriginalName();
            $request->file('image_path')->storeAs('images/', $test, 'public_uploads');

            Post::insert([
                'user_id' => $user_id,
                'post' => $post,
                'image_path' => $test,
            ]);
        } elseif (isset($post) && !isset($post_images)) {
            Post::insert([
                'user_id' => $user_id,
                'post' => $post,
            ]);
        } elseif (!isset($post) && isset($post_images)) {
            $test = $request->file('image_path')->getClientOriginalName();
            $request->file('image_path')->storeAs('images/', $test, 'public_uploads');

            $image = new Post;
            $image->user_id = $user_id;
            $image->image_path = $test;
            $image->save();
        } else {
        }

        if ($post == 1) { //$statusは投稿の公開ステータス 0：保留、1：公開
            $twitter = new TwitterOAuth(
                env('TWITTER_CLIENT_ID'),
                env('TWITTER_CLIENT_SECRET'),
                env('TWITTER_CLIENT_ID_ACCESS_TOKEN'),
                env('TWITTER_CLIENT_ID_ACCESS_TOKEN_SECRET')
            );
            $twitter->post("statuses/update", [
                "status" =>
                '💡新しい記事が投稿されました❗❗' . PHP_EOL .
                    '' . PHP_EOL .
                    '✋' . $post . '✨' . PHP_EOL .
                    '' . PHP_EOL .
                    'http://localhost/matching_app/public/' . $user_name . '/' . PHP_EOL .
                    '' . PHP_EOL .
                    '#プログラミング #プログラミング初心者 #プログラミング学習'
            ]);
        }

        return back();
    }

    //投稿一覧
    public function index()
    {

        $user_id = 1;
        $id = User::find(1)->id;


        // $posts = Post::where('user_id',$user_id)
        //          ->orderBy('created_at','desc')
        //          ->get();

        $users = \DB::table('users')
            ->where('users.id', $id)
            ->select('users.*')
            ->select('posts.*')
            ->leftjoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();

        $user_name = User::find(1)->name;


        return view('/users/post', compact('user_id', 'id', 'users', 'user_name'));
    }

    /////////////////////////////////相手とのトーク////////////////////////////////
    public function talkcreate(Request $request)
    {
        $user_id = 1;
        $talk = $request->input('newTalk');

        $talk_images = $request->file('image_path');

        if (isset($talk) && isset($talk_images)) {
            $test = $request->file('image_path')->getClientOriginalName();
            $request->file('image_path')->store('images/', '', $test);

            Post::insert([
                'user_id' => $user_id,
                'post' => $talk,
                'image_path' => $talk_images,
            ]);

            $image = new Post;
            $image->user_id = $user_id;
            $image->image_path = $talk;
            $image->save();
        } elseif (isset($talk) && !isset($talk_images)) {
            Post::insert([
                'user_id' => $user_id,
                'post' => $talk,
            ]);
        } elseif (!isset($talk) && isset($talk_images)) {
            $test = $request->file('image_path')->getClientOriginalName();
            $request->file('image_path')->store('images/', '', $test);

            $image = new Post;
            $image->user_id = $user_id;
            $image->image_path = $test;
            $image->save();
        } else {
        }
        return back();
    }

    public function talkindex()
    {
        $user = User::find(1)->user_id;

        $user_id = User::find(1)->id;

        $talks = Post::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $talker = \DB::table('users')
            ->where('posts.post', $user_id)
            ->select('users.*')
            ->leftjoin('posts', 'users.id', '=', 'posts.post')
            ->get();


        return view('/users/talk', compact('user', 'user_id', 'talks', 'talker'));
    }
}
