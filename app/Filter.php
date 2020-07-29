<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    //
    protected $fillable = [
        'status','priority','weight','date','workTime','budget'
    ];
}
