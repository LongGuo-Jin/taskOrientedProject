@extends('layouts.layout')
@section('title')
    taskCard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css/task/taskcard.css')}}">
@endsection

@section('content')
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
                                                        <div class="kt-regular-task-item thin
                                                        <?php if($taskId == $taskItem['ID']) echo 'selected';?>
                                                        <?php if($taskId != $taskItem['ID'] && in_array($taskItem['ID'], $parents)) echo 'parent_selected';?>"
                                                             data-task_id="{{$taskItem['ID']}}" data-show_type="regular">
                                                            <div class="row">
                                                                <div class="col-lg-2 task-status">
                                                                    <?php echo($taskItem['status_icon'])?>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <div class="row task-name">
                                                                        {{$taskItem['title']}}
                                                                    </div>
                                                                    <div class="row project-name">
                                                                        {{$taskItem['TagNames']}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    @switch($taskItem['avatarType'])
                                                                        @case (1)
                                                                        <svg width="32" height="32">
                                                                            <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="{{$taskItem['avatarColor']}}"></circle>
                                                                            <text x="5" y="22"  style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                            @break
                                                                        @case (2)
                                                                        {{--//rect--}}
                                                                        <svg width="32" height="32">
                                                                            <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="{{$taskItem['avatarColor']}}" style="stroke-width:0;"></rect>
                                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                            @break
                                                                        @case (3)
                                                                        {{--//polygon 5--}}
                                                                        <svg width="32" height="32">
                                                                            <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="{{$taskItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                            @break
                                                                        @case (4)
                                                                        {{--//polygon 6--}}
                                                                        <svg width="32" height="32" >
                                                                            <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="{{$taskItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                            @break
                                                                        @case (5)
                                                                        {{--//rotated rectangle--}}
                                                                          <svg width="32" height="32">
                                                                            <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="{{$taskItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                            @break
                                                                    @endswitch
                                                                    @switch($taskItem['roleID'])
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
                                                                    {{--<span class="kt-badge kt-badge--brand kt-badge--lg">--}}
                                                                        {{--{{$taskItem['psntagName']}}--}}
                                                                    {{--</span>--}}
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
                                                    @endforeach
                                                </div>
                                                <div class="tab-pane" id="kt_extended_tab_{{$columnClass}}">
                                                    @foreach($columnItem as $taskItem)
                                                        <div class="row kt-extended-task-item <?php if($taskId == $taskItem['ID']) echo 'selected';?>"  data-task_id="{{$taskItem['ID']}}" data-show_type="extended">
                                                            <div class="col-lg-8 extand-main-content">
                                                                <div class="kt-extend-part fat">
                                                                    <div class="row">
                                                                        <div class="col-lg-2 task-status">
                                                                            <?php echo($taskItem['status_icon'])?>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            <div class="row task-name kt-font-task-warning">
                                                                                {{$taskItem['title']}}
                                                                            </div>
                                                                            <div class="row project-name">
                                                                                {{$taskItem['TagNames']}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 person-tag">
                                                                            @switch($taskItem['avatarType'])
                                                                                @case (1)
                                                                                <svg width="32" height="32">
                                                                                    <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="{{$taskItem['avatarColor']}}"></circle>
                                                                                    <text x="5" y="22"  style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                                    @break
                                                                                @case (2)
                                                                                {{--//rect--}}
                                                                                <svg width="32" height="32">
                                                                                    <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="{{$taskItem['avatarColor']}}" style="stroke-width:0;"></rect>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                                    @break
                                                                                @case (3)
                                                                                {{--//polygon 5--}}
                                                                                <svg width="32" height="32">
                                                                                    <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="{{$taskItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                                    @break
                                                                                @case (4)
                                                                                {{--//polygon 6--}}
                                                                                <svg width="32" height="32" >
                                                                                    <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="{{$taskItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                                    @break
                                                                                @case (5)
                                                                                {{--//rotated rectangle--}}
                                                                                <svg width="32" height="32">
                                                                                    <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="{{$taskItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                                    @break
                                                                                @endswitch
                                                                                @switch($taskItem['roleID'])
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
                                                                                {{--{{$taskItem['psntagName']}}--}}
                                                                            {{--</span>--}}
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
                                                                &nbsp;&nbsp;&nbsp;{{$taskItem['fullName']}}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="row" style="margin-top: 10px;">
                                                                    <div class="col-lg-6">
                                                                        <div class="triangle">
                                                                            <span>{{$taskItem['priority_title']}}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6" style="text-align: right">
                                                                        <span class="kt-badge kt-badge--default kt-badge--md kt-badge--rounded">
                                                                            {{$taskItem['weight']}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row task-extand-description">
                                                                    <div class="col-lg-6 task-extand-description-left">
                                                                        {{__('task.finished')}}
                                                                    </div>
                                                                    <div class="col-lg-6 task-extand-description-right kt-font-success">
                                                                        100%
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            @if($taskId == $taskItem['ID'])
                                                                <input type="hidden" id="quick_token" name="_token" value="{{csrf_token()}}">
                                                                <div class="row task-expense-add">
                                                                    <div class="col-lg-5">
                                                                        <input type="text" class="form-control" id="quick-expense-title" placeholder="{{__('task.addExpense')}}">
                                                                    </div>
                                                                    <div class="row col-lg-4">
                                                                        <input type="text" class="form-control" id="quick-expense-val" placeholder="0.00">
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <button type="button" class="btn btn-outline-brand btn-elevate btn-pill quick-add-expense" style="float: right;">
                                                                            <i class="flaticon-add"></i> {{__('task.add')}}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="row task-extand-add">
                                                                    <div class="col-lg-5">
                                                                        <input type="text" class="form-control" id="quick-subtask-title" placeholder="{{__('task.addSubTask')}}">
                                                                    </div>
                                                                    <div class="row col-lg-4">
                                                                        {{--<div class="col-lg-4">--}}
                                                                            {{--<span class="kt-badge kt-badge--brand kt-badge--lg" id="quick-add-personTag">--}}
                                                                                {{--{{$PersonTagNameList[$personalID]}}--}}
                                                                            {{--</span>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="col-lg-12">--}}
                                                                            <select class="form-control" id="quick-add-person" name="personID">
                                                                                <option value=""></option>
                                                                                @foreach($rolePersonList as $personItem)
                                                                                    <option value="{{$personItem['id']}}" <?php if($personItem['id'] == $personalID) print_r("selected=selected");?>>{{$personItem['nameFamily'] . " " . $personItem['nameFirst']}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        {{--</div>--}}
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <button type="button" class="btn btn-outline-brand btn-elevate btn-pill quick-add-task" data-parent_id="{{$parents[$columnClass]}}" style="float: right;">
                                                                            <i class="flaticon-add"></i> {{__('task.add')}}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="tab-pane" id="kt_simple_tab_{{$columnClass}}">
                                                    @foreach($columnItem as $taskItem)
                                                        <div class="kt-simple-task-item thin"  data-task_id="{{$taskItem['ID']}}" data-show_type="simple">
                                                            <div class="row">
                                                                <div class="col-lg-2 task-status">
                                                                    <?php echo($taskItem['status_icon'])?>
                                                                </div>
                                                                <div class="col-lg-7 final-sub-task-name">
                                                                    {{$taskItem['title']}}
                                                                </div>
                                                                <div class="col-lg-3 final-sub-task-name">
                                                                    @switch($taskItem['avatarType'])
                                                                        @case (1)
                                                                        <svg width="32" height="32">
                                                                            <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="{{$taskItem['avatarColor']}}"></circle>
                                                                            <text x="5" y="22"  style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                            @break
                                                                            @case (2)
                                                                            {{--//rect--}}
                                                                            <svg width="32" height="32">
                                                                                <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="{{$taskItem['avatarColor']}}" style="stroke-width:0;"></rect>
                                                                                <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                                @break
                                                                            @case (3)
                                                                            {{--//polygon 5--}}
                                                                            <svg width="32" height="32">
                                                                                <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="{{$taskItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                                @break
                                                                            @case (4)
                                                                            {{--//polygon 6--}}
                                                                            <svg width="32" height="32" >
                                                                                <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="{{$taskItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                                @break
                                                                            @case (5)
                                                                            {{--//rotated rectangle--}}
                                                                            <svg width="32" height="32">
                                                                                <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="{{$taskItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                <text x="5" y="22" style="fill:black;font-size: 16px">{{$taskItem['nameTag']}}</text>

                                                                                @break
                                                                            @endswitch
                                                                            @switch($taskItem['roleID'])
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
                                                                    {{--<span class="kt-badge kt-badge--brand kt-badge--lg">--}}
                                                                        {{--{{$taskItem['psntagName']}}--}}
                                                                    {{--</span>--}}
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


                    @if (isset($taskDetails['ID']))
                        @include('task.taskDetailAdd')
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
        let personTagList = $.parseJSON('<?php echo(json_encode($PersonTagNameList));?>');
        let base_url = "{{URL::to('')}}";
        let person_id = "{{$personalID}}";
        let task_id = "{{$taskId}}";
        let showType = "{{$showType}}";
        let userRoleId = "{{$login_role_id}}";;
        let detailTab = "{{$detailTab}}";
        let message = $.parseJSON('<?php echo(json_encode($message));?>');
        let timeAllocated = "{{$timeAllocated}}";
        let totalTimeSpent = "{{$totalTime}}";
        let subTimeSpent = "{{$timeSpentOnSubTask}}";

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

            $("#timeAllocated").text(timeAllocatedDay + "d " + timeAllocateHour + "h");
            $("#allocatedTime").text(timeAllocatedDay + "d " + timeAllocateHour + "h");

            $("#totalTime").text(timeSpentDay+"d "+timeSpentHour+"h");
            $("#timeSpentOnSubTask").text(sutTimeSpentDay+"d "+sutTimeSpentHour+"h");
            $("#timeLeft").text(timeLeftDay+"d "+timeLeftHour+"h");
            $("#workHours").text(timeSpentDay+"d "+timeSpentHour+"h");
            if (timeAllocated == 0) {
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
            })

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
                    var alert = $('#kt_form_1_msg');
                    alert.removeClass('kt--hide').show();
                    $(".taskAddBody").scrollTop("0");
                },

                submitHandler: function (form) {
                    confirmAddTask();
                }
            });


        });

    </script>

    <script type="text/javascript" charset="utf-8" src="{{asset('public/assets/js/task/taskcard.js')}}"></script>
@endsection
