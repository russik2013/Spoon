<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantPreference extends Model
{
    protected $fillable = [
        'AMERICAN','ASIAN','BAR','BURGER','CAFE','CHINESE','DESSERT','ITALIAN','JAPANESE','MEXICAN','PIZZA','SEAFOOD',
        'STEAKHOUSE','SUSHI','restaurants_id'
    ];
}
