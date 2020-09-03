@if(!empty($taskDetails))
<div class="col-detail-add detail-edit">
    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <form class="kt-form" id="task_update_form" name="task_update_form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="taskID" value="{{$taskId}}">
            <input type="hidden" name="personID" value="{{$taskDetails["personID"]}}">
            <input type="hidden" name="parentID" value="{{$taskDetails["parentID"]}}">
            <input type="hidden" name="oldstatusID" value="{{$taskDetails["statusID"]}}">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{__('task.details')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" style="text-transform: uppercase" data-toggle="tab" id="tab_information" href="#edit_panel_tab_information" role="tab">{{__('task.information')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" id="tab_time" href="#edit_panel_tab_time" role="tab">{{__('task.time')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" id="tab_budget" href="#edit_panel_tab_budget" role="tab">{{__('task.budget')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="text-transform: uppercase" data-toggle="tab"  id="tab_statistics" href="#edit_panel_tab_statistics" role="tab">{{__('task.statistics')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-scroll" data-scroll="true" style="height: 600px">
                    <div class="tab-content">
                        <div class="tab-pane active" id="edit_panel_tab_information">
                            <div class="detail-infomation-content">
                                <div class="row" style="justify-content: space-between; margin: 5px">
                                    <div class="row detail-information-title">
                                    @for($i=count($pathArr)-1; $i>=1; $i--)
                                        <a href="{{url('/task/taskCard?task_id=')}}{{$pathArr[$i]['ID']}}">
                                            <h5>
                                                {{$pathArr[$i]["title"]}}
                                            </h5>
                                        </a>
                                        @if($i != 1)
                                            <h5>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</h5>
                                        @endif
                                    @endfor
                                    </div>
                                </div>
                                <div class="row detail-information-task-name" style="justify-content: space-between;">
                                    <p>{{$taskDetails["title"]}}</p>
                                    <input type="text" class="form-control" style="display: none; width: 80%" placeholder="{{__('task.title')}}" name="title" value="{{$taskDetails["title"]}}" >
                                    @if($pinnedTask['personID'] == auth()->user()->id)
                                        <a href="{{route('task.removePin',['taskID'=>$taskDetails['ID']])}}"><img src="{{asset('public/images/pinned.png')}}" alt="logo" height="25"></a>
                                    @else
                                        <a href="{{route('task.addPin',['taskID'=>$taskDetails['ID']])}}"><img src="{{asset('public/images/unpinned.png')}}" alt="logo" height="25"></a>
                                    @endif
                                </div>
                                <div class="row detail-information-staus">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                @switch($taskDetails['avatarType'])
                                                    @case (1)
                                                    <svg width="32" height="32">
                                                        <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="{{$taskDetails['avatarColor']}}"></circle>
                                                        <text x="5" y="22"  style="fill:black;font-size: 16px">{{$taskDetails['nameTag']}}</text>

                                                        @break
                                                    @case (2)
                                                    {{--//rect--}}
                                                    <svg width="32" height="32">
                                                        <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="{{$taskDetails['avatarColor']}}" style="stroke-width:0;"></rect>
                                                        <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskDetails['nameTag']}}</text>

                                                        @break
                                                    @case (3)
                                                    {{--//polygon 5--}}
                                                    <svg width="32" height="32">
                                                        <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="{{$taskDetails['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                        <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskDetails['nameTag']}}</text>

                                                        @break
                                                    @case (4)
                                                    {{--//polygon 6--}}
                                                    <svg width="32" height="32" >
                                                        <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="{{$taskDetails['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                        <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskDetails['nameTag']}}</text>

                                                        @break
                                                    @case (5)
                                                    {{--//rotated rectangle--}}
                                                    <svg width="32" height="32">
                                                        <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="{{$taskDetails['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                        <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskDetails['nameTag']}}</text>

                                                        @break
                                                @endswitch
                                                @switch($taskDetails['roleID'])
                                                    @case (1)
                                                    <circle cx="28" cy="4" r="3" stroke="black" stroke-width="0" fill="black"></circle>
                                                    <rect height="8" width="2" x="27" y="0" fill="black"></rect>
                                                    <polygon points="25.145898644316,1.1974823013079 24.145898266966,2.9295328910135 30.854099523987,6.802519564103 31.854101033387,5.0704696279878 " fill = "black" style="stroke:purple;stroke-width:0;"></polygon>
                                                    <polygon points="24.14589756732,5.0704645899847 25.14589681262,6.8025158332799 31.854103132324,2.9295379290175 30.854105019076,1.1974860321334 " fill = "black" style="stroke:purple;stroke-width:0;"></polygon>
                                                    @break
                                                    @case (2)
                                                    <polygon points="28,0 25.648857298782,7.2360667481539 31.804227357789,2.7639360007462 24.195775873739,2.7639260551337 30.35113424097,7.2360728948744 " fill = "black" style="stroke:purple;stroke-width:0;"></polygon>
                                                    @break
                                                    @case (4)
                                                    <circle cx="28" cy="4" r="4" stroke="black" stroke-width="0" fill = "black" style="stroke-width:0;"></circle>
                                                    @break
                                                @endswitch
                                            </svg>
                                                {{--<span class="kt-badge kt-badge--brand kt-badge--lg" id="detail-add-personTag">--}}
                                                    {{--{{$taskDetails["psntagName"]}}--}}
                                                {{--</span>--}}
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="detail-information-staus-title">
                                                    {{__('task.inCharge')}}
                                                </div>
                                                <div class="detail-information-person-content">
                                                    <p>{{$taskDetails["fullName"]}}</p>
                                                    <select class="form-control"  @if($taskDetails["fullName"] != "") style="display: none" @endif id="detail-add-person" name="selectedPersonID" >
                                                        {{--<option value=""></option>--}}
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
                                                    {{__('task.status')}}
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
                                                    {{__('task.priority')}}
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
                                                    {{__('task.weight')}}
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
                                        {{__('task.tags')}}
                                    </div>
                                    <div class="col-lg-10 detail-edit-tags">
                                        <div style="display: flex; flex-wrap: wrap;"><?php
                                            foreach($taskTagList as $taskTag) {
                                                ?>
                                                <span class="@if($taskTag['tagtype']==1) system-span @elseif($taskTag['tagtype']==2) organization-span @elseif($taskTag['tagtype']==3) personal-span @endif" style="@if ($taskTag['tagtype']!=3 )background-color:{{$taskTag['color']}} @else border-color:{{$taskTag['color']}} @endif">
                                                    {{$taskTag['name']}}
                                                </span> &nbsp;
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <p @if (count($taskTagList) != 0) style="display: none;" @endif>
                                            <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="tags">
                                                @foreach($tagList as $tagItem)
                                                    <option data-content='<span class="@if($tagItem['tagtype']==1) system-span @elseif($tagItem['tagtype']==2) organization-span @elseif($tagItem['tagtype']==3) personal-span @endif" style="@if ($tagItem['tagtype']!=3 )background-color:{{$tagItem['color']}} @else border-color:{{$tagItem['color']}} @endif">
                                                    {{$tagItem['name']}}
                                                        </span>' value="{{$tagItem['ID']}}"
                                                        <?php
                                                            foreach($taskTagList as $taskTag) {
                                                            if ($taskTag['ID'] == $tagItem['ID'])
                                                            {
                                                                echo 'selected';
                                                                break;
                                                            }
                                                        }
                                                        ?>
                                                    >
                                                    </option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                </div>

                                <div class="detail-information-task-date">
                                    <div class="row">
                                        <div class="col-lg-3 detail-label">
                                            {{__('task.startDate')}}
                                        </div>
                                        <div class="col-lg-3 detail-content detail-start-date">
                                            <p>{{$taskDetails["datePlanStart"]}}</p>
                                            <input type="text" class="form-control date-picker" @if ($taskDetails["datePlanStart"] != "") style="display: none" @endif
                                                   name="datePlanStart" id="datePlanStartEdit" autocomplete="off" value="{{$taskDetails["datePlanStart"]}}" >
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            {{__('task.endDate')}}
                                        </div>
                                        <div class="col-lg-3 detail-content detail-end-date">
                                            <p>{{$taskDetails["datePlanEnd"]}}</p>
                                            <input type="text" class="form-control date-picker" @if ($taskDetails["datePlanEnd"] != "")) style="display: none" @endif name="datePlanEnd" id="datePlanEndEdit" autocomplete="off" value="{{$taskDetails["datePlanEnd"]}}" >
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-lg-3 detail-label">
                                            {{__('task.actualStartDate')}}
                                        </div>
                                        <div class="col-lg-3 detail-content detail-actual-start-date">
                                            <p>{{$taskDetails["dateActualStart"]}}</p>
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            {{__('task.actualEndDate')}}
                                        </div>
                                        <div class="col-lg-3 detail-content  detail-actual-end-date">
                                            <p>{{$taskDetails["dateActualEnd"]}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-information-description">
                                    <h5>{{__('task.description')}}</h5>
                                    <p style="white-space: pre-line;">{{$taskDetails["description"]}}</p>
                                    <textarea class="form-control" id="edit_description" @if ($taskDetails["description"] != "") style="display: none;" @endif rows="5" name="info_description">{{$taskDetails["description"]}}</textarea>
                                </div>
                                <div class="detail-information-addExpense">

                                    <h5>{{__('task.addSubTask')}}</h5>
                                    <div class="row task-extand-add  m-2">
                                        <div class="col-lg-5">
                                            <input type="text" class="form-control" id="quick-subtask-title" placeholder="{{__('task.addSubTask')}}">
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" id="quick-add-person" name="personID">
                                                <option value=""></option>
                                                @foreach($rolePersonList as $personItem)
                                                    <option value="{{$personItem['id']}}" <?php if($personItem['id'] == $personalID) print_r("selected=selected");?>>{{$personItem['nameFamily'] . " " . $personItem['nameFirst']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="button" class="btn btn-outline-brand btn-elevate btn-pill quick-add-task" >
                                                {{__('task.add')}}
                                            </button>
                                        </div>
                                    </div>
                                    {{--@endif--}}
                                </div>
                                <div class="detail-information-task-memos">
                                    <h5>{{__('task.memos')}}</h5>
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
                                        <input type="text"  class="form-control" id="detail-information-task-memos_input" name="memo">
                                    </div>
                                </div>
                                <div class="detail-information-task-attachments">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>{{__('task.attachments')}}</h5><br>
                                        </div>
                                    </div>
                                    @foreach($attachs as $attchItem)
                                        <div class="row attach_file" style="margin-top: 10px" data-tmpfilename="{{$attchItem['tmpFileName']}}">
                                            <div class="col-lg-2">
                                                <div class="kt-widget4__pic kt-widget4__pic--icon">
                                                    <?php
                                                        $images = ['jpg','jpeg','png','bmp','svg','gif'];
                                                        $docs = ['doc','docx'];
                                                        $csv = ['csv'];
                                                        $zip = ['zip','rar'];
                                                        $pdf = ['pdf'];
                                                        $file = ['csv','doc','gif','html','jpg','mid','mp3','pdf','png','rar','rtf','txt',
                                                            'wav','xls','xml','zip'];
                                                        $extension = strtolower($attchItem['extension']);

                                                        $attachIcon = asset('public/assets/media/files/file.png');
                                                        if (in_array($extension,$file)) {
                                                            $attachIcon = asset('public/assets/media/files/'.$extension.'.png');
                                                        }
                                                    ?>
                                                    <img src="{{$attachIcon}}" width="60%" alt="">
                                                    {{--<span class="fiv-cla fiv-icon-{{$extension}} fiv-size-lg" style="font-size: 60px"></span>--}}
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="row">
                                                    <div class="col-lg-12 detail-label">
                                                        <h5 style="cursor: pointer;">
                                                            <span>
                                                                {{$attchItem['fileName']}}
                                                            </span>
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
                                            <label class="custom-file-label" for="customFile">{{__('task.chooseFile')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-information-task-memos" id="detail-information-task-memos">
                                    <h5>{{__('task.history')}}</h5><br>
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
                        <div class="tab-pane" id="edit_panel_tab_time">
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
                                <div class="row detail-budget-dashboard">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                {{__('task.timeAllocated')}}
                                            </div>
                                            <div class="col-lg-6" id="timeAllocated" style="text-align: right">
                                                {{$timeAllocated}}d
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                {{__('task.timeSpent')}}
                                            </div>
                                            <div class="col-lg-6" id="totalTime" style="text-align: right">
                                                {{$totalTime}} h
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                {{__('task.timeSpentOnSubTask')}}
                                            </div>
                                            <div class="col-lg-6" id="timeSpentOnSubTask" style="text-align: right">
                                                {{$timeSpentOnSubTask}}h
                                            </div>
                                        </div>
                                        <div class="row balance">
                                            <div class="col-lg-6">
                                                {{__('task.timeLeft')}}
                                            </div>
                                            <div class="col-lg-6" id="timeLeft" style="text-align: right">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="kt-portlet__body">
                                            <div id="timePieChart" style="height: 150px; width:150px"></div>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row mt-4 mb-4 pt-5 pb-4" style="border-top: solid 1px #000;">--}}
                                    {{--<span class="ml-auto mr-auto" id="workTimeCounterText" style="font-size: 54px;text-align: center">00:00:00</span>--}}
                                {{--</div>--}}
                                 {{--<div class="row mb-4">--}}
                                    {{--<div class="col-lg-9">--}}
                                        {{--<input type="text"  class="form-control" id="workTime_description" name="workTimeDescription" placeholder=" {{__('task.workTimeDescription')}}">--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3">--}}
                                        {{--<button type="button" class="btn btn-outline-brand btn-elevate btn-pill" id="startCounter">--}}
                                            {{--Start Work--}}
                                        {{--</button>--}}
                                        {{--<button type="button" class="btn btn-outline-brand btn-elevate btn-pill" id="stopCounter" style="display: none">--}}
                                            {{--Stop Work--}}
                                        {{--</button>--}}
                                    {{--</div>--}}
                                  {{--</div>--}}
                                <div class="row mt-4 mb-4 pt-5 pb-4" style="border-top: solid 1px #000;">
                                    <div class="col-lg-6 text-left" style="font-size: 30px;">Work Hours</div>
                                    <div class="col-lg-6 text-right" style="font-size: 30px;" id="workHours"></div>
                                </div>
                                @foreach($workTime as $time)
                                <div class="row">
                                    <div class="col-lg-3 text-left">
                                        {{$time['workDate']}}
                                    </div>
                                    <div class="col-lg-3 text-left">
                                        {{$time['personName']}}
                                    </div>
                                    <div class="col-lg-3 text-left">
                                        {{$time['description']}}
                                    </div>
                                    <div class="col-lg-3 text-right">
                                        {{floor($time['timeSpent']/8) }}d &nbsp; {{round($time['timeSpent']-floor($time['timeSpent']/8) * 8,1)}}h
                                    </div>
                                </div>
                                @endforeach
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <input name="workDescription" id="workDescription" class="form-control" placeholder="Work Description">
                                    </div>
                                    <div class="col-lg-3" style="display: flex">
                                        <input name="workHour" id="workHour" class="form-control" value="0" min="0" type="number"> &nbsp; <span class="mt-auto mb-auto" style="font-size: 16px">h</span>
                                    </div>
                                    <div class="col-lg-3"  style="display: flex">
                                        <input name="workMin" id="workMin" class="form-control" value="0" max="59" min="0" type="number">&nbsp;<span class="mt-auto mb-auto" style="font-size: 16px">m</span>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4 ml-auto">
                                        <button type="button" class="btn btn-outline-brand btn-elevate btn-pill" id="addWorkHour">
                                            Add Work Hours
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-4 pt-5 pb-4" style="border-top: solid 1px #000;">
                                    <div class="col-lg-6 text-left" style="font-size: 30px;">Allocated time</div>
                                    <div class="col-lg-6 text-right" style="font-size: 30px;" id="allocatedTime"></div>
                                </div>
                                @foreach($allocatedTimes as $allocatedTime)
                                    <div class="row">
                                        <div class="col-lg-3 text-left">
                                            {{$allocatedTime['allocateDate']}}
                                        </div>
                                        <div class="col-lg-3 text-left">
                                            {{$allocatedTime['personName']}}
                                        </div>
                                        <div class="col-lg-3 text-left">
                                            {{$allocatedTime['description']}}
                                        </div>
                                        <div class="col-lg-3 text-right">
                                            {{floor($allocatedTime['timeAllocated']/8) }}d &nbsp; {{round($allocatedTime['timeAllocated']-floor($allocatedTime['timeAllocated']/8) * 8 , 1)}}h
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <input name="allocationDescription"  id="allocationDescription" class="form-control" placeholder="Time Allocation Description">
                                    </div>
                                    <div class="col-lg-3" style="display: flex">
                                        <input name="allocationHour" id="allocationHour" class="form-control" value="0" type="number"> &nbsp; <span class="mt-auto mb-auto" style="font-size: 16px">h</span>
                                    </div>
                                    <div class="col-lg-3"  style="display: flex">
                                        <input name="allocationMin" id="allocationMin" class="form-control" value="0" max="59" type="number">&nbsp;<span class="mt-auto mb-auto" style="font-size: 16px">m</span>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4 ml-auto">
                                        <button type="button" class="btn btn-outline-brand btn-elevate btn-pill" id="addAllocationTime">
                                            Add Work Hours
                                        </button>
                                    </div>
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
                                                {{__('task.budget')}}
                                            </div>
                                            <div class="col-lg-6" style="text-align: right">
                                                {{number_format($budgetTotalSum, 2, ',', '.')}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                {{__('task.expense')}}
                                            </div>
                                            <div class="col-lg-6" style="text-align: right">
                                                {{number_format($expenseTotalSum, 2, ',', '.')}}
                                            </div>
                                        </div>
                                        <div class="row balance">
                                            <div class="col-lg-6">
                                                {{__('task.balance')}}
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
                                            <h5>{{__('task.budget')}}</h5>
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
                                            <input type="text"  class="form-control" id="income_description" name="description" placeholder=" {{__('task.incomeDescription')}}">
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
                                                {{__('task.addBudget')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-expense-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>{{__('task.expense')}}</h5>
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
                                            <input type="text"  class="form-control" id="expense_description" name="description" placeholder=" {{__('task.expenseDescription')}}">
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
                                                {{__('task.addExpense')}}
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
                                                {{__('task.startDate')}}
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$taskDetails['datePlanStart']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                {{__('task.endDate')}}
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$taskDetails['datePlanEnd']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                {{__('task.timeLeft')}}
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$statisticsData['timeLeft']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                {{__('task.timeLeft')}}%
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
                                                {{__('task.progress')}}
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$taskDetails['finishProgress']}}%
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-8 statistics-label">
                                                {{__('task.progressLeft')}}
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
                                            {{__('task.progress')}}
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
                                                {{__('task.subTasks')}}
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$statisticsData['totalCount']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                {{__('task.subTasksFinished')}}
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$statisticsData['finishCount']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                {{__('task.subTasksLeft')}}
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                {{$statisticsData['leftCount']}}
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                {{__('task.subTasksFinished')}}
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
                                            {{__('task.subTasksFinished')}}
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
                <button type="button" class="btn btn-primary" data-taskid="{{$taskId}}" data-parentid="{{$taskDetails["parentID"]}}" id="taskDetailDelete"> {{__('task.delete')}}</button>
                <button type="button" class="btn btn-primary disabled" id="taskDetailUpdate"> {{__('task.update')}}</button>
            </div>
        </form>
    </div>
</div>
@endif
