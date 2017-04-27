<?php

namespace App\Http\Controllers\User;

use Storage;
use Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User\Profile;
use App\Models\User\Ucare;
use Sentinel;

class AvatarController extends Controller
{
    public function ajaxAvatar(Request $request, Profile $profile)
    {

        $validation = $this->validator($request->all())->validate();

        if($validation)
        {
            return $validation;
        }

        $ucare = Ucare::find(Sentinel::getUser()->ucare_id);

        $headers = array('Accept' => 'application/json');
        $options = array('Authorization' => array('Uploadcare.Simple', $ucare->public_key.':'.$ucare->private_key));
        $image = Requests::get($request['avatar'].'-/resize/150x150/', $headers, $options);

        $avatar = Storage::put(
            'public/avatars/'.$profile->id.'.jpg', $image->body
        );

        $profile->avatar = 'storage/avatars/'.$profile->id.'.jpg';
        $profile->save();

        return $avatar ? $profile->avatar : 'error';
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
            'avatar' => 'required',
        ]);
    }
}
