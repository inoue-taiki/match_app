<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;

class PostController extends Controller
{
    //トーク画面
    public function talk(){

        return view('/users/talk');
    }

    //トーク詳細画面
    public function create(Request $request){

        return view('/users/talk_detail');
    }
}
