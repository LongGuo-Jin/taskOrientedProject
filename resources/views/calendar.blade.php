@extends('layouts.layout')
@section('title')
    Calendar | TOP
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css/task/taskcard.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/calendar/vanilla-calendar.css')}}">
    <style>

        .checked-title {
            font-size: 14px;
            font-weight: bold;
        }

        .main {
            display: block;
            position: relative;
            padding-left: 20px;
            margin-bottom: 15px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Hide the default checkbox */
        input[type=checkbox] {
            visibility: hidden;
        }

        .check-title {
            font-size: 14px;
            /*background-color: #9d88bf;*/
        }
        /* Creating a custom checkbox
        based on demand */
        .geekmark {
            position: absolute;
            top: 3px;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: rgba(42, 25, 14, 0.38);
        }

        /* Specify the background color to be
        shown when hovering over checkbox */
        .main:hover input ~ .geekmark {
            background-color: #346c80;
        }

        /* Specify the background color to be
        shown when checkbox is active */
        .main input:active ~ .geekmark {
            background-color: red;
        }

        /* Specify the background color to be
        shown when checkbox is checked */

        .main input:checked ~ .check-title{
            font-size: 14px;
            font-weight: bold;
        }

        .main input:checked ~ .geekmark {
            background-color: #9d88bf;
        }

        /* Checkmark to be shown in checkbox */
        /* It is not be shown when not checked */
        .geekmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Display checkmark when checked */
        .main input:checked ~ .geekmark:after {
            display: block;
        }


        /* Styling the checkmark using webkit */
        /* Rotated the rectangle by 45 degree and
        showing only two border to make it look
        like a tickmark */
        .main .geekmark:after {
            left: 7px;
            bottom: 5px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 2px 2px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

    </style>
@endsection

@section('content')
    <?php
    $notifications = explode(',',$memoNotification);
    $locale = app()->getLocale();
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
                                                                    <div style="width: 90%; padding: 10px;  <?php if ($columnItem['overdue']) echo "background: #fff2f2";?>">
                                                                        <div class="row">
                                                                            <div class="col-lg-9 task-name">
                                                                                {{$columnItem['title']}}
                                                                            </div>
                                                                            <div class="col-lg-3 person-tag">
                                                                                <x-user-avatar :type="$columnItem['avatarType']" :nameTag="$columnItem['nameTag']" :roleID="$columnItem['roleID']" :color="$columnItem['avatarColor']" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-2">
                                                                            <div class="col-lg-12" style="display:flex; flex-wrap: wrap;"><?php

                                                                                foreach($taskTags as $taskTag) {
                                                                                ?>
                                                                                <span class="@if($taskTag['tagtype']==1) system-span @elseif($taskTag['tagtype']==2) organization-span @elseif($taskTag['tagtype']==3) personal-span @endif" style="color:{{$taskTag['color']}}">
                                                                                   {{$taskTag['tagtype']==1?__('tag.'.$taskTag['name']):$taskTag['name']}}
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
                                                                    <div class="extand-main-content" style=" width: 90%;  <?php if ($columnItem['overdue']) echo "background: #fff2f2";?>">
                                                                        <div class="kt-extend-part">
                                                                            <div class="row">
                                                                                <div class="col-lg-9 task-name">
                                                                                    <div class=" kt-font-task-warning">
                                                                                        {{$columnItem['title']}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3 person-tag">
                                                                                    <x-user-avatar :type="$columnItem['avatarType']" :nameTag="$columnItem['nameTag']" :roleID="$columnItem['roleID']" :color="$columnItem['avatarColor']" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="kt-space-10"></div>
                                                                            <div class="row">
                                                                                <div class="col-lg-12" style="display:flex;flex-wrap: wrap;"><?php
                                                                                    foreach($taskTags as $taskTag) {
                                                                                    ?>
                                                                                        <span class="@if($taskTag['tagtype']==1) system-span @elseif($taskTag['tagtype']==2) organization-span @elseif($taskTag['tagtype']==3) personal-span @endif" style="color:{{$taskTag['color']}}">
                                                                                            {{$taskTag['tagtype']==1?__('tag.'.$taskTag['name']):$taskTag['name']}}
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
                                                                                    <p style="float: right">{{$columnItem['datePlanEnd']}}</p>
                                                                                </div>
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
                                                                    <div style="width: 90%; padding: 10px;  <?php if ($columnItem['overdue']) echo "background: #fff2f2";?>">
                                                                        <div class="row">
                                                                            <div class="col-lg-9 final-sub-task-name">
                                                                                {{$columnItem['title']}}
                                                                            </div>
                                                                            <div class="col-lg-3 final-sub-task-name person-tag">
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
                                            <div class="ml-3 mt-4">
                                                <h5 class="mb-3">{{__('calendar.showPriority')}}</h5>
                                                <label class="main">
                                                    <input type="checkbox" id="check_high">
                                                    H <span class="check-title">{{__('calendar.high')}}</span>
                                                    <span class="geekmark"></span>
                                                </label>

                                                <label class="main">
                                                    <input type="checkbox" id="check_medium">
                                                    M <span class="check-title">{{__('calendar.medium')}}</span>
                                                    <span class="geekmark"></span>
                                                </label>

                                                <label class="main">
                                                    <input type="checkbox" id="check_low">
                                                    L <span class="check-title">{{__('calendar.low')}}</span>
                                                    <span class="geekmark"></span>
                                                </label>
                                                <label class="main">
                                                    <input type="checkbox" id="check_ness">
                                                    O <span class="check-title">{{__('calendar.ness')}}</span>
                                                    <span class="geekmark"></span>
                                                </label>

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
        let locale = "{{$locale}}";
        let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        let shortWeekday = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
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

        if (locale == 'si') {
            months = ['Januar', 'Februar', 'Marec', 'April', 'Maj', 'Junij', 'Julij', 'Avgust', 'September', 'Oktober', 'November', 'December'];
            shortWeekday = ['Ne', 'Po', 'To', 'Sr', 'Če', 'Pe', 'So'];
        }

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
                months: months,
                shortWeekday: shortWeekday,
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
