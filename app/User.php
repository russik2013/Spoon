<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table ='restaurants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
        'email','password','name','nets','category','description','phone','average_check','verified','specify_time',
        'monday','tuesday','wednesday','thursday','friday','saturday','sunday','reviewer_review','address','location',
        'rating','display_tables','number_of_free_tables'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function preference(){

       return $this -> hasOne('App\RestaurantPreference','restaurants_id','id');

    }

    public function products(){

        return $this -> hasMany('App\Products','restaurants_id','id');
    }
}
