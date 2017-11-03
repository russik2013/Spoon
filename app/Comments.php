<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = ['restaurants_id', 'client_id', 'review', 'text', 'value'];

    public function likes(){

            return $this -> hasMany('App\CommentsLikes');

    }
}
