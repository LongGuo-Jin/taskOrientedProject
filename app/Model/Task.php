<?php

namespace App\Model;
use Carbon\Carbon;
use DB;
use App\Helper\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use DateTime;
use Illuminate\Support\Facades\Log;
class Task extends Model
{
    protected $table = "task";
    protected $roleId;
    protected $login_id;
    public $tmpArr = array();

    protected $fillable = [
        'ID', 'title', 'datePlanStart', 'datePlanEnd', 'dateActualStart', 'dateActualEnd', 'statusID', 'priorityID', 'weightID', 'personID'
        , 'budgetAllocated', 'hoursAllocated', 'hourSpent', 'hourCost','taskCreatorID', 'deleteFlag'
    ];

    public function __construct()
    {
        $Person = auth()->user();

        $personID = $Person->id;
        $login_role_id = $Person->roleID;

        $this->roleId = $login_role_id;
        $this->login_id = $personID;
    }

    public function addTask($taskData)
    {
        $ret = DB::table($this->table)
            ->insert($taskData);
        Log::debug("insert task data".$ret);
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
        $organization_id = auth()->user()->organization_id;
        $filter_order = auth()->user()->filter_order;

        $retArr = array();
        $qrBuilder = DB::table($this->table)
            ->leftJoin("taskstatus", "task.statusID", "=", "taskstatus.ID")
            ->leftJoin("taskpriority", "task.priorityID", "=", "taskpriority.ID")
            ->leftJoin("taskweight", "task.weightID", "=", "taskweight.ID")
            ->leftJoin("allocated_times","task.ID",'=',"allocated_times.taskID")
            ->leftJoin("users", "task.personID", "=", "users.id")
            ->where('deleteFlag', 0)
            ->where('users.organization_id',$organization_id)
            ->select("{$this->table}.*", "taskstatus.note as status_icon"
                , "taskpriority.title as priority_title","taskpriority.order as order" , "taskweight.title as weight"
                ,"users.avatarType as avatarType","users.avatarColor as avatarColor" , "users.nameTag as nameTag" ,"users.roleID"
                , DB::raw("concat(users.nameFamily, ' ', users.nameFirst) as fullName"));

        $ret = [];
        switch ($this->roleId) {
            case Common::constant("role.proManager"):
            case Common::constant("role.foreman"):
            case Common::constant("role.worker"):
//                $qrBuilder = $qrBuilder->whereNull("task.parentID");
                $qrBuilder = $qrBuilder->where("task.personID", "=", $this->login_id);
                $ret = $qrBuilder->orderBy('order', 'asc')->orderBy('id','asc')->get()->toArray();
                $pmArr = [];

                foreach($ret as $eachTask){
                    $task = $this->getTaskListbyCond(array("taskID" => $eachTask->parentID));
                    if ($task[0]['personID'] != $this->login_id) {
                        array_push($pmArr,$eachTask);
                    }
                }
                $ret = $pmArr;
                break;

            case Common::constant("role.admin"):

                $qrBuilder = $qrBuilder->whereNull("task.parentID");
                $ret = $qrBuilder->orderBy('order', 'asc')->orderBy('id','asc')->get()->toArray();

                break;
        }


        $result1 = $this->adtResult(Common::stdClass2Array($ret));

        $retArr[0] = $result1;

        $result['list'] = $retArr;
        $result['parents'][0] = "";

        return $result;
    }

