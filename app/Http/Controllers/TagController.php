<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Psy\Command\HistoryCommand;
use App\Helper\Common;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\TagTask;
use App\Model\Tag;
use App\AllocatedTime;
use App\Filter;
use App\Model\Attachment;
use App\Model\Budget;
use App\Model\Expense;
use App\Model\History;
use App\Model\Memo;
use App\Model\TagPerson;
use App\Model\Task;
use App\Model\TaskPriority;
use App\Model\TaskStatus;
use App\Model\TaskWeight;
use App\Organization;
use App\PinnedTask;
use App\SubTaskTime;
use App\Time;
use App\User;
use DB;

class TagController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request) {
        $user = auth()->user();
        $personID = $user->id;
        $role_id = $user->roleID;
        $organization_id = $user->organization_id;

        $selectedTag = null;
        $selected = null;
        $system = null;
        if (isset($request['tagID']) && $request['tagID'] != '') {
            $selectedTag = Tag::where('ID' , $request['tagID'])->firstOrFail()->toArray();
            $selected = $request['tagID'];
            $system = $request['system'];
        }

        $system_tag = Tag::where('organization_id', $organization_id)->where('tagtype',1)->orderby('color','asc')->get()->toArray();
        foreach ($system_tag as $index => $tag) {
            $qrBuilder = TagTask::leftJoin('task','tag_tasks.taskID','=','task.ID')->where('tag_tasks.tagID',$tag['ID'])->select('task.*');
            $ret = [];
            switch ($user->roleID) {
                case Common::constant("role.proManager"):
                case Common::constant("role.foreman"):
                case Common::constant("role.worker"):
                    $qrBuilder = $qrBuilder->where("task.personID", "=", $user->id);
                    break;
                case Common::constant("role.admin"):
                    break;
            }
            $ret = $qrBuilder->get()->toArray();
            $system_tag[$index]['use_count'] = count($ret);
        }

        $system_tag_color = $system_tag;
        for ($i = 0 ; $i < count($system_tag) -1 ; $i ++) {
            for ($j = $i; $j < count($system_tag); $j ++) {
                if ($system_tag[$i] > $system_tag[$j]) {
                    $temp = $system_tag[$i];
                    $system_tag[$i] = $system_tag[$j];
                    $system_tag[$j] = $temp;
                }
            }
        }

        $organization_tag = Tag::where('organization_id', $organization_id)->where('tagtype',2)->orderby('color','asc')->get()->toArray();
        foreach ($organization_tag as $index => $tag) {
            $qrBuilder = TagTask::leftJoin('task','tag_tasks.taskID','=','task.ID')->where('tag_tasks.tagID',$tag['ID'])->select('task.*');
            $ret = [];
            switch ($user->roleID) {
                case Common::constant("role.proManager"):
                case Common::constant("role.foreman"):
                case Common::constant("role.worker"):
                    $qrBuilder = $qrBuilder->where("task.personID", "=", $user->id);
                    break;
                case Common::constant("role.admin"):
                    break;
            }
            $ret = $qrBuilder->get()->toArray();
            $organization_tag[$index]['use_count'] = count($ret);
        }
        $organization_tag_color = $organization_tag;
        for ($i = 0 ; $i < count($organization_tag) -1 ; $i ++) {
            for ($j = $i; $j < count($organization_tag); $j ++) {
                if ($organization_tag[$i] > $organization_tag[$j]) {
                    $temp = $organization_tag[$i];
                    $organization_tag[$i] = $organization_tag[$j];
                    $organization_tag[$j] = $temp;
                }
            }
        }

        $personal_tag = Tag::where('organization_id', $organization_id)->where('tagtype' , 3)->where('person_id',$personID)->orderby('color','asc')->get()->toArray();
        foreach ($personal_tag as $index => $tag) {
            $qrBuilder = TagTask::leftJoin('task','tag_tasks.taskID','=','task.ID')->where('tag_tasks.tagID',$tag['ID'])->select('task.*');
            $ret = [];
            switch ($user->roleID) {
                case Common::constant("role.proManager"):
                case Common::constant("role.foreman"):
                case Common::constant("role.worker"):
                    $qrBuilder = $qrBuilder->where("task.personID", "=", $user->id);
                    break;

                case Common::constant("role.admin"):
                    break;
            }
            $ret = $qrBuilder->get()->toArray();
            $personal_tag[$index]['use_count'] = count($ret);
        }

