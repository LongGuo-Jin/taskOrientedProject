@if(!empty($taskDetails))
<div class="col-detail-add detail-edit">
    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <form class="kt-form" id="task_update_form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="taskID" value="{{$taskId}}">
            <input type="hidden" name="parentID" value="{{$taskDetails["parentID"]}}">
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
                <div class="kt-scroll" data-scroll="true" style="height: 600px">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_quick_panel_tab_information">
                            <div class="detail-infomation-content">
                                <div class="row detail-information-title">

                                </div>
                                <div class="row detail-information-task-name">
                                    <p>{{$taskDetails["title"]}}</p>
                                    <input type="text" class="form-control" style="display: none" placeholder="Title" name="title" value="{{$taskDetails["title"]}}" >
                                </div>
                                <div class="row detail-information-staus">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <span class="kt-badge kt-badge--brand kt-badge--lg" id="detail-add-personTag">
                                                    {{$taskDetails["psntagName"]}}
                                                </span>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="detail-information-staus-title">
                                                    In Charge
                                                </div>
                                                <div class="detail-information-person-content">
                                                    <p>{{$taskDetails["fullName"]}}</p>
                                                    <select class="form-control"  style="display: none" id="detail-add-person" name="personID" >
                                                        <option value=""></option>
                                                        @foreach($rolePersonList as $personItem)
                                                            <option value="{{$personItem['ID']}}" <?php if($personItem['ID'] == $taskDetails["personID"]) echo 'selected=selected';?>>
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
                                                    Status
                                                </div>
                                                <div class="detail-information-staus-content">
                                                    <p><?php print_r($taskDetails["status_icon"]);?></p>
                                                    <p @if($taskDetails["status_icon"] != "") style="display: none;" @endif>
                                                        <select class="form-control kt-selectpicker" id="detail-information-staus" name="statusID">
                                                            @foreach($TaskStatusList as $taskStatusItem)
                                                                <option data-content="{{$taskStatusItem['note']}}" value="{{$taskStatusItem['ID']}}" <?php if($taskStatusItem['ID'] == $taskDetails["statusID"]) echo 'selected=selected';?>>
                                                                    {{$taskStatusItem['title']}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="detail-information-staus-title">
                                                    Priority
                                                </div>
                                                <div class="detail-information-priority-content">
                                                    <p>{{$taskDetails["priority_title"]}}</p>
                                                    <p @if ($taskDetails["priority_title"] != "") style="display: none;" @endif>
                                                        <select class="form-control kt-selectpicker"  id="detail-information-priority" name="priorityID">
                                                            @foreach($TaskPriorityList as $taskPriorityItem)
                                                                <option value="{{$taskPriorityItem['ID']}}" <?php if($taskPriorityItem['ID'] == $taskDetails["priorityID"]) echo 'selected=selected';?>>{{$taskPriorityItem['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="detail-information-staus-title">
                                                    Weight
                                                </div>
                                                <div class="detail-information-weight-content">
                                                    <p>{{$taskDetails["weight"]}}</p>
                                                    <p @if ($taskDetails["weight"]) style="display: none;" @endif>
                                                        <select class="form-control kt-selectpicker" id="detail-information-priority" name="weightID">
                                                            @foreach($TaskWeightList as $taskWeightItem)
                                                                <option value="{{$taskWeightItem['ID']}}" <?php if($taskWeightItem['ID'] == $taskDetails["weightID"]) echo 'selected=selected';?>>{{$taskWeightItem['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row detail-information-tags">
                                    <div class="col-lg-2">
                                        Tags
                                    </div>
                                    <div class="col-lg-10 detail-edit-tags">
                                        <p><?php
                                            print_r($taskDetails["TagNameIcons"]);
                                            $tmpTagArr = explode(",", $taskDetails["tags"]);
                                            ?>
                                        </p>
                                        <p @if ($taskDetails["TagNameIcons"] != "") style="display: none;" @endif>
                                            <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="tags">
                                                @foreach($systemTagList as $tagItem)
                                                    <option data-content="{{$tagItem['note']}}" value="{{$tagItem['ID']}}"
                                                        <?php
                                                        if(in_array($tagItem["ID"], $tmpTagArr) == 1)
                                                            echo 'selected=selected';
                                                        ?>
                                                    >
                                                        {{$tagItem['name']}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="detail-information-task-date">
                                    <div class="row">
                                        <div class="col-lg-3 detail-label">
                                            Start Date
                                        </div>
                                        <div class="col-lg-3 detail-content detail-start-date">
                                            <p>{{$taskDetails["datePlanStart"]}}</p>
                                            <input type="text" class="form-control date-picker" @if ($taskDetails["datePlanStart"] != "") style="display: none" @endif
                                                   name="datePlanStart" autocomplete="off" value="{{$taskDetails["datePlanStart"]}}" >
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            End Date
                                        </div>
                                        <div class="col-lg-3 detail-content detail-end-date">
                                            <p>{{$taskDetails["datePlanEnd"]}}</p>
                                            <input type="text" class="form-control date-picker" @if ($taskDetails["datePlanEnd"] != "")) style="display: none" @endif name="datePlanEnd" autocomplete="off" value="{{$taskDetails["datePlanEnd"]}}" >
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-lg-3 detail-label">
                                            Actual Start Date
                                        </div>
                                        <div class="col-lg-3 detail-content detail-actual-start-date">
                                            <p>{{$taskDetails["dateActualStart"]}}</p>
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            Actual End Date
                                        </div>
                                        <div class="col-lg-3 detail-content  detail-actual-end-date">
                                            <p>{{$taskDetails["dateActualEnd"]}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-information-description">
                                    <h5>Description</h5>
                                    <p>{{$taskDetails["description"]}}</p>
                                    <textarea class="form-control" id="edit_description" @if ($taskDetails["description"] != "") style="display: none" @endif rows="5" name="description">{{$taskDetails["description"]}}</textarea>
                                </div>
                                <div class="detail-information-task-memos">
                                    <h5>Memos</h5>
                                    <div class="row">
                                        <div class="col-lg-4 detail-content">
                                            15. 11. 2019 08:12
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            Tine Strehar
                                        </div>
                                        <div class="col-lg-5 detail-content">
                                            Fixed!
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-lg-4 detail-content">
                                            10. 10. 2019 07:37
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            Janez Novak
                                        </div>
                                        <div class="col-lg-5">
                                            Someone please fix the little wheel on the trolley. It keeps on
                                            falling of if loaded.
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="text"  class="form-control" name="memo">
                                    </div>
                                </div>
                                <div class="detail-information-task-attachments">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>Attachmets</h5><br>
                                        </div>
                                        <div class="custom-file col-lg-6">
                                            <input type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="kt-widget4__pic kt-widget4__pic--icon">
                                                <img src="./assets/media/files/pdf.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="row">
                                                <h5>
                                                    Contract 2019-267 - Baustelle Ulm.pdf
                                                </h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5 detail-label">
                                                    Attached:
                                                </div>
                                                <div class="col-lg-7 detail-content">
                                                    10. 10. 2019
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5 detail-label">
                                                    Attached by:
                                                </div>
                                                <div class="col-lg-7 detail-content">
                                                    Janez Novak
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-information-task-memos">
                                    <h5>History</h5><br>
                                    <div class="row">
                                        <div class="col-lg-4 detail-content">
                                            15. 11. 2019 08:12
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            Tine Strehar
                                        </div>
                                        <div class="col-lg-5 detail-content">
                                            Status change: Active
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-lg-4 detail-content">
                                            10. 10. 2019 07:37
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            Janez Novak
                                        </div>
                                        <div class="col-lg-5">
                                            Attachment added: Contract 2019-267 - Fabrike Ulm.pdf
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-lg-4 detail-content">
                                            10. 10. 2019 07:35
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            Janez Novak
                                        </div>
                                        <div class="col-lg-5">
                                            Created
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
                <button type="button" class="btn btn-primary disabled" id="taskDetailUpdate">Update</button>
            </div>
        </form>
    </div>
</div>
@endif
