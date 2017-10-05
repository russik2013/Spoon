<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotosRestaurant extends Model
{
    protected $fillable = [
        'restaurants_id','photo_url'
    ];


}
