@extends('layouts.layout')
@section('title')
    Dashboard
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
                    <div class="column-body m-3">
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
                                    <h5>{{__('dashboard.newTasks')}}</h5>
                                </div>
                            </div>
                         @foreach($taskList['new'] as $columnClass => $columnItem)
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
                                                                <span class="kt-badge kt-badge--brand kt-badge--lg">
                                                                    {{$columnItem['psntagName']}}
                                                                </span>
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
                    <div class="column-body m-3">
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
                                    <h5>{{__('dashboard.activeTasks')}}</h5>
                                </div>
                            </div>
                            @foreach($taskList['active'] as $columnClass => $columnItem)
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
                                                                <span class="kt-badge kt-badge--brand kt-badge--lg">
                                                                    {{$columnItem['psntagName']}}
                                                                </span>
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
                    <div class="column-body m-3">
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
                                    <h5>{{__('dashboard.overdueTasks')}}</h5>
                                </div>
                            </div>
                            @foreach($taskList['overdue'] as $columnClass => $columnItem)
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
                                                                <span class="kt-badge kt-badge--brand kt-badge--lg">
                                                                    {{$columnItem['psntagName']}}
                                                                </span>
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
    </script>
    <script type="text/javascript" charset="utf-8" src="{{asset('public/assets/js/task/taskcard.js')}}"></script>
@endsection
