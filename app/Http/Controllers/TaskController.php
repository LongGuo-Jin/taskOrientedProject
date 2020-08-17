<?php

namespace App\Http\Controllers;

use App\AllocatedTime;
use App\Filter;
use App\Model\Attachment;
use App\Model\Budget;
use App\Model\Expense;
use App\Model\History;
use App\Model\Memo;
use App\Model\Tag;
use App\Model\TagPerson;
use App\Model\Task;
use App\Model\TaskPriority;
use App\Model\TaskStatus;
use App\Model\TaskWeight;
use App\Organization;
use App\SubTaskTime;
use App\TagTask;
use App\Time;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Psy\Command\HistoryCommand;
use App\Helper\Common;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function __construct()
    {
    }

    public function index() {
        $locale = App::getLocale();
        $Task = new Task();
        $taskList = $Task->getTaskListForDashboard(auth()->user());
        $user = auth()->user();
        $personID = $user->id;
        $filters =Filter::where('user_id',$personID)->first()->toArray();
        $memoNotification = auth()->user()->memoNotification;
        $notifications = explode(',',$memoNotification);

        $filter_order = auth()->user()->filter_order;
        $filter_array= array();
        $filter_array_str = ["status","priority","weight","date","workTime","budget"];

        for ($i = 0 ; $i < strlen($filter_order);  $i ++) {
            $filter_array[$filter_order[$i]] = $filter_array_str[$i];
        }

        for ($i = count($filter_array) ; $i >= 1;  $i --) {
            if ($filter_array[$i] == 'budget')
                continue;
            $taskList['new'] = $this->topSort($taskList['new'],$filter_array[$i],auth()->user());
            $taskList['active'] = $this->topSort($taskList['active'],$filter_array[$i],auth()->user());
            $taskList['overdue'] = $this->topSort($taskList['overdue'],$filter_array[$i],auth()->user());
        }

        $taskList['new'] = $this->task_filter($taskList['new'],auth()->user());
        $taskList['active'] = $this->task_filter($taskList['active'],auth()->user());
        $taskList['overdue'] = $this->task_filter($taskList['overdue'],auth()->user());
        $taskList['unread'] = [];
        foreach($taskList as $tasks) {
            foreach($tasks as $task) {
                if (in_array($task['ID'],$notifications)) {
                    array_push($taskList['unread'],$task);
                }
            }
        }

        return view('dashboard',
            [
                'taskList' => $taskList,
                'dashboard' => true,
                'personalID' => $personID,
                'locale' => $locale,
                'filters' => $filters,
                'memoNotification' => $memoNotification,
            ]
        );
    }

    public function CalendarView(Request $request) {
        $Task = new Task();
        $taskList = $Task->getTaskListForCalendar($request,auth()->user());
        $user = auth()->user();
        $personID = $user->id;
        $status = $request->input('status') == "" ? "1": $request->input('status');
        $priority_high= $request->input('H') == "" ? "": $request->input('H');
        $priority_medium= $request->input('M') == "" ? "": $request->input('M');
        $priority_low= $request->input('L') == "" ? "": $request->input('L');
        $priority_ness= $request->input('O') == "" ? "": $request->input('O');

        if ($priority_high == "" && $priority_medium == "" && $priority_low == "" && $priority_ness == "" ) {
            $priority_high = 1;
        }
        if ($priority_high == '1') {
            $priority_high = 1;
        }
        if ($priority_medium == '1') {
            $priority_medium = 1;
        }
        if ($priority_low == '1') {
            $priority_low = 1;
        }
        if ($priority_ness == '1') {
            $priority_ness = 1;
        }

        return view('calendar', [
            'taskList' => $taskList,
            'calendar' => true,
            'personalID' => $personID,
            'status' => $status,
            'H' => $priority_high,
            'M' => $priority_medium,
            'L' => $priority_low,
            'O' => $priority_ness,
        ]);
    }

    public function task_filter($data , $user) {

        $user_id = $user->id;
        $filter = Filter::where('user_id',$user_id)->get()->first();
        $new_data = [];
        foreach($data as $item) {
            if ($filter['status'][$item['statusID']-1]=='1' && $filter['priority'][$item['order']]=='1'
                && $filter['weight'][9 - $item['weight']] == '1') {
                if ($filter['date'][2] != '1') {
                    if ($item['datePlanStart'] != null) {
                        array_push($new_data,$item);
                    }
                } else {
                    array_push($new_data,$item);
                }
            }
        }

        return $new_data;
    }

    public function topSort($data , $key , $user) {
        $user_id = $user->id;
        $filter = Filter::where('user_id',$user_id)->get()->first();
        $option = $filter[$key][strlen($filter[$key])-1]=='1'?true:false;
        $length = count($data);
        $op1 = null;
        $op2 = null;
        for ($i = 0 ; $i < $length - 1; $i ++) {
            for ($j = $i ; $j < $length; $j ++) {
                switch ($key) {
                    case "status":
                        if ($option) {
                            if ($data[$i]["statusID"] > $data[$j]["statusID"]) {
                                $temp = $data[$i];
                                $data[$i] = $data[$j];
                                $data[$j] = $temp;
                            }
                        } else {
                            if ($data[$i]["statusID"] < $data[$j]["statusID"]) {
                                $temp = $data[$i];
                                $data[$i] = $data[$j];
                                $data[$j] = $temp;
                            }
                        }
                        break;
                    case "priority":
                        if ($option) {
                            if ($data[$i]["order"] < $data[$j]["order"]) {
                                $temp = $data[$i];
                                $data[$i] = $data[$j];
                                $data[$j] = $temp;
                            }
                        } else {
                            if ($data[$i]["order"] > $data[$j]["order"]) {
                                $temp = $data[$i];
                                $data[$i] = $data[$j];
                                $data[$j] = $temp;
                            }
                        }
                        break;
                    case "weight":
                        if ($option) {
                            if ($data[$i]["weight"] > $data[$j]["weight"]) {
                                $temp = $data[$i];
                                $data[$i] = $data[$j];
                                $data[$j] = $temp;
                            }
                        } else {
                            if ($data[$i]["weight"] < $data[$j]["weight"]) {
                                $temp = $data[$i];
                                $data[$i] = $data[$j];
                                $data[$j] = $temp;
                            }
                        }
                        break;
                    case "date":
                        switch ($filter['date'][0]) {
                            case '1':
                                $op1 = strtotime($data[$i]['creatAt']);
                                $op2 = strtotime($data[$j]['creatAt']);
                                break;
                            case '2':
                                $op1 = date_create_from_format("d.m.Y",$data[$i]['datePlanStart'])->getTimestamp();
                                $op2 = date_create_from_format("d.m.Y",$data[$j]['datePlanStart'])->getTimestamp();

                                break;
                            case '3':
                                $op1 = date_create_from_format("d.m.Y",$data[$i]['datePlanEnd'])->getTimestamp();
                                $op2 = date_create_from_format("d.m.Y",$data[$j]['datePlanEnd'])->getTimestamp();
                                break;
                            case '4':
                                $op1 = $data[$i]['dateActualStart'] != null?strtotime($data[$i]['dateActualStart']):date_create_from_format("d.m.Y",$data[$i]['datePlanStart'])->getTimestamp();
                                $op2 = $data[$j]['dateActualStart'] != null?strtotime($data[$j]['dateActualStart']):date_create_from_format("d.m.Y",$data[$j]['datePlanStart'])->getTimestamp();
                                break;
                            case '5':
                                $op1 = $data[$i]['dateActualEnd'] != null?strtotime($data[$i]['dateActualEnd']):date_create_from_format("d.m.Y",$data[$i]['datePlanEnd'])->getTimestamp();
                                $op2 = $data[$j]['dateActualEnd'] != null?strtotime($data[$j]['dateActualEnd']):date_create_from_format("d.m.Y",$data[$j]['datePlanEnd'])->getTimestamp();
                                break;
                        }

                        if ($option) {
                            if ($op1 > $op2) {
                                $temp = $data[$i];
                                $data[$i] = $data[$j];
                                $data[$j] = $temp;
                            }
                        } else {
                            if ($op1 < $op2) {
                                $temp = $data[$i];
                                $data[$i] = $data[$j];
                                $data[$j] = $temp;
                            }
                        }
                        break;
                    case "workTime":
                        /// for index $i
                        $totalTime_i = 0;
                        $timeAllocated_i = 0;
                        $taskId= $data[$i]['ID'];
                        $workTime = Time::where('taskID',$taskId)->get()->toArray();
                        foreach($workTime as $time) {
                            $totalTime_i+= $time['timeSpent'] * 1.0;
                        }
                        $timeSpentOnSubTask_i = SubTaskTime::where('taskID',$taskId)->get()->first();
                        $timeSpentOnSubTask_i = $timeSpentOnSubTask_i==null?0:$timeSpentOnSubTask_i['timeSpentOnSubTask'] * 1.0;

                        $allocateTimes = AllocatedTime::where('taskID',$taskId)->get()->toArray();
                        foreach($allocateTimes as $allocateTime) {
                            $timeAllocated_i += $allocateTime['timeAllocated'] * 1.0;
                        }
                        $timeSpent_i = $totalTime_i + $timeSpentOnSubTask_i;
                        $remainingTime_i = $timeAllocated_i - $timeSpent_i;

                        /// for index $j
                        $totalTime_j = 0;
                        $timeAllocated_j = 0;
                        $taskId= $data[$j]['ID'];
                        $workTime = Time::where('taskID',$taskId)->get()->toArray();
                        foreach($workTime as $time) {
                            $totalTime_j+= $time['timeSpent'] * 1.0;
                        }
                        $timeSpentOnSubTask_j = SubTaskTime::where('taskID',$taskId)->get()->first();
                        $timeSpentOnSubTask_j = $timeSpentOnSubTask_j==null?0:$timeSpentOnSubTask_j['timeSpentOnSubTask'] * 1.0;

                        $allocateTimes = AllocatedTime::where('taskID',$taskId)->get()->toArray();
                        foreach($allocateTimes as $allocateTime) {
                            $timeAllocated_j += $allocateTime['timeAllocated'] * 1.0;
                        }
                        $timeSpent_j = $totalTime_j + $timeSpentOnSubTask_j;
                        $remainingTime_j = $timeAllocated_j - $timeSpent_j;

                        switch ($filter['workTime'][0]) {
                            case '1':
                                if ($option) {
                                    if ($timeAllocated_i > $timeAllocated_j) {
                                        $temp = $data[$i];
                                        $data[$i] = $data[$j];
                                        $data[$j] = $temp;
                                    }
                                } else {
                                    if ($timeAllocated_i < $timeAllocated_j) {
                                        $temp = $data[$i];
                                        $data[$i] = $data[$j];
                                        $data[$j] = $temp;
                                    }
                                }
                                break;
                            case '2':
                                if ($option) {
                                    if ($timeSpent_i > $timeSpent_j) {
                                        $temp = $data[$i];
                                        $data[$i] = $data[$j];
                                        $data[$j] = $temp;
                                    }
                                } else {
                                    if ($timeSpent_i < $timeSpent_j) {
                                        $temp = $data[$i];
                                        $data[$i] = $data[$j];
                                        $data[$j] = $temp;
                                    }
                                }
                                break;
                            case '3':
                                if ($option) {
                                    if ($remainingTime_i > $remainingTime_j) {
                                        $temp = $data[$i];
                                        $data[$i] = $data[$j];
                                        $data[$j] = $temp;
                                    }
                                } else {
                                    if ($remainingTime_i < $remainingTime_j) {
                                        $temp = $data[$i];
                                        $data[$i] = $data[$j];
                                        $data[$j] = $temp;
                                    }
                                }
                                break;
                        }
                        break;
                    case "budget":
                        break;
                    default:
                        break;
                }
            }
        }
        return $data;
    }

    public function taskCard(Request $request) {
        $Person = new User();
        $TaskPriority = new TaskPriority();
        $TaskStatus = new TaskStatus();
        $TaskWeight = new TaskWeight();
        $Task = new Task();
        $Tag = new Tag();
        $Memo = new Memo();
        $Budget = new Budget();
        $Expense = new Expense();
        $Attachment = new Attachment();
        $History = new History();
        $taskTag = new TagTask();
        $totalPersonList = $Person->getPersonList();
        $rolePersonList = $Person->getrolePersonList();
        $TaskPriorityList = $TaskPriority->getTaskPriorityList();
        $TaskStatusList = $TaskStatus->getTaskStatusList();
        $TaskWeightList = $TaskWeight->getTaskWeightList();
        $systemTagList = $Tag->getSystemTagList();
        $tagList = $Tag->getTagList();

        $memoNotification = auth()->user()->memoNotification;

        $taskDetails = array();
        $memos = array();
        $budget = array();
        $expense = array();
        $attachs = array();
        $statisticsData = array();
        $history = array();
        $pathArr = array();
        $workTime = array();
        $allocateTimes = array();
        $filters = array();
        $taskTagList = array();
        $timeSpentOnSubTask = null;
        $totalTime = 0;
        $timeAllocated = 0;
        $expenseSum = $budgetSum = $expenseTotalSum = $budgetTotalSum =0;
        $showType = $request->input('show_type') == "" ? "regular": $request->input('show_type');
        $taskId = $request->input('task_id') == "" ? "": $request->input('task_id');
        $detailTab = "information";
        $entireTree = $Task->getEntirTreeIds($taskId);
        $message = array("flage" => 0);
        if ($request->input('message') != "") {
            $message["flage"] = 1;
            $message["message"] = $request->input('message');
            $message["messageType"] = $request->input('messageType');
        }
     
        $user = auth()->user();
        $personID = $user->id;
        $login_role_id = $user->roleID;
        $filters =Filter::where('user_id',$personID)->first()->toArray();

        if ($taskId == "") {
            $taskList = $Task->getTaskListInit(auth()->user());
        } else {
            $notifications = explode(',',$memoNotification);
            if (in_array($taskId, $notifications)) {
                $newMemoNotification = "";
                $cnt = 0;
                foreach($notifications as $notification) {
                    if ($notification != $taskId) {
                        if ($cnt == 0) {
                            $newMemoNotification = $notification;
                        } else {
                            $newMemoNotification = $newMemoNotification.",".$notification;
                        }
                        $cnt += 1;
                    }
                }
                User::where('id',$personID)->update(["memoNotification" => $newMemoNotification]);
//                $memoNotification = $newMemoNotification;
            }

            $workTime = Time::where('taskID',$taskId)->get()->toArray();
            foreach($workTime as $time) {
                $totalTime += $time['timeSpent'];
            }
            $timeSpentOnSubTask = SubTaskTime::where('taskID',$taskId)->get()->first();
            $timeSpentOnSubTask = $timeSpentOnSubTask==null?0:$timeSpentOnSubTask['timeSpentOnSubTask'];
            $taskDetails = $Task->adtResult($Task->getTaskListbyCond(array("taskID" => $taskId),auth()->user()));

            $allocateTimes = AllocatedTime::where('taskID',$taskId)->get()->toArray();
            foreach($allocateTimes as $allocateTime) {
                $timeAllocated += $allocateTime['timeAllocated'];
            }

            $taskTagList = $taskTag->getTaskTagList($taskId);
            $memos = $Memo->getMemoByCond(array("taskID" => $taskId));
            $budget = $Budget->getBudgetByCond(array("taskID" => $taskId, "personID" => $personID));
            $expense = $Expense->getExpenseByCond(array("taskID" => $taskId, "personID" => $personID));
            $expenseSum = $Expense->getSumExpense(array("taskID" => $taskId, "personID" => $personID));
            $budgetSum = $Budget->getSumBudget(array("taskID" => $taskId, "personID" => $personID));
            $expenseTotalSum = $Expense->getSumExpense(array("entireTree" => $entireTree));
            $budgetTotalSum = $Budget->getSumBudget(array("entireTree" => $entireTree));
            $pathArr = $Task->getPathName($taskId);

            $attachs = $Attachment->getAttachmentByCond(array("taskID" => $taskId));
            $history = $History->getHistoryByCond(array("taskID" => $taskId, "personID" => $personID));
            $statisticsData = $Task->getStatisticsData($taskDetails[0]);
            $taskList = $Task->getTaskList($taskDetails[0],auth()->user());

            $detailTab = $request->input("detailTab");
        }

        $filter_order = auth()->user()->filter_order;
        $filter_array= array();
        $filter_array_str = ["status","priority","weight","date","workTime","budget"];

        for ($i = 0 ; $i < strlen($filter_order);  $i ++) {
            $filter_array[$filter_order[$i]] = $filter_array_str[$i];
        }

        for ($i = count($filter_array) ; $i >= 1;  $i --) {
            if ($filter_array[$i] == 'budget')
                continue;
            foreach ($taskList['list'] as $index => $task) {
                $taskList['list'][$index] = $this->topSort($task,$filter_array[$i],auth()->user());
            }
        }

        foreach ($taskList['list'] as $index => $task) {
            $taskList['list'][$index] = $this->task_filter($task,auth()->user());
        }

        return view('task/taskCard',
            [
                'totalPersonList' => $totalPersonList,
                'rolePersonList' => $rolePersonList,
                'TaskPriorityList' => $TaskPriorityList,
                'TaskStatusList' => $TaskStatusList,
                'TaskWeightList' => $TaskWeightList,
                'taskList' => $taskList['list'],
                'taskTagList' =>$taskTagList,
                'tagList' => $tagList,
                'parents' => $taskList['parents'],
                'personalID' => $personID,
                'login_role_id' => $login_role_id,
                'systemTagList' => $systemTagList,
                'showType' => $showType,
                'taskId' => $taskId,
                'taskDetails' => isset($taskDetails[0]) ? $taskDetails[0]: array(),
                'memos' => $memos,
                'budget' => $budget,
                'expense'=> $expense,
                'attachs' => $attachs,
                'expenseSum' => $expenseSum,
                'budgetSum' => $budgetSum,
                'detailTab' => $detailTab,
                'statisticsData' => $statisticsData,
                'history' => $history,
                'expenseTotalSum' => $expenseTotalSum,
                'budgetTotalSum' => $budgetTotalSum,
                'workTime' => $workTime,
                'timeSpentOnSubTask' => $timeSpentOnSubTask,
                'timeAllocated' => $timeAllocated,
                'allocatedTimes' => $allocateTimes,
                'totalTime' => $totalTime,
                'pathArr'   => $pathArr,
                'message'   => $message,
                'taskCard'  => true,
                'filters'   => $filters,
                'memoNotification' => $memoNotification,
            ]
        );
    }

    public function taskCardAdd(Request $request) {

        $user = auth()->user();
        $personID = $user->id;
        $login_role_id = $user->roleID;

        $taskData = array(
            'title' =>  $request->input('title'),
            'datePlanStart' =>  $request->input('datePlanStart') == "" ? date("d.m.Y") : $request->input('datePlanStart'),
            'datePlanEnd' =>  $request->input('datePlanEnd') == "" ? date("d.m.Y") : $request->input('datePlanEnd'),
            'statusID' =>  $request->input('statusID') == "" ? Common::constant("defaultId.Status"): $request->input('statusID'),
            'priorityID' =>  $request->input('priorityID') == "" ? Common::constant("defaultId.Priority"): $request->input('priorityID'),
            'weightID' =>  $request->input('weightID') == "" ? Common::constant("defaultId.Weight"): $request->input('weightID'),
            'personID' =>  $request->input('personID'),
            'parentID' =>  $request->input('parentID') == 0 ? null: $request->input('parentID'),
            'description' =>  $request->input('description'),
            'tags' =>  $request->input('tagList'),
            'taskCreatorID' => $personID,
            'deleteFlag'    => 0,
            'creatAt'   =>  date('Y-m-d h:i:s'),
            'updateAt'   =>  date('Y-m-d h:i:s')
        );

        if ($taskData["statusID"] == 2)
            $taskData["dateActualStart"] = date('Y-m-d h:i:s');
        if ($taskData["statusID"] == 4 || $taskData["statusID"] == 5)
            $taskData["dateActualEnd"] = date('Y-m-d h:i:s');

        $Task = new Task();


        try {
            DB::beginTransaction();

            $ret = $Task->addTask($taskData);
            $taskID = $Task->getLastInsertId();
            if($taskData['tags'] != "") {
                $tags = explode(",",$taskData['tags']);

                foreach($tags as $tag) {
                    TagTask::create(['taskID'=>$taskID,'tagID'=>$tag]);
                }
            }

            if ($request->input('memo') != "") {
                $Memo = new Memo();
                $memo = array(
                    'timeStamp' => date("d.m.Y h:i"),
                    'personID' => $personID,
                    'taskID' => $taskID,
                    'Message' => $request->input('memo')
                );
                $ret = $Memo->addMemo($memo);
                //starting adding memo notification;;;
                $orgID = $user->organization_id;
                $organization = Organization::where('id',$orgID)->get()->first();
                $org_users = $organization->Users()->get();
                foreach($org_users as $org_user) {
                    $id = $org_user->id;
                    $memoNotification = $org_user->memoNotification;
                    if ($id != $personID) {
                        if ($memoNotification == "") {
                            $memoNotification = $taskID;
                        } else {
                            $notifications = explode(',',$memoNotification);
                            if (!in_array($taskID,$notifications)) {
                                $memoNotification = $memoNotification.",".$taskID;
                            }
                        }
                        User::where('id',$id)->update(['memoNotification'=>$memoNotification]);
                    }
                }
                //end adding memo notification;;;
            }

            $History = new History();
            $historyData = array(
                'eventDate' => date("d.m.Y h:i"),
                'personID' => $personID,
                'taskID' => $taskID,
                'event' => "Created."
            );
            $ret = $History->addHistory($historyData);

            DB::commit();
        }catch (\Exception $e ){
            Log::debug($e->getMessage());
            DB::rollBack();
            $ret = -1;
        }

        if ($ret != 1) {
            DB::rollBack();
        }

        $data = array();
        $data["ID"] = $taskID;
        $data["result"] = $ret;

        print_r(json_encode($data));die;
    }

    public function AddAllocationTime(Request $request) {

        Log::debug($request);
        $taskID = $request->input('taskID');
        $description = $request->input('description');
        $hour = $request->input('hour');
        $min = $request->input('min');
        $personID = $request->input('personID');
        $user = User::where('id',$personID)->get()->first();
        $timeSpent = $hour * 1 + $min * 1/60;
        $taskData = [
            'taskID' => $taskID,
            'personID'=>$personID,
            'personName' =>  $user->nameFirst." ".$user->nameFamily,
            'description' =>  $description,
            'timeAllocated'=> $timeSpent,
            'allocateDate'   =>  date('Y-m-d'),
        ];
        $ret = 1;
        try{
            AllocatedTime::create($taskData);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            $ret = -1;
        }
        $data = array();
        $data["result"] = $ret;
        print_r(json_encode($data));die;
    }

    public function AddWorkTime(Request $request) {
        $taskID = $request->input('taskID');
        $description = $request->input('description');
        $hour = $request->input('hour');
        $min = $request->input('min');
        $personID = $request->input('personID');
        $user = User::where('id',$personID)->get()->first();
        $timeSpent = $hour * 1 + $min * 1/60;
        $taskData = [
            'taskID' => $taskID,
            'personID'=>$personID,
            'personName' =>  $user->nameFirst." ".$user->nameFamily,
            'description' =>  $description,
            'timeSpent'=> $timeSpent,
            'workDate'   =>  date('Y-m-d'),
        ];
        $ret = 1;
        try {
            Time::create($taskData);
            $taskParentID = Task::where('ID',$taskData['taskID'])->get()->first()->parentID;
            while($taskParentID != null) {
                $time = SubTaskTime::where('taskID',$taskParentID)->get()->first();
                $task = Task::where('ID',$taskParentID)->get()->first();
                if ($time == null) {
                    SubTaskTime::create(['taskID'=>$task->ID,
                        'timeSpentOnSubTask' => $timeSpent * 1.0
                    ]);
                } else {
                    SubTaskTime::where('taskID',$taskParentID)->update(['timeSpentOnSubTask' => $time->timeSpentOnSubTask + $timeSpent * 1.0]);
                }
                $taskParentID = $task->parentID;
            }
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            $ret = -1;
        }

        $data = array();
        $data["result"] = $ret;
        print_r(json_encode($data));die;
    }

    public function taskWorkTimeUpdate(Request $request) {

        $taskID = $request->input('taskID');
        $timeSpent = $request->input('workTime');

        $taskData = [
            'taskID' => $request->input('taskID'),
            'personID' =>  $request->input('personID'),
            'description' =>  $request->input('workTimeDescription'),
            'timeSpent'=>$request->input('workTime'),
            'workDate'   =>  date('Y-m-d'),
        ];
        $ret = $taskID;
         try {
             Time::create($taskData);
             $taskParentID = Task::where('ID',$taskData['taskID'])->get()->first()->parentID;
             while($taskParentID != null) {
                 $time = SubTaskTime::where('taskID',$taskParentID)->get()->first();
                 $task = Task::where('ID',$taskParentID)->get()->first();
                 if ($time == null) {
                     SubTaskTime::create(['taskID'=>$task->ID,
                         'timeSpentOnSubTask' => $timeSpent * 1.0
                     ]);
                 } else {
                     SubTaskTime::where('taskID',$taskParentID)->update(['timeSpentOnSubTask' => $time->timeSpentOnSubTask + $timeSpent * 1.0]);
                 }
                 $taskParentID = $task->parentID;
             }
         } catch (\Exception $e) {
             Log::debug($e->getMessage());
             $ret = -1;
         }

        $data = array();
        $data["result"] = $ret;
        Log::debug($data);
        print_r(json_encode($data));die;
    }

    public function taskCardUpdate(Request $request) {
        $data = array();
        $data["result"] = -1;
        $taskID = "";
        $user = auth()->user();
        $personID = $user->id;
        $login_role_id = $user->roleID;


        $taskData = array(
            'title' =>  $request->input('title'),
            'datePlanStart' =>  $request->input('datePlanStart') == "" ? date("d.m.Y") : $request->input('datePlanStart'),
            'datePlanEnd' =>  $request->input('datePlanEnd') == "" ? date("d.m.Y") : $request->input('datePlanEnd'),
            'statusID' =>  $request->input('statusID'),
            'priorityID' =>  $request->input('priorityID'),
            'weightID' =>  $request->input('weightID'),
            'personID' =>  $request->input('selectedPersonID'),
            'parentID' =>  $request->input('parentID') == 0 ? null: $request->input('parentID'),
            'description' =>  $request->input('info_description'),
            'tags' =>  $request->input('tagList'),
            'updateAt'   =>  date('Y-m-d h:i:s')
        );

        if ($taskData["statusID"] == 2)
            $taskData["dateActualStart"] = date('Y-m-d h:i:s');
        if ($taskData["statusID"] == 4 || $taskData["statusID"] == 5)
            $taskData["dateActualEnd"] = date('Y-m-d h:i:s');

        if ($request->input('taskID') != "") {
            $taskID = $request->input('taskID');
        } else {
            print_r($data);die;
        }

        try{
            DB::beginTransaction();

            $Task = new Task();
            $attachment = new Attachment();
            $History = new History();
            $taskStatus = new TaskStatus();
//            $TaskTag = new TagTask();

            TagTask::where('taskID',$taskID)->delete();
            if ($taskData['tags'] != "") {
                $tags = explode(",",$taskData['tags']);
                foreach($tags as $tag) {
                    TagTask::create(['taskID'=>$taskID,'tagID'=>$tag]);
                }
            }

            if ($request->input("fileInfo") != "") {
                $fileInfo = $request->input("fileInfo");
                $fileInfoArr = json_decode($fileInfo, true);

                $attach = array(
                    'timeStamp' => date("d.m.Y h:i"),
                    'personID' => $personID,
                    'taskID' => $taskID,
                    'tmpFileName' => $fileInfoArr["tmpFileName"],
                    'fileName' => $fileInfoArr["fileName"],
                    'extension' => $fileInfoArr["extension"]
                );

                $ret = $attachment->addAttachment($attach);

                $historyData = array(
                    'eventDate' => date("d.m.Y h:i"),
                    'personID' => $personID,
                    'taskID' => $taskID,
                    'event' => "Attachment added: {$attach['fileName']}"
                );
                $ret = $History->addHistory($historyData);
            }

            if ($request->input('memo') != "") {
                $Memo = new Memo();
                $memo = array(
                    'timeStamp' => date("d.m.Y h:i"),
                    'personID' => $personID,
                    'taskID' => $taskID,
                    'Message' => $request->input('memo')
                );

                $ret = $Memo->addMemo($memo);
                //starting adding memo notification;;;
                $orgID = $user->organization_id;
                $organization = Organization::where('id',$orgID)->get()->first();
                $org_users = $organization->Users()->get();
                foreach($org_users as $org_user) {
                    $id = $org_user->id;
                    $memoNotification = $org_user->memoNotification;
                    if ($id != $personID) {
                        if ($memoNotification == "") {
                            $memoNotification = $taskID;
                        } else {
                            $notifications = explode(',',$memoNotification);
                            if (!in_array($taskID,$notifications)) {
                                $memoNotification = $memoNotification.",".$taskID;
                            }
                        }
                        Log::debug(__FUNCTION__."=>".$memoNotification."=>".$org_user."=>"."memoNotification");
                        User::where('id',$id)->update(['memoNotification'=>$memoNotification]);
                    }
                }
                //end adding memo notification;;;
            }

            $ret = $Task->updateTask($taskID, $taskData);

            $oldStatusId = $request->input("oldstatusID");
            if ($taskData["statusID"] != $oldStatusId) {
                $historyData = array(
                    'eventDate' => date("d.m.Y h:i"),
                    'personID' => $personID,
                    'taskID' => $taskID,
                    'event' => "Status change: ".$taskStatus->getStatusName($taskData["statusID"])
                );
                $ret = $History->addHistory($historyData);
            }

            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            $ret = -1;
        }

        if ($ret != 1)
            DB::rollBack();

        $data["ID"] = $taskID;
        $data["result"] = $ret;

        print_r(json_encode($data));die;
    }

    public function taskCardDelete(Request $request) {
        $data = array();
        $data["result"] = -1;
        $data["ID"] = "";
        $taskID = "";

        if ($request->input('taskID') != "") {
            $taskID = $request->input('taskID');
        } else {
            print_r(json_encode($data));die;
        }

        $Task = new Task();
        $Task->tmpArr = array();
        $Task->getAllSubTree($taskID);
        $ret = $Task->deleteTask($Task->tmpArr);

        $data["ID"] = $taskID;
        $data["result"] = $ret;

        print_r(json_encode($data));die;
    }

    public function isFinalTask(Request $request) {
        $data = array();
        $data["result"] = 1;
        $data["ID"] = "";
        $taskID = "";

        if ($request->input('taskID') != "") {
            $taskID = $request->input('taskID');
        } else {
            print_r(json_encode($data));die;
        }

        $Task = new Task();
        if ($Task->isFinalTask($taskID) ==  -1) {
            $data["result"] = -1;
            print_r(json_encode($data));die;
        }

        $data["ID"] = $taskID;

        print_r(json_encode($data));die;
    }

    public function fileUpload(Request $request)
    {
        $file = $request->file("fileName");
        $destinationPath = 'uploads';
        $fileName = date("Ymdhis")."_".$file->getClientOriginalName();
        $file->move($destinationPath,$fileName);

        $fileInfo = array(
            "tmpFileName"  =>  $fileName,
            "fileName"     =>   $file->getClientOriginalName(),
            "extension"    =>   $file->getClientOriginalExtension()
        );

        print_r(json_encode($fileInfo));die;
    }

    public function taskList() {
        return view('task/taskList'
        );
    }

    public function setLoginUser(Request $request) {
        Session::flush();
        Session::put('login_person_id', $request->input("user_id"));
        $Person = new Person();
        $personInfo = $Person->getPerson(Session::get('login_person_id'))[0]["roleID"];
        Session::put('login_role_id', $personInfo);

        return redirect("task/taskCard");
    }

    public function addBudget(Request $request) {
        $user = auth()->user();
        $personID = $user->id;

        $budgetData = array(
            "taskID" => $request->input("taskID"),
            "personID" => $personID,
            "description" => $request->input("description"),
            "income" => $request->input("income"),
            "timestamp" => date("d.m.Y")
        );

        $Budget = new Budget();
        $ret = $Budget->addBudget($budgetData);

        $data["result"] = $ret;

        print_r(json_encode($data));die;
    }

    public function addExpense(Request $request) {
        $user = auth()->user();
        $personID = $user->id;

        $expenseData = array(
            "taskID" => $request->input("taskID"),
            "personID" => $personID,
            "description" => $request->input("description"),
            "expense" => $request->input("expense"),
            "timestamp" => date("d.m.Y")
        );

        $Expense = new Expense();
        $ret = $Expense->addExpense($expenseData);

        $data["result"] = $ret;

        print_r(json_encode($data));die;
    }

    public function Settings() {
        $user = auth()->user();
        return view('user.settings',['user'=>$user]);
    }

    public function SaveSettings(Request $request) {
        $user = auth()->user();
        $password = $request["password"]==""?$user->password: Hash::make($request["password"]);

        $fields = $this->validate($request, [
            'nameFirst' => ['required', 'string', 'max:255'],
            'nameFamily' => ['required', 'string', 'max:255'],
        ]);

        $user->update([
            'nameFirst' => $fields['nameFirst'],
            'nameFamily' => $fields['nameFamily'],
            'password' => $password,
            'avatarType' => $request['avatarType'],
            'avatarColor' => $request['avatarColor'],
            'avatarColorValue' => $request['avatarColorValue'],
        ]);

        return redirect('dashboard');
    }

    public function language($locale) {
        if (! in_array($locale, ['en', 'es', 'de'])) {
            abort(400);
        }
        app()->setLocale($locale);
        return redirect('dashboard');
    }

    public function Shake(Request $request) {
        return ['success'=>true];
    }


    public function Locale($locale) {
        Session::put('locale', $locale);
        $id = auth()->user()->id;
        $user = User::where('id',$id)->get()->first();
        $user->update(['locale'=>$locale]);
        return redirect()->back();
    }

    public function UpdateFilter(Request $request) {
        $user_id = $request['user_id'];
        $data = [
            'status'=>$request['statusFilter'],
            'priority'=>$request['priorityFilter'],
            'weight'=>$request['weightFilter'],
            'date'=>$request['dateFilter'],
            'workTime'=>$request['workTimeFilter'],
            'budget'=>$request['budgetFilter'],
        ];
        Filter::where('user_id',$user_id)->update($data);
        User::where('id',$user_id)->update(['filter_order'=>$request['task_filter_order']]);
        return  redirect()->back();
    }
    public function ResetFilter(Request $request) {
        $data = [
            'status'=>'111110000001',
            'priority'=>'111100',
            'weight'=>'11111111110',
            'date'=>'211',
            'workTime'=>'20',
            'budget'=>'10',
        ];
        Filter::where('user_id',$request['user_id'])->update($data);
        User::where('id',$request['user_id'])->update(['filter_order'=>'214356']);
        return  redirect()->back();
    }
}

