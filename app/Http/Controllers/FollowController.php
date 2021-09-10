<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\Follow;
use Auth;

class FollowController extends Controller
{
    /////////////////////////////////マッチング画面///////////////////////////////////////
    public function match(){
        //$user_id = Auth::id()->user_id;
        //$id = Auth::id()->id;
        $user_id = User::find(1)->user_id;
        $id = User::find(1)->id;

        //フォローされている人
        $follower = \DB::table('follows')
                  ->leftjoin('users','follows.follower','=','users.id')
                  ->where('follower',$id)
                  ->get();


        //フォローされている人のID
        $follower_user = []; 
        //フォローされている人のIDを配列化
        foreach ($follower as $follower_id){
        $follower_user[] = $follower_id->follow;
        }
        
        //フォローしている人
        $following = \DB::table('follows')
                   ->where('follow',$id)
                   ->get();

        //フォローしている人のID
        $following_user = []; 
        //フォローしてる人のIDを配列化
        foreach ($following as $following_id){
        $following_user[] = $following_id->follow;
        } 
        

        //フォローしあっているリスト（マッチング）
        $match_lists = \DB::table('users')
                     ->where('follows.follow',$id)
                     ->whereIn('follows.follower',$follower_user)
                     ->select('users.*')
                     ->leftjoin('follows','follows.follower','users.id')
                     ->get();
        

        return view('/follows/match',compact('user_id','id','follower','follower_user','following','following_user','match_lists'));
    }
    //  マッチング画面  //
    //フォロー外す
    public function unfollow($id){

        \DB::table('follows')
        ->where('follow',$id)//フォローしてる人
        ->delete();

        $match_lists = \DB::table('users')
                     ->where('follows.follow',$id)
                     ->select('users.*')
                     ->leftjoin('follows','follows.follow','users.id')
                     ->get();

        return back();
    }
  
    ////////////////////////////////////リクエスト中画面//////////////////////////////////
    public function follow(){
            //$user_id = Auth::id()->user_id;
            //$id = Auth::id()->id;
            $user_id = User::find(1)->user_id;
            $id = User::find(1)->id;

            //フォローしている人
            $following = \DB::table('follows')
                       ->where('follower',$id)
                       ->get();

            $following_user = []; 
            foreach ($following as $following_id){
            $following_user[] = $following_id->follow;
            } 

            //フォローしてるリスト
            $request_lists = \DB::table('users')
                         ->where('follows.follow',$id)
                         ->whereNotIn('follows.follower',$following_user)
                         ->select('users.*')
                         ->leftjoin('follows','follows.follower','users.id')
                         ->get();


        return view('/follows/follow',compact('user_id','id','following','following_user','request_lists'));
    }
    public function unrequest($id){

        \DB::table('follows')
        ->where('follower',$id)
        ->delete();

        $following = \DB::table('follows')
                       ->where('follower',$id)
                       ->get();

        $following_user = []; 
        foreach ($following as $following_id){
        $following_user[] = $following_id->follow;
        } 

        $request_lists = \DB::table('users')
                       ->where('follows.follow',$id)
                       ->whereNotIn('follows.follower',$following_user)
                       ->select('users.*')
                       ->leftjoin('follows','follows.follower','users.id')
                       ->get();
        return back();
    }
  

    


    //////////////////////////////////////////リクエスト受け中画面/////////////////////////////////

    public function follower(){

        //ログインユーザー
        //$user_id = Auth::id()->user_id;
        //$id = Auth::id()->id;
        $user_id = User::find(1)->user_id;
        $id = User::find(1)->id;

        //フォローしている人
        $following = \DB::table('follows')
                   ->where('follower',$id)
                   ->get();
        //フォローしている人のID
        $following_user = []; 
        //フォローしてる人のIDを配列化
        foreach ($following as $following_id){
            $following_user[] = $following_id->follow;
        } 
        
        
        //フォローされている人
        $follower = \DB::table('follows')
                  ->leftjoin('users','follows.follow','=','users.id')
                  ->where('follow',$id)
                  ->get();
        //フォローされている人のID
        $follower_user = []; 
        //フォローされている人のIDを配列化
        foreach ($follower as $follower_id){
        $follower_user[] = $follower_id->follow;
        }
        
        //フォローされているリスト（リクエスト受け中）
        $requested_lists = \DB::table('users')
                        ->where('follows.follower',$id)
                        ->whereNotIn('follows.follow',$follower_user)
                        ->select('users.*')
                        ->leftjoin('follows','follows.follow','users.id')
                        ->get();
                        
        
        return view('/follows/follower',compact('user_id','id','follower','follower_user','following','following_user','requested_lists'));
    }

    //リクエスト許可
    public function add($id){

        //$user_id = Auth::id()->user_id;
        $user_id = User::find(1)->user_id;

         //フォローされている人
         $follower = \DB::table('follows')
         ->leftjoin('users','follows.follow','=','users.id')
         ->where('follow',$id)
         ->get();
        //フォローされている人のID
        $follower_user = []; 
        //フォローされている人のIDを配列化
        foreach ($follower as $follower_id){
        $follower_user[] = $follower_id->follow;
        }

        $approve = new Forrow;
        $approve->follow=$user_id;
        $approve->follower=$follower_user;
        $approve->save();
        
        return redirect('follow.match',compact('user_id','follower_user','approve'));
    }
    //リクエスト拒否
    public function decline($id){

        \DB::table('follows')
        ->where('follow',$id)//フォローしてる人
        ->delete();

        $requested_lists = \DB::table('users')
                        ->where('follows.follower',$id)
                        ->select('users.*')
                        ->leftjoin('follows','follows.follow','users.id')
                        ->get();

        return back();
    }
}
