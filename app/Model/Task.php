<?php

namespace App\Model;
use DB;
use App\Helper\Common;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "task";

    protected $fillable = [
        'ID', 'title', 'datePlanStart', 'datePlanEnd', 'dateActualStart', 'dateActualEnd', 'statusID', 'priorityID', 'weightID', 'personID'
        , 'budgetAllocated', 'hoursAllocated', 'hourSpent', 'hourCost', 'organizationID', 'locationID', 'taskCreator', 'level'
    ];

    public function addTask($taskData)
    {
        $ret = DB::table($this->table)
            ->insert($taskData);

        return $ret;
    }

    public function getTaskListInit()
    {
        $ret = array();
        $roleId = session()->get('login_person_info.roleID');
        $login_id = session()->get('login_person_id');

        if ($roleId == Common::constant("role.proManager") || $roleId == Common::constant("role.foreman")) {
            $ret = DB::table($this->table)
                ->leftJoin("tagperson", "task.personID", "=", "tagperson.tagID")
                ->leftJoin("tag", "tagperson.tagID", "=", "tag.ID")
                ->leftJoin("taskstatus", "task.statusID", "=", "taskstatus.ID")
                ->select("{$this->table}.*", "tag.name as psntagName", "taskstatus.note as status_icon")
                ->where('task.taskCreator', $login_id)
                ->where('task.level', 1)
                ->orderBy('task.ID', 'asc')->get()->toArray();
        } elseif ($roleId == Common::constant("role.worker")) {
            $ret = DB::table($this->table)
                ->leftJoin("tagperson", "task.personID", "=", "tagperson.tagID")
                ->leftJoin("tag", "tagperson.tagID", "=", "tag.ID")
                ->select("{$this->table}.*", "tag.name as psntagName")
                ->where('personID', $login_id)
                ->where('level', 1)
                ->orderBy('id', 'asc')->get()->toArray();
        } elseif ($roleId == Common::constant("role.admin")) {
            $ret = DB::table($this->table)
                ->leftJoin("tagperson", "task.personID", "=", "tagperson.tagID")
                ->leftJoin("tag", "tagperson.tagID", "=", "tag.ID")
                ->select("{$this->table}.*", "tag.name as psntagName")
                ->where('level', 1)
                ->orderBy('id', 'asc')->get()->toArray();
        }

        $retArr = Common::stdClass2Array($ret);

        $Tag = new Tag();
        $PersonTag = new TagPerson();

        $sysTagArr = Array();
        foreach($Tag->getSystemTagList() as $key => $sysTagitem)
            $sysTagArr[$sysTagitem["ID"]] = $sysTagitem["name"];

        foreach ($retArr as $key => $retItem) {
            $retArr[$key]["TagNames"] = $this->getTagIds2Names($sysTagArr, $retItem["tags"]);
        }

        return $retArr;
    }

    public function getTagIds2Names($sysTagArr, $str)
    {
        if ($str == "")
            return ;

        $retStr = "";
        $tmpArr = explode(",", $str);
        foreach ($tmpArr as $tmpItem)
            $retStr = $retStr . $sysTagArr[$tmpItem] . " ,";

        return substr($retStr, 0, -1);
    }
}
