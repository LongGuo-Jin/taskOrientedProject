<?php

namespace App\Model;
use DB;

use App\Helper\Common;
use Illuminate\Database\Eloquent\Model;

class TagPerson extends Model
{
    protected $table = "tagperson";

    protected $fillable = [
        'tagID', 'personID'
    ];

    public function getPersonTagName()
    {
        $ret = DB::table('tag')
                    ->join($this->table, 'tagID', '=', 'ID')
                    ->select('tag.name', "{$this->table}.personID")
                    ->get()
                    ->toArray();

        $keyArr = array();

        foreach (Common::stdClass2Array($ret) as $item) {
            $keyArr[$item["personID"]] = $item["name"];
        }

        return $keyArr;
    }
}
