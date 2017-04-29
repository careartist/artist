<?php

namespace App\Models\Artist;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artist\Event;

class EventTag extends Model
{/**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function events()
    {
    	return $this->belongsToMany(Event::class);
    }
}
