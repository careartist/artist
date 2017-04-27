<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
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
}
