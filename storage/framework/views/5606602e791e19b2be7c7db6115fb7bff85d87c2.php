<?php if(!empty($taskDetails)): ?>
<div class="col-detail-add detail-edit">
    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <form class="kt-form" id="task_update_form" name="task_update_form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" name="taskID" value="<?php echo e($taskId); ?>">
            <input type="hidden" name="personID" value="<?php echo e($taskDetails["personID"]); ?>">
            <input type="hidden" name="parentID" value="<?php echo e($taskDetails["parentID"]); ?>">
            <input type="hidden" name="oldstatusID" value="<?php echo e($taskDetails["statusID"]); ?>">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        <?php echo e(__('task.details')); ?>

                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" style="text-transform: uppercase" data-toggle="tab" id="tab_information" href="#edit_panel_tab_information" role="tab"><?php echo e(__('task.information')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" id="tab_time" href="#edit_panel_tab_time" role="tab"><?php echo e(__('task.time')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" id="tab_budget" href="#edit_panel_tab_budget" role="tab"><?php echo e(__('task.budget')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="text-transform: uppercase" data-toggle="tab"  id="tab_statistics" href="#edit_panel_tab_statistics" role="tab"><?php echo e(__('task.statistics')); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-scroll" data-scroll="true" style="height: 600px">
                    <div class="tab-content">
                        <div class="tab-pane active" id="edit_panel_tab_information">
                            <div class="detail-infomation-content">
                                <div class="row" style="justify-content: space-between; margin: 5px">
                                    <div class="row detail-information-title">
                                    <?php for($i=count($pathArr)-1; $i>=1; $i--): ?>
                                        <a href="<?php echo e(url('/task/taskCard?task_id=')); ?><?php echo e($pathArr[$i]['ID']); ?>">
                                            <h5>
                                                <?php echo e($pathArr[$i]["title"]); ?>

                                            </h5>
                                        </a>
                                        <?php if($i != 1): ?>
                                            <h5>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</h5>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    </div>
                                </div>
                                <div class="row detail-information-task-name" style="justify-content: space-between;">
                                    <p><?php echo e($taskDetails["title"]); ?></p>
                                    <input type="text" class="form-control" style="display: none; width: 80%" placeholder="<?php echo e(__('task.title')); ?>" name="title" value="<?php echo e($taskDetails["title"]); ?>" >
                                    <?php if($pinnedTask['personID'] == auth()->user()->id): ?>
                                        <a href="<?php echo e(route('task.removePin',['taskID'=>$taskDetails['ID']])); ?>"><img src="<?php echo e(asset('public/images/pinned.png')); ?>" alt="logo" height="25"></a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('task.addPin',['taskID'=>$taskDetails['ID']])); ?>"><img src="<?php echo e(asset('public/images/unpinned.png')); ?>" alt="logo" height="25"></a>
                                    <?php endif; ?>
                                </div>
                                <div class="row detail-information-staus">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <?php switch($taskDetails['avatarType']):
                                                    case (1): ?>
                                                    <svg width="32" height="32">
                                                        <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="<?php echo e($taskDetails['avatarColor']); ?>"></circle>
                                                        <text x="5" y="22"  style="fill:black;font-size: 16px"><?php echo e($taskDetails['nameTag']); ?></text>

                                                        <?php break; ?>
                                                    <?php case (2): ?>
                                                    
                                                    <svg width="32" height="32">
                                                        <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="<?php echo e($taskDetails['avatarColor']); ?>" style="stroke-width:0;"></rect>
                                                        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($taskDetails['nameTag']); ?></text>

                                                        <?php break; ?>
                                                    <?php case (3): ?>
                                                    
                                                    <svg width="32" height="32">
                                                        <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="<?php echo e($taskDetails['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($taskDetails['nameTag']); ?></text>

                                                        <?php break; ?>
                                                    <?php case (4): ?>
                                                    
                                                    <svg width="32" height="32" >
                                                        <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="<?php echo e($taskDetails['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($taskDetails['nameTag']); ?></text>

                                                        <?php break; ?>
                                                    <?php case (5): ?>
                                                    
                                                    <svg width="32" height="32">
                                                        <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="<?php echo e($taskDetails['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($taskDetails['nameTag']); ?></text>

                                                        <?php break; ?>
                                                <?php endswitch; ?>
                                                <?php switch($taskDetails['roleID']):
                                                    case (1): ?>
                                                    <circle cx="28" cy="4" r="3" stroke="black" stroke-width="0" fill="black"></circle>
                                                    <rect height="8" width="2" x="27" y="0" fill="black"></rect>
                                                    <polygon points="25.145898644316,1.1974823013079 24.145898266966,2.9295328910135 30.854099523987,6.802519564103 31.854101033387,5.0704696279878 " fill = "black" style="stroke:purple;stroke-width:0;"></polygon>
                                                    <polygon points="24.14589756732,5.0704645899847 25.14589681262,6.8025158332799 31.854103132324,2.9295379290175 30.854105019076,1.1974860321334 " fill = "black" style="stroke:purple;stroke-width:0;"></polygon>
                                                    <?php break; ?>
                                                    <?php case (2): ?>
                                                    <polygon points="28,0 25.648857298782,7.2360667481539 31.804227357789,2.7639360007462 24.195775873739,2.7639260551337 30.35113424097,7.2360728948744 " fill = "black" style="stroke:purple;stroke-width:0;"></polygon>
                                                    <?php break; ?>
                                                    <?php case (4): ?>
                                                    <circle cx="28" cy="4" r="4" stroke="black" stroke-width="0" fill = "black" style="stroke-width:0;"></circle>
                                                    <?php break; ?>
                                                <?php endswitch; ?>
                                            </svg>
                                                
                                                    
                                                
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="detail-information-staus-title">
                                                    <?php echo e(__('task.inCharge')); ?>

                                                </div>
                                                <div class="detail-information-person-content">
                                                    <p><?php echo e($taskDetails["fullName"]); ?></p>
                                                    <select class="form-control"  <?php if($taskDetails["fullName"] != ""): ?> style="display: none" <?php endif; ?> id="detail-add-person" name="selectedPersonID" >
                                                        
                                                        <?php $__currentLoopData = $rolePersonList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($personItem['id']); ?>" <?php if($personItem['id'] == $taskDetails["personID"]) echo 'selected=selected';?>>
                                                                <?php echo e($personItem['nameFamily'] . " " . $personItem['nameFirst']); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" style="text-align: center">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="detail-information-staus-title">
                                                    <?php echo e(__('task.status')); ?>

                                                </div>
                                                <div class="detail-information-staus-content">
                                                    <p><?php print_r($taskDetails["status_icon"]);?></p>
                                                    <p <?php if($taskDetails["status_icon"] != ""): ?> style="display: none;" <?php endif; ?>>
                                                        <select class="form-control kt-selectpicker" id="detail-information-staus" name="statusID">
                                                            <?php $__currentLoopData = $TaskStatusList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskStatusItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option data-content="<?php echo e($taskStatusItem['note']); ?>" value="<?php echo e($taskStatusItem['ID']); ?>" <?php if($taskStatusItem['ID'] == $taskDetails["statusID"]) echo 'selected=selected';?>>
                                                                    <?php echo e($taskStatusItem['title']); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="detail-information-staus-title">
                                                    <?php echo e(__('task.priority')); ?>

                                                </div>
                                                <div class="detail-information-priority-content">
                                                    <p><?php echo e($taskDetails["priority_title"]); ?></p>
                                                    <p <?php if($taskDetails["priority_title"] != ""): ?> style="display: none;" <?php endif; ?>>
                                                        <select class="form-control kt-selectpicker"  id="detail-information-priority" name="priorityID">
                                                            <?php $__currentLoopData = $TaskPriorityList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskPriorityItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($taskPriorityItem['ID']); ?>" <?php if($taskPriorityItem['ID'] == $taskDetails["priorityID"]) echo 'selected=selected';?>><?php echo e($taskPriorityItem['title']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="detail-information-staus-title">
                                                    <?php echo e(__('task.weight')); ?>

                                                </div>
                                                <div class="detail-information-weight-content">
                                                    <p><?php echo e($taskDetails["weight"]); ?></p>
                                                    <p <?php if(isset($taskDetails["weight"])): ?> style="display: none;" <?php endif; ?>>
                                                        <select class="form-control kt-selectpicker" id="detail-information-priority" name="weightID">
                                                            <?php $__currentLoopData = $TaskWeightList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskWeightItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($taskWeightItem['ID']); ?>" <?php if($taskWeightItem['ID'] == $taskDetails["weightID"]) echo 'selected=selected';?>><?php echo e($taskWeightItem['title']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row detail-information-tags">
                                    <div class="col-lg-2">
                                        <?php echo e(__('task.tags')); ?>

                                    </div>
                                    <div class="col-lg-10 detail-edit-tags">
                                        <div style="display: flex; flex-wrap: wrap;"><?php
                                            foreach($taskTagList as $taskTag) {
                                                ?>
                                                <span class="<?php if($taskTag['tagtype']==1): ?> system-span <?php elseif($taskTag['tagtype']==2): ?> organization-span <?php elseif($taskTag['tagtype']==3): ?> personal-span <?php endif; ?>" style="<?php if($taskTag['tagtype']!=3 ): ?>background-color:<?php echo e($taskTag['color']); ?> <?php else: ?> border-color:<?php echo e($taskTag['color']); ?> <?php endif; ?>">
                                                    <?php echo e($taskTag['name']); ?>

                                                </span> &nbsp;
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <p <?php if(count($taskTagList) != 0): ?> style="display: none;" <?php endif; ?>>
                                            <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="tags">
                                                <?php $__currentLoopData = $tagList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tagItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option data-content='<span class="<?php if($tagItem['tagtype']==1): ?> system-span <?php elseif($tagItem['tagtype']==2): ?> organization-span <?php elseif($tagItem['tagtype']==3): ?> personal-span <?php endif; ?>" style="<?php if($tagItem['tagtype']!=3 ): ?>background-color:<?php echo e($tagItem['color']); ?> <?php else: ?> border-color:<?php echo e($tagItem['color']); ?> <?php endif; ?>">
                                                    <?php echo e($tagItem['name']); ?>

                                                        </span>' value="<?php echo e($tagItem['ID']); ?>"
                                                        <?php
                                                            foreach($taskTagList as $taskTag) {
                                                            if ($taskTag['ID'] == $tagItem['ID'])
                                                            {
                                                                echo 'selected';
                                                                break;
                                                            }
                                                        }
                                                        ?>
                                                    >
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </p>
                                    </div>
                                </div>

                                <div class="detail-information-task-date">
                                    <div class="row">
                                        <div class="col-lg-3 detail-label">
                                            <?php echo e(__('task.startDate')); ?>

                                        </div>
                                        <div class="col-lg-3 detail-content detail-start-date">
                                            <p><?php echo e($taskDetails["datePlanStart"]); ?></p>
                                            <input type="text" class="form-control date-picker" <?php if($taskDetails["datePlanStart"] != ""): ?> style="display: none" <?php endif; ?>
                                                   name="datePlanStart" id="datePlanStartEdit" autocomplete="off" value="<?php echo e($taskDetails["datePlanStart"]); ?>" >
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            <?php echo e(__('task.endDate')); ?>

                                        </div>
                                        <div class="col-lg-3 detail-content detail-end-date">
                                            <p><?php echo e($taskDetails["datePlanEnd"]); ?></p>
                                            <input type="text" class="form-control date-picker" <?php if($taskDetails["datePlanEnd"] != ""): ?>) style="display: none" <?php endif; ?> name="datePlanEnd" id="datePlanEndEdit" autocomplete="off" value="<?php echo e($taskDetails["datePlanEnd"]); ?>" >
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-lg-3 detail-label">
                                            <?php echo e(__('task.actualStartDate')); ?>

                                        </div>
                                        <div class="col-lg-3 detail-content detail-actual-start-date">
                                            <p><?php echo e($taskDetails["dateActualStart"]); ?></p>
                                        </div>
                                        <div class="col-lg-3 detail-label">
                                            <?php echo e(__('task.actualEndDate')); ?>

                                        </div>
                                        <div class="col-lg-3 detail-content  detail-actual-end-date">
                                            <p><?php echo e($taskDetails["dateActualEnd"]); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-information-description">
                                    <h5><?php echo e(__('task.description')); ?></h5>
                                    <p style="white-space: pre-line;"><?php echo e($taskDetails["description"]); ?></p>
                                    <textarea class="form-control" id="edit_description" <?php if($taskDetails["description"] != ""): ?> style="display: none;" <?php endif; ?> rows="5" name="info_description"><?php echo e($taskDetails["description"]); ?></textarea>
                                </div>
                                <div class="detail-information-addExpense">

                                    <h5><?php echo e(__('task.addSubTask')); ?></h5>
                                    <div class="row task-extand-add  m-2">
                                        <div class="col-lg-5">
                                            <input type="text" class="form-control" id="quick-subtask-title" placeholder="<?php echo e(__('task.addSubTask')); ?>">
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" id="quick-add-person" name="personID">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $rolePersonList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($personItem['id']); ?>" <?php if($personItem['id'] == $personalID) print_r("selected=selected");?>><?php echo e($personItem['nameFamily'] . " " . $personItem['nameFirst']); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="button" class="btn btn-outline-brand btn-elevate btn-pill quick-add-task" >
                                                <?php echo e(__('task.add')); ?>

                                            </button>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="detail-information-task-memos">
                                    <h5><?php echo e(__('task.memos')); ?></h5>
                                    <?php $__currentLoopData = $memos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $memoitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <div class="col-lg-6 detail-content">
                                                <?php echo e($memoitem["timestamp"]); ?>

                                            </div>
                                            <div class="col-lg-6 detail-label">
                                                <?php echo e($memoitem["fullName"]); ?>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 detail-content" style="word-wrap: break-word;">
                                                <?php echo e($memoitem["Message"]); ?>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row">
                                        <input type="text"  class="form-control" id="detail-information-task-memos_input" name="memo">
                                    </div>
                                </div>
                                <div class="detail-information-task-attachments">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5><?php echo e(__('task.attachments')); ?></h5><br>
                                        </div>
                                    </div>
                                    <?php $__currentLoopData = $attachs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attchItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row attach_file" style="margin-top: 10px" data-tmpfilename="<?php echo e($attchItem['tmpFileName']); ?>">
                                            <div class="col-lg-2">
                                                <div class="kt-widget4__pic kt-widget4__pic--icon">
                                                    <?php
                                                        $images = ['jpg','jpeg','png','bmp','svg','gif'];
                                                        $docs = ['doc','docx'];
                                                        $csv = ['csv'];
                                                        $zip = ['zip','rar'];
                                                        $pdf = ['pdf'];
                                                        $file = ['csv','doc','gif','html','jpg','mid','mp3','pdf','png','rar','rtf','txt',
                                                            'wav','xls','xml','zip'];
                                                        $extension = strtolower($attchItem['extension']);

                                                        $attachIcon = asset('public/assets/media/files/file.png');
                                                        if (in_array($extension,$file)) {
                                                            $attachIcon = asset('public/assets/media/files/'.$extension.'.png');
                                                        }
                                                    ?>
                                                    <img src="<?php echo e($attachIcon); ?>" width="60%" alt="">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="row">
                                                    <div class="col-lg-12 detail-label">
                                                        <h5 style="cursor: pointer;">
                                                            <span>
                                                                <?php echo e($attchItem['fileName']); ?>

                                                            </span>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5 detail-label">
                                                        Attached:
                                                    </div>
                                                    <div class="col-lg-7 detail-content">
                                                        <?php echo e($attchItem['timestamp']); ?>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5 detail-label">
                                                        Attached by:
                                                    </div>
                                                    <div class="col-lg-7 detail-content">
                                                        <?php echo e($attchItem['fullName']); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row" style="margin-top:30px;">
                                        <div class="col-lg-1">
                                        </div>
                                        <div class="custom-file col-lg-10">
                                            <input type="file" class="custom-file-input" id="customFile" name="fileName">
                                            <input type="hidden" name="fileInfo">
                                            <label class="custom-file-label" for="customFile"><?php echo e(__('task.chooseFile')); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-information-task-memos" id="detail-information-task-memos">
                                    <h5><?php echo e(__('task.history')); ?></h5><br>
                                    <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $historyItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <div class="col-lg-4 detail-content">
                                                <?php echo e($historyItem['eventDate']); ?>

                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                <?php echo e($historyItem['fullName']); ?>

                                            </div>
                                            <div class="col-lg-5 detail-content">
                                                <?php echo e($historyItem['event']); ?>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="edit_panel_tab_time">
                            <div class="detail-infomation-content">
                                <div class="row detail-information-title">
                                    <?php for($i=count($pathArr)-1; $i>=0; $i--): ?>
                                        <a href="<?php echo e(url('/task/taskCard?task_id=')); ?><?php echo e($pathArr[$i]['ID']); ?>">
                                            <h5>
                                                <?php echo e($pathArr[$i]["title"]); ?>

                                            </h5>
                                        </a>
                                        <?php if($i != 0): ?>
                                            <h5>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</h5>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <div class="row detail-budget-dashboard">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <?php echo e(__('task.timeAllocated')); ?>

                                            </div>
                                            <div class="col-lg-6" id="timeAllocated" style="text-align: right">
                                                <?php echo e($timeAllocated); ?>d
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <?php echo e(__('task.timeSpent')); ?>

                                            </div>
                                            <div class="col-lg-6" id="totalTime" style="text-align: right">
                                                <?php echo e($totalTime); ?> h
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <?php echo e(__('task.timeSpentOnSubTask')); ?>

                                            </div>
                                            <div class="col-lg-6" id="timeSpentOnSubTask" style="text-align: right">
                                                <?php echo e($timeSpentOnSubTask); ?>h
                                            </div>
                                        </div>
                                        <div class="row balance">
                                            <div class="col-lg-6">
                                                <?php echo e(__('task.timeLeft')); ?>

                                            </div>
                                            <div class="col-lg-6" id="timeLeft" style="text-align: right">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="kt-portlet__body">
                                            <div id="timePieChart" style="height: 150px; width:150px"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                    
                                
                                 
                                    
                                        
                                    
                                    
                                        
                                            
                                        
                                        
                                            
                                        
                                    
                                  
                                <div class="row mt-4 mb-4 pt-5 pb-4" style="border-top: solid 1px #000;">
                                    <div class="col-lg-6 text-left" style="font-size: 30px;">Work Hours</div>
                                    <div class="col-lg-6 text-right" style="font-size: 30px;" id="workHours"></div>
                                </div>
                                <?php $__currentLoopData = $workTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                    <div class="col-lg-3 text-left">
                                        <?php echo e($time['workDate']); ?>

                                    </div>
                                    <div class="col-lg-3 text-left">
                                        <?php echo e($time['personName']); ?>

                                    </div>
                                    <div class="col-lg-3 text-left">
                                        <?php echo e($time['description']); ?>

                                    </div>
                                    <div class="col-lg-3 text-right">
                                        <?php echo e(floor($time['timeSpent']/8)); ?>d &nbsp; <?php echo e(round($time['timeSpent']-floor($time['timeSpent']/8) * 8,1)); ?>h
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <input name="workDescription" id="workDescription" class="form-control" placeholder="Work Description">
                                    </div>
                                    <div class="col-lg-3" style="display: flex">
                                        <input name="workHour" id="workHour" class="form-control" value="0" min="0" type="number"> &nbsp; <span class="mt-auto mb-auto" style="font-size: 16px">h</span>
                                    </div>
                                    <div class="col-lg-3"  style="display: flex">
                                        <input name="workMin" id="workMin" class="form-control" value="0" max="59" min="0" type="number">&nbsp;<span class="mt-auto mb-auto" style="font-size: 16px">m</span>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4 ml-auto">
                                        <button type="button" class="btn btn-outline-brand btn-elevate btn-pill" id="addWorkHour">
                                            Add Work Hours
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-4 pt-5 pb-4" style="border-top: solid 1px #000;">
                                    <div class="col-lg-6 text-left" style="font-size: 30px;">Allocated time</div>
                                    <div class="col-lg-6 text-right" style="font-size: 30px;" id="allocatedTime"></div>
                                </div>
                                <?php $__currentLoopData = $allocatedTimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allocatedTime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row">
                                        <div class="col-lg-3 text-left">
                                            <?php echo e($allocatedTime['allocateDate']); ?>

                                        </div>
                                        <div class="col-lg-3 text-left">
                                            <?php echo e($allocatedTime['personName']); ?>

                                        </div>
                                        <div class="col-lg-3 text-left">
                                            <?php echo e($allocatedTime['description']); ?>

                                        </div>
                                        <div class="col-lg-3 text-right">
                                            <?php echo e(floor($allocatedTime['timeAllocated']/8)); ?>d &nbsp; <?php echo e(round($allocatedTime['timeAllocated']-floor($allocatedTime['timeAllocated']/8) * 8 , 1)); ?>h
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <input name="allocationDescription"  id="allocationDescription" class="form-control" placeholder="Time Allocation Description">
                                    </div>
                                    <div class="col-lg-3" style="display: flex">
                                        <input name="allocationHour" id="allocationHour" class="form-control" value="0" type="number"> &nbsp; <span class="mt-auto mb-auto" style="font-size: 16px">h</span>
                                    </div>
                                    <div class="col-lg-3"  style="display: flex">
                                        <input name="allocationMin" id="allocationMin" class="form-control" value="0" max="59" type="number">&nbsp;<span class="mt-auto mb-auto" style="font-size: 16px">m</span>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4 ml-auto">
                                        <button type="button" class="btn btn-outline-brand btn-elevate btn-pill" id="addAllocationTime">
                                            Add Work Hours
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="edit_panel_tab_budget">
                            <div class="detail-budget-content">
                                <div class="row detail-budget-task-name">
                                    <p><?php echo e($taskDetails["title"]); ?></p>
                                </div>
                                <div class="row detail-budget-dashboard">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <?php echo e(__('task.budget')); ?>

                                            </div>
                                            <div class="col-lg-6" style="text-align: right">
                                                <?php echo e(number_format($budgetTotalSum, 2, ',', '.')); ?>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <?php echo e(__('task.expense')); ?>

                                            </div>
                                            <div class="col-lg-6" style="text-align: right">
                                                <?php echo e(number_format($expenseTotalSum, 2, ',', '.')); ?>

                                            </div>
                                        </div>
                                        <div class="row balance">
                                            <div class="col-lg-6">
                                                <?php echo e(__('task.balance')); ?>

                                            </div>
                                            <div class="col-lg-6" style="text-align: right">
                                                <?php echo e(number_format($budgetTotalSum - $expenseTotalSum, 2, ',', '.')); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                </div>
                                <div class="detail-income-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5><?php echo e(__('task.budget')); ?></h5>
                                        </div>
                                        <div class="col-lg-6" style="text-align: right">
                                            <h3><?php echo e(number_format($budgetSum, 2, ',', '.')); ?></h3>
                                        </div>
                                    </div>
                                    <?php $__currentLoopData = $budget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budgetItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-lg-3 detail-content">
                                                <?php echo e($budgetItem["timestamp"]); ?>

                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                <?php echo e($budgetItem["fullName"]); ?>

                                            </div>
                                            <div class="col-lg-3 detail-content" style="display: block; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden;">
                                                <?php echo e($budgetItem["description"]); ?>

                                            </div>
                                            <div class="col-lg-3 detail-content" style="text-align: right;">
                                                <?php echo e(number_format($budgetItem["income"], 2, ',', '.')); ?>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-lg-7">
                                            <input type="text"  class="form-control" id="income_description" name="description" placeholder=" <?php echo e(__('task.incomeDescription')); ?>">
                                        </div>
                                        <div class="col-lg-5">
                                            <input type="text"  class="form-control" id="income" name="income" placeholder="0,00">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-lg-3">
                                        </div>
                                        <div class="col-lg-9" style="text-align: right;">
                                            <button type="button" class="btn btn-outline-brand btn-elevate btn-pill" id="budgetAdd">
                                                <i class="flaticon-add"></i>
                                                <?php echo e(__('task.addBudget')); ?>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-expense-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5><?php echo e(__('task.expense')); ?></h5>
                                        </div>
                                        <div class="col-lg-6" style="text-align: right">
                                            <h3><?php echo e(number_format($expenseSum, 2, ',', '.')); ?></h3>
                                        </div>
                                    </div>
                                    <?php $__currentLoopData = $expense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expenseItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-lg-3 detail-content">
                                                <?php echo e($expenseItem["timestamp"]); ?>

                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                <?php echo e($expenseItem["fullName"]); ?>

                                            </div>
                                            <div class="col-lg-3 detail-content" style="display: block; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden;">
                                                <?php echo e($expenseItem["description"]); ?>

                                            </div>
                                            <div class="col-lg-3 detail-content" style="text-align: right;">
                                                <?php echo e(number_format($expenseItem["expense"], 2, ',', '.')); ?>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-lg-7">
                                            <input type="text"  class="form-control" id="expense_description" name="description" placeholder=" <?php echo e(__('task.expenseDescription')); ?>">
                                        </div>
                                        <div class="col-lg-5">
                                            <input type="text"  class="form-control" id="expense" name="expense" placeholder="0,00">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-lg-3">
                                        </div>
                                        <div class="col-lg-9" style="text-align: right;">
                                            <button type="button" class="btn btn-outline-brand btn-elevate btn-pill" id="expensetAdd">
                                                <i class="flaticon-add"></i>
                                                <?php echo e(__('task.addExpense')); ?>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="edit_panel_tab_statistics">
                            <div class="detail-statistics-content">
                                <div class="row detail-statistics-task-name">
                                    <p><?php echo e($taskDetails["title"]); ?></p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                <?php echo e(__('task.startDate')); ?>

                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                <?php echo e($taskDetails['datePlanStart']); ?>

                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                <?php echo e(__('task.endDate')); ?>

                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                <?php echo e($taskDetails['datePlanEnd']); ?>

                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                <?php echo e(__('task.timeLeft')); ?>

                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                <?php echo e($statisticsData['timeLeft']); ?>

                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                <?php echo e(__('task.timeLeft')); ?>%
                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                <?php echo e($statisticsData['timeLeftPercent']); ?> %
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-lg-6">
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                <?php echo e(__('task.progress')); ?>

                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                <?php echo e($taskDetails['finishProgress']); ?>%
                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-8 statistics-label">
                                                <?php echo e(__('task.progressLeft')); ?>

                                            </div>
                                            <div class="col-lg-4 statistics-content" style="text-align: right">
                                                <?php echo e(100 - $taskDetails['finishProgress']); ?>%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="row statistics-row" style="text-align: right;">
                                            <?php echo e(__('task.progress')); ?>

                                        </div>
                                        <div class="row statistics-row progress" style="height: 14px;">
                                            <?php if($taskDetails['spentProgress'] <= $taskDetails['finishProgress']): ?>
                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($taskDetails['finishProgress']); ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            <?php else: ?>
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo e($taskDetails['finishProgress']); ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-dark" role="progressbar" style="width: <?php echo e($taskDetails['spentProgress'] - $taskDetails['finishProgress']); ?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-lg-6">
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                <?php echo e(__('task.subTasks')); ?>

                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                <?php echo e($statisticsData['totalCount']); ?>

                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                <?php echo e(__('task.subTasksFinished')); ?>

                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                <?php echo e($statisticsData['finishCount']); ?>

                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                <?php echo e(__('task.subTasksLeft')); ?>

                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                <?php echo e($statisticsData['leftCount']); ?>

                                            </div>
                                        </div>
                                        <div class="row statistics-row">
                                            <div class="col-lg-6 statistics-label">
                                                <?php echo e(__('task.subTasksFinished')); ?>

                                            </div>
                                            <div class="col-lg-6 statistics-content" style="text-align: right">
                                                <?php echo e($statisticsData['subFinishPercent']); ?>%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="row statistics-row" style="text-align: right;">
                                            <?php echo e(__('task.subTasksFinished')); ?>

                                        </div>
                                        <div class="row statistics-row progress" style="height: 14px;">
                                            <div class="progress-bar bg-dark" role="progressbar" style="width: <?php echo e($statisticsData['subFinishPercent']); ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-taskid="<?php echo e($taskId); ?>" data-parentid="<?php echo e($taskDetails["parentID"]); ?>" id="taskDetailDelete"> <?php echo e(__('task.delete')); ?></button>
                <button type="button" class="btn btn-primary disabled" id="taskDetailUpdate"> <?php echo e(__('task.update')); ?></button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/task/taskDetailEdit.blade.php ENDPATH**/ ?>