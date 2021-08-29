<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //  テーブル名参照
    protected $table = 'follow';

     //リレーション
     public function users()
     {
         return $this->belongsTo('App\Models\User');
     }

     public function posts()
     {
         return $this->belongsTo('App\Models\Post');
     }
}
