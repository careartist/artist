<?php

namespace App\Http\Controllers\Artist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Artist\Profile as ArtistProfile;
use App\Models\User\Ucare;
use Sentinel;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('artist');
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
        
        $artist_profile = ArtistProfile::where('user_id', Sentinel::getUser()->id)->first();

        if($artist_profile->artist_bio)
        {
            return view('artist.profile.index')->with(['user' => $user, 'ucare' => $ucare]);
        }

        return redirect()->route('artist.profile.create');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artist_profile = ArtistProfile::where('user_id', Sentinel::getUser()->id)->first();

        if($artist_profile->artist_bio)
        {
            return redirect()->route('artist.profile.edit');
        }

        return view('artist.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validator($request->all())->validate();

        if($validation)
        {
            return $validation;
        }

        $artist_profile = ArtistProfile::where('user_id', Sentinel::getUser()->id)->first();

        $artist_profile->artist_bio()->create([
            'bio' => $request['bio'],
            'tags' => $request['tags'],
            'subdomain' => $request['subdomain'],
        ]);
        return redirect()->route('artist.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $artist_profile = ArtistProfile::where('user_id', Sentinel::getUser()->id)->first();

        if(!$artist_profile->artist_bio)
        {
            return redirect()->route('artist.profile.create');
        }

        return view('artist.profile.edit')->withProfile($artist_profile->artist_bio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $artist_profile = ArtistProfile::where('user_id', Sentinel::getUser()->id)->first();

        if(!$artist_profile->artist_bio)
        {
            return redirect()->route('artist.profile.create');
        }

        $this->validate($request, [
            'bio' => 'required',
        ]);

        $artist_bio = $artist_profile->artist_bio;

        $artist_bio->bio =  $request->bio;
        $artist_bio->save();

        return redirect()->route('artist.profile')->with('success', 'Artist Bio updated!');
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
            'bio' => 'required',
            'tags' => 'required',
            'subdomain' => 'bail|required|string|max:50|unique:artist_profiles_bio',
        ]);
    }

}
