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