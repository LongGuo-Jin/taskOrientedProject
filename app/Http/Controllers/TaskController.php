<?php

namespace App\Http\Controllers;

use App\Model\Person;
use App\Model\Tag;
use App\Model\TagPerson;
use App\Model\Task;
use App\Model\TaskPriority;
use App\Model\TaskStatus;
use App\Model\TaskWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function __construct()
    {
        if (Session::get('login_person_id') == "")
            Session::put('login_person_id', 1);
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

        $totalPersonList = $Person->getPersonList();
        $rolePersonList = $Person->getrolePersonList();
        $TaskPriorityList = $TaskPriority->getTaskPriorityList();
        $TaskStatusList = $TaskStatus->getTaskStatusList();
        $TaskWeightList = $TaskWeight->getTaskWeightList();
        $PersonTagNameList = $TagPerson->getPersonTagName();
        $systemTagList = $Tag->getSystemTagList();

        $taskDetails = array();
        $showType = $request->input('show_type') == "" ? "regular": $request->input('show_type');
        $taskId = $request->input('task_id') == "" ? "": $request->input('task_id');

        if ($taskId == "") {
            $taskList = $Task->getTaskListInit();
        } else {
            $taskDetails = $Task->getTaskListbyCond(array("taskID" => $taskId));
            $taskList = $Task->getTaskList($taskDetails[0]);
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
                'taskDetails' => isset($taskDetails[0]) ? $taskDetails[0]: array()
            ]
        );
    }

    public function taskCardAdd(Request $request) {
        $taskData = array(
            'title' =>  $request->input('title'),
            'datePlanStart' =>  $request->input('datePlanStart'),
            'datePlanEnd' =>  $request->input('datePlanEnd'),
            'statusID' =>  $request->input('statusID'),
            'priorityID' =>  $request->input('priorityID'),
            'weightID' =>  $request->input('weightID'),
            'personID' =>  $request->input('personID'),
            'parentID' =>  $request->input('parentID') == 0 ? null: $request->input('parentID'),
            'description' =>  $request->input('description'),
            'tags' =>  $request->input('tagList'),
            'taskCreatorID' => Session::get('login_person_id'),
            'creatAt'   =>  date('Y-m-d h:i:s'),
            'updateAt'   =>  date('Y-m-d h:i:s')
        );

        if ($taskData["statusID"] == 2)
            $taskData["dateActualStart"] = date('Y-m-d h:i:s');
        if ($taskData["statusID"] == 4 || $taskData["statusID"] == 5)
            $taskData["dateActualEnd"] = date('Y-m-d h:i:s');

        $Task = new Task();
        $ret = $Task->addTask($taskData);

        $data = array();
        $data["ID"] = $Task->getLastInsertId();
        $data["result"] = $ret;

        print_r(json_encode($data));die;
    }

    public function taskCardUpdate(Request $request) {
        $taskData = array(
            'title' =>  $request->input('title'),
            'datePlanStart' =>  $request->input('datePlanStart'),
            'datePlanEnd' =>  $request->input('datePlanEnd'),
            'statusID' =>  $request->input('statusID'),
            'priorityID' =>  $request->input('priorityID'),
            'weightID' =>  $request->input('weightID'),
            'personID' =>  $request->input('personID'),
            'parentID' =>  $request->input('parentID') == 0 ? null: $request->input('parentID'),
            'description' =>  $request->input('description'),
            'tags' =>  $request->input('tagList'),
            'updateAt'   =>  date('Y-m-d h:i:s')
        );

        if ($request->input('taskID') != "")
            $taskID = $request->input('taskID');

        $Task = new Task();
        $ret = $Task->updateTask($taskID, $taskData);

        $data = array();
        $data["ID"] = $taskID;
        $data["result"] = $ret;

        print_r(json_encode($data));die;
    }

    public function taskList() {
        return view('task/taskList'
        );
    }

    public function setLoginUser(Request $request) {
        Session::flush();
        Session::put('login_person_id', $request->input("user_id"));

        return redirect("task/taskCard");
    }
}
