<?php

namespace App\Models\Artist;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artist\Event;

class EventTag extends Model
{
    public function events()
    {
    	return $this->belongsToMany(Event::class);
    }
}
