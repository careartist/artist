<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\Ucare;
use Sentinel;

class UcareController extends Controller
{
    public function increment()
    {
    	$ucare = Ucare::find(Sentinel::getUser()->ucare_id);
        $ucare->increment('uploads');
        $ucare->save();
    }
}
