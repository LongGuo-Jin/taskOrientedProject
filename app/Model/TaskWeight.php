<?php

namespace App\Model;
use DB;
use App\Helper\Common;
use Illuminate\Database\Eloquent\Model;

class TaskWeight extends Model
{
    protected $table = "taskweight";

    protected $fillable = [
        'ID', 'title', 'order', 'note'
    ];

    public function getTaskWeightList()
    {
        $ret = DB::table($this->table)->orderBy('id', 'asc')->get()->toArray();

        return Common::stdClass2Array($ret);
    }
}
