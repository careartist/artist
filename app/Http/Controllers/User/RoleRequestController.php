<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Artist\Profile as ArtistProfile;
use App\Models\User\RoleRequest;
use Sentinel;

class RoleRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = Sentinel::getUser()->profile;
        if($profile->account_type == 'uap')
            return view('user.request.uap');
        elseif($profile->account_type == 'artist')
            return view('user.request.artist');
        else
            return redirect()->route('user.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Sentinel::getUser();
        if(ArtistProfile::where('user_id')->first())
        {
            return redirect()->route('user.profile');
        }

        $validation = $this->validator($request->all())->validate();

        if($validation)
        {
            return $validation;
        }

        $artist_profile = ArtistProfile::create([
            'cui_number' => $request['cui_number'],
            'legal_name' => $request['legal_name'],
            'authority' => $request['authority'],
            'user_id' => $user->id,
        ]);

        RoleRequest::create([
            'artist_profile_id' => $artist_profile->id,
            'user_id' => $user->id,
            'role' => $user->profile->account_type,
        ]);

        return redirect()->route('user.profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get a validator for an incoming address request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'cui_number' => 'required|max:50|unique:artist_profiles',
            'legal_name' => 'required|max:190',
            'authority' => 'required|max:190',
        ]);
    }
}
