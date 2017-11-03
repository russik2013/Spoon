<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentLikes extends Model
{
    protected $fillable = ['comment_id', 'client_id', 'value'];

    public function comment(){

        return $this -> belongsTo('App\Comments');

}

}
