<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTaskTime extends Model
{
    //
    protected $fillable = [
        'taskID','timeSpentOnSubTask'
    ];
}
