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
        $ret = DB::table($this->table)->where('ID' ,'<',7)->orderBy('id', 'asc')->get()->toArray();

        return Common::stdClass2Array($ret);
    }

    public function getStatusName($statusId){
        $ret = DB::table($this->table)
            ->where("ID", "=", $statusId)
            ->orderBy('id', 'asc')->get()->toArray();

        $retData = Common::stdClass2Array($ret);

        return $retData[0]["title"];
    }
}
