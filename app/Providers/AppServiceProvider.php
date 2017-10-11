<?php

namespace App\Providers;

use App\Client;
use App\Restaurant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('valid_email', function ($attribute, $value){

            if(Client::where('email', '=', $value) -> first())
            return false;
            else return true;

        },'Email in use');

        Validator::extend('valid_restaurant_email', function ($attribute, $value){

            if(Restaurant::where('email', '=', $value) -> first())
                return false;
            else return true;

        },'Email in use');

        Validator::extend('valid_nickname', function ($attribute, $value){

            if(Client::where('nickName', '=', $value) -> first())
                return false;
            else return true;

        },'NickName in use');


        Validator::extend('numeric_size', function ($attribute, $value,$parameters){


           // dd($parameters); array:2
           //[▼ 0 => "2"
           //   1 => "40"
           //]
          //  if(Client::where('nickName', '=', $value) -> first())
           //     return false;
          //  else return true;

        },'NickName in use');




    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
