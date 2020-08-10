<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Common;

class TagOrganization extends Model
{
    //
    protected $table = "tag_organizations";

    protected $fillable = [
        'tagID', 'companyID'
    ];

    public function getOrganizationTagList($companyID) {
        $ret  = DB::table($this->table)->leftJoin('tag','tag_organizations.tagID','tag.ID')
            ->select('tag_organizations.companyID','tag.*')->where('tag_organizations.companyID',$companyID)->where('tag.show',1)->get()->toArray();
        return Common::stdClass2Array($ret);
    }
}
