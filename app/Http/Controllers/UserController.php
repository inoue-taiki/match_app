<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;
use App\Models\Keep;
use Auth;

class UserController extends Controller
{
    public function index(){

        return view('top');
    }
}
