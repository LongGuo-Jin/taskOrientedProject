<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Common;
class TagTask extends Model
{
    //
    protected $table = "tag_tasks";
    protected $fillable = [
        'tagID', 'taskID'
    ];

    public function getTaskTagList($taskID) {
        $ret  = DB::table($this->table)->leftJoin('tag','tag_tasks.tagID','tag.ID')
                    ->where('tag_tasks.taskID',$taskID)->where('tag.show',1)->select('tag.ID','tag.name','tag.tagtype','tag.color')->get()->toArray();
        return Common::stdClass2Array($ret);
    }

}
