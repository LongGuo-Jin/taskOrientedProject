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
                                                                    {{--{{$columnItem['psntagName']}}--}}
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
                                                                    {{--{{$columnItem['psntagName']}}--}}
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
                                                                        {{--{{$columnItem['psntagName']}}--}}
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
                                                                <span class="kt-badge kt-badge--brand kt-badge--lg">
                                                                    {{--{{$columnItem['psntagName']}}--}}
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
        console.log();
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

        $('#datepicker').datepicker({
            inline: true,
        });

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

    </script>

    <script type="text/javascript" charset="utf-8" src="{{asset('public/assets/js/task/taskcard.js')}}"></script>

@endsection
