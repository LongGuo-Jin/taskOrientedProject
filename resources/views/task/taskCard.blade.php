@extends('layouts.layout')
@section('title')
    taskCard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('/css/task/taskcard.css')}}">
@endsection

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
        @include('task.layout.header')
        <!-- end:: Header -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

            <!-- begin:: Content -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                <div class="row">
                    <div class="content-task">
                        @foreach($taskList as $level => $columnItem)
                            <div class="col-task-regular">
                                <!--begin::Portlet-->
                                <div class="kt-portlet">
                                    <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-label">
                                            <button type="button" class="btn btn-outline-brand btn-elevate btn-icon header-btn">
                                                <i class="fa fa-align-justify"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-brand btn-elevate btn-icon header-btn">
                                                <i class="flaticon-laptop"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-brand btn-elevate btn-icon header-btn active">
                                                <i class="flaticon-background"></i>
                                            </button>
                                        </div>
                                        <div class="kt-portlet__head-toolbar">
                                            <div class="kt-portlet__head-actions">
                                                <button type="button" class="btn btn-outline-brand btn-elevate btn-pill addTask"
                                                        data-level="{{$level}}" data-parentid="{{$parentId}}">
                                                    <i class="flaticon-add"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body">
                                        <div class="kt-scroll" data-scroll="true">
                                            @foreach($columnItem as $taskItem)
                                                <div class="kt-task-item thin">
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
                                                            <span class="kt-badge kt-badge--brand kt-badge--lg" id="detail-add-personTag">
                                                                {{$taskItem['psntagName']}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="kt-space-10"></div>
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-dark" role="progressbar" style="width: 35%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                        <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
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
    <script src="{{asset('/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="./assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="./assets/js/demo1/pages/components/extended/blockui.js" type="text/javascript"></script>

    <script type="text/javascript">
        var personTagList = $.parseJSON('<?php echo(json_encode($PersonTagNameList));?>');

        $(document).ready(function () {
            var arrows;
            $('input.date-picker').datepicker({
                rtl: KTUtil.isRTL(),
                orientation: "bottom right",
                todayHighlight: true,
                templates: arrows,
                format: 'mm.dd.yyyy',
                autoclose: true
            });

            $( "#task_add_form" ).validate({
                // define validation rules
                rules: {
                    title: {
                        required: true
                    },
                    personID: {
                        required: true
                    },
                    datePlanStart: {
                        required: true
                    },
                    datePlanEnd: {
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
                    addTask();
                }
            });
        });
    </script>

    <script type="text/javascript" charset="utf-8" src="{{asset('/js/task/taskcard.js')}}"></script>
@endsection
