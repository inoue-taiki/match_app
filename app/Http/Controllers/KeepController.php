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

     //削除する
     public function delete($id){

        \DB::table('keeps')
        ->where('other_id',$id)
        ->delete();

        return back();
     }

    //お気に入り画面
    public function keep(){
        $user_id = 1;
        $id = User::find(1)->id;
        
        $keeps = Keep::where('user_id',$user_id)
               ->leftjoin('users','users.id','=','keeps.other_id')
               ->groupBy('other_id')
               ->get();
      
        $follower = \DB::table('follows')
                  ->leftjoin('users','follows.follower','=','users.id')
                  ->where('follower',$id)
                  ->get();

        $follower_user = []; 
        foreach ($follower as $follower_id){
        $follower_user[] = $follower_id->follow;
        }

        $following = \DB::table('follows')
                        ->where('follower',$id)
                        ->get();

        $following_user = []; 
        foreach ($following as $following_id){
        $following_user[] = $following_id->follow;
        }

        $match_lists = \DB::table('users')
                    ->where('follows.follow',$id)
                    ->whereIn('follows.follower',$follower_user)
                    ->select('users.*')
                    ->leftjoin('follows','follows.follower','users.id')
                    ->groupBy('follower')
                    ->get();
                   
    
        $request_lists = \DB::table('users')
                        ->where('follows.follow',$id)
                        ->whereNotIn('follows.follower',$following_user)
                        ->select('users.*')
                        ->leftjoin('follows','follows.follower','users.id')
                        ->groupBy('follower')
                        ->get();
                        

        $requested_lists = \DB::table('users')
                        ->where('follows.follower',$id)
                        ->whereNotIn('follows.follow',$following_user)
                        ->select('users.*')
                        ->leftjoin('follows','follows.follow','users.id')
                        ->get();

        return view('/users/keep',compact('user_id','id','keeps','requested_lists','request_lists','match_lists','following_user','follower_user'));
    }


}
