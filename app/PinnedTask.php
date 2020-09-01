<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PinnedTask extends Model
{
    //
    protected $fillable = [
        'taskID','personID'
    ];
}
