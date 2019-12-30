<?php

namespace App\Http\Controllers;

use App\Model\Attachment;
use App\Model\Budget;
use App\Model\Expense;
use App\Model\History;
use App\Model\Memo;
use App\Model\Person;
use App\Model\Tag;
use App\Model\TagPerson;
use App\Model\Task;
use App\Model\TaskPriority;
use App\Model\TaskStatus;
use App\Model\TaskWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Psy\Command\HistoryCommand;

class TaskController extends Controller
{
    public function __construct()
    {
        if (Session::get('login_person_id') == "")
            Session::put('login_person_id', 1);
        if (Session::get('login_role_id') == "")
            Session::put('login_role_id', 1);
    }

    public function index() {
        echo "index";
    }

    public function taskCard(Request $request) {
        $Person = new Person();
        $TaskPriority = new TaskPriority();
        $TaskStatus = new TaskStatus();
        $TaskWeight = new TaskWeight();
        $TagPerson = new TagPerson();
        $Task = new Task();
        $Tag = new Tag();
        $Memo = new Memo();
        $Budget = new Budget();
        $Expense = new Expense();
        $Attachment = new Attachment();
        $History = new History();

        $totalPersonList = $Person->getPersonList();
        $rolePersonList = $Person->getrolePersonList();
        $TaskPriorityList = $TaskPriority->getTaskPriorityList();
        $TaskStatusList = $TaskStatus->getTaskStatusList();
        $TaskWeightList = $TaskWeight->getTaskWeightList();
        $PersonTagNameList = $TagPerson->getPersonTagName();
        $systemTagList = $Tag->getSystemTagList();

        $taskDetails = array();
        $memos = array();
        $budget = array();
        $expense = array();
        $attachs = array();
        $statisticsData = array();
        $history = array();
        $expenseSum = $budgetSum = $expenseTotalSum = $budgetTotalSum =0;
        $showType = $request->input('show_type') == "" ? "regular": $request->input('show_type');
        $taskId = $request->input('task_id') == "" ? "": $request->input('task_id');
        $detailTab = "information";
        $entireTree = $Task->getEntirTreeIds($taskId);

        if ($taskId == "") {
            $taskList = $Task->getTaskListInit();
        } else {
            $taskDetails = $Task->adtResult($Task->getTaskListbyCond(array("taskID" => $taskId)));
            $memos = $Memo->getMemoByCond(array("taskID" => $taskId, "personID" => Session::get('login_person_id')));
            $budget = $Budget->getBudgetByCond(array("taskID" => $taskId, "personID" => Session::get('login_person_id')));
            $expense = $Expense->getExpenseByCond(array("taskID" => $taskId, "personID" => Session::get('login_person_id')));
            $expenseSum = $Expense->getSumExpense(array("taskID" => $taskId, "personID" => Session::get('login_person_id')));
            $budgetSum = $Budget->getSumBudget(array("taskID" => $taskId, "personID" => Session::get('login_person_id')));
            $expenseTotalSum = $Expense->getSumExpense(array("entireTree" => $entireTree));
            $budgetTotalSum = $Budget->getSumBudget(array("entireTree" => $entireTree));

            $attachs = $Attachment->getAttachmentByCond(array("taskID" => $taskId, "personID" => Session::get('login_person_id')));
            $history = $History->getHistoryByCond(array("taskID" => $taskId, "personID" => Session::get('login_person_id')));
            $statisticsData = $Task->getStatisticsData($taskDetails[0]);
            $taskList = $Task->getTaskList($taskDetails[0]);
            $detailTab = $request->input("detailTab");
        }

        return view('task/taskCard',
            [
                'totalPersonList' => $totalPersonList,
                'rolePersonList' => $rolePersonList,
                'TaskPriorityList' => $TaskPriorityList,
                'TaskStatusList' => $TaskStatusList,
                'TaskWeightList' => $TaskWeightList,
                'PersonTagNameList' => $PersonTagNameList,
                'taskList' => $taskList['list'],
                'parents' => $taskList['parents'],
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
                'budgetTotalSum' => $budgetTotalSum
            ]
        );
    }

