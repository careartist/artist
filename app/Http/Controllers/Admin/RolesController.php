<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\User;
use Sentinel;

class RolesController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_role = Sentinel::findRoleBySlug('admin');
        $artist_role = Sentinel::findRoleBySlug('artist');
        $seller_role = Sentinel::findRoleBySlug('seller');
        $buyer_role = Sentinel::findRoleBySlug('buyer');
        $bidder_role = Sentinel::findRoleBySlug('bidder');

        $admins = $admin_role->users()->with('roles')->get();
        $artists = $artist_role->users()->with('roles')->get();
        $sellers = $seller_role->users()->with('roles')->get();
        $buyers = $buyer_role->users()->with('roles')->get();
        $bidders = $bidder_role->users()->with('roles')->get();


        return view('admin.manage.roles.index')->with([
            'admins' => $admins,
            'artists' => $artists,
            'sellers' => $sellers,
            'buyers' => $buyers,
            'bidders' => $bidders,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $role = Sentinel::findRoleBySlug($slug);
        $users = $role->users()->with('roles')->get();
        return view('admin.manage.roles.show')->with(['users' => $users, 'role' => $slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userRoles($id)
    {

        $user = User::find($id);
        $roles = Sentinel::getRoleRepository()->get();
        return view('admin.manage.users.roles')->with(['user' => $user, 'roles' => $roles]);
    }
}
