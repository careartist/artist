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

        $profile = Sentinel::getUser()->profile;
        if(!$profile->address)
        {
            return redirect()->route('user.address.create');
        }
        
    	return redirect()->route('user.dashboard');
    }

    public function logout()
    {
    	Sentinel::logout();
    	return redirect()->route('home');
    }
}