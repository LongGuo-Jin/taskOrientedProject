<?php

namespace App\Model;
use DB;
use App\Helper\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Task extends Model
{
    protected $table = "task";
    protected $roleId;
    protected $login_id;

    protected $fillable = [
        'ID', 'title', 'datePlanStart', 'datePlanEnd', 'dateActualStart', 'dateActualEnd', 'statusID', 'priorityID', 'weightID', 'personID'
        , 'budgetAllocated', 'hoursAllocated', 'hourSpent', 'hourCost', 'organizationID', 'locationID', 'taskCreatorID'
    ];

    public function __construct()
    {
        $Person = new Person();
        $personInfo = $Person->getPerson(Session::get('login_person_id'));
        $this->roleId = Session::get('login_role_id');
        $this->login_id = Session::get('login_person_id');
    }

    public function addTask($taskData)
    {
        $ret = DB::table($this->table)
            ->insert($taskData);

        return $ret;
    }

    public function updateTask($taskID, $taskData)
    {
        $ret = DB::table($this->table)
            ->where("ID", $taskID)
            ->update($taskData);

        return $ret;
    }

    public function getLastInsertId()
    {
        return DB::getPdo()->lastInsertId();
    }

    public function getTaskListInit()
    {
        $retArr = array();
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

        switch ($this->roleId) {
            case Common::constant("role.proManager"):
            case Common::constant("role.foreman"):
                $qrBuilder = $qrBuilder->whereNull("task.parentID");
                $qrBuilder = $qrBuilder->where("task.personID", "=", $this->login_id);
                break;
            case Common::constant("role.admin"):
                $qrBuilder = $qrBuilder->whereNull("task.parentID");
                break;
            case Common::constant("role.worker"):
                $qrBuilder = $qrBuilder->where("taskCreatorID", "!=", $this->login_id);
                $qrBuilder = $qrBuilder->where("task.personID", "=", $this->login_id);
                break;
        }

        $ret = $qrBuilder->orderBy('id', 'asc')->get()->toArray();

        $Tag = new Tag();
        $sysTagArr = $sysTagIconArr = Array();
        $result = Common::stdClass2Array($ret);
        foreach($Tag->getSystemTagList() as $key => $sysTagitem) {
            $sysTagArr[$sysTagitem["ID"]] = $sysTagitem["name"];
            $sysTagIconArr[$sysTagitem["ID"]] = $sysTagitem["note"];
        }
        foreach ($result as $key => $retItem) {
            $result[$key]["TagNames"] = $this->getTagIds2Names($sysTagArr, $retItem["tags"]);
            $result[$key]["TagNameIcons"] = $this->getTagIds2Names($sysTagIconArr, $retItem["tags"], "");
        }

        $retArr[0] = $result;

        $result['list'] = $retArr;
        $result['parents'][0] = "";

        return $result;
    }

    public function getTaskList($taskDetails)
    {
        $result['list'] = $result['parents'] = array();
        $parentsArr[2] = $parentsArr[1] = $parentsArr[0] = "";
        $retArr[2] = $retArr[1] = $retArr[0] = array();
        $parentId = empty($taskDetails["parentID"]) ? "": $taskDetails["parentID"];
        $isMainRoot = $this->isRootLevel($taskDetails["ID"]);
        $isParentRoot = $this->isRootLevel($taskDetails["parentID"]);

        //get first column data.
        if ($parentId != "" && !$isMainRoot) {
            if ($isParentRoot) {
                $initList = $this->getTaskListInit();
                $retArr[0] = $initList["list"][0];
                $parentsArr[0] = $initList['parents'][0];
            } else {
                $tmp = $this->getTaskListbyCond(array("taskID" => $parentId));
                if (count($tmp)) {
                    $retArr[0] = $tmp;
                    $upParentId = empty($tmp[0]["parentID"]) ? "": $tmp[0]["parentID"];
                    $parentsArr[0] = $upParentId;
                }
            }
        }

        //get second column data.
        if ($parentId == "" || $isMainRoot) {
            $initList = $this->getTaskListInit();
            $retArr[1] = $initList["list"][0];
            $parentsArr[1] = $initList['parents'][0];
        } else {
            $retArr[1] = $this->getTaskListbyCond(array("parentID" => $parentId));
            $parentsArr[1] = $parentId;
        }

        //get third column data.
        $tmp = $this->getTaskListbyCond(array("parentID" => $taskDetails["ID"]));
        $parentsArr[2] = $taskDetails["ID"];
        if (count($tmp))
            $retArr[2] = $tmp;

        foreach ($retArr as $key => $retItem)
        {
            if (!empty($retItem)) {
                array_push($result['list'], $retItem);
                array_push($result['parents'], $parentsArr[$key]);
            }
        }

        return $result;
    }

    /**
     * Checking what level for this task is root.
     */
    public function isRootLevel($taskId)
    {
        $ret = false;

        $parentId = "";
        $tmp = $this->getTaskListbyCond(array("taskID" => $taskId));
        if (count($tmp))
            $parentId = empty($tmp[0]["parentID"]) ? "": $tmp[0]["parentID"];

        switch ($this->roleId) {
            case Common::constant("role.proManager"):
            case Common::constant("role.foreman"):
            case Common::constant("role.admin"):
                if ($parentId == "")
                    $ret = true;
                break;
            case Common::constant("role.worker"):
                if ($parentId == "")
                    $ret = true;

                $tmp = array();
                $tmp = $this->getTaskListbyCond(array("taskID" => $parentId));
                if (count($tmp) == 0)
                    $ret = true;
                break;
        }

        return $ret;
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

        if (isset($cond['taskID'])){
            if ($cond['taskID'] == "") {
                $qrBuilder = $qrBuilder->whereNull("task.ID");
            } else {
                $qrBuilder = $qrBuilder->where("task.ID", "=", $cond['taskID']);
            }
        }
        if (isset($cond['parentID'])) {
            if ($cond['parentID'] == "") {
                $qrBuilder = $qrBuilder->whereNull("task.parentID");
            } else {
                $qrBuilder = $qrBuilder->where("task.parentID", "=", $cond['parentID']);
            }
        }

        switch ($this->roleId) {
            case Common::constant("role.proManager"):
            case Common::constant("role.foreman"):
                if (isset($cond['parentID']) && $cond['parentID'] == "")
                    $qrBuilder = $qrBuilder->where('task.personID', $this->login_id);
                break;
            case $this->roleId == Common::constant("role.worker"):
                $qrBuilder = $qrBuilder->where('task.personID', $this->login_id);
                break;
            case Common::constant("role.admin"):
                break;
        }

        $ret = $qrBuilder->orderBy('id', 'asc')->get()->toArray();

        $retArr = Common::stdClass2Array($ret);
        $Tag = new Tag();
        $sysTagArr = $sysTagIconArr = Array();
        foreach($Tag->getSystemTagList() as $key => $sysTagitem) {
            $sysTagArr[$sysTagitem["ID"]] = $sysTagitem["name"];
            $sysTagIconArr[$sysTagitem["ID"]] = $sysTagitem["note"];
        }
        foreach ($retArr as $key => $retItem) {
            $retArr[$key]["TagNames"] = $this->getTagIds2Names($sysTagArr, $retItem["tags"]);
            $retArr[$key]["TagNameIcons"] = $this->getTagIds2Names($sysTagIconArr, $retItem["tags"], "");
        }

        return $retArr;
    }

    public function getTagIds2Names($sysTagArr, $str, $delimiter = ",")
    {
        if ($str == "")
            return ;

        $retStr = "";
        $tmpArr = explode(",", $str);
        foreach ($tmpArr as $tmpItem)
            $retStr = $retStr . $sysTagArr[$tmpItem] . " " .$delimiter;

        return substr($retStr, 0, -1);
    }
}
