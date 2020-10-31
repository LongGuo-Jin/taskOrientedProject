@extends('layouts.layout')
@section('title')
    Dashboard | TOP
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
                    @foreach($taskList as $index => $taskListItem)
                        <div class="col-md-3">
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
                                        @if($index == 'new')
                                            <h5>{{__('dashboard.newTasks')}}</h5>
                                        @elseif($index=='overdue')
                                            <h5>{{__('dashboard.overdueTasks')}}</h5>
                                        @elseif($index=='active')
                                            <h5>{{__('dashboard.activeTasks')}}</h5>
                                        @elseif($index=='unread')
                                            <h5>{{__('dashboard.unreadMessages')}}</h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="kt-portlet__body active">
                                    <div class="kt-scroll " data-scroll="true"  >
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
                                                                    <div style="width: 90%; padding: 10px; <?php if ($columnItem['overdue']) echo "background: #be98987a";?>">
                                                                    <div class="row">
                                                                        <div class="col-lg-9 task-name">
                                                                            {{$columnItem['title']}}
                                                                        </div>
                                                                        <div class="col-lg-3 person-tag">
                                                                            <x-user-avatar :type="$columnItem['avatarType']" :nameTag="$columnItem['nameTag']" :roleID="$columnItem['roleID']" :color="$columnItem['avatarColor']" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col-lg-12" style="display: flex; flex-wrap: wrap;"><?php

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
                                                                <div class="extand-main-content" style="width: 90%; <?php if ($columnItem['overdue']) echo "background: #be98987a";?>">
                                                                    <div class="kt-extend-part">
                                                                        <div class="row">
                                                                            <div class="col-lg-9 task-name ">
                                                                                <div class="kt-font-task-warning">
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
                                                                <div style="width: 90%; padding: 10px; <?php if ($columnItem['overdue']) echo "background: #be98987a";?>">
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
                <!-- end:: Content -->
            </div>
        </div>
    @include('layouts.footer')
    </div>
@endsection

@section('script')
    <script src="{{asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/components/extended/blockui.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        var base_url = "{{URL::to('')}}";
        {{--var task_id = "{{$taskId}}";--}}
        {{--var showType = "{{$showType}}"; --}}
    </script>

@endsection
