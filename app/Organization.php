<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //
    protected $fillable = [
        'organization'
    ];

    function Users() {
        return $this->hasMany(User::class);
    }

}
