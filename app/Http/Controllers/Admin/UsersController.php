<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin', 'user_address']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('admin.manage.users.index')->withUsers($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $user = User::find($user);
        if(!$user)
            return redirect()->route('users.index');

        return view('admin.manage.users.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $user = User::find($user);
        if(!$user)
            return redirect()->route('users.index');

        return view('admin.manage.users.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $user = User::find($user);
        if(!$user)
            return redirect()->route('users.index');

        $validation = $this->validator($request->all(), $user->profile->id)->validate();

        if($validation)
        {
            return $validation;
        }

        $profile = $user->profile;
        $profile->screen_name = $request['screen_name'];
        $profile->first_name = $request['first_name'];
        $profile->last_name = $request['last_name'];
        $profile->save();

        return redirect()->route('users.show', ['user' => $user->id])->withSuccess('Profile updated!');
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
            'screen_name' => 'required|max:50|unique:user_profiles,screen_name,' . $id,
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_number' => 'required|numeric|unique:user_profiles,phone_number,' . $id,
        ]);
    }
}
