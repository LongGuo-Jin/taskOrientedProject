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
                                            <?php echo e($pathArr[$i]["title"]); ?>

                                        </a>
                                        <?php if($i != 1): ?>
                                            &nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp
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
                                                 <?php if (isset($component)) { $__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserAvatar::class, ['type' => $taskDetails['avatarType'],'nameTag' => $taskDetails['nameTag'],'roleID' => $taskDetails['roleID'],'color' => $taskDetails['avatarColor']]); ?>
<?php $component->withName('user-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da)): ?>
<?php $component = $__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da; ?>
<?php unset($__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
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
                                    <div class="col-lg-2 pt-2">
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
                                    <h5 class="subtitle_text"><?php echo e(__('task.description')); ?></h5>
                                    <p style="white-space: pre-line;"><?php echo e($taskDetails["description"]); ?></p>
                                    <textarea class="form-control" id="edit_description" <?php if($taskDetails["description"] != ""): ?> style="display: none;" <?php endif; ?> rows="5" name="info_description"><?php echo e($taskDetails["description"]); ?></textarea>
                                </div>
                                <div class="detail-information-task-memos">
                                    <h5  class="subtitle_text"><?php echo e(__('task.memos')); ?></h5>
                                    <?php $__currentLoopData = $memos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $memoitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($memoitem['personID'] == auth()->user()->id): ?>
                                            <div class="row " style="display: flex; padding-left: 5px;text-align: right">
                                                <div class="detail-label" style="word-break: break-word;white-space: normal;flex-wrap: wrap;width: 50%;padding: 3px">
                                                    <?php echo e($memoitem["Message"]); ?>

                                                </div>
                                                <div class="detail-label" style="display: flex; flex-direction: column;width: 37%; padding: 3px">
                                                    <div><?php echo e($memoitem["timestamp"]); ?></div>
                                                    <div class="subtitle_text"><?php echo e($memoitem["fullName"]); ?></div>
                                                </div>
                                                <div style="width: 13%;">
                                                     <?php if (isset($component)) { $__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserAvatar::class, ['type' => $memoitem['avatarType'],'nameTag' => $memoitem['nameTag'],'roleID' => $memoitem['roleID'],'color' => $memoitem['avatarColor']]); ?>
<?php $component->withName('user-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da)): ?>
<?php $component = $__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da; ?>
<?php unset($__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                                                </div>
                                            </div>

                                        <?php else: ?>
                                            <div class="row " style="display: flex;">
                                                <div style="width: 13%; padding-left: 5px">
                                                     <?php if (isset($component)) { $__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserAvatar::class, ['type' => $memoitem['avatarType'],'nameTag' => $memoitem['nameTag'],'roleID' => $memoitem['roleID'],'color' => $memoitem['avatarColor']]); ?>
<?php $component->withName('user-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da)): ?>
<?php $component = $__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da; ?>
<?php unset($__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                                                </div>
                                                <div class="detail-label" style="display: flex; flex-direction: column;width: 37%; padding: 3px">
                                                    <div><?php echo e($memoitem["timestamp"]); ?></div>
                                                    <div class="subtitle_text"><?php echo e($memoitem["fullName"]); ?></div>
                                                </div>
                                                <div class="detail-label" style="word-break: break-word;white-space: normal;flex-wrap: wrap;width: 50%;padding: 3px">
                                                    <?php echo e($memoitem["Message"]); ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row">
                                        <input type="text"  class="form-control" id="detail-information-task-memos_input" name="memo">
                                    </div>
                                </div>
                                <div class="detail-information-task-attachments">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5  class="subtitle_text"><?php echo e(__('task.attachments')); ?></h5><br>
                                        </div>
                                    </div>
                                    <?php $__currentLoopData = $attachs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attchItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row attach_file" style="margin-top: 10px; cursor: pointer" data-tmpfilename="<?php echo e($attchItem['tmpFileName']); ?>">
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
                                                    <img src="<?php echo e($attachIcon); ?>" width="80%" alt="">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="row">
                                                    <div class="col-lg-12 detail-label">
                                                        <span style="font-size: 8pt;"  class="subtitle_text">
                                                            <?php echo e($attchItem['fileName']); ?>

                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5 detail-label">
                                                        <span style="font-size: 7pt;">
                                                        Attached:
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-7 detail-content">
                                                        <span style="font-size: 7pt;">
                                                            <?php echo e($attchItem['timestamp']); ?>

                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5 detail-label">
                                                        <span style="font-size: 7pt;">
                                                            Attached by:
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-7 detail-content">
                                                        <span style="font-size: 7pt;">
                                                            <?php echo e($attchItem['fullName']); ?>

                                                        </span>
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
                                    <h5 class="subtitle_text"><?php echo e(__('task.history')); ?></h5><br>
                                    <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $historyItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($historyItem['personID'] != auth()->user()->id): ?>
                                            <div class="row">
                                                <div class="col-lg-4 detail-label">
                                                    <?php echo e($historyItem['eventDate']); ?>

                                                </div>
                                                <div class="col-lg-3 detail-label subtitle_text">
                                                    <?php echo e($historyItem['fullName']); ?>

                                                </div>
                                                <div class="col-lg-5 detail-label">
                                                    <?php echo e($historyItem['event']); ?>

                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="row text-right">
                                                <div class="col-lg-5 detail-label">
                                                    <?php echo e($historyItem['event']); ?>

                                                </div>
                                                <div class="col-lg-3 detail-label subtitle_text">
                                                    <?php echo e($historyItem['fullName']); ?>

                                                </div>
                                                <div class="col-lg-4 detail-label">
                                                    <?php echo e($historyItem['eventDate']); ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="edit_panel_tab_time">
                            <div class="detail-infomation-content">
                                <div class="row detail-budget-task-name">
                                    <p><?php echo e($taskDetails["title"]); ?></p>
                                </div>
                                <div class="row detail-budget-dashboard">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <?php echo e(__('task.timeAllocated')); ?>

                                            </div>
                                            <div class="col-lg-6" id="timeAllocated" style="text-align: right">
                                                <p><?php echo e($timeAllocated); ?>d</p>
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
                                
                                    
                                
                                 
                                    
                                        
                                    
                                    
                                        
                                            
                                        
                                        
                                            
                                        
                                    
                                  
                                <div class="row mt-4 mb-4 pt-5" style="border-top: solid 1px #000;">
                                    <div class="col-lg-6 text-left">
                                        <h5 class="subtitle_text">Work Hours</h5>
                                    </div>
                                    <div class="col-lg-6 text-right" style="font-size: 1.25rem; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.2;" id="workHours">
                                    </div>
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
                                <div class="row mt-4 mb-4 pt-5" style="border-top: solid 1px #000;">
                                    <div class="col-lg-6 text-left"><h5 class="subtitle_text">Allocated time</h5></div>
                                    <div class="col-lg-6 text-right" style="font-size: 1.25rem; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.2;"  id="allocatedTime"></div>
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
                                            <h5 class="subtitle_text"><?php echo e(__('task.budget')); ?></h5>
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
                                            <h5 class="subtitle_text"><?php echo e(__('task.expense')); ?></h5>
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