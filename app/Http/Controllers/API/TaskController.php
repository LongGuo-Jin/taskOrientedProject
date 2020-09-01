<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 8/14/2020
 * Time: 5:42 AM
 */
namespace App\Http\Controllers\API;

use App\Filter;
use App\Http\Controllers\Controller;
use App\Model\Memo;
use App\Model\Task;
use App\Organization;
use App\TagTask;
use App\User;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Helper\Common;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller {

    public function TasksInfo(Request $request) {
        $user = $request->user();
        $taskModel = new Task();
        if ($user->roleID == 1) {
            $tmp = $taskModel->adtResult($taskModel->getTaskListbyCond(array(),auth()->user()));
        } else {
            $tmp = $taskModel->adtResult($taskModel->getTaskListbyCond(array("personID"=>$user->id),auth()->user()));
            $tmp1 = $taskModel->adtResult($taskModel->getTaskListbyCond(array("taskCreatorID"=>$user->id),auth()->user()));
            $tmp = array_merge($tmp,$tmp1);
        }

        $result = $tmp;
        $active_tasks = 0;
        $overdue_tasks = 0;
        $finished  = 0;
        $new_tasks = 0;
        $created = 0;

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
//                array_push($overdue_tasks , $taskItem);
                $overdue_tasks++;
            }

            if ($taskStatus != 4 && $taskStatus!= 5 && $now <=   $datePlanEnd){
//                array_push($active_tasks , $taskItem);
                $active_tasks++;
            }

            $datediff = $now - $datePlanStart;
            if (abs(round($datediff / (60 * 60 * 24))) < 5.0 && $taskStatus != 4 && $taskStatus!= 5) {
                $created++;
            }

//            if ($dateStart == $now) {
////                array_push($created,$taskItem);
//                $created++;
//            }

            if ($taskStatus == 4) {
                $finished ++;
            }
//            $datediff = $now - $datePlanStart;
//            if (abs(round($datediff / (60 * 60 * 24))) < 5.0 && $taskStatus != 4 && $taskStatus!= 5) {
//                array_push($new_tasks , $taskItem);
//            }
        }
        //Getting Unread messages
        $newMemo = $user->newMemo;
        $memos = explode(',',$newMemo);

        //////////////////////////
        $retArr['active'] = $active_tasks;
        $retArr['overdue'] = $overdue_tasks;
        $retArr['created'] = $created;
        $retArr['finished'] = $finished;
        $retArr['messages'] = $memos[0]==""?0:count($memos);
        return response()->json(['taskInfo'=>$retArr]);
    }

    public function Task(Request $request) {
        $user = $request->user();
        $taskModel = new Task();
        $TaskTag = new TagTask();
        $taskID = $request->taskID;
        $parentID = null;
        $parentName = null;
        if (!isset($taskID) || $taskID == null) {
            $result = $this->GetTaskListInit($user);

        } else {
            $task = Task::where('ID',$taskID)->get()->first();

            if ($task->personID == $user->id || $task->taskCreatorID == $user->id || $user->roleID == 1) {
                $parentID = $task->parentID;
                $parentName = $task->title;
            }
            if ($user->roleID == 1) {
                $result = $taskModel->adtResult($taskModel->getTaskListbyCond(array("parentID"=>$taskID),$user),$user);
            } else {
                $result = $taskModel->adtResult($taskModel->getTaskListbyCond(array("parentID"=>$taskID,"personID"=>$user->id),$user),$user);
            }
        }

        $retData = [];
        $filter_order = $user->mobile_filter_order;
        $filter_array= array();
        $filter_array_str = ["status","priority","weight"];

        for ($i = 0 ; $i < strlen($filter_order);  $i ++) {
            $filter_array[$filter_order[$i]] = $filter_array_str[$i];
        }

        for ($i = count($filter_array) ; $i >= 1;  $i --) {
            $result = $this->topSort($result,$filter_array[$i],$user);
        }

        $result = $this->task_filter($result,$user);

        foreach ($result as $item) {
            $childTasks = $taskModel->adtResult($taskModel->getTaskListbyCond(array("parentID"=>$item['ID']),$user),$user);
            $active_tasks = 0;
            $overdue_tasks = 0;
            $finished  = 0;
            $created = 0;

            $Memo = new Memo();
            $memos = $Memo->getMemoByCond(array("taskID" => $item['ID']));
            $path = $taskModel->getPathName($item['ID']);

            $now = time();
            foreach ($childTasks as $taskItem) {
                $dateEnd = $taskItem["datePlanEnd"];
                $taskStatus = $taskItem['taskstatusid'];
                $arrEnd = (explode(".",$dateEnd));
                $datePlanEnd = strtotime($arrEnd[1].'/'.$arrEnd[0].'/'.$arrEnd[2]);
                $dateStart = $taskItem["creatAt"];
                if ($taskStatus != 4 && $taskStatus!= 5 && $now >   $datePlanEnd){
                    $overdue_tasks++;
                }

                if ($taskStatus != 4 && $taskStatus!= 5 && $now <=   $datePlanEnd){
                    $active_tasks++;
                }

                if ($dateStart == $now) {
                    $created++;
                }

                if ($taskStatus == 4) {
                    $finished ++;
                }

            }

            $retArr['active'] = $active_tasks;
            $retArr['overdue'] = $overdue_tasks;
            $retArr['created'] = $created;
            $retArr['finished'] = $finished;

            $tags = $TaskTag->getTaskTagList($item['ID']);

            $ret['data'] = $item;
            $ret['tags'] = $tags;
            $ret['child'] = $retArr;
            $ret['memo'] = $memos;
            $ret['path'] = $path;
            array_push($retData,$ret);
        }

        $filter_order = $user->mobile_filter_order;
        $filter_status = Filter::where('user_id',$user->id)->get()->first()->mobile_status;

        return [
                    'tasks'=>$retData,
                    'parentID' => $parentID ,
                    'parentTitle' => $parentName,
                    'filter' => ['order'=>$filter_order,'status'=>$filter_status]
                ];

    }

    public function SaveFilter(Request $request) {
        $user = $request->user();
        $order = $request->order;
        $status = $request->status;
        User::where('id',$user->id)->update(['mobile_filter_order'=>$order]);
        Filter::where('user_id',$user->id)->update(['mobile_status'=>$status]);
        return ['success' => true];
    }

    public function GetTaskListInit($user) {
        $taskModel = new Task();
        $result = $taskModel->getTaskListInit($user);
        return $result['list'][0];
    }

    public function GetUnreadMessages(Request $request) {
        $newMemo = $request->user()->newMemo;
        $Task = new Task();
        $memos = explode(',',$newMemo);
        $messages = [];
        foreach($memos as $memo) {
            $mm = explode(' ',$memo);
            if (isset($mm[1])) {
                $path = $Task->getPathName($mm[0]);
                $message = Memo::leftJoin('users','users.ID','=',"memo.personID")
                    ->select(DB::raw("concat(users.nameFamily, ' ', users.nameFirst) as fullName") , 'memo.*')
                    ->where('memo.ID',$mm[1])->first();

                array_push($messages,['message'=>$message,'path'=>$path]);
            }
        }
        return response()->json($messages);
    }

    public function AddMemo(Request $request) {
        $user = $request->user();
        $message = $request->message;
        $taskID = $request->taskID;
        $Memo = new Memo();
        $Task = new Task();

        $memo = array(
            'timeStamp' => date("d.m.Y h:i"),
            'personID' => $user->id,
            'taskID' => $taskID,
            'Message' => $message
        );
        $ret = $Memo->addMemo($memo);

        $memoID = $ret->ID;
        //starting adding memo notification;;;
        $orgID = $user->organization_id;
        $organization = Organization::where('id',$orgID)->get()->first();
        $org_users = $organization->Users()->get();
        foreach($org_users as $org_user) {
            $id = $org_user->id;
            $memoNotification = $org_user->memoNotification;
            $newMemo = $org_user->newMemo;
            if ($id != $user->id && $Task->IsAvailableTaskForPerson($taskID,$id)) {
                if ($newMemo == "") {
                    $newMemo = $taskID.' '.$memoID;
                } else {
                    $memos = explode(',',$newMemo);
                    $memo_flag = false;
                    foreach($memos as $item) {
                        $memo = explode(',',$item);
                        if ($memo[0] == $taskID) {
                            $memo_flag = true;
                        }
                    }
                    if (!$memo_flag) {
                        $newMemo = $newMemo.",".$taskID." ".$memoID;
                    }
                }
                if ($memoNotification == "") {
                    $memoNotification = $taskID;
                } else {
                    $notifications = explode(',',$memoNotification);
                    if (!in_array($taskID,$notifications)) {
                        $memoNotification = $memoNotification.",".$taskID;
                    }
                }
                User::where('id',$id)->update(['memoNotification'=>$memoNotification,'newMemo' => $newMemo]);
            }
        }
        //end adding memo notification;;;
//        $memos = $Memo->getMemoByCond(array("ID" => $memoID));
        $memos = $Memo->getMemoByCond(array("taskID" => $taskID));
        return response()->json(['taskID'=> $taskID,'memos'=>$memos]);
    }

    public function SeenMessage(Request $request) {
        $user  = $request->user();
        $taskID = $request->taskID;
        $memoID = $request->memoID;
        $newMemo = $user->newMemo;
        $newMemos = '';
        $memos = explode(',',$newMemo);
        $memoCnt = 0;
        foreach($memos as $item) {
            $mm = explode(' ',$item);
            if (isset($mm[0]) && ($mm[0] != $taskID || $mm[1] != $memoID)) {
                if ($memoCnt==0) {
                    $newMemos = $item;
                } else {
                    $newMemos = $newMemos.','.$item;
                }
                $memoCnt ++;
            }
        }

        User::where('id',$user->id)->update(['newMemo'=>$newMemos]);

        $Task = new Task();
        $res_memos = explode(',',$newMemos);
        $messages = [];
        foreach($res_memos as $memo) {
            $mm = explode(' ',$memo);
            if (isset($mm[1])) {
                $path = $Task->getPathName($mm[0]);
                $message = Memo::leftJoin('users','users.ID','=',"memo.personID")
                    ->select(DB::raw("concat(users.nameFamily, ' ', users.nameFirst) as fullName") , 'memo.*')
                    ->where('memo.ID',$mm[1])->first();

                array_push($messages,['message'=>$message,'path'=>$path]);
            }
        }
        return response()->json($messages);
    }

    public function task_filter($data , $user) {

        $user_id = $user->id;
        $filter = Filter::where('user_id',$user_id)->get()->first();
        $new_data = [];
        foreach($data as $item) {
            if ($filter['mobile_status'][$item['statusID']-1]=='1') {
                array_push($new_data,$item);
            }
        }
        return $new_data;
    }

    public function topSort($data , $key , $user) {
        $length = count($data);
        for ($i = 0 ; $i < $length - 1; $i ++) {
            for ($j = $i ; $j < $length; $j ++) {
                switch ($key) {
                    case "status":
                        if ($data[$i]["statusID"] > $data[$j]["statusID"]) {
                            $temp = $data[$i];
                            $data[$i] = $data[$j];
                            $data[$j] = $temp;
                        }
                        break;
                    case "priority":
                        if ($data[$i]["order"] < $data[$j]["order"]) {
                            $temp = $data[$i];
                            $data[$i] = $data[$j];
                            $data[$j] = $temp;
                        }
                        break;
                    case "weight":
                        if ($data[$i]["weight"] > $data[$j]["weight"]) {
                            $temp = $data[$i];
                            $data[$i] = $data[$j];
                            $data[$j] = $temp;
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        return $data;
    }

    public function UpdateTask(Request $request) {
        $user = $request->user();
        $taskID = $request->taskID;
        $data = $request->data;
        Log::debug(__FUNCTION__.$request);
        Task::where('ID',$taskID)->update(['statusID' => $data['statusID']]);
        return response()->json(['success'=>true]);
    }
}