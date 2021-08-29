<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    //マッチしているユーザー
    public function match(){

        return view('/follows/match');
    }
  
    //リクエストしているユーザー
    public function follow(){
  
        return view('/follows/follow');
    }
  
    //リクエストされているユーザー
    public function follower(){
  
        return view('/follows/follower');
    }
}
