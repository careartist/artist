<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\RoleRequest;
use App\Models\Artist\Profile as ArtistProfile;
use Sentinel;

class ManageRequestController extends Controller
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

    public function acceptRequest($id)
    {
    	$request_role = RoleRequest::find($id);
    	$artist_profile = ArtistProfile::find($request_role->artist_profile_id);
		$user = Sentinel::findById($request_role->user_id);

        if($request_role->role == 'uap')
        {
            $role_artist = Sentinel::findRoleBySlug('artist');
            $role_artist->users()->attach($user);

            $role_seller = Sentinel::findRoleBySlug('seller');
            $role_seller->users()->attach($user);
        }
        elseif($request_role->role == 'artist')
        {
        	$role = Sentinel::findRoleBySlug('artist');
        	$role->users()->attach($user);
        }

    	$request_role->delete();
    	
    	$artist_profile->approved = 1;
    	$artist_profile->operated_by = Sentinel::getUser()->id;
    	$artist_profile->operated_at = \Carbon\Carbon::now();
    	$artist_profile->save();
    	
    	return redirect()->route('requests.index');
    }

    public function rejectRequest($id)
    {
    	$request_role = RoleRequest::find($id);
    	$artist_profile = ArtistProfile::find($request_role->artist_profile_id);

    	$artist_profile->rejected = 1;
    	$artist_profile->operated_by = Sentinel::getUser()->id;
    	$artist_profile->operated_at = \Carbon\Carbon::now();
    	$artist_profile->save();

    	$request_role->delete();
    	
    	return redirect()->route('requests.index');
    }
}
