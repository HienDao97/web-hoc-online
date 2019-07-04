<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntroduceController extends Controller
{
    public function index(){
        //dd(1);
        return view('gioi-thieu.index');
    }
}
