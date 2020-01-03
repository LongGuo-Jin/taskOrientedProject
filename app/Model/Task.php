<?php

namespace App\Model;
use DB;
use App\Helper\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use DateTime;

class Task extends Model
{
    protected $table = "task";
    protected $roleId;
    protected $login_id;
    public $tmpArr = array();

    protected $fillable = [
        'ID', 'title', 'datePlanStart', 'datePlanEnd', 'dateActualStart', 'dateActualEnd', 'statusID', 'priorityID', 'weightID', 'personID'
        , 'budgetAllocated', 'hoursAllocated', 'hourSpent', 'hourCost', 'organizationID', 'locationID', 'taskCreatorID', 'deleteFlag'
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
            ->where('deleteFlag', "!=", 1)
            ->select("{$this->table}.*", "tag.name as psntagName", "taskstatus.note as status_icon"
                , "taskpriority.title as priority_title", "taskweight.title as weight"
                , DB::raw("concat(person.nameFamily, ' ', person.nameFirst) as fullName"));

        switch ($this->roleId) {
            case Common::constant("role.proManager"):
            case Common::constant("role.foreman"):
                $qrBuilder = $qrBuilder->whereNull("task.parentID");
                $qrBuilder = $qrBuilder->where("task.personID", "=", $this->login_id);
                $qrBuilder = $qrBuilder->orwhere(function ($query) {
                    $query->where("task.personID", "=", $this->login_id)
                        ->where("taskCreatorID", "!=", $this->login_id);
                });
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
        $result = $this->adtResult(Common::stdClass2Array($ret));

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
                $tmp = $this->adtResult($this->getTaskListbyCond(array("taskID" => $parentId)));
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
            $retArr[1] = $this->adtResult($this->getTaskListbyCond(array("parentID" => $parentId)));
            $parentsArr[1] = $parentId;
        }

        //get third column data.
        $tmp = $this->adtResult($this->getTaskListbyCond(array("parentID" => $taskDetails["ID"])));
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
            ->where('deleteFlag', "!=", 1)
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

        return Common::stdClass2Array($ret);
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

    public function adtResult($arr)
    {
        $retArr = $arr;
        $Tag = new Tag();
        $sysTagArr = $sysTagIconArr = Array();
        foreach($Tag->getSystemTagList() as $key => $sysTagitem) {
            $sysTagArr[$sysTagitem["ID"]] = $sysTagitem["name"];
            $sysTagIconArr[$sysTagitem["ID"]] = $sysTagitem["note"];
        }

        $totalTaskArr = Common::stdClass2Array(
            DB::table($this->table)->leftjoin("taskweight", "task.weightID", "=", "taskweight.ID")
                ->select(DB::raw("sum(taskweight.title) as sumweight"), "task.parentID")
                ->where("task.statusID", "!=", "5")
                ->where("deleteFlag", "=", 0)
                ->groupBy('task.parentID')
                ->orderBy('task.parentID', 'asc')->get()->toArray());

        $totalTaskWieght = array();
        foreach ($totalTaskArr as $taskItem)
            $totalTaskWieght[$taskItem["parentID"]] = !empty($taskItem["sumweight"]) ? $taskItem["sumweight"]: 0;

        $finishTaskArr = Common::stdClass2Array(
            DB::table($this->table)->leftjoin("taskweight", "task.weightID", "=", "taskweight.ID")
                ->select(DB::raw("sum(taskweight.title) as sumweight"), "task.parentID")
                ->where("task.statusID", "=", "4")
                ->where("deleteFlag", "=", 0)
                ->groupBy('task.parentID')
                ->orderBy('task.parentID', 'asc')->get()->toArray());

        $finishTaskWieght = array();
        foreach ($finishTaskArr as $taskItem)
            $finishTaskWieght[$taskItem["parentID"]] = !empty($taskItem["sumweight"]) ? $taskItem["sumweight"]: 0;


        foreach ($retArr as $key => $retItem) {
            $retArr[$key]["TagNames"] = $this->getTagIds2Names($sysTagArr, $retItem["tags"]);
            $retArr[$key]["TagNameIcons"] = $this->getTagIds2Names($sysTagIconArr, $retItem["tags"], "");

            $datetime1 = strtotime(str_replace(".", "-", $retItem['datePlanStart']));
            $datetime2 = strtotime(str_replace(".", "-", $retItem['datePlanEnd']));
            $nowtime = strtotime("today");
            $totalDays = ($datetime2 - $datetime1) / 86400 + 1;
            $spentDays = ($nowtime - $datetime1) / 86400 + 1;
            if ($spentDays >= $totalDays)
                $retArr[$key]['spentProgress'] = 100;
            else
                $retArr[$key]['spentProgress'] = $totalDays == 0 ? 0 :round(($spentDays/$totalDays)*100);

            $tmpTlweight = isset($totalTaskWieght[$retItem["ID"]]) ? $totalTaskWieght[$retItem["ID"]]: 0;
            $tmpFiweight = isset($finishTaskWieght[$retItem["ID"]]) ? $finishTaskWieght[$retItem["ID"]]: 0;
            $retArr[$key]['finishProgress'] = $tmpTlweight == 0 ? 0 :round(($tmpFiweight/$tmpTlweight)*100);

            if ($retArr[$key]["statusID"] == 4)
                $retArr[$key]['finishProgress'] = 100;
        }

        return $retArr;
    }

    public function isFinalTask($taskId)
    {
        $checkRet = DB::table($this->table)
            ->where("parentID", "=", $taskId)
            ->where("deleteFlag", "=", 0)
            ->select(DB::raw("count(*) as count"))->get()->toArray();
        $checkArr = Common::stdClass2Array($checkRet);
        if (isset($checkArr[0]['count']) && $checkArr[0]['count'] == 0)
            return 1;

        return -1;
    }

    public function deleteTask($taskIds)
    {
        $ret = DB::table($this->table)
            ->whereIn("ID" , $taskIds)
            ->update(array("deleteFlag" => 1));

        return $ret;
    }

    function getAllSubTree($cat_id) {
        $ret = Common::stdClass2Array(DB::table($this->table)
            ->where("parentID", "=" , $cat_id)
            ->where("deleteFlag", "=", 0)
            ->select("*")->get()->toArray());

        foreach ($ret as $retItem) {
            $this->getAllSubTree($retItem["ID"]);
        }

        array_push($this->tmpArr, $cat_id);
        return ;
    }

    function getRootTaskId($taskId) {
        $ret = Common::stdClass2Array(DB::table($this->table)
            ->where("ID", "=" , $taskId)
            ->select("parentID")->get()->toArray());

        $parentId = isset($ret[0]["parentID"]) ? $ret[0]["parentID"]: "";
        $currId = $taskId;

        while($parentId != "") {
            $currId = $parentId;
            $tmp = array();
            $tmp = Common::stdClass2Array(DB::table($this->table)
                ->where("ID", "=" , $parentId)
                ->where("deleteFlag", "=", 0)
                ->select("parentID")->get()->toArray());
            $parentId = isset($tmp[0]["parentID"]) ? $tmp[0]["parentID"]: "";
        }

        return $currId;
    }

    function getPathName($taskId) {
        $ret = Common::stdClass2Array(DB::table($this->table)
            ->where("ID", "=" , $taskId)
            ->select("parentID", "title")->get()->toArray());

        $parentId = isset($ret[0]["parentID"]) ? $ret[0]["parentID"]: "";
        $parentName = isset($ret[0]["title"]) ? $ret[0]["title"]: "";
        $result = array();

        while($parentId != "") {
            $tmp = array();
            $tmp = Common::stdClass2Array(DB::table($this->table)
                ->where("ID", "=" , $parentId)
                ->where("deleteFlag", "=", 0)
                ->select("parentID", "title", "ID")->get()->toArray());
            $parentId = isset($tmp[0]["parentID"]) ? $tmp[0]["parentID"]: "";
            $id = isset($tmp[0]["ID"]) ? $tmp[0]["ID"]: "";
            $parentName = isset($tmp[0]["title"]) ? $tmp[0]["title"]: "";
            array_push($result, array("ID" => $id, "title" => $parentName));
        }

        return $result;
    }

    function getEntirTreeIds($taskId) {
        $rootTaskId = $this->getRootTaskId($taskId);
        $this->tmpArr = array();
        $this->getAllSubTree($rootTaskId);

        return $this->tmpArr;
    }

    function getStatisticsData($taskDetail) {
        $statisticsData = array();
        $datetime1 = strtotime(str_replace(".", "-", $taskDetail['datePlanStart']));
        $datetime2 = strtotime(str_replace(".", "-", $taskDetail['datePlanEnd']));
        $nowtime = strtotime("today");
        $totalDay = ($datetime2 - $datetime1) / 86400 + 1;
        $spentDay = ($nowtime - $datetime1) / 86400 + 1;
        if ($totalDay <= $spentDay)
            $timeLeft = 0;
        else
            $timeLeft = $totalDay - $spentDay;
        $statisticsData['timeLeft'] = $timeLeft;
        $statisticsData['timeLeftPercent'] = $totalDay == 0 ? 0 : round(($timeLeft/$totalDay)*100, 2);

        $retArr = Common::stdClass2Array(
            DB::table($this->table)->select(DB::raw("count(*) as totalCount"), DB::raw("count(case when statusID = 4 then 1 end) AS finishCount"))
                ->where("parentID", "=", $taskDetail["ID"])
                ->where("deleteFlag", "=", 0)->get()->toArray());

        $statisticsData["totalCount"] = isset($retArr[0]["totalCount"]) ? $retArr[0]["totalCount"]: 0;
        $statisticsData["finishCount"] = isset($retArr[0]["finishCount"]) ? $retArr[0]["finishCount"]: 0;
        $statisticsData["leftCount"] = $statisticsData["totalCount"] - $statisticsData["finishCount"];
        $statisticsData["subFinishPercent"] = $statisticsData["totalCount"] == 0 ? 100 : round(($statisticsData["finishCount"]/$statisticsData["totalCount"])*100, 2);

        return $statisticsData;
    }
}
