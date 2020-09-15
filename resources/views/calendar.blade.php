@extends('layouts.layout')
@section('title')
    Calendar
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css/task/taskcard.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/calendar/vanilla-calendar.css')}}">
    <style>
        .radio_span {
            font-size: 14px;
        }
        .check-span {
            font-size: 14px;
            font-weight: bold;
        }
    </style>
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
                <div style="display: flex">
                    <div class="content-calendar" >
                        @foreach($taskList as $index => $taskListItem)
                            <?php
                                $dt = date('d.m.Y',strtotime($index));
                                $today = date('d.m.Y');
                                $tomorrow = date('d.m.Y',strtotime('tomorrow'));
                                $yesterday = date('d.m.Y',strtotime('yesterday'));
                                $theNextDay = date('d.m.Y',strtotime("2 days",strtotime('today')));
                                $current_date = date('d.m.Y',strtotime($date));
                            ?>
                            <div style="margin-left: 10px; margin-right: 10px; flex: 0 0 30%;  box-sizing:border-box;" class="<?php if ($dt == $current_date) echo "today";?>">
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
                                                        <a class="dropdown-item" data-toggle="tab" data-type="col-task-simple" href="#kt_simple_tab_{{$index}}">
                                                            <i class="fa fa-align-justify"></i>{{__('task.sample')}}
                                                        </a>
                                                        <a class="dropdown-item" data-toggle="tab" data-type="col-task-regular" href="#kt_regular_tab_{{$index}}">
                                                            <i class="flaticon-laptop"></i>{{__('task.regular')}}
                                                        </a>
                                                        <a class="dropdown-item" data-toggle="tab" data-type="col-task-extended" href="#kt_extended_tab_{{$index}}">
                                                            <i class="flaticon-background"></i>{{__('task.extended')}}
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="kt-portlet__head-actions">
                                            {{--@if($index == 'yesterday')--}}
                                                {{--<h5>{{__('calendar.yesterday')}}</h5>--}}
                                            {{--@elseif($index=='today')--}}
                                                {{--<h5>{{__('calendar.today')}}</h5>--}}
                                            {{--@elseif($index=='tomorrow')--}}
                                                {{--<h5>{{__('calendar.tomorrow')}}</h5>--}}
                                            {{--@elseif($index=='theNextDay')--}}
                                                {{--<h5>{{__('calendar.theNextDay')}}</h5>--}}
                                            {{--@endif--}}
                                            <h5>
                                                <?php
                                                    if ($dt == $today) {
                                                        echo __('calendar.today');
                                                    } else if ($dt == $tomorrow) {
                                                        echo __('calendar.tomorrow');
                                                    } else if ($dt == $yesterday) {
                                                        echo __('calendar.yesterday');
                                                    } else if($dt == $theNextDay){
                                                        echo __('calendar.theNextDay');
                                                    } else {
                                                        echo $dt;
                                                    }
                                                ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body active">
                                        <div class="kt-scroll " data-scroll="true" >
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="kt_regular_tab_{{$index}}">
                                                    @foreach($taskListItem as  $index => $columnItem)
                                                        <div class="column-body">
                                                            @if(isset($columnItem["ID"]))
                                                                <?php $tagTask =new \App\TagTask();
                                                                $taskTags =  $tagTask->getTaskTagList($columnItem['ID']);
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
                                                                <div class="kt-regular-task-item thin"
                                                                     data-task_id="{{$columnItem['ID']}}" data-show_type="regular" style="display: flex">
                                                                    <div class="task-status" style="background-color: {{$color}}; display: flex; flex-direction: column; width: 10%; justify-content: space-between; padding-top:10px">
                                                                        <div style="display: flex; flex-direction: column">
                                                                            <div><?php echo($columnItem['status_icon'])?></div>
                                                                            <div>{{$columnItem['priority_title']}}</div>
                                                                            <div>{{$columnItem['weight']}}</div>
                                                                        </div>
                                                                        <div style="position: relative; margin: 0; padding: 0">
                                                                            @if(in_array($columnItem['ID'],$notifications))
                                                                                <i class="fa fa-envelope "></i>
                                                                                <div class="blink_mark blink_mail_icon" id="blink_mail_icon_{{$columnItem['ID']}}">
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 90%; padding: 10px">
                                                                        <div class="row m-2">
                                                                            <div class="col-lg-9">
                                                                                <div class="row task-name">
                                                                                    {{$columnItem['title']}}
                                                                                </div>
                                                                                <div class="row project-name">
                                                                                    {{--{{$columnItem['TagNames']}}--}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <x-user-avatar :type="$columnItem['avatarType']" :nameTag="$columnItem['nameTag']" :roleID="$columnItem['roleID']" :color="$columnItem['avatarColor']" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row m-2">
                                                                            <div style="display: flex; flex-wrap: wrap;"><?php

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
                                                                            @if($columnItem["statusID"] == 4)
                                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            @elseif($columnItem['spentProgress'] <= $columnItem['finishProgress'])
                                                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$columnItem['finishProgress']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            @else
                                                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$columnItem['finishProgress']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                <div class="progress-bar bg-dark" role="progressbar" style="width: {{$columnItem['spentProgress'] - $columnItem['finishProgress']}}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="kt-space-5"></div>
                                                                        <div class="row kt-item-date">
                                                                            <div class="col-lg-6 task-start-date">
                                                                                {{$columnItem['datePlanStart']}}
                                                                            </div>
                                                                            <div class="col-lg-6 task-end-date">
                                                                                {{$columnItem['datePlanEnd']}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="tab-pane" id="kt_extended_tab_{{$index}}">
                                                    @foreach($taskListItem as  $columnItem)
                                                        <div class="column-body">
                                                            @if(isset($columnItem["ID"]))
                                                                <?php $tagTask =new \App\TagTask();
                                                                $taskTags =  $tagTask->getTaskTagList($columnItem['ID']);
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
                                                                <div class="kt-extended-task-item"
                                                                     data-task_id="{{$columnItem['ID']}}" data-show_type="regular" style="display: flex">
                                                                    <div class="task-status" style="background-color: {{$color}}; display: flex; flex-direction: column; width: 10%; justify-content: space-between; padding-top:10px">
                                                                        <div style="display: flex; flex-direction: column">
                                                                            <div><?php echo($columnItem['status_icon'])?></div>
                                                                            <div>{{$columnItem['priority_title']}}</div>
                                                                            <div>{{$columnItem['weight']}}</div>
                                                                        </div>
                                                                        <div style="position: relative; margin: 0; padding: 0">
                                                                            @if(in_array($columnItem['ID'],$notifications))
                                                                                <i class="fa fa-envelope "></i>
                                                                                <div class="blink_mark blink_mail_icon" id="blink_mail_icon_{{$columnItem['ID']}}">
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 90%; padding: 10px">
                                                                        <div class="row m-2">
                                                                            <div class="col-lg-9">
                                                                                <div class="row task-name">
                                                                                    {{$columnItem['title']}}
                                                                                </div>
                                                                                <div class="row project-name">
                                                                                    {{--{{$columnItem['TagNames']}}--}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <x-user-avatar :type="$columnItem['avatarType']" :nameTag="$columnItem['nameTag']" :roleID="$columnItem['roleID']" :color="$columnItem['avatarColor']" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row m-2">
                                                                            <div style="display: flex; flex-wrap: wrap;"><?php

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
                                                                            @if($columnItem["statusID"] == 4)
                                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            @elseif($columnItem['spentProgress'] <= $columnItem['finishProgress'])
                                                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$columnItem['finishProgress']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            @else
                                                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$columnItem['finishProgress']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                <div class="progress-bar bg-dark" role="progressbar" style="width: {{$columnItem['spentProgress'] - $columnItem['finishProgress']}}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="kt-space-5"></div>
                                                                        <div class="row kt-item-date">
                                                                            <div class="col-lg-6 task-start-date">
                                                                                {{$columnItem['datePlanStart']}}
                                                                            </div>
                                                                            <div class="col-lg-6 task-end-date">
                                                                                {{$columnItem['datePlanEnd']}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="extand-below-content">
                                                                            <i class="fa fa-user"></i> &nbsp;&nbsp;&nbsp;{{$columnItem['fullName']}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="tab-pane" id="kt_simple_tab_{{$index}}">
                                                    @foreach($taskListItem as  $columnItem)
                                                        <div class="column-body">
                                                            @if(isset($columnItem["ID"]))
                                                                <?php $tagTask =new \App\TagTask();
                                                                $taskTags =  $tagTask->getTaskTagList($columnItem['ID']);
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
                                                                <div class="kt-simple-task-item thin"
                                                                     data-task_id="{{$columnItem['ID']}}" data-show_type="simple" style="display: flex">
                                                                    <div class="task-status" style="background-color: {{$color}}; display: flex; flex-direction: column; width: 10%; justify-content: space-between; padding-top:10px">
                                                                        <div style="display: flex; flex-direction: column">
                                                                            <div><?php echo($columnItem['status_icon'])?></div>
                                                                        </div>
                                                                        <div style="position: relative; margin: 0; padding: 0">
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 90%;">
                                                                        <div class="row ml-2">
                                                                            <div class="col-lg-9 final-sub-task-name">
                                                                                {{$columnItem['title']}}
                                                                            </div>
                                                                            <div class="col-lg-3 final-sub-task-name">
                                                                                <x-user-avatar :type="$columnItem['avatarType']" :nameTag="$columnItem['nameTag']" :roleID="$columnItem['roleID']" :color="$columnItem['avatarColor']" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Portlet-->
                            </div>
                        @endforeach
                    </div>
                    <div class="calendar-filter">
                        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                        <div class="kt-portlet  kt-portlet--tabs calendar-box">
                            <div class="kt-portlet__body active">
                                <div class="kt-scroll taskAddBody" data-scroll="true">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="kt_quick_panel_tab_information">
                                            <div id="myCalendar" class="vanilla-calendar ml-auto mr-auto mb-2"></div>
                                            <div style="height: 1px; width: 100%; background-color: grey">
                                            </div>
                                            {{--<div class="ml-3 mt-1">--}}
                                                {{--<h6> {{__('calendar.showStatus')}}</h6>--}}
                                                {{--<div>--}}
                                                    {{--<input type="radio"  class="mr-3" id="radio_created"> <i class="fa fa-circle mr-2"></i> <span class="radio_span">{{__('calendar.created')}}</span>--}}
                                                {{--</div>--}}
                                                {{--<div>--}}
                                                    {{--<input type="radio" class="mr-3" id="radio_active"> <i class='flaticon2-arrow lg mr-2'></i> <span class="radio_span">{{__('calendar.active')}}</span>--}}
                                                {{--</div>--}}
                                                {{--<div>--}}
                                                    {{--<input type="radio" class="mr-3" id="radio_paused"> <i class='fa fa-pause mr-2'></i> <span class="radio_span">{{__('calendar.paused')}}</span>--}}
                                                {{--</div>--}}
                                                {{--<div>--}}
                                                    {{--<input type="radio" class="mr-3" id="radio_finished"> <i class='flaticon2-check-mark mr-2'></i> <span class="radio_span">{{__('calendar.finished')}}</span>--}}
                                                {{--</div>--}}
                                                {{--<div>--}}
                                                    {{--<input type="radio" class="mr-3" id="radio_canceled"> <i class='flaticon2-hexagonal mr-2'></i> <span class="radio_span">{{__('calendar.canceled')}}</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div style="margin-top: 20px;height: 1px; width: 100%; background-color: grey">--}}
                                            {{--</div>--}}
                                            <div class="ml-3 mt-3">
                                                <h6>Show  Priority</h6>
                                                <div>
                                                    <input type="checkbox"  class="mr-3" id="check_high"> <span class="check-span mr-2">H</span> <span class="radio_span">{{__('calendar.high')}}</span>
                                                </div>
                                                <div>
                                                    <input type="checkbox" class="mr-3" id="check_medium"> <span class='check-span mr-2'>M</span><span class="radio_span">{{__('calendar.medium')}}</span>
                                                </div>
                                                <div>
                                                    <input type="checkbox" class="mr-3" id="check_low"> <span class='check-span mr-2'>L</span><span class="radio_span">{{__('calendar.low')}}</span>
                                                </div>
                                                <div>
                                                    <input type="checkbox" class="mr-3" id="check_ness"> <span class='check-span mr-2'>O</span><span class="radio_span">{{__('calendar.ness')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
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
    <script src="{{asset('public/assets/js/calendar/vanilla-calendar.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        let base_url = "{{URL::to('')}}";
        {{--var task_id = "{{$taskId}}";--}}
        {{--var showType = "{{$showType}}";--}}
        let filter_status = "{{$status}}";
        let H = "{{$H}}";
        let M = "{{$M}}";
        let L = "{{$L}}";
        let O = "{{$O}}";
        let date ="{{$date}}";
        const slider = document.querySelector('.content-calendar');
        const todayColumn = document.querySelector('.today');
        let isDown = false;
        let startX;
        let scrollLeft;
        slider.scrollLeft = todayColumn.offsetLeft - 310;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', (e) => {
            if(!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2; //scroll-fast
            slider.scrollLeft = scrollLeft - walk;
            console.log(walk);
        });

        switch (filter_status) {
            case '1':
                $('#radio_created').attr('checked',true);
                break;
            case '2':
                $('#radio_active').attr('checked',true);
                break;
            case '3':
                $('#radio_paused').attr('checked',true);
                break;
            case '4':
                $('#radio_finished').attr('checked',true);
                break;
            case '5':
                $('#radio_canceled').attr('checked',true);
                break;
        }

        if (H!="") {
            $('#check_high').attr('checked',true);
        }
        if (M!="") {
            $('#check_medium').attr('checked',true);
        }
        if (L!="") {
            $('#check_low').attr('checked',true);
        }
        if (O!="") {
            $('#check_ness').attr('checked',true);
        }

        $("input[type='radio']").change(function (e) {
            switch (e.target.id) {
                case "radio_created":
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + 1 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_active":
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + 2 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_paused":
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + 3 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_finished":
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + 4 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_canceled":
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + 5 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
            }
        });

        $("input[type='checkbox']").change(function (e) {
            switch (e.target.id) {
                case "check_high":
                    (H == "")?H=1:H="";
                    break;
                case "check_medium":
                    (M == "")?M=1:M="";
                    break;
                case "check_low":
                    (L == "")?L=1:L="";
                    break;
                case "check_ness":
                    (O == "")?O=1:O="";
                    break;
            }

            window.location.href = base_url + "/calendar?date="+date+"&status=" + filter_status + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
        });

        $(document).ready(function(){
            // $('#datepicker').datepicker({
            //     todayHighlight: true,
            //     onSelect: (e) => {
            //         console.log(e.target,"date picker date");
            //     }
            // });
            let calendar = new VanillaCalendar({
                selector: "#myCalendar",
                date:new Date(date),
                todaysDate: new Date(date),
                onSelect: (data, elem) => {
                    let selectedDate = new Date(data.date);

                    date = selectedDate.getFullYear()+'/'+(selectedDate.getMonth() + 1) +'/'+selectedDate.getDate();
                    // console.log(date);
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + filter_status + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                }
            });

        })
    </script>



@endsection
