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

Route::filter('login', function() {
    if(Auth::guest()) {
        $user_id = Authorizer::getResourceOwnerId();
        Auth::loginUsingId($user_id);

        if(!Auth::user()->hasRole('staff') && !Auth::user()->hasRole('vendor')) {
            return Response::json(array(
                'errors' => [
                    'title' => 'Unauthorized.',
                    'statusCode' => 401
                ]
            ), 401);
        }
    }
});

Route::filter('loginStaff', function() {
    if(Auth::guest()) {
        $user_id = Authorizer::getResourceOwnerId();
        Auth::loginUsingId($user_id);

        if(!Auth::user()->hasRole('staff')) {
            return Response::json(array(
                'errors' => [
                    'title' => 'Unauthorized.',
                    'statusCode' => 401
                ]
            ), 401);
        }
    }
});

Route::filter('loginVendor', function() {
    if(Auth::guest()) {
        $user_id = Authorizer::getResourceOwnerId();
        Auth::loginUsingId($user_id);

        if(!Auth::user()->hasRole('vendor')) {
            return Response::json(array(
                'errors' => [
                    'title' => 'Unauthorized.',
                    'statusCode' => 401
                ]
            ), 401);
        }
    }
});

// Authentucation
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(array('namespace' => 'Open', 'prefix' => 'v1/open', 'before' => 'oauth|login'), function() {
    Route::resource('authenticatedUser', 'AuthenticatedUserController', ['only' => ['index', 'destroy', 'update']]);
});

Route::group(array('namespace' => 'Staff', 'prefix' => 'v1/staff', 'before' => 'oauth|loginStaff'), function() {
    Route::resource('packages', 'PackageController');
    Route::resource('tests', 'TestController');
});

Route::group(array('namespace' => 'Vendor', 'prefix' => 'v1/vendor', 'before' => 'oauth|loginVendor'), function() {
    Route::resource('packages', 'PackageController', ['only' => ['index']]);
    Route::resource('tests', 'TestController', ['only' => ['index']]);
});