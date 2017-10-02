<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {

//    dd('russik');

//});

Route::post('/register', 'Mobile\ClientController@register');
Route::post('/authorization', 'Mobile\ClientController@authorization');
Route::post('/reset', 'Mobile\ClientController@resetPassword');
