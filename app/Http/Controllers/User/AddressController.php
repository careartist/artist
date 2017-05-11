<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User\Address;
use App\Models\User\Region;
use Sentinel;

class AddressController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Sentinel::getUser()->profile->address()->first();
        return view('user.address.index')->withAddress($address);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $address = Sentinel::getUser()->profile->address()->first();

        if($address)
        {
            return redirect()->route('user.address');
        }

        $regions = Region::select('id', 'place')->orderBy('place', 'asc')->get();

        return view('user.address.create')->withRegions($regions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = Sentinel::getUser()->profile;
        $address = $profile->address()->first();

        if($address)
        {
            return redirect()->route('user.address');
        }

        $validation = $this->validator($request->all())->validate();

        if($validation)
        {
            return $validation;
        }

        $address = new Address;

        $address->region_id = $request['region'];
        $address->place = $request['place'];
        $address->address = $request['address'];
        $address->save();

        $profile->address_id = $address->id;
        $profile->save();

        return redirect()->route('user.address');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Sentinel::getUser();
        $address = $user->profile->address;
        $regions = Region::select('id', 'place')->orderBy('place', 'asc')->get();

        return view('user.address.edit')
                ->withAddress($address)
                ->withRegions($regions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = $this->validator($request->all())->validate();

        if($validation)
        {
            return $validation;
        }

        $user = Sentinel::getUser();
        $address = $user->profile->address;

        $address->region_id = $request['region'];
        $address->place = $request['place'];
        $address->address = $request['address'];

        $address->save();

        return redirect()->route('user.profile')->with('success', 'Address updated!');
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
            'region' => 'required|numeric',
            'place' => 'required|string|max:190',
            'address' => 'required|string|max:190',
        ]);
    }
}
