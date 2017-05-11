<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User\Profile;
use Sentinel;

class RegistrationController extends Controller
{
    public function register()
    {
    	return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        // dd($request->all());
        // Laravel validation
        $validation = $this->validator($request->all())->validate();

        if($validation)
        {
            return $validation;
        }


        $data_user = [
            'email' => $request['email'],
            'password' => $request['password'],
            'password_confirm' => $request['password_confirmation'],
        ];

        $user = Sentinel::registerAndActivate($data_user);

        $profile = Profile::create([
            'screen_name' => $request['screen_name'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'account_type' => $request['account_type'],
            'user_id' => $user->id,
        ]);

        return redirect()->route('home')->with('success', 'Account registered. Please confirm your email!');;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'account_type' => 'required|string|max:50',
            'screen_name' => 'bail|required|string|max:50|unique:user_profiles',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_number' => 'bail|required|numeric|digits:10|unique:user_profiles',
            'email' => 'bail|required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
    }
}