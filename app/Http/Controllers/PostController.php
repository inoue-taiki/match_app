<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\Post;
use Auth;

class PostController extends Controller
{
    //トーク画面
    public function talk(){

        return view('/users/talk');
    }

    //トーク詳細画面
    public function create(Request $request){

        //$user_id = Auth::id();
        $user_id = User::find(1);
        $post = $request->input('newPost');

        return view('/users/talk_detail');
    }
}
