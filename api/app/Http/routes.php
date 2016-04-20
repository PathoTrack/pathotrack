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

Route::filter('loginCommon', function()
{
    if(Auth::guest()) {
        $user_id = Authorizer::getResourceOwnerId();
        Auth::loginUsingId($user_id);

        if (!Auth::user()->hasAtleastOneRole()) {
            return Response::json(array(
                'errors' => [
                    'title' => 'Unauthorized.',
                    'statusCode' => 401
                ]
            ), 401);
        }
    }
});

Route::filter('loginAdmin', function()
{
    if(Auth::guest()) {
        $user_id = Authorizer::getResourceOwnerId();
        Auth::loginUsingId($user_id);

        if(!Auth::user()->isAdmin()) {
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(array('namespace' => 'Staff', 'prefix' => 'v1/staff'), function() {
    Route::resource('packages', 'PackageController');
    Route::resource('tests', 'TestController');
});

Route::group(array('namespace' => 'Vendor', 'prefix' => 'v1/vendor'), function() {
    Route::resource('packages', 'PackageController', ['only' => ['index']]);
    Route::resource('tests', 'TestController', ['only' => ['index']]);
});

Route::group(array('namespace' => 'Open', 'prefix' => 'v1/open', 'before' => 'oauth|loginCommon'), function()
{
    Route::resource('authenticatedUser', 'AuthenticatedUserController', ['only' => ['index', 'destroy', 'update']]);
});