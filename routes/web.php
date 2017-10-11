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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', 'Admin\AdminController@index') -> name('login');
Route::post('/login', 'Admin\AdminController@auth');

Route::get('/register', 'Admin\AdminController@register');
Route::post('/register', 'Admin\AdminController@createRestaurant');
Route::post('/russik', 'Admin\AdminController@createRestaurant');



Route::get('/job', function (){
    return view('test');

});