    public  function getTaskListForCalendar($data) {
        $organization_id = auth()->user()->organization_id;
        $qrBuilder = DB::table($this->table)
            ->leftJoin("taskstatus", "task.statusID", "=", "taskstatus.ID")
            ->leftJoin("taskpriority", "task.priorityID", "=", "taskpriority.ID")
            ->leftJoin("taskweight", "task.weightID", "=", "taskweight.ID")
            ->leftJoin("users", "task.personID", "=", "users.id")
            ->where('deleteFlag', 0)
            ->where('users.organization_id',$organization_id)
            ->select("{$this->table}.*", "taskstatus.note as status_icon" , "taskpriority.title as priority_title", "taskpriority.order as order" ,  "taskweight.title as weight"
                ,"users.avatarType as avatarType","users.avatarColor as avatarColor" , "users.nameTag as nameTag" ,"users.roleID"
                , DB::raw("concat(users.nameFamily, ' ', users.nameFirst) as fullName"));

        $status = $data->input('status') == "" ? "1": $data->input('status');
        $priority_high= $data->input('H') == "" ? "": $data->input('H');
        $priority_medium= $data->input('M') == "" ? "": $data->input('M');
        $priority_low= $data->input('L') == "" ? "": $data->input('L');
        $priority_ness= $data->input('O') == "" ? "": $data->input('O');

        if ($priority_high == "" && $priority_medium == "" && $priority_low == "" && $priority_ness == "" ) {
            $priority_high = 1;
        }
        if ($priority_high == '1') {
            $priority_high = 1;
        }
        if ($priority_medium == '1') {
            $priority_medium = 2;
        }
        if ($priority_low == '1') {
            $priority_low = 3;
        }
        if ($priority_ness == '1') {
            $priority_ness = 4;
        }

        $qrBuilder = $qrBuilder->where("statusID",'=',$status);

        switch ($this->roleId) {
            case Common::constant("role.proManager"):
            case Common::constant("role.foreman"):
                $qrBuilder = $qrBuilder->where("task.personID", "=", $this->login_id);
                $qrBuilder = $qrBuilder->orwhere("taskCreatorID", "=", $this->login_id);
                break;
            case Common::constant("role.admin"):
                break;
            case Common::constant("role.worker"):
                $qrBuilder = $qrBuilder->where("taskCreatorID", "!=", $this->login_id);
                $qrBuilder = $qrBuilder->where("task.personID", "=", $this->login_id);
                break;
        }

        $ret = $qrBuilder->orderBy('order', 'asc')->orderBy('id','asc')->orderBy('statusID','asc')->get()->toArray();
        $result = $this->adtResult(Common::stdClass2Array($ret));
        $yesterday_tasks = [];
        $today_tasks = [];
        $tomorrow_tasks = [];
        $theNextDay_tasks = [];
        $retArr = [];

        foreach ($result as $taskItem) {
            if ($taskItem['priorityID'] != $priority_high && $taskItem['priorityID'] != $priority_medium && $taskItem['priorityID'] != $priority_low &&$taskItem['priorityID'] != $priority_ness) {
                continue;
            }

            $today = date("Y-m-d");
            $yesterday = date("Y-m-d",strtotime("yesterday"));
            $tomorrow = date("Y-m-d",strtotime("tomorrow"));
            $theNextDay = date("Y-m-d",strtotime("tomorrow")+60*60*24);
            $dateStart = date("Y-m-d",strtotime($taskItem["creatAt"]));


            switch ($dateStart) {
                case $yesterday:
                    array_push($yesterday_tasks,$taskItem);
                    break;
                case $today:
                    array_push($today_tasks,$taskItem);
                    break;
                case $tomorrow:
                    array_push($tomorrow_tasks,$taskItem);
                    break;
                case $theNextDay:
                    array_push($theNextDay_tasks,$taskItem);
                    break;
                default:
                    break;
            }
        }

        $retArr['yesterday'] = $yesterday_tasks;
        $retArr['today'] = $today_tasks;
        $retArr['tomorrow'] = $tomorrow_tasks;
        $retArr['theNextDay'] = $theNextDay_tasks;
        $retArr['theNextDay'] = $theNextDay_tasks;

        return $retArr;
    }


