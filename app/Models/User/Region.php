<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artist\Event;
use App\Models\User\PlacePivot;
use App\Models\User\Place;

class Region extends Model
{
    public function events()
    {
    	return $this->belongsToMany(Event::class);
    }

    public function places()
    {
    	return $this->hasMany(PlacePivot::class, 'sirsup', 'id')

            ->leftjoin('places', 'places_ref.id', '=', 'places.sirsup')

            ->select('places.*');

    	// return $this->hasMany(Place::class, PlacePivot::class, 'sirsup', 'id', 'id' );
    }
}
