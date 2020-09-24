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
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" name="parentID" id="add_parentID" value="">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_information" role="tab"><?php echo e(__('task.information')); ?></a>
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
                                        <input type="text" class="form-control" placeholder="<?php echo e(__('task.title')); ?>" name="title">
                                    </div>
                                    <div class="row detail-information-staus">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-3" style="margin: auto 0px auto 0px;">
                                                     <?php if (isset($component)) { $__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserAvatar::class, ['type' => $userDetails['avatarType'],'nameTag' => $userDetails['nameTag'],'roleID' => $userDetails['roleID'],'color' => $userDetails['avatarColor']]); ?>
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
                                                    <div class="detail-information-staus-content">
                                                        <select class="form-control" id="detail-add-person" name="personID">
                                                            <option value=""></option>
                                                            <?php $__currentLoopData = $rolePersonList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($personItem['id']); ?>" <?php if($personItem['id'] == $personalID) print_r("selected=selected");?>>
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
                                                        <select class="form-control kt-selectpicker"  id="detail-information-staus" name="statusID">
                                                            <?php $__currentLoopData = $TaskStatusList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskStatusItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option data-content="<?php echo e($taskStatusItem['note']); ?>" value="<?php echo e($taskStatusItem['ID']); ?>" selected><?php echo e($taskStatusItem['title']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="detail-information-staus-title">
                                                        <?php echo e(__('task.priority')); ?>

                                                    </div>
                                                    <div class="detail-information-staus-content">
                                                        <div class="detail-information-staus-content">
                                                            <select class="form-control kt-selectpicker"  id="detail-information-priority" name="priorityID">
                                                                <?php $__currentLoopData = $TaskPriorityList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskPriorityItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($taskPriorityItem['ID']); ?>" <?php if($taskPriorityItem['ID'] == "2"): ?> selected="selected" <?php endif; ?>><?php echo e($taskPriorityItem['title']); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="detail-information-staus-title">
                                                        <?php echo e(__('task.weight')); ?>

                                                    </div>
                                                    <div class="detail-information-staus-content">
                                                        <select class="form-control kt-selectpicker" id="detail-information-priority" name="weightID">
                                                            <?php $__currentLoopData = $TaskWeightList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskWeightItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($taskWeightItem['ID']); ?>"><?php echo e($taskWeightItem['title']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row detail-information-tags">
                                        <div class="row col-lg-12">
                                            <div class="col-lg-2" style="margin: auto 0px auto 0px;">
                                                <?php echo e(__('task.tags')); ?>

                                            </div>
                                            <div class="col-lg-10">
                                                <div class="detail-information-staus-content">
                                                    <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="tags">
                                                        <?php $__currentLoopData = $tagList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tagItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option data-content='<span class="<?php if($tagItem['tagtype']==1): ?> system-span <?php elseif($tagItem['tagtype']==2): ?> organization-span <?php elseif($tagItem['tagtype']==3): ?> personal-span <?php endif; ?>" style="color:<?php echo e($tagItem['color']); ?>">
                                                                       <?php echo e($taskTag['tagtype']==1?__('tag.'.$taskTag['name']):$taskTag['name']); ?>

                                                                    </span>' value="<?php echo e($tagItem['ID']); ?>">
                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="detail-information-task-date">
                                        <div class="row">
                                            <div class="col-lg-3 detail-label">
                                                <?php echo e(__('task.startDate')); ?>

                                            </div>
                                            <div class="col-lg-3 detail-content">
                                                <input type="text" class="form-control date-picker" name="datePlanStart" id="datePlanStartAdd" autocomplete="off"/>
                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                <?php echo e(__('task.endDate')); ?>

                                            </div>
                                            <div class="col-lg-3 detail-content">
                                                <input type="text" class="form-control date-picker" name="datePlanEnd"  id="datePlanEndAdd" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 15px">
                                            <div class="col-lg-3 detail-label">
                                                <?php echo e(__('task.actualStartDate')); ?>

                                            </div>
                                            <div class="col-lg-3 detail-content">
                                                <input type="text" class="form-control date-picker" name="dateActualStart" id="dateActualStartAdd" autocomplete="off"/>
                                            </div>
                                            <div class="col-lg-3 detail-label">
                                                <?php echo e(__('task.actualEndDate')); ?>

                                            </div>
                                            <div class="col-lg-3 detail-content disable">
                                                <input type="text" class="form-control date-picker" name="dateActualEnd" id="dateActualEndAdd" autocomplete="off"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row detail-information-description">
                                        <h5><?php echo e(__('task.description')); ?></h5><br>
                                        <textarea class="form-control" id="exampleTextarea" rows="5" name="description"></textarea>
                                    </div>
                                    <div class="detail-information-task-memos">
                                        <h5><?php echo e(__('task.memos')); ?></h5><br>
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
                <button type="submit" class="btn btn-primary" id="taskDetailSave"><?php echo e(__('task.save')); ?></button>
            </div>
        </form>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/task/taskDetailAdd.blade.php ENDPATH**/ ?>