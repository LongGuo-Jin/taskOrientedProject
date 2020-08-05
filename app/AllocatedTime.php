<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllocatedTime extends Model
{
    //
    protected $fillable = [
        'personID','personName','taskID','description','timeAllocated','allocateDate'
    ];
}
