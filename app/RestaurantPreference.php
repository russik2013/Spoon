<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantPreference extends Model
{
    protected $table ='restaurant_preferences';

    protected $fillable = [
        'AMERICAN','ASIAN','BAR','BURGER','CAFE','CHINESE','DESSERT','ITALIAN','JAPANESE','MEXICAN','PIZZA','SEAFOOD',
        'STEAKHOUSE','SUSHI','restaurants_id'
    ];

    public function restaurant(){

        return  $this -> belongsTo('App\User', 'restaurants_id','id');

    }

    public function getDefaults($id){

        $this->update([ 'AMERICAN' => 0,
                        'ASIAN' => 0,
                        'BAR' => 0,
                        'BURGER' => 0,
                        'CAFE' => 0,
                        'CHINESE' => 0,
                        'DESSERT' => 0,
                        'ITALIAN' => 0,
                        'JAPANESE' => 0,
                        'MEXICAN' => 0,
                        'PIZZA' => 0,
                        'SEAFOOD' => 0,
                        'STEAKHOUSE' => 0,
                        'SUSHI' => 0]);
    }
}
