<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Model\Task;

class CheckList extends Model
{
    //
    public function task() {
        return $this->belongsTo(Task::class,'taskID');
    }
}
