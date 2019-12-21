<div class="col-detail-add detail-add">
    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <form class="kt-form kt-form--label-right" id="task_add_form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" id="level" name="level">
            <input type="hidden" id="parentID" name="parentID">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Details
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_information" role="tab">INFORMATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_logs" role="tab">BUDGET</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_settings" role="tab">STATISTICS</a>
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
                                        <input type="text" class="form-control" placeholder="Title" name="title">
                                    </div>
                                    <div class="row detail-information-staus">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-2" style="margin: auto 0px auto 0px;">
                                                    <span class="kt-badge kt-badge--brand kt-badge--lg" id="detail-add-personTag"></span>
                                                </div>
                                                <div class="col-lg-10">
                                                    <div class="detail-information-staus-title">
                                                        In Charge
                                                    </div>
                                                    <div class="detail-information-staus-content">
                                                        <select class="form-control" id="detail-add-person" name="personID">
                                                            <option value=""></option>
                                                            @foreach($PersonList as $personItem)
                                                                <option value="{{$personItem['ID']}}">{{$personItem['nameFirst'] . " " . $personItem['nameFamily']}}</option>
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
                                                        Status
                                                    </div>
                                                    <div class="detail-information-staus-content">
                                                        <select class="form-control kt-selectpicker"  id="detail-information-staus" name="statusID">
                                                            @foreach($TaskStatusList as $taskStatusItem)
                                                                <option data-content="{{$taskStatusItem['note']}}" value="{{$taskStatusItem['ID']}}">{{$taskStatusItem['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="detail-information-staus-title">
                                                        Priority
                                                    </div>
                                                    <div class="detail-information-staus-content">
                                                        <div class="detail-information-staus-content">
                                                            <select class="form-control kt-selectpicker"  id="detail-information-priority" name="priorityID">
                                                                @foreach($TaskPriorityList as $taskPriorityItem)
                                                                    <option value="{{$taskPriorityItem['ID']}}">{{$taskPriorityItem['title']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="detail-information-staus-title">
                                                        Weight
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
                                        <div class="row col-lg-6">
                                            <div class="col-lg-2" style="margin: auto 0px auto 0px;">
                                                Tags
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="detail-information-staus-content">
                                                    <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="tags">
                                                        @foreach($systemTagList as $tagItem)
                                                            <option data-content="{{$tagItem['note']}}" value="{{$tagItem['ID']}}">{{$tagItem['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="detail-information-task-date">
                                        <div class="row">
                                            <div class="col-lg-3 detail-label">
                                                Start Date
                                            </div>
                                            <div class="col-lg-3 detail-content">
                                                <input type="text" class="form-control date-picker" name="datePlanStart"/>
                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                End Date
                                            </div>
                                            <div class="col-lg-3 detail-content">
                                                <input type="text" class="form-control date-picker" name="datePlanEnd"/>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 15px">
                                            <div class="col-lg-3 detail-label">
                                                Actual Start Date
                                            </div>
                                            <div class="col-lg-3 detail-content">
                                                <input type="text" class="form-control date-picker" name="dateActualStart"/>
                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                Actual End Date
                                            </div>
                                            <div class="col-lg-3 detail-content disable">
                                                <input type="text" class="form-control date-picker" name="dateActualEnd"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row detail-information-description">
                                        <h5>Description</h5><br>
                                        <textarea class="form-control" id="exampleTextarea" rows="5" name="description"></textarea>
                                    </div>
                                    <div class="detail-information-task-memos">
                                        <h5>Memos</h5><br>
                                        <div class="row">
                                            <input type="text"  class="form-control" name="memo">
                                        </div>
                                    </div>
                                    <div class="detail-information-task-attachments">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5>Attachmets</h5>
                                            </div>
                                            <div class="custom-file col-lg-6">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_quick_panel_tab_logs">

                            </div>
                            <div class="tab-pane" id="kt_quick_panel_tab_settings">

                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="taskDetailSave">Save</button>
            </div>
        </form>
    </div>
</div>
