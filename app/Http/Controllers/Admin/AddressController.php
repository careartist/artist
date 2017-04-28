<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User\Address;
use App\Models\User\Place;
use App\Models\User\Region;
use App\User;

class AddressController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit($address)
    {
        $address = Address::find($address);
        if(!$address)
            return redirect()->route('users.index');

        $regions = Region::select('id', 'place')->orderBy('place', 'asc')->get();
        $places = $this->ajaxCities($address->region_id);

        return view('admin.manage.address.edit')
                ->withAddress($address)
                ->withRegions($regions)
                ->withPlaces($places);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $address)
    {
        $address = Address::find($address);
        if(!$address)
            return redirect()->route('users.index');

        $validation = $this->validator($request->all())->validate();

        if($validation)
        {
            return $validation;
        }

        $address->region_id = $request['region'];
        $address->place_id = $request['place'];
        $address->address = $request['address'];
        $address->save();

        return redirect()->route('users.show', ['user' => $address->user_profile->user_id])->withSuccess('Address updated!');
    }

    public function ajaxCities($region_id)
    {
        return $regions = Place::select('places.id', 'places.place', 'c.id as p_id', 'c.place as p_place')
                        ->leftJoin('places as c', 'c.id', '=', 'places.sirsup')
                        ->whereIn('places.sirsup', Place::select('places.id')
                            ->where('places.sirsup', $region_id)
                            ->get()
                        )
                        ->orderBy('places.fsl', 'asc')->get();
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
            'place' => 'required|numeric',
            'address' => 'required|string|max:190',
        ]);
    }
}
