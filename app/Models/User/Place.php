<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artist\Event;
use App\Models\User\PlacePivot;
use App\Models\User\Place;

class Place extends Model
{

    public function places()
    {
    	return $this->hasManyThrough(Place::class, PlacePivot::class, 'id', 'sirsup', 'id' );
    }
	
}
