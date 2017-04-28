<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Sentinel;

class ManageRolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin', 'user_address']);
    }

    public function assignRole($user, $role)
    {
    	$user = Sentinel::findById($user);
    	$role = Sentinel::findRoleById($role);
    	$role->users()->attach($user);

        return back();
    }

    public function removeRole($user, $role)
    {
    	$user = Sentinel::findById($user);
    	$role = Sentinel::findRoleById($role);
    	$role->users()->detach($user);
        
    	return back();
    }
}
