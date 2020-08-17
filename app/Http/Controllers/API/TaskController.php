<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 8/14/2020
 * Time: 5:42 AM
 */
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Task;
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
        $tmp = $taskModel->adtResult($taskModel->getTaskListbyCond(array("personID"=>$user->id),auth()->user()));
        $tmp1 = $taskModel->adtResult($taskModel->getTaskListbyCond(array("taskCreatorID"=>$user->id),auth()->user()));
        $tmp = array_merge($tmp,$tmp1);

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

            if ($dateStart == $now) {
//                array_push($created,$taskItem);
                $created++;
            }

            if ($taskStatus == 4) {
                $finished ++;
            }
//            $datediff = $now - $datePlanStart;
//            if (abs(round($datediff / (60 * 60 * 24))) < 5.0 && $taskStatus != 4 && $taskStatus!= 5) {
//                array_push($new_tasks , $taskItem);
//            }
        }
        $retArr['active'] = $active_tasks;
        $retArr['overdue'] = $overdue_tasks;
        $retArr['created'] = $created;
        $retArr['finished'] = $finished;
        return response()->json(['taskInfo'=>$retArr]);
    }

    public function Task(Request $request) {
        $user = $request->user();
        $taskModel = new Task();
        $taskID = $request->taskID;
        $parentID = null;
        if (!isset($taskID)) {
            $result = $this->GetTaskListInit($user);

        } else {
            $task = Task::where('ID',$taskID)->get()->first();
            $parentID = $task->parentID;
            $result = $taskModel->adtResult($taskModel->getTaskListbyCond(array("parentID"=>$taskID,"personID"=>$user->id),$user),$user);
        }

        $retData = [];
        foreach ($result as $item) {
//            $childTasks = $taskModel->getTaskListbyCond(array("parentID"=>$item['ID']),$user);
            $childTasks = $taskModel->adtResult($taskModel->getTaskListbyCond(array("parentID"=>$item['ID']),$user),$user);
            $active_tasks = 0;
            $overdue_tasks = 0;
            $finished  = 0;
            $created = 0;

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
            $ret['data'] = $item;
            $ret['child'] = $retArr;
            array_push($retData,$ret);
        }
        return ['tasks'=>$retData,'parentID' => $parentID];

    }

    public function GetTaskListInit($user) {
        $taskModel = new Task();
        $result = $taskModel->getTaskListInit($user);
        return $result['list'][0];
    }
}