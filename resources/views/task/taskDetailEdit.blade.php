@if(!empty($taskDetails))
<div class="col-detail-add detail-edit">
    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <form class="kt-form" id="task_update_form" name="task_update_form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="taskID" value="{{$taskId}}">
            <input type="hidden" name="parentID" value="{{$taskDetails["parentID"]}}">
            <input type="hidden" name="oldstatusID" value="{{$taskDetails["statusID"]}}">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Details
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" data-toggle="tab" id="tab_information" href="#edit_panel_tab_information" role="tab">INFORMATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" id="tab_budget" href="#edit_panel_tab_budget" role="tab">BUDGET</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab"  id="tab_statistics" href="#edit_panel_tab_statistics" role="tab">STATISTICS</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-scroll" data-scroll="true" style="height: 600px">
                    <div class="tab-content">
                        <div class="tab-pane active" id="edit_panel_tab_information">
                            <div class="detail-infomation-content">
                                <div class="row detail-information-title">
                                    @for($i=count($pathArr)-1; $i>=0; $i--)
                                        <a href="{{url('/task/taskCard?task_id=')}}{{$pathArr[$i]['ID']}}">
                                            <h5>
                                                {{$pathArr[$i]["title"]}}
                                            </h5>
                                        </a>
                                        @if($i != 0)
                                            <h5>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</h5>
                                        @endif
                                    @endfor
                                </div>
                                <div class="row detail-information-task-name">
                                    <p>{{$taskDetails["title"]}}</p>
                                    <input type="text" class="form-control" style="display: none" placeholder="Title" name="title" value="{{$taskDetails["title"]}}" >
                                </div>
                                <div class="row detail-information-staus">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <span class="kt-badge kt-badge--brand kt-badge--lg" id="detail-add-personTag">
                                                    {{$taskDetails["psntagName"]}}
                                                </span>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="detail-information-staus-title">
                                                    In Charge
                                                </div>
                                                <div class="detail-information-person-content">
                                                    <p>{{$taskDetails["fullName"]}}</p>
                                                    <select class="form-control"  @if($taskDetails["fullName"] != "") style="display: none" @endif id="detail-add-person" name="personID" >
                                                        <option value=""></option>
                                                        @foreach($rolePersonList as $personItem)
                                                            <option value="{{$personItem['id']}}" <?php if($personItem['id'] == $taskDetails["personID"]) echo 'selected=selected';?>>
                                                                {{$personItem['nameFamily'] . " " . $personItem['nameFirst']}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" style="text-align: center">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="detail-information-staus-title">
                                                    Status
                                                </div>
                                                <div class="detail-information-staus-content">
                                                    <p><?php print_r($taskDetails["status_icon"]);?></p>
                                                    <p @if($taskDetails["status_icon"] != "") style="display: none;" @endif>
                                                        <select class="form-control kt-selectpicker" id="detail-information-staus" name="statusID">
                                                            @foreach($TaskStatusList as $taskStatusItem)
                                                                <option data-content="{{$taskStatusItem['note']}}" value="{{$taskStatusItem['ID']}}" <?php if($taskStatusItem['ID'] == $taskDetails["statusID"]) echo 'selected=selected';?>>
                                                                    {{$taskStatusItem['title']}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="detail-information-staus-title">
                                                    Priority
                                                </div>
                                                <div class="detail-information-priority-content">
                                                    <p>{{$taskDetails["priority_title"]}}</p>
                                                    <p @if ($taskDetails["priority_title"] != "") style="display: none;" @endif>
                                                        <select class="form-control kt-selectpicker"  id="detail-information-priority" name="priorityID">
                                                            @foreach($TaskPriorityList as $taskPriorityItem)
                                                                <option value="{{$taskPriorityItem['ID']}}" <?php if($taskPriorityItem['ID'] == $taskDetails["priorityID"]) echo 'selected=selected';?>>{{$taskPriorityItem['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="detail-information-staus-title">
                                                    Weight
                                                </div>
                                                <div class="detail-information-weight-content">
                                                    <p>{{$taskDetails["weight"]}}</p>
                                                    <p @if (isset($taskDetails["weight"])) style="display: none;" @endif>
                                                        <select class="form-control kt-selectpicker" id="detail-information-priority" name="weightID">
                                                            @foreach($TaskWeightList as $taskWeightItem)
                                                                <option value="{{$taskWeightItem['ID']}}" <?php if($taskWeightItem['ID'] == $taskDetails["weightID"]) echo 'selected=selected';?>>{{$taskWeightItem['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row detail-information-tags">
                                    <div class="col-lg-2">
                                        Tags
                                    </div>
                                    <div class="col-lg-10 detail-edit-tags">
                                        <p><?php
                                            print_r($taskDetails["TagNameIcons"]);
                                            $tmpTagArr = explode(",", $taskDetails["tags"]);
                                            ?>
                                        </p>
                                        <p @if ($taskDetails["TagNameIcons"] != "") style="display: none;" @endif>
                                            <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="tags">
                                                @foreach($systemTagList as $tagItem)
                                                    <option data-content="{{$tagItem['note']}}" value="{{$tagItem['ID']}}"
                                                        <?php
                                                        if(in_array($tagItem["ID"], $tmpTagArr) == 1)
                                                            echo 'selected=selected';
                                                        ?>
                                                    >
                                                        {{$tagItem['name']}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="detail-information-task-date">
                                    <div class="row">
                                        <div class="col-lg-3 detail-label">
                                            Start Date
                                        </div>
                                        <div class="col-lg-3 detail-content detail-start-date">
                                            <p>{{$taskDetails["datePlanStart"]}}</p>
                                            <input type="text" class="form-control date-picker" @if ($taskDetails["datePlanStart"] != "") style="display: none" @endif
                                                   name="datePlanStart" id="datePlanStartEdit" autocomplete="off" value="{{$taskDetails["datePlanStart"]}}" >
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            End Date
                                        </div>
                                        <div class="col-lg-3 detail-content detail-end-date">
                                            <p>{{$taskDetails["datePlanEnd"]}}</p>
                                            <input type="text" class="form-control date-picker" @if ($taskDetails["datePlanEnd"] != "")) style="display: none" @endif name="datePlanEnd" id="datePlanEndEdit" autocomplete="off" value="{{$taskDetails["datePlanEnd"]}}" >
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-lg-3 detail-label">
                                            Actual Start Date
                                        </div>
                                        <div class="col-lg-3 detail-content detail-actual-start-date">
                                            <p>{{$taskDetails["dateActualStart"]}}</p>
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            Actual End Date
                                        </div>
                                        <div class="col-lg-3 detail-content  detail-actual-end-date">
                                            <p>{{$taskDetails["dateActualEnd"]}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-information-description">
                                    <h5>Description</h5>
                                    <p>{{$taskDetails["description"]}}</p>
                                    <textarea class="form-control" id="edit_description" @if ($taskDetails["description"] != "") style="display: none" @endif rows="5" name="info_description">{{$taskDetails["description"]}}</textarea>
                                </div>
                                <div class="detail-information-task-memos">
                                    <h5>Memos</h5>
                                    @foreach($memos as $memoitem)
                                        <div class="row">
                                            <div class="col-lg-6 detail-content">
                                                {{$memoitem["timestamp"]}}
                                            </div>
                                            <div class="col-lg-6 detail-label">
                                                {{$memoitem["fullName"]}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 detail-content" style="word-wrap: break-word;">
                                                {{$memoitem["Message"]}}
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <input type="text"  class="form-control" name="memo">
                                    </div>
                                </div>
                                <div class="detail-information-task-attachments">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>Attachmets</h5><br>
                                        </div>
                                    </div>
                                    @foreach($attachs as $attchItem)
                                        <div class="row attach_file" style="margin-top: 10px" data-tmpfilename="{{$attchItem['tmpFileName']}}">
                                            <div class="col-lg-3">
                                                <div class="kt-widget4__pic kt-widget4__pic--icon">
                                                    <img src="./assets/media/files/pdf.svg" width="70%" alt="">
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="row">
                                                    <div class="col-lg-12 detail-label">
                                                        <h5>
                                                        {{$attchItem['fileName']}}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5 detail-label">
                                                        Attached:
                                                    </div>
                                                    <div class="col-lg-7 detail-content">
                                                        {{$attchItem['timestamp']}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5 detail-label">
                                                        Attached by:
                                                    </div>
                                                    <div class="col-lg-7 detail-content">
                                                        {{$attchItem['fullName']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row" style="margin-top:30px;">
                                        <div class="col-lg-1">
                                        </div>
                                        <div class="custom-file col-lg-10">
                                            <input type="file" class="custom-file-input" id="customFile" name="fileName">
                                            <input type="hidden" name="fileInfo">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-information-task-memos">
                                    <h5>History</h5><br>
                                    @foreach($history as $historyItem)
                                        <div class="row">
                                            <div class="col-lg-4 detail-content">
                                                {{$historyItem['eventDate']}}
                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                {{$historyItem['fullName']}}
                                            </div>
                                            <div class="col-lg-5 detail-content">
                                                {{$historyItem['event']}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="edit_panel_tab_budget">
                            <div class="detail-budget-content">
                                <div class="row detail-budget-task-name">
                                    <p>{{$taskDetails["title"]}}</p>
                                </div>
                                <div class="row detail-budget-dashboard">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                Budget
                                            </div>
                                            <div class="col-lg-6" style="text-align: right">
                                                {{number_format($budgetTotalSum, 2, ',', '.')}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                Expense
                                            </div>
                                            <div class="col-lg-6" style="text-align: right">
                                                {{number_format($expenseTotalSum, 2, ',', '.')}}
                                            </div>
                                        </div>
                                        <div class="row balance">
                                            <div class="col-lg-6">
                                                Balance
                                            </div>
                                            <div class="col-lg-6" style="text-align: right">
                                                {{number_format($budgetTotalSum - $expenseTotalSum, 2, ',', '.')}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                </div>
                                <div class="detail-income-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>Budget</h5>
                                        </div>
                                        <div class="col-lg-6" style="text-align: right">
                                            <h3>{{number_format($budgetSum, 2, ',', '.')}}</h3>
                                        </div>
                                    </div>
                                    @foreach($budget as $budgetItem)
                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-lg-3 detail-content">
                                                {{$budgetItem["timestamp"]}}
                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                {{$budgetItem["fullName"]}}
                                            </div>
                                            <div class="col-lg-3 detail-content" style="display: block; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden;">
                                                {{$budgetItem["description"]}}
                                            </div>
                                            <div class="col-lg-3 detail-content" style="text-align: right;">
                                                {{number_format($budgetItem["income"], 2, ',', '.')}}
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-lg-7">
                                            <input type="text"  class="form-control" id="income_description" name="description" placeholder="income description">
                                        </div>
                                        <div class="col-lg-5">
                                            <input type="text"  class="form-control" id="income" name="income" placeholder="0,00">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-lg-3">
                                        </div>
                                        <div class="col-lg-9" style="text-align: right;">
                                            <button type="button" class="btn btn-outline-brand btn-elevate btn-pill" id="budgetAdd">
                                                <i class="flaticon-add"></i>
                                                Add Budget
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-expense-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>Expense</h5>
                                        </div>
                                        <div class="col-lg-6" style="text-align: right">
                                            <h3>{{number_format($expenseSum, 2, ',', '.')}}</h3>
                                        </div>
                                    </div>
                                    @foreach($expense as $expenseItem)
                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-lg-3 detail-content">
                                                {{$expenseItem["timestamp"]}}
                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                {{$expenseItem["fullName"]}}
                                            </div>
                                            <div class="col-lg-3 detail-content" style="display: block; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden;">
                                                {{$expenseItem["description"]}}
                                            </div>
                                            <div class="col-lg-3 detail-content" style="text-align: right;">
                                                {{number_format($expenseItem["expense"], 2, ',', '.')}}
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-lg-7">
                                            <input type="text"  class="form-control" id="expense_description" name="description" placeholder="expense description">
                                        </div>
                                        <div class="col-lg-5">
                                            <input type="text"  class="form-control" id="expense" name="expense" placeholder="0,00">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-lg-3">
                                        </div>
                                        <div class="col-lg-9" style="text-align: right;">
                                            <button type="button" class="btn btn-outline-brand btn-elevate btn-pill" id="expensetAdd">
                                                <i class="flaticon-add"></i>
                                                Add Expense
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="edit_panel_tab_statistics">
                            <div class="detail-statistics-content">
                                <div class="row detail-statistics-task-name">
                                    <p>{{$taskDetails["title"]}}</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                Start date
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$taskDetails['datePlanStart']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                End date
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$taskDetails['datePlanEnd']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                Time Left
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$statisticsData['timeLeft']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                Time Left%
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$statisticsData['timeLeftPercent']}} %
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-lg-6">
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                Progress
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$taskDetails['finishProgress']}}%
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-8 statistics-label">
                                                Progress Left
                                            </div>
                                            <div class="col-lg-4 statistics-content" style="text-align: right">
                                                {{100 - $taskDetails['finishProgress']}}%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="row statistics-row" style="text-align: right;">
                                            Progress
                                        </div>
                                        <div class="row statistics-row progress" style="height: 14px;">
                                            @if($taskDetails['spentProgress'] <= $taskDetails['finishProgress'])
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$taskDetails['finishProgress']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            @else
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$taskDetails['finishProgress']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-dark" role="progressbar" style="width: {{$taskDetails['spentProgress'] - $taskDetails['finishProgress']}}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-lg-6">
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                Sub Tasks
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$statisticsData['totalCount']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                Sub Tasks finished
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$statisticsData['finishCount']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                Sub Tasks Left
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$statisticsData['leftCount']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                Sub Tasks finished
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$statisticsData['subFinishPercent']}}%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="row statistics-row" style="text-align: right;">
                                            Subtasks finished
                                        </div>
                                        <div class="row statistics-row progress" style="height: 14px;">
                                            <div class="progress-bar bg-dark" role="progressbar" style="width: {{$statisticsData['subFinishPercent']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-taskid="{{$taskId}}" data-parentid="{{$taskDetails["parentID"]}}" id="taskDetailDelete">Delete</button>
                <button type="button" class="btn btn-primary disabled" id="taskDetailUpdate">Update</button>
            </div>
        </form>
    </div>
</div>
@endif