    public function getTaskListForDashboard() {
        $organization_id = auth()->user()->organization_id;
        $qrBuilder = DB::table($this->table)

            ->leftJoin("taskstatus", "task.statusID", "=", "taskstatus.ID")
            ->leftJoin("taskpriority", "task.priorityID", "=", "taskpriority.ID")
            ->leftJoin("taskweight", "task.weightID", "=", "taskweight.ID")
            ->leftJoin("users", "task.personID", "=", "users.id")
            ->where('deleteFlag', 0)
            ->where('users.organization_id',$organization_id)
            ->select("{$this->table}.*", "taskstatus.note as status_icon" , "taskstatus.id as taskstatusid"
                , "taskpriority.title as priority_title", "taskpriority.order as order" ,  "taskweight.title as weight"
                ,"users.avatarType as avatarType","users.avatarColor as avatarColor" , "users.nameTag as nameTag" ,"users.roleID"
                , DB::raw("concat(users.nameFamily, ' ', users.nameFirst) as fullName"));

        switch ($this->roleId) {
            case Common::constant("role.proManager"):
            case Common::constant("role.foreman"):
                $qrBuilder = $qrBuilder->where("task.personID", "=", $this->login_id);
                $qrBuilder = $qrBuilder->orwhere("taskCreatorID", "=", $this->login_id);
                break;
            case Common::constant("role.admin"):
                break;
            case Common::constant("role.worker"):
                $qrBuilder = $qrBuilder->where("taskCreatorID", "!=", $this->login_id);
                $qrBuilder = $qrBuilder->where("task.personID", "=", $this->login_id);
                break;
        }

        $ret = $qrBuilder->orderBy('order', 'asc')->orderBy('id','asc')->orderBy('statusID','asc')->get()->toArray();
        $result = $this->adtResult(Common::stdClass2Array($ret));
        $active_tasks = [];
        $overdue_tasks = [];
        $new_tasks = [];
        $retArr = [];

        $now = time();
        foreach ($result as $taskItem) {
            $dateEnd = $taskItem["datePlanEnd"];
            $actualEnd = $taskItem["dateActualEnd"];
            $taskStatus = $taskItem['taskstatusid'];
            $arrEnd = (explode(".",$dateEnd));
            $datePlanEnd = strtotime($arrEnd[1].'/'.$arrEnd[0].'/'.$arrEnd[2]);


            $dateStart = $taskItem["creatAt"];
            $datePlanStart = strtotime($dateStart);
            if ($taskStatus != 4 && $taskStatus!= 5 && $now >   $datePlanEnd){
                array_push($overdue_tasks , $taskItem);
            } else {
                array_push($active_tasks , $taskItem);
            }
            $datediff = $now - $datePlanStart;
            if (abs(round($datediff / (60 * 60 * 24))) < 5.0 && $taskStatus != 4 && $taskStatus!= 5) {
                array_push($new_tasks , $taskItem);
            }
        }
        $retArr['active'] = $active_tasks;
        $retArr['overdue'] = $overdue_tasks;
        $retArr['new'] = $new_tasks;

        return $retArr;

    }


    public function getTaskList($taskDetails)
    {
        $role = auth()->user()->roleID;
        $result['list'] = $result['parents'] = array();
        $parentsArr[2] = $parentsArr[1] = $parentsArr[0] = "";
        $retArr[2] = $retArr[1] = $retArr[0] = array();
        $parentId = empty($taskDetails["parentID"]) ? "": $taskDetails["parentID"];

        $isMainRoot = $this->isRootLevel($taskDetails["ID"]);

        $isParentRoot = $this->isRootLevel($taskDetails["parentID"]);

        //get first column data
        if ($isParentRoot || $isMainRoot) {

            $initList = $this->getTaskListInit();
            $retArr[0] = $initList["list"][0];
            $parentsArr[0] = $initList['parents'][0];

        } else {
            $tmp = $this->adtResult($this->getTaskListbyCond(array("taskID" => $taskDetails['parentID'])));

            if ($this->roleId == 1) {
                $tmp1 = $this->adtResult($this->getTaskListbyCond(array("parentID" => $tmp[0]['parentID'])));
            } else {
                $tmp1 = $this->adtResult($this->getTaskListbyCond(array("parentID" => $tmp[0]['parentID'] , "personID"=>auth()->user()->id)));
            }
            $parentsArr[0] =  $parentId;
            if (count($tmp1)) {
                $retArr[0] = $tmp1;
                $upParentId = $tmp[0]['parentID'];
                $parentsArr[0] = $upParentId;
            }
        }

        // get second column
        if ($isMainRoot ){
            if ($this->roleId == 1) {
                $retArr[1] = $this->adtResult($this->getTaskListbyCond(array("parentID" => $taskDetails['ID'])));
            } else {

                $tmp = $this->adtResult($this->getTaskListbyCond(array("parentID" => $taskDetails['ID'], "personID"=>auth()->user()->id)));
                $tmp1 = $this->adtResult($this->getTaskListbyCond(array("parentID" =>$taskDetails['ID'],"taskCreatorID"=>auth()->user()->id)));
//                dd($tmp1);
                $tmp = array_merge($tmp,$tmp1);
                $retArr[1] = $tmp;
            }
            $parentsArr[1] = $taskDetails['ID'];
        } else {
            if ($this->roleId == 1) {
                $tmp = $this->adtResult($this->getTaskListbyCond(array("parentID" => $parentId)));
            } else {
                $tmp = $this->adtResult($this->getTaskListbyCond(array("parentID" => $parentId, "personID"=>auth()->user()->id)));

                $tmp1 = $this->adtResult($this->getTaskListbyCond(array("parentID" =>$parentId,"taskCreatorID"=>auth()->user()->id)));

                $tmp = array_merge($tmp,$tmp1);
            }
            if (count($tmp)) {
                $retArr[1] = $tmp;
                $upParentId =$parentId;
                $parentsArr[1] = $upParentId;
            }
        }

        // get third column
        if (!$isMainRoot) {
            if ($this->roleId == 1) {
                $tmp = $this->adtResult($this->getTaskListbyCond(array("parentID" => $taskDetails['ID'])));
            } else {
                $tmp = $this->adtResult($this->getTaskListbyCond(array("parentID" => $taskDetails['ID'], "personID"=>auth()->user()->id)));
                $tmp1 = $this->adtResult($this->getTaskListbyCond(array("parentID" => $taskDetails['ID'],"taskCreatorID"=>auth()->user()->id)));
                $tmp = array_merge($tmp,$tmp1);
            }
            if (count($tmp)) {
                $retArr[2] = $tmp;
                $upParentId = $taskDetails['ID'];
                $parentsArr[2] = $upParentId;
            }
        }

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
        $user_id = auth()->user()->id;
        $ret = false;
        $parentId = "";

        if ($this->roleId == 1) {
            $tmp = $this->getTaskListbyCond(array("taskID" => $taskId));

        } else {
            $tmp = $this->getTaskListbyCond(array("taskID" => $taskId , "personID"=>$user_id));
        }

        if (count($tmp)) {
            $parentId = empty($tmp[0]["parentID"]) ? "": $tmp[0]["parentID"];
        }
        else {
            if ($this->roleId != 1) {
                return false;
            }
        }

        switch ($this->roleId) {
            case Common::constant("role.admin"):
                if ($parentId == "")
                    $ret = true;
                break;
            case Common::constant("role.proManager"):
            case Common::constant("role.foreman"):
            case Common::constant("role.worker"):
                if ($parentId == "")
                    $ret = true;
//                $tmp = array();
                $tmp = $this->getTaskListbyCond(array("taskID" => $parentId,"personID"=>$user_id));
                if (count($tmp) == 0)
                    $ret = true;
                break;
        }

        return $ret;
    }


