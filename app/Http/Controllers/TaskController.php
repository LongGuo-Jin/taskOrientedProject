<?php

namespace App\Http\Controllers;

use App\Model\Attachment;
use App\Model\Memo;
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
        $Attachment = new Attachment();

        $totalPersonList = $Person->getPersonList();
        $rolePersonList = $Person->getrolePersonList();
        $TaskPriorityList = $TaskPriority->getTaskPriorityList();
        $TaskStatusList = $TaskStatus->getTaskStatusList();
        $TaskWeightList = $TaskWeight->getTaskWeightList();
        $PersonTagNameList = $TagPerson->getPersonTagName();
        $systemTagList = $Tag->getSystemTagList();

        $taskDetails = array();
        $memos = array();
        $attachs = array();
        $showType = $request->input('show_type') == "" ? "regular": $request->input('show_type');
        $taskId = $request->input('task_id') == "" ? "": $request->input('task_id');

        if ($taskId == "") {
            $taskList = $Task->getTaskListInit();
        } else {
            $taskDetails = $Task->adtResult($Task->getTaskListbyCond(array("taskID" => $taskId)));
            $memos = $Memo->getMemoByCond(array("taskID" => $taskId, "personID" => Session::get('login_person_id')));
            $attachs = $Attachment->getAttachmentByCond(array("taskID" => $taskId, "personID" => Session::get('login_person_id')));
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
                'taskDetails' => isset($taskDetails[0]) ? $taskDetails[0]: array(),
                'memos' => $memos,
                'attachs' => $attachs
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

        if ($request->input('memo') != "") {
            $Memo = new Memo();
            $memo = array(
                'timeStamp' => date("d.m.Y h:i"),
                'personID' => Session::get('login_person_id'),
                'taskID' => $Task->getLastInsertId(),
                'Message' => $request->input('memo')
            );

            $ret = $Memo->addMemo($memo);
        }

        $data = array();
        $data["ID"] = $Task->getLastInsertId();
        $data["result"] = $ret;

        print_r(json_encode($data));die;
    }

    public function taskCardUpdate(Request $request) {
        $data = array();
        $data["result"] = -1;
        $taskID = "";

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

        if ($taskData["statusID"] == 2)
            $taskData["dateActualStart"] = date('Y-m-d h:i:s');
        if ($taskData["statusID"] == 4 || $taskData["statusID"] == 5)
            $taskData["dateActualEnd"] = date('Y-m-d h:i:s');

        if ($request->input('taskID') != "") {
            $taskID = $request->input('taskID');
        } else {
            print_r($data);die;
        }

        if ($request->input("fileInfo") != "") {
            $fileInfo = $request->input("fileInfo");
            $fileInfoArr = json_decode($fileInfo, true);

            $attachment = new Attachment();
            $attach = array(
                'timeStamp' => date("d.m.Y h:i"),
                'personID' => Session::get('login_person_id'),
                'taskID' => $taskID,
                'tmpFileName' => $fileInfoArr["tmpFileName"],
                'fileName' => $fileInfoArr["fileName"],
                'extension' => $fileInfoArr["extension"]
            );

            $ret = $attachment->addAttachment($attach);
        }

        $Task = new Task();
        $ret = $Task->updateTask($taskID, $taskData);

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


        $data["ID"] = $taskID;
        $data["result"] = $ret;

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
}
