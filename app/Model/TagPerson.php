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
    public function getPersonTagList($personID) {
        $ret  = DB::table($this->table)->leftJoin('tag','tagperson.tagID','tag.ID')
            ->select('tagperson.personID','tag.*')->where('tagperson.personID',$personID)->where('tag.show',1)->get()->toArray();
        return Common::stdClass2Array($ret);
    }
}
