<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Keep extends Model
{
    // テーブル名参照
    protected $table = 'keeps';

    //リレーション
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

}
