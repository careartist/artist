<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\PlacePivot;
use App\Models\User\Place;

class PlacePivot extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'places_ref';

    public function place()
    {
    	return $this->manyToMany(Place::class, 'id', 'sirsup');
    }
}
