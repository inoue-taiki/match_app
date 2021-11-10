<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\Schedule;

class ScheduleController extends Controller
{
    
    //スケジュール追加
    public function schedule_add(Request $request){
      $user = User::all(); 
      $user_id = 1;

      $event = $request->input('newEvent');
      $date = $request->input('newDate');
      $memo = $request->input('newMemo');

      $event_lists = new Schedule;
      $event_lists->user_id=$user_id;
      $event_lists->event=$event;
      $event_lists->date=$date;
      $event_lists->memo=$memo;
      $event_lists->save();

     
      

      return view('/users/schedule',compact('event_lists'));
    }

    //スケジュール画面
    public function schedule(){

      $lists = Schedule::all();
      

      return view('/users/schedule',compact('lists'));
      }

      //  編集・更新部分
      public function schedule_edit(Request $request)
      {
        $user = User::find(1);
        $lists = Schedule::all();

        $edit = $request->input('edit'); //入力されているname属性（title）を$editとして定義
  
        //$update = $request->input('update');//新しく入力されたname属性を$updateとして定義
        
        

        Schedule::where('memo',$user)->update([
          'memo'=>$edit,
        ]);
            
          
        return view('/users/schedule',compact('user','lists','input','edit'));
      }
}
