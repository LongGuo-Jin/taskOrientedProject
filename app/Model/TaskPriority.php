<?php

namespace App\Model;
use DB;
use App\Helper\Common;
use Illuminate\Database\Eloquent\Model;

class TaskPriority extends Model
{
    protected $table = "taskpriority";

    protected $fillable = [
        'ID', 'title', 'order', 'note'
    ];

    public function getTaskPriorityList()
    {
        $ret = DB::table($this->table)->orderBy('id', 'asc')->get()->toArray();

        return Common::stdClass2Array($ret);
    }
}
