<?php

namespace App\Http\Controllers;

use App\Http\Models\Keep as ModelsKeep;
use Illuminate\Http\Request;
use App\Http\Models\Follow;
use App\Http\Models\User;
use App\Http\Models\Keep;
use Auth;

class KeepController extends Controller
{
     //お気に入り画面に追加
    public function add($id){
        //$user_id = Auth::id();
        $user_id = 1;//ログインユーザー

         $keep = new Keep;
         $keep->user_id=$user_id;
         $keep->other_id = $id;
         $keep->save();

         return redirect()->route('user.keep');
     }

    public function keep(){

        return view('/users/keep');
    }
}
