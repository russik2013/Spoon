<?php

use App\Client;
use App\Preference;
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




Route::post('/test', function (){
    $client = Client::where('id',2)->get(['email','firstName','lastName','middleName',
        'nickName','sex','age','photo','reviewer','rating','changePreferences']) -> first();

    $client -> pref = Preference::where('client_id',2)->get(['AMERICAN','ASIAN','BAR','BURGER','CAFE','CHINESE','DESSERT','ITALIAN','JAPANESE','MEXICAN','PIZZA','SEAFOOD',
        'STEAKHOUSE','SUSHI'])->first();
    dd($client -> toJson());
});

Route::post('/register', 'Mobile\ClientController@register');
Route::post('/authorization', 'Mobile\ClientController@authorization');
Route::post('/reset', 'Mobile\ClientController@resetPassword');
Route::post('/check', 'Mobile\ClientController@checkKod');
Route::post('/edit', 'Mobile\ClientController@editUser');

Route::group(['prefix' => 'preference'], function () {

    Route::post('/get', 'Mobile\PreferenceController@get');
    Route::post('/edit', 'Mobile\PreferenceController@edit');

});

Route::group(['prefix' => 'client'], function () {

    Route::post('/get', 'Mobile\ClientController@get');

});

//Route::post();