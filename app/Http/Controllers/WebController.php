<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home(Request $request){
        return view('home', [
            'user' => $request->user()
        ]);
    }

    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }
}