    public function taskCardAdd(Request $request) {
        $taskData = array(
            'title' =>  $request->input('title'),
            'datePlanStart' =>  $request->input('datePlanStart') == "" ? date("d.m.Y") : $request->input('datePlanStart'),
            'datePlanEnd' =>  $request->input('datePlanEnd') == "" ? date("d.m.Y") : $request->input('datePlanEnd'),
            'statusID' =>  $request->input('statusID'),
            'priorityID' =>  $request->input('priorityID'),
            'weightID' =>  $request->input('weightID'),
            'personID' =>  $request->input('personID'),
            'parentID' =>  $request->input('parentID') == 0 ? null: $request->input('parentID'),
            'description' =>  $request->input('description'),
            'tags' =>  $request->input('tagList'),
            'taskCreatorID' => Session::get('login_person_id'),
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

            if ($request->input('memo') != "") {
                $Memo = new Memo();
                $memo = array(
                    'timeStamp' => date("d.m.Y h:i"),
                    'personID' => Session::get('login_person_id'),
                    'taskID' => $taskID,
                    'Message' => $request->input('memo')
                );

                $ret = $Memo->addMemo($memo);
            }

            $History = new History();
            $historyData = array(
                'eventDate' => date("d.m.Y h:i"),
                'personID' => Session::get('login_person_id'),
                'taskID' => $taskID,
                'event' => "Created."
            );
            $ret = $History->addHistory($historyData);

            DB::commit();
        }catch (\Exception $e ){
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

    public function taskCardUpdate(Request $request) {
        $data = array();
        $data["result"] = -1;
        $taskID = "";

        $taskData = array(
            'title' =>  $request->input('title'),
            'datePlanStart' =>  $request->input('datePlanStart') == "" ? date("d.m.Y") : $request->input('datePlanStart'),
            'datePlanEnd' =>  $request->input('datePlanEnd') == "" ? date("d.m.Y") : $request->input('datePlanEnd'),
            'statusID' =>  $request->input('statusID'),
            'priorityID' =>  $request->input('priorityID'),
            'weightID' =>  $request->input('weightID'),
            'personID' =>  $request->input('personID'),
            'parentID' =>  $request->input('parentID') == 0 ? null: $request->input('parentID'),
            'description' =>  $request->input('description'),
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

            if ($request->input("fileInfo") != "") {
                $fileInfo = $request->input("fileInfo");
                $fileInfoArr = json_decode($fileInfo, true);

                $attach = array(
                    'timeStamp' => date("d.m.Y h:i"),
                    'personID' => Session::get('login_person_id'),
                    'taskID' => $taskID,
                    'tmpFileName' => $fileInfoArr["tmpFileName"],
                    'fileName' => $fileInfoArr["fileName"],
                    'extension' => $fileInfoArr["extension"]
                );

                $ret = $attachment->addAttachment($attach);

                $historyData = array(
                    'eventDate' => date("d.m.Y h:i"),
                    'personID' => Session::get('login_person_id'),
                    'taskID' => $taskID,
                    'event' => "Attachment added: {$attach['fileName']}"
                );
                $ret = $History->addHistory($historyData);
            }

            if ($request->input('memo') != "") {
                $Memo = new Memo();
                $memo = array(
                    'timeStamp' => date("d.m.Y h:i"),
                    'personID' => Session::get('login_person_id'),
                    'taskID' => $taskID,
                    'Message' => $request->input('memo')
                );

                $ret = $Memo->addMemo($memo);
            }

            $ret = $Task->updateTask($taskID, $taskData);
            $oldStatusId = $request->input("oldstatusID");
            if ($taskData["statusID"] != $oldStatusId) {
                $historyData = array(
                    'eventDate' => date("d.m.Y h:i"),
                    'personID' => Session::get('login_person_id'),
                    'taskID' => $taskID,
                    'event' => "Status change: ".$taskStatus->getStatusName($taskData["statusID"])
                );
                $ret = $History->addHistory($historyData);
            }

            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
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
        $budgetData = array(
            "taskID" => $request->input("taskID"),
            "personID" => Session::get('login_person_id'),
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
        $expenseData = array(
            "taskID" => $request->input("taskID"),
            "personID" => Session::get('login_person_id'),
            "description" => $request->input("description"),
            "expense" => $request->input("expense"),
            "timestamp" => date("d.m.Y")
        );

        $Expense = new Expense();
        $ret = $Expense->addExpense($expenseData);

        $data["result"] = $ret;

        print_r(json_encode($data));die;
    }
}
