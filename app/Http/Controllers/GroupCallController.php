<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupCallController extends Controller
{
    public function room(){
        return view('group_calls.room');
    }
}
