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
    //                  フォローされている人の定義                  //
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

    $match_lists = \DB::table('users')
                     ->where('follows.follow',$id)
                     ->whereIn('follows.follower',$follower_user)
                     ->select('users.*')
                     ->leftjoin('follows','follows.follower','users.id')
                     ->get();

    $requested_lists = \DB::table('users')
                        ->where('follows.follower',$id)
                        ->select('users.*')
                        ->leftjoin('follows','follows.follow','users.id')
                        ->get();
    
    //フォローしてるリスト
    $request_lists = \DB::table('users')
                       ->where('follows.follow',$id)
                       ->whereNotIn('follows.follower',$following_user)
                       ->select('users.*')
                       ->leftjoin('follows','follows.follower','users.id')
                       ->get();

        return view('/users/profile',compact('user','user_id','id','follower','follower_user','match_lists','requested_lists','request_lists'));
    }

    //プロフィール編集
    public function update(Request $request){
        $user = User::find(1);

        // //新しく入力したもの
        $edit_images = $request->file('image_path');
        $edit_name = $request->input('name');
        $edit_mail = $request->input('email');
        $edit_password = $request->input('newpassword');
        $edit_bio = $request->input('bio');

        if(isset($edit_password) && isset($edit_images)){
             $test = $request->file('image_path')->getClientOriginalName();
             $request->file('image_path')->storeAs('image_path',$test,'public_uploads');

             User::where('id',$user)->update([
                 'name' => $edit_name,
                 'email' => $edit_mail,
                 'password' => $edit_password,
                 'bio' => $edit_bio,
                 'image_path' => $test,
             ]);
         }
         elseif(isset($edit_password) && !isset($edit_images)){
             User::where('id',$user)->update([ 
                    'name' => $edit_name,
                    'email' => $edit_mail,
                    'password' => $edit_password,
                    'bio' => $edit_bio,
                ]);
        }
        elseif(!isset($edit_password) && isset($edit_images)){
            $test = $request->file('image_path')->getClientOriginalName();
            $request->file('image_path')->storeAs('image_path',$test,'public_uploads');

             User::where('id',$user)->update([ 
               'name' => $edit_name,
               'email' => $edit_mail,
               'bio' => $edit_bio,
               'image_path' => $test
           ]);
        }
        else{
             User::where('id',$user)->update([ 
               'name' => $edit_name,
               'email' => $edit_mail,
               'bio' => $edit_bio,
           ]);
        }
  
        return view('/users/profile_update',compact('user','edit_images','edit_name','edit_mail','edit_password','edit_bio'));
    }

    ////////////////////////////////      検索       //////////////////////////////////////
    public function search(Request $request){
        $words = $request->input('userwords');
        $id = 1;
        $users = User::where('id','<>',1)->where('name', 'like', '%'.$words.'%')->get();
        
    
        //フォローされている人
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
                     ->first();
        
        $request_lists = \DB::table('users')
                       ->where('follows.follow',$id)
                       ->whereNotIn('follows.follower',$following_user)
                       ->select('users.*')
                       ->leftjoin('follows','follows.follower','users.id')
                       ->first();

        $requested_lists = \DB::table('users')
                         ->where('follows.follower',$id)
                         ->whereNotIn('follows.follow',$following_user)
                         ->select('users.*')
                         ->leftjoin('follows','follows.follow','users.id')
                         ->first();
  
        return view('/users/search',compact('users','match_lists','id','follower_user','following_user','request_lists','requested_lists'));
      }
  

      public function request($id){
        
        

          return redirect('/users/search');
      }
  
      //相手ユーザー画面
      public function other($other_id){
        $user_id = User::find(1);
        $other_id = User::whereNotIn('id', $user_id)->get();//指定ユーザー以外を指定
    
        return view('/users/other');
      }
}