    public function getTaskListbyCond($cond)
    {
        $organization_id = auth()->user()->organization_id;
        $qrBuilder = DB::table($this->table)
            ->leftJoin("taskstatus", "task.statusID", "=", "taskstatus.ID")
            ->leftJoin("taskpriority", "task.priorityID", "=", "taskpriority.ID")
            ->leftJoin("taskweight", "task.weightID", "=", "taskweight.ID")
            ->leftJoin("users", "task.personID", "=", "users.id")
            ->where('users.organization_id',$organization_id)
            ->where('deleteFlag', "=", 0)
            ->select("{$this->table}.*", "taskstatus.note as status_icon"
                , "taskpriority.title as priority_title","taskpriority.order as order" , "taskweight.title as weight"
                ,"users.organization_id as organizationID","users.avatarType as avatarType","users.avatarColor as avatarColor" , "users.nameTag as nameTag" ,"users.roleID"
                , DB::raw("concat(users.nameFamily, ' ', users.nameFirst) as fullName"));


        if (isset($cond['taskID'])){
            if ($cond['taskID'] == "") {
                $qrBuilder = $qrBuilder->whereNull("task.ID");
            } else {
                $qrBuilder = $qrBuilder->where("task.ID", "=", $cond['taskID']);
            }
        }
        if (isset($cond['taskCreatorID'])){
            $qrBuilder =  $qrBuilder->where("users.id", "!=", $cond['taskCreatorID']);
           $qrBuilder = $qrBuilder->where("task.taskCreatorID", "=", $cond['taskCreatorID']);

        }

        if (isset($cond['personID'])){
            $qrBuilder =  $qrBuilder->where("users.id", "=", $cond['personID']);
//            $qrBuilder = $qrBuilder->where("task.taskCreatorID", "!=", $cond['personID']);
        }

        if (isset($cond['parentID'])) {
            if ($cond['parentID'] == "") {
                $qrBuilder = $qrBuilder->whereNull("task.parentID");
            } else {
                $qrBuilder = $qrBuilder->where("task.parentID", "=", $cond['parentID']);
            }
        }

        $ret = $qrBuilder->orderBy('order', 'asc')->orderBy('id', 'asc')->orderBy('statusID','asc')->get()->toArray();
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
    function childTask() {
        return $this->hasMany(Task::class);
    }
    function parentTask() {
        return $this->belongsTo(Task::class,'parentID');
    }
}
