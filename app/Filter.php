<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    //
    protected $fillable = [
        'user_id','status','priority','weight','date','workTime','budget'
    ];
}
