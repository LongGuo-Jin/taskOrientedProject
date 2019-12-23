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

class TaskController extends Controller
{
    public function __construct() {
        session()->flush();
        session()->put('login_person_id', 2);

        $Person = new Person();
        $personInfo = $Person->getPerson(session()->get('login_person_id'));
        session()->forget('login_person_info');
        session()->put('login_person_info', $personInfo[0]);
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

        $personList = $Person->getPersonList();
        $TaskPriorityList = $TaskPriority->getTaskPriorityList();
        $TaskStatusList = $TaskStatus->getTaskStatusList();
        $TaskWeightList = $TaskWeight->getTaskWeightList();
        $PersonTagNameList = $TagPerson->getPersonTagName();
        $systemTagList = $Tag->getSystemTagList();

        $Level = 1;
        $parentId = 0;
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
                'PersonList' => $personList,
                'TaskPriorityList' => $TaskPriorityList,
                'TaskStatusList' => $TaskStatusList,
                'TaskWeightList' => $TaskWeightList,
                'PersonTagNameList' => $PersonTagNameList,
                'taskList' => $taskList['list'],
                'systemTagList' => $systemTagList,
                'showType' => $showType,
                'taskId' => $taskId
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
            'creatAt'   =>  date('Y-m-d h:i:s')
        );

        $Task = new Task();
        $ret = $Task->addTask($taskData);

        $data = array();
        $data["ID"] = $Task->getLastInsertId();
        $data["result"] = $ret;

        print_r(json_encode($data));die;
    }

    public function taskList() {
        return view('task/taskList'
        );
    }
}
