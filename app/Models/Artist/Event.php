<?php

namespace App\Models\Artist;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artist\Profile as ArtistProfile;
use App\Models\Artist\EventTag;
use App\Models\User\Region;
use App\Models\User\Place;

class Event extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artist_events';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'price',
        'start_at',
        'end_at',
        'contact_name',
        'contact_email',
        'contact_phone',
        'region_id',
        'place_id',
        'profile_id',
    ];

    public function artist()
    {
        return $this->belongsTo(ArtistProfile::class, 'profile_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(EventTag::class);
    }
    
    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function place()
    {
        return $this->hasOne(Place::class, 'id', 'place_id');
    }
}