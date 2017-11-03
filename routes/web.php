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

Route::get('/404', function (){
    return view('404');
});


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

        Route::get('/','Admin\RestaurantController@index');
        Route::get('{id}/edit','Admin\RestaurantController@edit');
        Route::post('{id}/update','Admin\RestaurantController@update');
        Route::get('{id}/menu','Admin\RestaurantController@menu');
        Route::get('{id}/product','Admin\RestaurantController@product');
        Route::post('{id}/updateProduct','Admin\RestaurantController@updateProduct');

        Route::group(['prefix' => 'comments'], function () {

            Route::get('/{restaurant}', 'Admin\CommentsController@index');

        });

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
        Route::post('/all', 'Admin\RegisterKeyController@getAllKeys')->middleware('admin_restaurant');
        Route::post('/delete', 'Admin\RegisterKeyController@delete')->middleware('admin_restaurant');
        Route::post('/get', 'Admin\RegisterKeyController@getKey')->middleware('admin_restaurant');
    });
/////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////Контроль пользователей/////////////////////////////////////////////
    Route::group(['prefix' => 'clients'], function () {

        Route::get('/{page}', 'Admin\ClientController@index')->middleware('admin_restaurant');
        Route::get('/{id}/edit', 'Admin\ClientController@edit')->middleware('admin_restaurant');
        Route::post('/{id}/update', 'Admin\ClientController@update')->middleware('admin_restaurant');
        Route::post('/change', 'Admin\ClientController@changeStatus')->middleware('admin_restaurant');
        Route::post('/reviewer', 'Admin\ClientController@changeReviewer')->middleware('admin_restaurant');
    });

/////////////////////////////////////////////////////////////////////////////////////////////////
});

Route::get('/job', function (){
    return view('test');

});
