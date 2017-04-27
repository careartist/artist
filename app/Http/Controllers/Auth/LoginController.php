<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;

class LoginController extends Controller
{
    public function login()
    {
    	return view('auth.login');
    }
    
    public function postLogin(Request $request)
    {
    	Sentinel::authenticate($request->all());
    	return redirect()->route('home');
    }

    public function logout()
    {
    	Sentinel::logout();
    	return redirect()->route('home');
    }
}