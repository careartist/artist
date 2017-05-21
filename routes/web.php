<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('home')->get('/', function () {
    return view('welcome');
});

Route::name('auth.register')->get('/register', 'Auth\RegistrationController@register');
Route::post('/register', 'Auth\RegistrationController@postRegister');

Route::name('auth.login')->get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@postLogin');
Route::name('auth.logout')->post('/logout', 'Auth\LoginController@logout');

Route::name('public.events')->get('events', 'EventController@index');
Route::name('public.events.show')->get('event/{id}/{title}', 'EventController@show');
Route::name('public.events.tag')->get('events/tag/{tag}', 'EventController@showTags');
Route::name('public.events.type')->get('events/type/{type}', 'EventController@showTypes');

Route::prefix('user')->group(function() {

	Route::name('user.dashboard')->get('/', 'User\DashboardController@index');

	Route::prefix('profile')->group(function() {
		Route::name('user.profile')->get('/', 'User\ProfileController@index');
		Route::name('user.profile.edit')->get('/edit', 'User\ProfileController@edit');
		Route::name('user.profile.update')->put('/edit', 'User\ProfileController@update');
	});

	Route::prefix('address')->group(function() {
		Route::name('user.address')->get('/', 'User\AddressController@index');
		Route::name('user.address.create')->get('/create', 'User\AddressController@create');
		Route::name('user.address.store')->post('/create', 'User\AddressController@store');
		Route::name('user.address.edit')->get('/edit', 'User\AddressController@edit');
		Route::name('user.address.update')->put('/edit', 'User\AddressController@update');
	});

	Route::prefix('artist')->group(function() {
		Route::name('artist.profile')->get('/profile', 'Artist\ProfileController@index');
		Route::name('artist.profile.create')->get('/profile/add', 'Artist\ProfileController@create');
		Route::name('artist.profile.store')->post('/profile/add', 'Artist\ProfileController@store');
		Route::name('artist.profile.edit')->get('/profile/edit', 'Artist\ProfileController@edit');
		Route::name('artist.profile.update')->put('/profile/edit', 'Artist\ProfileController@update');

		Route::resource('/artist/events', 'Artist\EventController');
	});
	
	Route::get('/event-place/{region}', 'Artist\EventController@ajaxCities');

	Route::name('user.request.role.create')->get('/request/role', 'User\RoleRequestController@create');
	Route::name('user.request.role.store')->post('/request/role', 'User\RoleRequestController@store');
	Route::name('user.request.role.show')->get('/requests/role/{request}', 'User\RoleRequestController@show');

	Route::prefix('admin')->group(function() {

		Route::prefix('manage')->group(function() {
			Route::resource('/users', 'Admin\UsersController');
			Route::resource('/address', 'Admin\AddressController');
			Route::resource('/roles', 'Admin\RolesController');
			Route::name('user.roles')->get('/users/{user}/roles', 'Admin\RolesController@userRoles');

			// Route::prefix('role')->group(function() {
				Route::resource('/role/requests', 'Admin\RoleRequestController');
			// });
		});

		Route::prefix('role')->group(function() {
			Route::name('assign.role')->post('/assign/{user}/{role}', 'Admin\ManageRolesController@assignRole');
			Route::name('remove.role')->post('/remove/{user}/{role}', 'Admin\ManageRolesController@removeRole');
			Route::name('accept.request')->post('/request/accept/{profile}', 'Admin\ManageRequestController@acceptRequest');
			Route::name('reject.request')->post('/request/reject/{profile}', 'Admin\ManageRequestController@rejectRequest');
		});

	});

	Route::get('/ajax-places/{region}', 'User\AddressController@ajaxCities');
	Route::name('ucare.increment')->post('/ucare-increment', 'User\UcareController@increment');
	Route::name('user.avatar')->post('/ajax-avatar/{profile}', 'User\AvatarController@ajaxAvatar');
	Route::name('event.cover')->post('/ajax-cover/{event}', 'Artist\EventCoverController@ajaxCover');
});

// Route::prefix('services')->group(function() {
// 	Route::prefix('describe')->group(function() {
// 		Route::name('describe.role')->get('/role/{role}', 'User\DescribeRoleController@role');
// 	});
// });