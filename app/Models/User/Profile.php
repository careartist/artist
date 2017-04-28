<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artist\Profile as ArtistProfile;
use App\Models\User\Address;
use App\User;

class Profile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_type',
        'screen_name',
        'first_name',
        'last_name',
        'phone_number',
        'avatar',
        'address_id',
        'user_id',
    ];

    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function artist_profile()
    {
        return $this->hasOne(ArtistProfile::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsToOne(User::class, 'user_id', 'id');
    }
}
