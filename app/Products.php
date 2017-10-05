<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable =[
        'restaurants_id','name','description','kitchen','category','prise','weight','unit_of_measurement',
        'cooking_time','rating','ingredients'
    ];

}
