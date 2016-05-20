<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('home', 'WelcomeController@index');

// Verification
Route::get('verify/{verificationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'ActivationController@confirm'
]);

Route::controllers([
    'password' => 'Auth\PasswordController',
]);

// Authentucation
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(array('namespace' => 'Open', 'prefix' => 'v1/open', 'middleware' => ['oauth', 'oauth-user', 'role']), function() {
    Route::resource('authenticatedUser', 'AuthenticatedUserController', ['only' => ['index', 'destroy', 'update']]);
});

Route::group(array('namespace' => 'Staff', 'prefix' => 'v1/staff', 'middleware' => ['oauth', 'oauth-user', 'role']), function() {
    Route::resource('authenticatedUser', 'AuthenticatedUserController', ['only' => ['index', 'destroy', 'update']]);
    Route::resource('packages', 'PackageController');
    Route::resource('tests', 'TestController');
    Route::resource('bookings', 'BookingController');
    Route::resource('vendors', 'VendorController');
    Route::resource('users', 'UserController');
    Route::resource('bookingSlots', 'BookingSlotController', ['only' => ['index']]);
});

Route::group(array('namespace' => 'Vendor', 'prefix' => 'v1/vendor', 'middleware' => ['oauth', 'oauth-user', 'role']), function() {
    Route::resource('authenticatedUser', 'AuthenticatedUserController', ['only' => ['index', 'destroy', 'update']]);
    Route::resource('packages', 'PackageController', ['only' => ['index']]);
    Route::resource('tests', 'TestController', ['only' => ['index']]);
    Route::resource('bookings', 'BookingController');
    Route::resource('vendors', 'VendorController');
    Route::resource('users', 'UserController');
    Route::resource('bookingSlots', 'BookingSlotController', ['only' => ['index']]);
});

Route::group(array('namespace' => 'Admin', 'prefix' => 'v1/admin', 'middleware' => ['oauth', 'oauth-user', 'role']), function() {
    Route::resource('authenticatedUser', 'AuthenticatedUserController', ['only' => ['index', 'destroy', 'update']]);
    Route::resource('vendors', 'VendorController');
    Route::resource('contacts', 'ContactController');
    Route::resource('bookingSlots', 'BookingSlotController');
});

Route::group(array('namespace' => 'Open', 'prefix' => 'v1/open'), function() {
    Route::resource('packages', 'PackageController', ['only' => ['index']]);
    Route::resource('tests', 'TestController', ['only' => ['index']]);
});

Route::group(array('namespace' => 'Open', 'prefix' => 'v1/open', 'middleware' => ['vendor-key']), function() {
    Route::resource('bookings', 'BookingController');
});