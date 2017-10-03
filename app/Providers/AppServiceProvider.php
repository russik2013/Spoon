<?php

namespace App\Providers;

use App\Client;
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


        Validator::extend('valid_nickname', function ($attribute, $value){

            if(Client::where('nickName', '=', $value) -> first())
                return false;
            else return true;

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
