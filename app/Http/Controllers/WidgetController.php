<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function widget(){
        return view('widget');
    }

    public function test(){
        return view('test');
    }
}
