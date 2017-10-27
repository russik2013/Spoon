<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable =[
        'email','password','name','nets','category','description','phone','average_check','verified','specify_time',
        'monday','tuesday','wednesday','thursday','friday','saturday','sunday','reviewer_review','address','location',
        'rating','display_tables','number_of_free_tables','role'
    ];


}
