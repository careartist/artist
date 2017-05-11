<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artist\Event;

class Region extends Model
{
    public function events()
    {
    	return $this->belongsToMany(Event::class);
    }
}
