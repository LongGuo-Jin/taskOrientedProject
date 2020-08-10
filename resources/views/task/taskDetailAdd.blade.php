<?php
        $userDetails = array();
        $userDetails['avatarType'] = auth()->user()->avatarType;
        $userDetails['avatarColor'] = auth()->user()->avatarColor;
        $userDetails['nameTag'] = auth()->user()->nameTag;
        $userDetails['roleID'] = auth()->user()->roleID;
?>
<div class="col-detail-add detail-add">
    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <form class="kt-form kt-form--label-right" id="task_add_form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="parentID" id="add_parentID" value="">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{__('task.details')}}
                    </h3>
                </div>
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
                                                    @switch($userDetails['avatarType'])
                                                        @case (1)
                                                        <svg width="32" height="32">
                                                            <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="{{$userDetails['avatarColor']}}"></circle>
                                                            <text x="5" y="22"  style="fill:black;font-size: 16px">{{$userDetails['nameTag']}}</text>

                                                            @break
                                                        @case (2)
                                                        {{--//rect--}}
                                                        <svg width="32" height="32">
                                                            <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="{{$userDetails['avatarColor']}}" style="stroke-width:0;"></rect>
                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$userDetails['nameTag']}}</text>

                                                            @break
                                                        @case (3)
                                                        {{--//polygon 5--}}
                                                        <svg width="32" height="32">
                                                            <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="{{$userDetails['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$userDetails['nameTag']}}</text>

                                                            @break
                                                        @case (4)
                                                        {{--//polygon 6--}}
                                                        <svg width="32" height="32" >
                                                            <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="{{$userDetails['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$userDetails['nameTag']}}</text>

                                                            @break
                                                        @case (5)
                                                        {{--//rotated rectangle--}}
                                                        <svg width="32" height="32">
                                                            <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="{{$userDetails['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$userDetails['nameTag']}}</text>

                                                            @break
                                                    @endswitch
                                                    @switch($userDetails['roleID'])
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
                                                            <option data-content='<span class="@if($tagItem['tagtype']==1) system-span @elseif($tagItem['tagtype']==2) organization-span @elseif($tagItem['tagtype']==3) personal-span @endif" style="@if ($tagItem['tagtype']!=3 )background-color:{{$tagItem['color']}} @else border-color:{{$tagItem['color']}} @endif">
                                                                        {{$tagItem['name']}}
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
