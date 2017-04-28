<?php

namespace App\Http\Controllers\Artist;

use Storage;
use Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Artist\Event;
use App\Models\User\Ucare;
use Sentinel;

class EventCoverController extends Controller
{
    public function ajaxCover(Request $request, Event $event)
    {

        $validation = $this->validator($request->all())->validate();

        if($validation)
        {
            return $validation;
        }

        $ucare = Ucare::find(Sentinel::getUser()->ucare_id);

        $headers = array('Accept' => 'application/json');
        $options = array('Authorization' => array('Uploadcare.Simple', $ucare->public_key.':'.$ucare->private_key));
        $image = Requests::get($request['cover'].'-/resize/900x300/', $headers, $options);

        $cover = Storage::put(
            'public/artist/events/'.$event->id.'.jpg', $image->body
        );

        $event->cover = 'storage/artist/events/'.$event->id.'.jpg';
        $event->save();

        return $cover ? $event->cover : 'error';
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
            'cover' => 'required',
        ]);
    }
}
