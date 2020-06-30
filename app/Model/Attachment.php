<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Helper\Common;

class attachment extends Model
{
    protected $table = "attachment";

    protected $fillable = [
        'ID', 'fileName', 'tmpFileName', 'extension', 'timestamp', 'personID', 'taskID'
    ];

    public function getAttachmentByCond($cond)
    {
        $qrBuilder = DB::table($this->table)
            ->leftjoin("users", "attachment.personID", "=", "users.id")
            ->leftjoin("task", "attachment.taskID", "=", "task.ID")
            ->select("{$this->table}.*", DB::raw("concat(users.nameFamily, ' ', users.nameFirst) as fullName"));

        if (isset($cond["taskID"]) && $cond["taskID"])
            $qrBuilder = $qrBuilder->where("attachment.taskID", "=", $cond["taskID"]);
        if (isset($cond["personID"]) && $cond["personID"])
            $qrBuilder = $qrBuilder->where("attachment.personID", "=", $cond["personID"]);

        $ret = $qrBuilder->orderBy('id', 'asc')->get()->toArray();

        return Common::stdClass2Array($ret);
    }

    public function addAttachment($Attachment)
    {
        $ret = DB::table($this->table)
            ->insert($Attachment);

        return $ret;
    }
}
