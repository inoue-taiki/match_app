<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Http\Models\User;
use App\Models\Keep;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //トップ画面
    public function index(){

        return view('top');
    }

    //プロフィール画面
    public function profile(){
        $user = User::find(1);
        
        return view('/users/profile',compact('user'));
    }

    //プロフィール編集
    public function update(Request $request){
        $user = User::find(1);

        
  
        return view('/users/profile_update',compact('user'));
    }

}
