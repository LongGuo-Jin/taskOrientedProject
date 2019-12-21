<?php

namespace App\Model;
use DB;
use App\Helper\Common;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $table = "taskstatus";

    protected $fillable = [
        'ID', 'title', 'note'
    ];

    public function getTaskStatusList()
    {
        $ret = DB::table($this->table)->orderBy('id', 'asc')->get()->toArray();

        return Common::stdClass2Array($ret);
    }
}
