<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SingleCallController extends Controller
{
    public function lobby(){
        return view('single_calls.lobby');
    }

}
