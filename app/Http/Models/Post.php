<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function follows()
    {
        return $this->belongsTo('App\Models\Follow');
    }

}

