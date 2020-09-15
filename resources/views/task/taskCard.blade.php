@extends('layouts.layout')
@section('title')
    taskCard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css/task/taskcard.css')}}">
@endsection

@section('content')
    <?php
        $notifications = explode(',',$memoNotification);
    ?>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
        @include('layouts.header')
        <!-- end:: Header -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
            <!-- begin:: Content -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                <div class="row">
                    <div class="content-task">
                        @foreach($taskList as $columnClass => $columnItem)
                                <div class="column-body" data-column_id="{{$columnClass}}">
                                <!--begin::Portlet-->
                                <div class="kt-portlet  kt-portlet--tabs">
                                    <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-toolbar">
                                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-primary" role="tablist">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="la flaticon-background"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" data-toggle="tab" data-type="col-task-simple" href="#kt_simple_tab_{{$columnClass}}">
                                                            <i class="fa fa-align-justify"></i>{{__('task.sample')}}
                                                        </a>
                                                        <a class="dropdown-item" data-toggle="tab" data-type="col-task-regular" href="#kt_regular_tab_{{$columnClass}}">
                                                            <i class="flaticon-laptop"></i>{{__('task.regular')}}
                                                        </a>
                                                        <a class="dropdown-item" data-toggle="tab" data-type="col-task-extended" href="#kt_extended_tab_{{$columnClass}}">
                                                            <i class="flaticon-background"></i>{{__('task.extended')}}
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="kt-portlet__head-actions">
                                            <button type="button" class="btn btn-outline-brand btn-elevate btn-pill addTask" data-parent_id="{{$parents[$columnClass]}}">
                                                <i class="flaticon-add"></i> {{__('task.addTask')}}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body">
                                        @if(isset($columnItem[0]["ID"]))
                                            <div class="kt-scroll" data-scroll="true">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="kt_regular_tab_{{$columnClass}}">
                                                    @foreach($columnItem as $taskItem)
                                                        <div class="kt-regular-task-item row thin <?php if($taskId == $taskItem['ID']) echo 'selected';?>
                                                        <?php if($taskId != $taskItem['ID'] && in_array($taskItem['ID'], $parents)) echo 'parent_selected';?>"
                                                             data-task_id="{{$taskItem['ID']}}" data-show_type="regular" style="display: flex;">
                                                            <?php $tagTask =new \App\TagTask();
                                                                $taskTags =  $tagTask->getTaskTagList($taskItem['ID']);
                                                                $color = '#9d88bf';

                                                                foreach($taskTags as $taskTag) {
                                                                    if ($taskTag["tagtype"] != 1 ) {
                                                                        continue;
                                                                    }

                                                                    if($taskTag['name'] == "PROJECT") {
                                                                        $color = '#302344';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "MILESTONE") {
                                                                        $color = '#98b6ea';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "TO DO") {
                                                                        $color = '#f7dd6d';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "PERMANENT") {
                                                                        $color = '#4fc6a2';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "PERIODIC") {
                                                                        $color = '#88e588';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "TRIP") {
                                                                        $color = '#a5a3aa';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "ERROR") {
                                                                        $color = '#ef6f6f';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "ALARM") {
                                                                        $color = '#f4c67d';
                                                                        break;
                                                                    }
                                                                }

                                                                ?>
                                                            <div class="task-status" style="padding-top: 10px; background-color: {{$color}};display: flex; flex-direction: column; width: 10%; justify-content: space-between">
                                                                <div style="display: flex; flex-direction: column">
                                                                    <div><?php echo($taskItem['status_icon'])?></div>
                                                                    <div>{{$taskItem['priority_title']}}</div>
                                                                    <div>{{$taskItem['weight']}}</div>
                                                                </div>
                                                                <div style="position: relative; margin: 0; padding: 0">
                                                                    @if(in_array($taskItem['ID'],$notifications))
                                                                        <i class="fa fa-envelope "></i>
                                                                        <div class="blink_mark blink_mail_icon" id="blink_mail_icon_{{$taskItem['ID']}}">
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div style="width: 90%; padding: 10px; <?php if ($taskItem['overdue']) echo "background: #fff2f2";?>">
                                                                <div class="row">
                                                                    <div class="col-lg-9 task-name">
                                                                        {{$taskItem['title']}}
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <x-user-avatar :type="$taskItem['avatarType']" :nameTag="$taskItem['nameTag']" :roleID="$taskItem['roleID']" :color="$taskItem['avatarColor']" />
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col-lg-12" style="display: flex; flex-wrap: wrap;"><?php

                                                                        foreach($taskTags as $taskTag) {
                                                                        ?>
                                                                        <span class="@if($taskTag['tagtype']==1) system-span @elseif($taskTag['tagtype']==2) organization-span @elseif($taskTag['tagtype']==3) personal-span @endif" style="@if ($taskTag['tagtype']!=3 )background-color:{{$taskTag['color']}} @else border-color:{{$taskTag['color']}} @endif">
                                                                           {{$taskTag['name']}}
                                                                        </span> &nbsp;
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>

                                                                <div class="kt-space-10"></div>
                                                                <div class="progress" style="height: 6px;">
                                                                    @if($taskItem["statusID"] == 4)
                                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    @elseif($taskItem['spentProgress'] <= $taskItem['finishProgress'])
                                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$taskItem['finishProgress']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    @else
                                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{$taskItem['finishProgress']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        <div class="progress-bar bg-dark" role="progressbar" style="width: {{$taskItem['spentProgress'] - $taskItem['finishProgress']}}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    @endif
                                                                </div>
                                                                <div class="kt-space-5"></div>
                                                                <div class="row kt-item-date">
                                                                    <div class="col-lg-6 task-start-date">
                                                                        {{$taskItem['datePlanStart']}}
                                                                    </div>
                                                                    <div class="col-lg-6 task-end-date">
                                                                        {{$taskItem['datePlanEnd']}}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="tab-pane" id="kt_extended_tab_{{$columnClass}}">
                                                    @foreach($columnItem as $taskItem)
                                                        <div class="row kt-extended-task-item <?php if($taskId == $taskItem['ID']) echo 'selected';?>
                                                        <?php if($taskId != $taskItem['ID'] && in_array($taskItem['ID'], $parents)) echo 'parent_selected';?>"
                                                                data-task_id="{{$taskItem['ID']}}" data-show_type="extended" style="display: flex;">
                                                            <?php $tagTask =new \App\TagTask();
                                                            $taskTags =  $tagTask->getTaskTagList($taskItem['ID']);
                                                            $color = '#9d88bf';

                                                            foreach($taskTags as $taskTag) {
                                                                if ($taskTag["tagtype"] != 1 ) {
                                                                    continue;
                                                                }

                                                                if($taskTag['name'] == "PROJECT") {
                                                                    $color = '#302344';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "MILESTONE") {
                                                                    $color = '#98b6ea';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "TO DO") {
                                                                    $color = '#f7dd6d';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "PERMANENT") {
                                                                    $color = '#4fc6a2';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "PERIODIC") {
                                                                    $color = '#88e588';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "TRIP") {
                                                                    $color = '#a5a3aa';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "ERROR") {
                                                                    $color = '#ef6f6f';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "ALARM") {
                                                                    $color = '#f4c67d';
                                                                    break;
                                                                }
                                                            }

                                                            ?>
                                                            <div class="task-status" style="padding-top: 10px; background-color: {{$color}}; display: flex; flex-direction: column; width: 10%; justify-content: space-between">
                                                                <div style="display: flex; flex-direction: column">
                                                                    <div><?php echo($taskItem['status_icon'])?></div>
                                                                    <div>{{$taskItem['priority_title']}}</div>
                                                                    <div>{{$taskItem['weight']}}</div>
                                                                </div>
                                                                <div style="position: relative; margin: 0; padding: 0">
                                                                    @if(in_array($taskItem['ID'],$notifications))
                                                                        <i class="fa fa-envelope "></i>
                                                                        <div class="blink_mark blink_mail_icon"  id="blink_mail_icon_{{$taskItem['ID']}}">
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="extand-main-content" style=" width: 90%; <?php if ($taskItem['overdue']) echo "background: #fff2f2";?>">
                                                                <div class="kt-extend-part">
                                                                    <div class="row">
                                                                        <div class="col-lg-9">
                                                                            <div class="task-name kt-font-task-warning">
                                                                                {{$taskItem['title']}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 person-tag">
                                                                            <x-user-avatar :type="$taskItem['avatarType']" :nameTag="$taskItem['nameTag']" :roleID="$taskItem['roleID']" :color="$taskItem['avatarColor']" />
                                                                       </div>
                                                                    </div>
                                                                    <div class="kt-space-10"></div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12" style="display: flex; flex-wrap: wrap;"><?php
                                                                            foreach($taskTags as $taskTag) {
                                                                            ?>
                                                                            <span class="@if($taskTag['tagtype']==1) system-span @elseif($taskTag['tagtype']==2) organization-span @elseif($taskTag['tagtype']==3) personal-span @endif" style="@if ($taskTag['tagtype']!=3 )background-color:{{$taskTag['color']}} @else border-color:{{$taskTag['color']}} @endif">
                                                                           {{$taskTag['name']}}
                                                                        </span> &nbsp;
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="kt-space-10"></div>
                                                                    <div class="progress" style="height: 6px;">
                                                                        @if($taskItem["statusID"] == 4)
                                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        @elseif($taskItem['spentProgress'] <= $taskItem['finishProgress'])
                                                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$taskItem['finishProgress']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        @else
                                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$taskItem['finishProgress']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            <div class="progress-bar bg-dark" role="progressbar" style="width: {{$taskItem['spentProgress'] - $taskItem['finishProgress']}}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="kt-space-5"></div>
                                                                    <div class="row kt-item-date">
                                                                        <div class="col-lg-6 task-start-date">
                                                                            {{$taskItem['datePlanStart']}}
                                                                        </div>
                                                                        <div class="col-lg-6 task-end-date">
                                                                            <p style="float: right">{{$taskItem['datePlanEnd']}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="extand-below-content">
                                                                    <i class="fa fa-user"></i> &nbsp;&nbsp;&nbsp;{{$taskItem['fullName']}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="tab-pane" id="kt_simple_tab_{{$columnClass}}">
                                                    @foreach($columnItem as $taskItem)
                                                        <div class="row kt-simple-task-item thin <?php if($taskId == $taskItem['ID']) echo 'selected';?>
                                                        <?php if($taskId != $taskItem['ID'] && in_array($taskItem['ID'], $parents)) echo 'parent_selected';?>"
                                                        data-task_id="{{$taskItem['ID']}}" data-show_type="simple"  data-task_id="{{$taskItem['ID']}}"   style="display: flex">
                                                            <?php $tagTask =new \App\TagTask();
                                                            $taskTags =  $tagTask->getTaskTagList($taskItem['ID']);
                                                            $color = '#9d88bf';

                                                            foreach($taskTags as $taskTag) {
                                                                if ($taskTag["tagtype"] != 1 ) {
                                                                    continue;
                                                                }

                                                                if($taskTag['name'] == "PROJECT") {
                                                                    $color = '#302344';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "MILESTONE") {
                                                                    $color = '#98b6ea';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "TO DO") {
                                                                    $color = '#f7dd6d';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "PERMANENT") {
                                                                    $color = '#4fc6a2';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "PERIODIC") {
                                                                    $color = '#88e588';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "TRIP") {
                                                                    $color = '#a5a3aa';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "ERROR") {
                                                                    $color = '#ef6f6f';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "ALARM") {
                                                                    $color = '#f4c67d';
                                                                    break;
                                                                }
                                                            }

                                                            ?>

                                                            <div class="task-status " style="padding-top: 10px; width: 10%;background-color: {{$color}};">
                                                                <?php echo($taskItem['status_icon'])?>
                                                            </div>
                                                            <div style="width: 90%; padding: 10px;  <?php if ($taskItem['overdue']) echo "background: #fff2f2";?>">
                                                            <div class="row">
                                                                <div class="col-lg-9 final-sub-task-name">
                                                                    {{$taskItem['title']}}
                                                                </div>
                                                                <div class="col-lg-3 final-sub-task-name">
                                                                    <x-user-avatar :type="$taskItem['avatarType']" :nameTag="$taskItem['nameTag']" :roleID="$taskItem['roleID']" :color="$taskItem['avatarColor']" />
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <!--end::Portlet-->
                            </div>

                        @endforeach
                        </div>
                    @include('task.taskDetailAdd')
                    @if (isset($taskDetails['ID']))
                        @include('task.taskDetailEdit')
                    @endif
                </div>

                <!-- end:: Content -->
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/components/extended/blockui.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        let base_url = "{{URL::to('')}}";
        let person_id = "{{$personalID}}";
        let task_id = "{{$taskId}}";
        let showType = "{{$showType}}";
        let userRoleId = "{{$login_role_id}}";
        let detailTab = "{{$detailTab}}";
        let memoNotification = "{{$memoNotification}}";
        let message = $.parseJSON('<?php echo(json_encode($message));?>');
        let filters = $.parseJSON('<?php echo(json_encode($filters));?>');
        let timeAllocated = "{{$timeAllocated}}";
        let totalTimeSpent = "{{$totalTime}}";
        let subTimeSpent = "{{$timeSpentOnSubTask}}";
        {{--let selectedTask = $.parseJSON('<?php echo((isset($taskDetails['ID'])?json_encode($taskDetails['ID']):''));?>');--}}

        $(document).ready(function () {
            let arrows;
            let timeAllocatedDay = Math.floor(timeAllocated / 8);
            let timeAllocateHour = (timeAllocated - timeAllocatedDay * 8).toPrecision(1);
            let timeSpentDay = Math.floor(totalTimeSpent / 8);
            let timeSpentHour = (totalTimeSpent - timeSpentDay * 8).toPrecision(1);
            let sutTimeSpentDay = Math.floor(subTimeSpent / 8);
            let sutTimeSpentHour = (subTimeSpent - sutTimeSpentDay * 8).toPrecision(1);
            let timeLeft = timeAllocated  - totalTimeSpent - subTimeSpent;
            let timeLeftDay = Math.floor(timeLeft / 8);
            let timeLeftHour = (timeLeft - timeLeftDay * 8).toPrecision(1);

            let element = '.kt-'+showType+'-task-item.selected';
            let targetTask = $(element);
            let parentTask = targetTask.parents('.kt-scroll');

            if (parentTask.length > 0) {
                parentTask.scrollTop(
                    targetTask.offset().top - parentTask.offset().top + parentTask.scrollTop() - 120
                );
            }

            $("#timeAllocated").text(timeAllocatedDay + "d " + timeAllocateHour + "h");
            $("#allocatedTime").text(timeAllocatedDay + "d " + timeAllocateHour + "h");

            $("#totalTime").text(timeSpentDay+"d "+timeSpentHour+"h");
            $("#timeSpentOnSubTask").text(sutTimeSpentDay+"d "+sutTimeSpentHour+"h");
            $("#timeLeft").text(timeLeftDay+"d "+timeLeftHour+"h");
            $("#workHours").text(timeSpentDay+"d "+timeSpentHour+"h");

            if (timeAllocated === 0) {
                $("#timeLeft").text("Nan");
            }

            let data = [
                { data: totalTimeSpent},
                { data: subTimeSpent},
                { data: timeLeft},
            ];

            $.plot($("#timePieChart"), data, {
                series: {
                    pie: {
                        show: true
                    }
                }
            });

            $('input.date-picker').datepicker({
                rtl: KTUtil.isRTL(),
                orientation: "bottom right",
                todayHighlight: true,
                templates: arrows,
                format: 'dd.mm.yyyy',
                autoclose: true
            });

            $('input.date-picker').change(function(e){
                let targetId= e.target.id;
                let val = e.target.value;
                let arrVal = val.split('.');
                let date = new Date(arrVal[1]+"/"+arrVal[0]+"/"+arrVal[2]);

                if (targetId == "datePlanStartAdd") {
                    let oVal = $('#datePlanEndAdd').val();
                    console.log(oVal, "datePlanStartAdd");
                    let oArrVal = oVal.split('.');
                    let oDate = new Date(oArrVal[1]+"/"+oArrVal[0]+"/"+oArrVal[2]);
                    if (oDate < date || oVal == "") {
                        $('#datePlanEndAdd').val(val);
                    }
                } else if (targetId == "datePlanEndAdd") {
                    let oVal = $('#datePlanStartAdd').val();

                    let oArrVal = oVal.split('.');
                    let oDate = new Date(oArrVal[1]+"/"+oArrVal[0]+"/"+oArrVal[2]);
                    if (oDate > date || oVal == "") {
                        $('#datePlanStartAdd').val(val);
                    }
                } else if (targetId == "datePlanStartEdit") {
                    let oVal = $('#datePlanEndEdit').val();
                    console.log(oVal);
                    let oArrVal = oVal.split('.');
                    let oDate = new Date(oArrVal[1]+"/"+oArrVal[0]+"/"+oArrVal[2]);
                    if (oDate < date) {
                        $('#datePlanEndEdit').closest('div').find('p')[0].innerText = val;
                        $('#datePlanEndEdit').val(val);
                    }
                } else if (targetId == "datePlanEndEdit") {
                    let oVal = $('#datePlanStartEdit').val();
                    console.log(oVal);
                    let oArrVal = oVal.split('.');
                    let oDate = new Date(oArrVal[1]+"/"+oArrVal[0]+"/"+oArrVal[2]);
                    if (oDate > date) {
                        $('#datePlanStartEdit').closest('div').find('p')[0].innerText = val;
                        $('#datePlanStartEdit').val(val);
                    }
                }
            });

            $( "#task_add_form" ).validate({
                // define validation rules
                rules: {
                    title: {
                        required: true
                    },
                    personID: {
                        required: true
                    }
                },
                //display error alert on form submit
                invalidHandler: function(event, validator) {
                    let alert = $('#kt_form_1_msg');
                    alert.removeClass('kt--hide').show();
                    $(".taskAddBody").scrollTop("0");
                },
                submitHandler: function (form) {
                    confirmAddTask();
                }
            });
        });

    </script>

@endsection
