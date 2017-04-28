<?php

namespace App\Models\Artist;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artist\Profile as ArtistProfile;
use App\Models\Artist\EventTag;

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
}