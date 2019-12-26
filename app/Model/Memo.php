<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use App\Helper\Common;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $table = "memo";

    protected $fillable = [
        'ID', 'timeStamp', 'personID', 'taskID', 'Message'
    ];

    public function getMemoByCond($cond)
    {
        $qrBuilder = DB::table($this->table)
            ->leftjoin("person", "memo.personID", "=", "person.ID")
            ->leftjoin("task", "memo.taskID", "=", "task.ID")
            ->select("{$this->table}.*", DB::raw("concat(person.nameFamily, ' ', person.nameFirst) as fullName"));

        if (isset($cond["taskID"]) && $cond["taskID"])
            $qrBuilder = $qrBuilder->where("memo.taskID", "=", $cond["taskID"]);
        if (isset($cond["personID"]) && $cond["personID"])
            $qrBuilder = $qrBuilder->where("memo.personID", "=", $cond["personID"]);

        $ret = $qrBuilder->orderBy('id', 'asc')->get()->toArray();

        return Common::stdClass2Array($ret);
    }

    public function addMemo($memo)
    {
        $ret = DB::table($this->table)
            ->insert($memo);

        return $ret;
    }
}
