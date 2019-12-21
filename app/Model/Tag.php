<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Common;

class Tag extends Model
{
    protected $table = "tag";

    protected $fillable = [
        'ID', 'name', 'tagtype', 'color', 'note'
    ];

    public function getSystemTagList()
    {
        $ret = DB::Table($this->table)
                ->where('tagtype', Common::constant("tagType.system"))
                ->orderBy('ID')->get()->toArray();

        return Common::stdClass2Array($ret);
    }
}
