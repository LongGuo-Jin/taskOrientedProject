<?php

namespace App\Model;
use DB;
use App\Helper\Common;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "task";
    protected $roleId;
    protected $login_id;

    protected $fillable = [
        'ID', 'title', 'datePlanStart', 'datePlanEnd', 'dateActualStart', 'dateActualEnd', 'statusID', 'priorityID', 'weightID', 'personID'
        , 'budgetAllocated', 'hoursAllocated', 'hourSpent', 'hourCost', 'organizationID', 'locationID'
    ];

    public function __construct()
    {
        $this->roleId = session()->get('login_person_info.roleID');
        $this->login_id = session()->get('login_person_id');
    }

    public function addTask($taskData)
    {
        $ret = DB::table($this->table)
            ->insert($taskData);

        return $ret;
    }

    public function getLastInsertId()
    {
        return DB::getPdo()->lastInsertId();
    }

    public function getTaskListInit()
    {
        $retArr = array();
        $retArr["0"] = $this->getTaskListbyCond(array("parentID" => "" , "level" => "root"));
        $retArr["1"] = array();
        $retArr["2"] = array();

        $result['list'] = $retArr;
        $result['level'] = "root";

        return $result;
    }

    public function getTaskList($taskDetails)
    {
        $retArr[2] = $retArr[1] = $retArr[0] = array();
        $result = array();

        $parentId = $taskDetails["parentID"];
        //get first column data.
        if ($parentId == "") {
            $retArr[0] = $this->getTaskListbyCond(array("parentID" => "" , "level" => "root"));
            $result["level"] = "root";
        }
        else {
            $tmpArr = $this->getTaskListbyCond(array("taskID" => $parentId));
            $upParentId = $tmpArr[0]["parentID"];

            if ($upParentId == "") {
                $result["level"] = "root";
                $retArr[0] = $this->getTaskListbyCond(array("parentID" => "" , "level" => "root"));
            }
            else
                $retArr[0] = $this->getTaskListbyCond(array("parentID" => $upParentId));
        }

        //get second column data.

        if ($parentId != "") {
            $retArr[1] = $this->getTaskListbyCond(array("parentID" => $parentId));
        }

        //get third column data.
        $tmp = $this->getTaskListbyCond(array("parentID" => $taskDetails["ID"]));
        if (count($tmp))
            $retArr[2] = $tmp;

        $result['list'] = $retArr;

        return $result;
    }

    public function getTaskListbyCond($cond)
    {
        $qrBuilder = DB::table($this->table)
            ->leftJoin("tagperson", "task.personID", "=", "tagperson.tagID")
            ->leftJoin("tag", "tagperson.tagID", "=", "tag.ID")
            ->leftJoin("taskstatus", "task.statusID", "=", "taskstatus.ID")
            ->leftJoin("taskpriority", "task.priorityID", "=", "taskpriority.ID")
            ->leftJoin("taskweight", "task.weightID", "=", "taskweight.ID")
            ->leftJoin("person", "task.personID", "=", "person.ID")
            ->select("{$this->table}.*", "tag.name as psntagName", "taskstatus.note as status_icon"
                , "taskpriority.title as priority_title", "taskweight.title as weight"
                , DB::raw("concat(person.nameFamily, ' ', person.nameFirst) as fullName"));

        if (isset($cond['taskID']))
            $qrBuilder = $qrBuilder->where("task.ID", "=", $cond['taskID']);
        if (isset($cond['parentID'])) {
            if ($cond['parentID'] == "") {
                $qrBuilder = $qrBuilder->whereNull("task.parentID");
            } else {
                $qrBuilder = $qrBuilder->where("task.parentID", "=", "1");
            }
        }


        if (($this->roleId == Common::constant("role.proManager")
            || $this->roleId == Common::constant("role.foreman"))
            && (isset($cond['level']) && $cond['level'] == "root")
        ) {
            $qrBuilder = $qrBuilder
                ->where('task.personID', $this->login_id);
        } elseif ($this->roleId == Common::constant("role.worker")) {
            $qrBuilder = $qrBuilder
                ->where('personID', $this->roleId);
        }

        $ret = $qrBuilder->orderBy('id', 'asc')->get()->toArray();

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
