<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User\Ucare;
use sentinel;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user_address');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ucare = Ucare::getLowestUploads();
        $user = Sentinel::getUser();
        $user->ucare_id = $ucare->id;
        $user->save();
        
        return view('user.profile.index')
                    ->withUser($user)
                    ->withUcare($ucare);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $profile = Sentinel::getUser()->profile;
        return view('user.profile.edit')->withProfile($profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profile = Sentinel::getUser()->profile;

        $this->validate($request, [
            // 'screen_name' => 'bail|required|max:50|unique:user_profiles,screen_name,' . $profile->id,
            // 'first_name' => 'required|string|max:50',
            // 'last_name' => 'required|string|max:50',
            'phone_number' => 'bail|required|numeric|unique:user_profiles,phone_number,' . $profile->id,
        ]);

        // $profile->screen_name = $request['screen_name'];
        // $profile->first_name = $request['first_name'];
        // $profile->last_name = $request['last_name'];
        $profile->phone_number = $request['phone_number'];
        $profile->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated!');
    }

    /**
     * Get a validator for an incoming address request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $id)
    {
        return Validator::make($data, [
            'screen_name' => 'bail|required|max:50|unique:user_profiles,screen_name,' . $id,
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_number' => 'bail|required|numeric|unique:user_profiles,phone_number,' . $id,
        ]);
    }
}
