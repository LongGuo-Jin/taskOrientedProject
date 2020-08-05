<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    //
    protected $fillable = [
       'personID', 'personName','taskID','description','timeSpent','timeAllocated','workDate'
    ];
}
