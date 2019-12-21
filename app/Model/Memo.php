<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $table = "Memo";

    protected $fillable = [
        'ID', 'timeStamp', 'personID', 'taskID', 'Message'
    ];


}