        $personal_tag_color = $personal_tag;
        for ($i = 0 ; $i < count($personal_tag) -1 ; $i ++) {
            for ($j = $i; $j < count($personal_tag); $j ++) {
                if ($personal_tag[$i] > $personal_tag[$j]) {
                    $temp = $personal_tag[$i];
                    $personal_tag[$i] = $personal_tag[$j];
                    $personal_tag[$j] = $temp;
                }
            }
        }
        $displayType = $request->input('displayType')==""?"111":$request->input('displayType');
        $tags = [];
        $tags['system'] = $system_tag;
        $tags['organization'] = $organization_tag;
        $tags['personal'] = $personal_tag;
        $tags['system_color'] = $system_tag_color;
        $tags['organization_color'] = $organization_tag_color;
        $tags['personal_color'] = $personal_tag_color;

        $tags['selected'] = $selectedTag;

        return view('tag.index',
            [
                'TagManager' => true,
                'personalID' => $personID,
                'tags' => $tags,
                'roleID' => $role_id,
                'organizationID' => $organization_id,
                'selected' => $selected,
                'system' => $system,
                'displayType' => $displayType
            ]
        );
    }

    public function PinnedTag(Request $request) {
        $tagID = $request->input('ID');

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
        $tagList = $Tag->getTagList(auth()->user());

        $memoNotification = auth()->user()->memoNotification;
        $newMemo = auth()->user()->newMemo;

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
        $pinnedTask = array();
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
        $filters =Filter::where('user_id',$user->id)->first()->toArray();

        $qrBuilder = TagTask::leftJoin('task','tag_tasks.taskID','=','task.ID')
            ->leftJoin("taskstatus", "task.statusID", "=", "taskstatus.ID")
            ->leftJoin("taskpriority", "task.priorityID", "=", "taskpriority.ID")
            ->leftJoin("taskweight", "task.weightID", "=", "taskweight.ID")
            ->leftJoin("allocated_times","task.ID",'=',"allocated_times.taskID")
            ->leftJoin("users", "task.personID", "=", "users.id")
            ->leftJoin("organizations","users.organization_id",'=',"organizations.id")
            ->where('deleteFlag', 0)
            ->where('tag_tasks.tagID',$tagID)
            ->select("task.*", "taskstatus.note as status_icon"
                , "taskpriority.title as priority_title","taskpriority.order as order" , "taskweight.title as weight"
                ,"users.avatarType as avatarType","users.avatarColor as avatarColor" , "users.nameTag as nameTag" ,"users.roleID"
                ,'organizations.organization as organization'
                , DB::raw("concat(users.nameFamily, ' ', users.nameFirst) as fullName"));


        $ret = [];
        switch ($user->roleID) {
            case Common::constant("role.proManager"):
            case Common::constant("role.foreman"):
            case Common::constant("role.worker"):
//                $qrBuilder = $qrBuilder->whereNull("task.parentID");
                $qrBuilder = $qrBuilder->where("task.personID", "=", $user->id);
                $ret = $qrBuilder->orderBy('order', 'asc')->orderBy('id','asc')->get()->toArray();

                break;

            case Common::constant("role.admin"):

//                $qrBuilder = $qrBuilder->whereNull("task.parentID");
                $ret = $qrBuilder->orderBy('order', 'asc')->orderBy('id','asc')->get()->toArray();

                break;
        }


        $result1 = $Task->adtResult(Common::stdClass2Array($ret));
        $retArr[0] = $result1;

        $result['list'] = $retArr;
        $result['parents'][0] = "";

        $filter_order = $user->filter_order;
        $filter_array= array();
        $filter_array_str = ["status","priority","weight","date","workTime","budget"];
        $taskController = new TaskController();
        for ($i = 0 ; $i < strlen($filter_order);  $i ++) {
            $filter_array[$filter_order[$i]] = $filter_array_str[$i];
        }

        for ($i = count($filter_array) ; $i >= 1;  $i --) {
            if ($filter_array[$i] == 'budget')
                continue;
            foreach ($result['list'] as $index => $task) {
                $result['list'][$index] = $taskController->topSort($task,$filter_array[$i],auth()->user());
            }
        }
        foreach ($result['list'] as $index => $task) {
            $result['list'][$index] = $taskController->task_filter($task,auth()->user());
        }

        return view('task/taskCard',
            [
                'totalPersonList' => $totalPersonList,
                'rolePersonList' => $rolePersonList,
                'TaskPriorityList' => $TaskPriorityList,
                'TaskStatusList' => $TaskStatusList,
                'TaskWeightList' => $TaskWeightList,
                'taskList' => $result['list'],
                'taskTagList' =>$taskTagList,
                'tagList' => $tagList,
                'parents' => $result['parents'],
                'personalID' => $user->id,
                'login_role_id' => $user->roleID,
                'systemTagList' => $systemTagList,
                'showType' => $showType,
                'taskId' => $taskId,
                'taskDetails' => isset($taskDetails[0]) ? $taskDetails[0]: array(),
                'pinnedTask' => $pinnedTask,
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
            ]);
    }

    public function Add(Request $request) {
        $user = auth()->user();
        $personID = $user->id;
        $role_id = $user->roleID;
        $organization_id = $user->organization_id;

        $fields = $this->validate($request, [
            'tagName' => ['required', 'string', 'max:255'],
            'tagNote' => ['required', 'string', 'max:255'],
            'tagDescription' => ['required', 'string', 'max:255'],
        ]);

        if ($request['tagType'] == 'organization') {
            if ($role_id == 1) {
                Tag::create(['name'=>$request['tagName'],
                             'organization_id' => $organization_id,
                             'person_id' => $personID,
                             'tagtype' => 2,
                             'color' => $request['tagColor'],
                             'colorValue' => $request['tagColorValue'],
                             'note' => $request['tagNote'],
                             'description' => $request['tagDescription'] ,
                             'show' => $request['showTag']=='on'?1:0
                ]);
            }
        } else if ($request['tagType'] == 'personal') {
            Tag::create(['name'=>$request['tagName'],
                'organization_id' => $organization_id,
                'person_id' => $personID,
                'tagtype' => 3,
                'color' => $request['tagColor'],
                'colorValue' => $request['tagColorValue'],
                'note' => $request['tagNote'],
                'description' => $request['tagDescription'] ]);
        }

        return redirect('tag');
    }

    public function Update(Request $request) {

//        dd($request);
        $systemTag = null;
        if (isset($request['systemTag'])) {
            Tag::where('ID',$request['tagID'])->update(
                [
                    'color' => $request['tagColor'],
                    'colorValue' => $request['tagColorValue'],
                    'description' => $request['tagDescription'],
                    'show' => $request['showTagEdit']=='on'?1:0,
                ]
            );
        } else {
            Tag::where('ID',$request['tagID'])->update(
                [
                    'name' => $request['tagName'],
                    'color' => $request['tagColor'],
                    'colorValue' => $request['tagColorValue'],
                    'note' => $request['tagNote'],
                    'description' => $request['tagDescription'],
                    'show' => $request['showTagEdit']=='on'?1:0,
                ]
            );
        }
        return redirect('tag');
    }

    public function Delete(Request $request) {
        Tag::where('ID',$request['tagID'])->delete();
        return redirect('tag');
    }
    public function UpdatePin(Request $request) {

        $tag = Tag::where('ID',$request['tagID'])->firstOrFail()->toArray();

        if ($tag['pinned'] == 1) {
            Tag::where('ID',$request['tagID'])->update(
                ['pinned' => 0]
            );
        } else {
            Tag::where('ID',$request['tagID'])->update(
                ['pinned' => 1]
            );
        }
        return redirect()->back();
    }
}
