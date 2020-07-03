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
                                                                    <span class="kt-badge kt-badge--brand kt-badge--lg">
                                                                        {{$taskItem['psntagName']}}
                                                                    </span>
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
                                                                            <span class="kt-badge kt-badge--brand kt-badge--lg" id="detail-add-personTag">
                                                                                {{$taskItem['psntagName']}}
                                                                            </span>
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
                                                                <div class="row task-extand-description">
                                                                    <div class="col-lg-6 task-extand-description-left">
                                                                        {{__('task.hours')}}
                                                                    </div>
                                                                    <div class="col-lg-6 task-extand-description-right kt-font-warning">
                                                                        22,52
                                                                    </div>
                                                                </div>
                                                                <div class="row task-extand-description">
                                                                    <div class="col-lg-6 task-extand-description-left">
                                                                        {{__('task.budget')}}
                                                                    </div>
                                                                    <div class="col-lg-6 task-extand-description-right kt-font-success">
                                                                        2.427,662
                                                                    </div>
                                                                </div>
                                                                <div class="row task-extand-description">
                                                                    <div class="col-lg-6 task-extand-description-left">
                                                                        {{__('task.time')}}
                                                                    </div>
                                                                    <div class="col-lg-6 task-extand-description-right kt-font-danger">
                                                                        42D
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
                                                                        <div class="col-lg-4">
                                                                            <span class="kt-badge kt-badge--brand kt-badge--lg" id="quick-add-personTag">
                                                                                {{$PersonTagNameList[$personalID]}}
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-lg-8">
                                                                            <select class="form-control" id="quick-add-person" name="personID">
                                                                                <option value=""></option>
                                                                                @foreach($rolePersonList as $personItem)
                                                                                    <option value="{{$personItem['id']}}" <?php if($personItem['id'] == $personalID) print_r("selected=selected");?>>{{$personItem['nameFamily'] . " " . $personItem['nameFirst']}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
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
                                                                    <span class="kt-badge kt-badge--brand kt-badge--lg">
                                                                        {{$taskItem['psntagName']}}
                                                                    </span>
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
                    @include('task.taskDetailEdit')
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
        var personTagList = $.parseJSON('<?php echo(json_encode($PersonTagNameList));?>');
        var base_url = "{{URL::to('')}}";
        var task_id = "{{$taskId}}";
        var showType = "{{$showType}}";
        var userRoleId = "{{$login_role_id}}";;
        var detailTab = "{{$detailTab}}";
        var message = $.parseJSON('<?php echo(json_encode($message));?>');

        $(document).ready(function () {
            var arrows;
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

                    let oArrVal = oVal.split('.');
                    let oDate = new Date(oArrVal[1]+"/"+oArrVal[0]+"/"+oArrVal[2]);
                    if (oDate < date) {
                        $('#datePlanEndAdd').closest('div').find('p')[0].innerText = val;
                        $('#datePlanEndAdd').val(val);
                    }
                } else if (targetId == "datePlanEndAdd") {
                    let oVal = $('#datePlanStartAdd').val();

                    let oArrVal = oVal.split('.');
                    let oDate = new Date(oArrVal[1]+"/"+oArrVal[0]+"/"+oArrVal[2]);
                    if (oDate > date) {
                        $('#datePlanStartAdd').closest('div').find('p')[0].innerText = val;
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
