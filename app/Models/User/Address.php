<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\Profile;
use App\Models\User\Region;
use App\Models\User\Place;

class Address extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_addresses';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'region_id',
        'place_id',
        'address',
        'profile_id',
    ];
    
    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function place()
    {
        return $this->hasOne(Place::class, 'id', 'place_id');
    }

    public function user_profile()
    {
        return $this->belongsTo(Profile::class, 'id', 'address_id');
    }
}
