<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Cartalyst\Sentinel\Users\EloquentUser;
use App\Models\User\Profile;

class User extends EloquentUser
{
    use Notifiable;

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
