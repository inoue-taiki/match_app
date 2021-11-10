<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
