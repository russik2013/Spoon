<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterKey extends Model
{
    protected $fillable = ['key_text', 'restaurant_count'];
}
