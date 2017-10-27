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

Route::get('/reset', 'Admin\AdminController@reset');
Route::post('/reset', 'Admin\AdminController@sendMail');

Route::get('/change', 'Admin\AdminController@changePassword');
Route::post('/change', 'Admin\AdminController@setNewPassword');

Route::get('/register', 'Admin\AdminController@register');
Route::post('/register', 'Admin\AdminController@createRestaurant');




Route::group(['prefix' => 'restaurant', 'middleware' => 'auth'], function () {


    Route::get('/', 'Restaurant\RestaurantController@index');
    Route::get('/edit', 'Restaurant\RestaurantController@edit');
    Route::post('/update', 'Restaurant\RestaurantController@update');

    Route::group(['prefix' => 'preference'], function () {

        Route::get('/', 'Restaurant\PreferenceController@index');


    });

    Route::group(['prefix' => 'products'], function () {

        Route::get('/', 'Restaurant\ProductController@index');
        Route::get('/add', 'Restaurant\ProductController@add');
        Route::post('/create', 'Restaurant\ProductController@create');
        Route::get('/{id}/edit','Restaurant\ProductController@edit');
        Route::post('/{id}/update','Restaurant\ProductController@update');
        Route::get('/{id}/delete','Restaurant\ProductController@delete');
       // Route::post('/{id}/delete','Restaurant\ProductController@delete');


    });


});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/', 'Admin\HomeController@index')->middleware('admin_restaurant');

//////////////////////////////Контроль ресторанов/////////////////////////////////////
    Route::group(['prefix' => 'restaurant', 'middleware' => 'auth'], function () {


        Route::group(['prefix' => 'preference'], function () {

            Route::get('/edit', 'Restaurant\PreferenceController@edit');
            Route::post('/update', 'Restaurant\PreferenceController@update');

        });
    });
/////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////Контроль ключей регистрации/////////////////////////////////////
    Route::group(['prefix' => 'keys'], function () {

        Route::get('/', 'Admin\RegisterKeyController@index')->middleware('admin_restaurant');
        Route::post('/create', 'Admin\RegisterKeyController@create')->middleware('admin_restaurant');


    });

});

Route::get('/job', function (){
    return view('test');

});
