<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasApiTokens;

    protected $fillable = ['email','password','firebaseID','socialNetworkID','firstName','lastName','middleName',
                            'nickName','sex','age','photo','reviewer','rating','changePreferences'];
}






