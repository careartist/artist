<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User\Address;
// use App\Models\User\Place;
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

        return view('admin.manage.address.edit')
                ->withAddress($address)
                ->withRegions($regions);
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
        $address->place = $request['place'];
        $address->address = $request['address'];
        $address->save();

        return redirect()->route('users.show', ['user' => $address->user_profile->user_id])->withSuccess('Address updated!');
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
