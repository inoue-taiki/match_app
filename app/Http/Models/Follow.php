<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //  テーブル名参照
    protected $table = 'follow';

     //リレーション
     public function user()
     {
         return $this->belongsTo('App\Models\User');
     }

     public function posts()
     {
         return $this->belongsTo('App\Models\Post');
     }
}
