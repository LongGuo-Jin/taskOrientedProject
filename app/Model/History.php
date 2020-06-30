<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Common;

class History extends Model
{
    protected $table = "history";

    protected $fillable = [
        'ID', 'personID', 'taskID', 'event', 'eventDate'
    ];

    public function addHistory($historyData) {
        $ret = DB::table($this->table)
            ->insert($historyData);

        return $ret;
	}

	public function getHistoryByCond($cond) {
        $qrBuilder = DB::table($this->table)
            ->leftjoin("users", "history.personID", "=", "users.id")
            ->leftjoin("task", "history.taskID", "=", "task.ID")
            ->select("{$this->table}.*", DB::raw("concat(users.nameFamily, ' ', users.nameFirst) as fullName"));

        if (isset($cond["taskID"]) && $cond["taskID"])
            $qrBuilder = $qrBuilder->where("history.taskID", "=", $cond["taskID"]);
        if (isset($cond["personID"]) && $cond["personID"])
            $qrBuilder = $qrBuilder->where("history.personID", "=", $cond["personID"]);

        $ret = $qrBuilder->orderBy('id', 'desc')->get()->toArray();

        return Common::stdClass2Array($ret);
    }
}
