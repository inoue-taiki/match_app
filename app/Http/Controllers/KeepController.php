<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;
use App\Models\Keep;
use Auth;

class KeepsController extends Controller
{
    public function keep(){

        return view('/users/keep');
    }
}
