<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Common;

class Tag extends Model
{
    protected $table = "tag";

    protected $fillable = [
        'ID', 'name', 'tagtype', 'organization_id' , 'person_id' ,'color', 'note' , 'description' , 'show' , 'colorValue'
    ];

    public function getSystemTagList()
    {
        $ret = DB::Table($this->table)
                ->where('tagtype', Common::constant("tagType.system"))
                ->orderBy('ID')->get()->toArray();
        return Common::stdClass2Array($ret);
    }

    public function getTagList($user) {
        $personID = $user->id;
        $organizationID = $user->organization_id;

        $ret = DB::Table($this->table)
            ->where('organization_id',$organizationID)
            ->whereIn('tagtype', [1,2])
            ->orWhere(function($query) use ($organizationID,$personID){
              $query->where('organization_id',$organizationID)
                  ->where('tagtype', 3)
                  ->where('person_id', $personID);
            })
            ->select('ID','name','tagtype','color')->orderBy('ID')->get()->toArray();

        return Common::stdClass2Array($ret);
    }

}
