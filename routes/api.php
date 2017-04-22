<?php

use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('jwt.auth');


Route::post('/devices/list/paginated', 'Frontend\DevicesController@getList');
Route::get('/devices/list/paginated', 'Frontend\DevicesController@getList');


//Auth
Route::post('register', 'Api\Auth\JWTAuthenticateController@register');
Route::post('signIn', 'Api\Auth\JWTAuthenticateController@authenticate');
Route::post('logout', 'Api\Auth\JWTAuthenticateController@logout')->middleware('jwt.auth');
Route::post('emailExists', 'Api\Auth\UserAccountController@hasEmail');


//Devices
//middleware should be implemented here too.
Route::post('devices', 'Api\DevicesController@store')->middleware('jwt.auth');
Route::put('devices/{serialNum}', 'Api\DevicesController@update')->middleware('jwt.auth');
Route::get('devices/{serialNum}', 'Api\DevicesController@show');


//Discussions
Route::post('/discussions/{model}/{id}', 'Api\DiscussionsController@store')->middleware('jwt.auth');
Route::delete('/discussions/{discussion}', 'Api\DiscussionsController@destroy')->middleware('jwt.auth');

//admin
Route::post('/admin/devices/list/paginated', 'Admin\Device\DevicesController@getList')->middleware('auth');
