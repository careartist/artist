<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Ucare extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ucare';


	public static function getLowestUploads()
	{
	    return self::orderBy('uploads', 'asc')->first();
	}
}
