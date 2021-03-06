<?php
        $userDetails = array();
        $userDetails['avatarType'] = auth()->user()->avatarType;
        $userDetails['avatarColor'] = auth()->user()->avatarColor;
        $userDetails['nameTag'] = auth()->user()->nameTag;
        $userDetails['roleID'] = auth()->user()->roleID;
?>
<div class="col-detail-add detail-add" style="display: none">
    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <form class="kt-form kt-form--label-right" id="task_add_form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="parentID" id="add_parentID" value="">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_information" role="tab">{{__('task.information')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-scroll taskAddBody" data-scroll="true">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_quick_panel_tab_information">
                                <div class="detail-infomation-content">
                                    <div class="row detail-information-task-name">
                                        <input type="text" class="form-control" placeholder="{{__('task.title')}}" name="title">
                                    </div>
                                    <div class="row detail-information-staus">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-3" style="margin: auto 0px auto 0px;">
                                                    <x-user-avatar :type="$userDetails['avatarType']" :nameTag="$userDetails['nameTag']" :roleID="$userDetails['roleID']" :color="$userDetails['avatarColor']" />
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="detail-information-staus-title">
                                                        {{__('task.inCharge')}}
                                                    </div>
                                                    <div class="detail-information-staus-content">
                                                        <select class="form-control" id="detail-add-person" name="personID">
                                                            <option value=""></option>
                                                            @foreach($rolePersonList as $personItem)
                                                                <option value="{{$personItem['id']}}" <?php if($personItem['id'] == $personalID) print_r("selected=selected");?>>
                                                                    {{$personItem['nameFamily'] . " " . $personItem['nameFirst']}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" style="text-align: center">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="detail-information-staus-title">
                                                        {{__('task.status')}}
                                                    </div>
                                                    <div class="detail-information-staus-content">
                                                        <select class="form-control kt-selectpicker"  id="detail-information-staus" name="statusID">
                                                            @foreach($TaskStatusList as $taskStatusItem)
                                                                <option data-content="{{$taskStatusItem['note']}}" value="{{$taskStatusItem['ID']}}" selected>{{$taskStatusItem['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="detail-information-staus-title">
                                                        {{__('task.priority')}}
                                                    </div>
                                                    <div class="detail-information-staus-content">
                                                        <div class="detail-information-staus-content">
                                                            <select class="form-control kt-selectpicker"  id="detail-information-priority" name="priorityID">
                                                                @foreach($TaskPriorityList as $taskPriorityItem)
                                                                    <option value="{{$taskPriorityItem['ID']}}" @if ($taskPriorityItem['ID'] == "2") selected="selected" @endif>{{$taskPriorityItem['title']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="detail-information-staus-title">
                                                        {{__('task.weight')}}
                                                    </div>
                                                    <div class="detail-information-staus-content">
                                                        <select class="form-control kt-selectpicker" id="detail-information-priority" name="weightID">
                                                            @foreach($TaskWeightList as $taskWeightItem)
                                                                <option value="{{$taskWeightItem['ID']}}">{{$taskWeightItem['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row detail-information-tags">
                                        <div class="row col-lg-12">
                                            <div class="col-lg-2" style="margin: auto 0px auto 0px;">
                                                {{__('task.tags')}}
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="detail-information-staus-content">
                                                    <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="tags">
                                                        @foreach($tagList as $tagItem)
                                                            <option data-content='<span class="@if($tagItem['tagtype']==1) system-span @elseif($tagItem['tagtype']==2) organization-span @elseif($tagItem['tagtype']==3) personal-span @endif" style="color:{{$tagItem['color']}}">
                                                                       {{$tagItem['tagtype']==1?__('tag.'.$tagItem['name']):$tagItem['name']}}
                                                                    </span>' value="{{$tagItem['ID']}}">
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="detail-information-task-date">
                                        <div class="row">
                                            <div class="col-lg-3 detail-label">
                                                {{__('task.startDate')}}
                                            </div>
                                            <div class="col-lg-3 detail-content">
                                                <input type="text" class="form-control date-picker" name="datePlanStart" id="datePlanStartAdd" autocomplete="off"/>
                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                {{__('task.endDate')}}
                                            </div>
                                            <div class="col-lg-3 detail-content">
                                                <input type="text" class="form-control date-picker" name="datePlanEnd"  id="datePlanEndAdd" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 15px">
                                            <div class="col-lg-3 detail-label">
                                                {{__('task.actualStartDate')}}
                                            </div>
                                            <div class="col-lg-3 detail-content">
                                                <input type="text" class="form-control date-picker" name="dateActualStart" id="dateActualStartAdd" autocomplete="off"/>
                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                {{__('task.actualEndDate')}}
                                            </div>
                                            <div class="col-lg-3 detail-content disable">
                                                <input type="text" class="form-control date-picker" name="dateActualEnd" id="dateActualEndAdd" autocomplete="off"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row detail-information-description">
                                        <h5>{{__('task.description')}}</h5><br>
                                        <textarea class="form-control" id="exampleTextarea" rows="5" name="description"></textarea>
                                    </div>
                                    <div class="detail-information-task-memos">
                                        <h5>{{__('task.memos')}}</h5><br>
                                        <div class="row">
                                            <input type="text"  class="form-control" name="memo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="taskDetailSave">{{__('task.save')}}</button>
            </div>
        </form>
    </div>
</div>
