@extends('layouts.layout')
@section('title')
    Calendar
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css/task/taskcard.css')}}">
    <style>
        .radio_span {
            font-size: 18px;
        }
        .check-span {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')

    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
    @include('layouts.header')
    <!-- end:: Header -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
            <!-- begin:: Content -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                <div class="row">
                    <div class="content-calendar row">
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
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="kt-portlet__head-actions">
                                        <h5>{{__('calendar.yesterday')}}</h5>
                                    </div>
                                </div>
                                @foreach($taskList['yesterday'] as $columnClass => $columnItem)
                                    <div class="column-body" data-column_id="{{$columnClass}}">
                                        @if(isset($columnItem["ID"]))

                                            <div class="tab-content">
                                                <div class="kt-regular-task-item thin"
                                                     data-task_id="{{$columnItem['ID']}}" data-show_type="regular" style="display: flex">
                                                    <div class="task-status pt-2" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%">
                                                        <div><?php echo($columnItem['status_icon'])?></div>
                                                        <div>{{$columnItem['priority_title']}}</div>
                                                        <div>{{$columnItem['weight']}}</div>
                                                    </div>
                                                    <div style="width: 90%; padding: 10px">
                                                        <div class="row m-2">
                                                            <div class="col-lg-9">
                                                                <div class="row task-name">
                                                                    {{$columnItem['title']}}
                                                                </div>
                                                                <div class="row project-name">
                                                                    {{$columnItem['TagNames']}}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                @switch($columnItem['avatarType'])
                                                                    @case (1)
                                                                    <svg width="32" height="32">
                                                                        <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="{{$columnItem['avatarColor']}}"></circle>
                                                                        <text x="5" y="22"  style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                        @break
                                                                        @case (2)
                                                                        {{--//rect--}}
                                                                        <svg width="32" height="32">
                                                                            <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="{{$columnItem['avatarColor']}}" style="stroke-width:0;"></rect>
                                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                            @break
                                                                            @case (3)
                                                                            {{--//polygon 5--}}
                                                                            <svg width="32" height="32">
                                                                                <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                @break
                                                                                @case (4)
                                                                                {{--//polygon 6--}}
                                                                                <svg width="32" height="32" >
                                                                                    <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                    @break
                                                                                    @case (5)
                                                                                    {{--//rotated rectangle--}}
                                                                                    <svg width="32" height="32">
                                                                                        <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                        <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                        @break
                                                                                        @endswitch
                                                                                        @switch($columnItem['roleID'])
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
                                            </div>

                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <!--end::Portlet-->
                        </div>
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

                                            </li>
                                        </ul>
                                    </div>
                                    <div class="kt-portlet__head-actions">
                                        <h5>{{__('calendar.today')}}</h5>
                                    </div>
                                </div>
                                @foreach($taskList['today'] as $columnClass => $columnItem)
                                    <div class="column-body" data-column_id="{{$columnClass}}">
                                        @if(isset($columnItem["ID"]))
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="kt_regular_tab_{{$columnClass}}">
                                                    <div class="kt-regular-task-item thin"
                                                         data-task_id="{{$columnItem['ID']}}" data-show_type="regular" style="display: flex">
                                                        <div class="task-status pt-2" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%">
                                                            <div><?php echo($columnItem['status_icon'])?></div>
                                                            <div>{{$columnItem['priority_title']}}</div>
                                                            <div>{{$columnItem['weight']}}</div>
                                                        </div>
                                                        <div style="width: 90%; padding: 10px">
                                                            <div class="row m-2">
                                                                <div class="col-lg-9">
                                                                    <div class="row task-name">
                                                                        {{$columnItem['title']}}
                                                                    </div>
                                                                    <div class="row project-name">
                                                                        {{$columnItem['TagNames']}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    @switch($columnItem['avatarType'])
                                                                        @case (1)
                                                                        <svg width="32" height="32">
                                                                            <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="{{$columnItem['avatarColor']}}"></circle>
                                                                            <text x="5" y="22"  style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                            @break
                                                                            @case (2)
                                                                            {{--//rect--}}
                                                                            <svg width="32" height="32">
                                                                                <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="{{$columnItem['avatarColor']}}" style="stroke-width:0;"></rect>
                                                                                <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                @break
                                                                                @case (3)
                                                                                {{--//polygon 5--}}
                                                                                <svg width="32" height="32">
                                                                                    <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                    @break
                                                                                    @case (4)
                                                                                    {{--//polygon 6--}}
                                                                                    <svg width="32" height="32" >
                                                                                        <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                        <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                        @break
                                                                                        @case (5)
                                                                                        {{--//rotated rectangle--}}
                                                                                        <svg width="32" height="32">
                                                                                            <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                            @break
                                                                                            @endswitch
                                                                                            @switch($columnItem['roleID'])
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
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <!--end::Portlet-->
                        </div>
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
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="kt-portlet__head-actions">
                                            <h5>{{__('calendar.tomorrow')}}</h5>
                                        </div>
                                    </div>
                                    @foreach($taskList['tomorrow'] as $columnClass => $columnItem)
                                        <div class="column-body" data-column_id="{{$columnClass}}">
                                            @if(isset($columnItem["ID"]))
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="kt_regular_tab_{{$columnClass}}">
                                                        <div class="kt-regular-task-item thin"
                                                             data-task_id="{{$columnItem['ID']}}" data-show_type="regular" style="display: flex">
                                                            <div class="task-status pt-2" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%">
                                                                <div><?php echo($columnItem['status_icon'])?></div>
                                                                <div>{{$columnItem['priority_title']}}</div>
                                                                <div>{{$columnItem['weight']}}</div>
                                                            </div>
                                                            <div style="width: 90%; padding: 10px">
                                                                <div class="row m-2">
                                                                    <div class="col-lg-9">
                                                                        <div class="row task-name">
                                                                            {{$columnItem['title']}}
                                                                        </div>
                                                                        <div class="row project-name">
                                                                            {{$columnItem['TagNames']}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        @switch($columnItem['avatarType'])
                                                                            @case (1)
                                                                            <svg width="32" height="32">
                                                                                <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="{{$columnItem['avatarColor']}}"></circle>
                                                                                <text x="5" y="22"  style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                @break
                                                                                @case (2)
                                                                                {{--//rect--}}
                                                                                <svg width="32" height="32">
                                                                                    <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="{{$columnItem['avatarColor']}}" style="stroke-width:0;"></rect>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                    @break
                                                                                    @case (3)
                                                                                    {{--//polygon 5--}}
                                                                                    <svg width="32" height="32">
                                                                                        <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                        <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                        @break
                                                                                        @case (4)
                                                                                        {{--//polygon 6--}}
                                                                                        <svg width="32" height="32" >
                                                                                            <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                            @break
                                                                                            @case (5)
                                                                                            {{--//rotated rectangle--}}
                                                                                            <svg width="32" height="32">
                                                                                                <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                                <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                                @break
                                                                                                @endswitch
                                                                                                @switch($columnItem['roleID'])
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
                                                    </div>

                                                </div>

                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <!--end::Portlet-->
                            </div>
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

                                            </li>
                                        </ul>
                                    </div>
                                    <div class="kt-portlet__head-actions">
                                        <h5>{{__('calendar.theNextDay')}}</h5>
                                    </div>
                                </div>
                                @foreach($taskList['theNextDay'] as $columnClass => $columnItem)
                                    <div class="column-body" data-column_id="{{$columnClass}}">
                                        @if(isset($columnItem["ID"]))
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="kt_regular_tab_{{$columnClass}}">
                                                    <div class="kt-regular-task-item thin"
                                                         data-task_id="{{$columnItem['ID']}}" data-show_type="regular">
                                                        <div class="row">
                                                            <div class="col-lg-2 task-status">
                                                                <?php echo($columnItem['status_icon'])?>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <div class="row task-name">
                                                                    {{$columnItem['title']}}
                                                                </div>
                                                                <div class="row project-name">
                                                                    {{$columnItem['TagNames']}}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                @switch($columnItem['avatarType'])
                                                                    @case (1)
                                                                    <svg width="32" height="32">
                                                                        <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="{{$columnItem['avatarColor']}}"></circle>
                                                                        <text x="5" y="22"  style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                        @break
                                                                        @case (2)
                                                                        {{--//rect--}}
                                                                        <svg width="32" height="32">
                                                                            <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="{{$columnItem['avatarColor']}}" style="stroke-width:0;"></rect>
                                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                            @break
                                                                            @case (3)
                                                                            {{--//polygon 5--}}
                                                                            <svg width="32" height="32">
                                                                                <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                @break
                                                                                @case (4)
                                                                                {{--//polygon 6--}}
                                                                                <svg width="32" height="32" >
                                                                                    <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                    @break
                                                                                    @case (5)
                                                                                    {{--//rotated rectangle--}}
                                                                                    <svg width="32" height="32">
                                                                                        <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="{{$columnItem['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                        <text x="5" y="22" style="fill:black;font-size: 16px">{{$columnItem['nameTag']}}</text>

                                                                                        @break
                                                                                        @endswitch
                                                                                        @switch($columnItem['roleID'])
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
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <!--end::Portlet-->
                        </div>
                    </div>
                    <div class="calendar-filter">
                        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid calendar-box">
                            <div id="datepicker" class="ml-auto mr-auto mb-5"></div>

                            <div style="height: 2px; width: 100%; background-color: grey">
                            </div>
                            <div class="ml-3 mt-2">
                                <h4> {{__('calendar.showStatus')}}</h4>
                                <div>
                                    <input type="radio"  class="mr-3" id="radio_onHold"> <i class="fa fa-circle mr-2"></i> <span class="radio_span">{{__('calendar.onHold')}}</span>
                                </div>
                                <div>
                                    <input type="radio" class="mr-3" id="radio_active"> <i class='flaticon2-arrow lg mr-2'></i> <span class="radio_span">{{__('calendar.active')}}</span>
                                </div>
                                <div>
                                    <input type="radio" class="mr-3" id="radio_paused"> <i class='fa fa-pause mr-2'></i> <span class="radio_span">{{__('calendar.paused')}}</span>
                                </div>
                                <div>
                                    <input type="radio" class="mr-3" id="radio_finished"> <i class='flaticon2-check-mark mr-2'></i> <span class="radio_span">{{__('calendar.finished')}}</span>
                                </div>
                                <div>
                                    <input type="radio" class="mr-3" id="radio_canceled"> <i class='flaticon2-hexagonal mr-2'></i> <span class="radio_span">{{__('calendar.canceled')}}</span>
                                </div>
                            </div>
                            <div style="margin-top: 20px;height: 2px; width: 100%; background-color: grey">
                            </div>
                            <div class="ml-3 mt-2">
                                    <h4>Show  Priority</h4>
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
        var base_url = "{{URL::to('')}}";
        {{--var task_id = "{{$taskId}}";--}}
        {{--var showType = "{{$showType}}";--}}
        var filter_status = "{{$status}}";
        var H = "{{$H}}";
        var M = "{{$M}}";
        var L = "{{$L}}";
        var O = "{{$O}}";



        switch (filter_status) {
            case '1':
                $('#radio_onHold').attr('checked',true);
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
                case "radio_onHold":
                    window.location.href = base_url + "/calendar?status=" + 1 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_active":
                    window.location.href = base_url + "/calendar?status=" + 2 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_paused":
                    window.location.href = base_url + "/calendar?status=" + 3 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_finished":
                    window.location.href = base_url + "/calendar?status=" + 4 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_canceled":
                    window.location.href = base_url + "/calendar?status=" + 5 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
            }
        })

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

            window.location.href = base_url + "/calendar?status=" + filter_status + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
        })

        $(document).ready(function(){
            // $('#datepicker').datepicker({
            //     todayHighlight: true,
            //     onSelect: (e) => {
            //         console.log(e.target,"date picker date");
            //     }
            // });

            $('#datepicker').datepicker({
                todayHighlight: true,
                format: 'YY-mm-dd',
            });
        })
    </script>



@endsection
