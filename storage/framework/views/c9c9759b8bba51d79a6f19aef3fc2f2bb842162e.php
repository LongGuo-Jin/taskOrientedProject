
<?php $__env->startSection('title'); ?>
    Dashboard | TOP
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/task/taskcard.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php
    $notifications = explode(',',$memoNotification);
    ?>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- end:: Header -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
            <!-- begin:: Content -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                <div class="row">
                    <?php $__currentLoopData = $taskList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $taskListItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" data-toggle="tab" data-type="col-task-simple" href="#kt_simple_tab_<?php echo e($index); ?>">
                                                        <i class="fa fa-align-justify"></i><?php echo e(__('task.sample')); ?>

                                                    </a>
                                                    <a class="dropdown-item" data-toggle="tab" data-type="col-task-regular" href="#kt_regular_tab_<?php echo e($index); ?>">
                                                        <i class="flaticon-laptop"></i><?php echo e(__('task.regular')); ?>

                                                    </a>
                                                    <a class="dropdown-item" data-toggle="tab" data-type="col-task-extended" href="#kt_extended_tab_<?php echo e($index); ?>">
                                                        <i class="flaticon-background"></i><?php echo e(__('task.extended')); ?>

                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="kt-portlet__head-actions">
                                        <?php if($index == 'new'): ?>
                                            <h5><?php echo e(__('dashboard.newTasks')); ?></h5>
                                        <?php elseif($index=='overdue'): ?>
                                            <h5><?php echo e(__('dashboard.overdueTasks')); ?></h5>
                                        <?php elseif($index=='active'): ?>
                                            <h5><?php echo e(__('dashboard.activeTasks')); ?></h5>
                                        <?php elseif($index=='unread'): ?>
                                            <h5><?php echo e(__('dashboard.unreadMessages')); ?></h5>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="kt-portlet__body active">
                                    <div class="kt-scroll " data-scroll="true"  >
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="kt_regular_tab_<?php echo e($index); ?>">
                                                <?php $__currentLoopData = $taskListItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="column-body">
                                                        <?php if(isset($columnItem["ID"])): ?>
                                                            <?php $tagTask =new \App\TagTask();
                                                            $taskTags =  $tagTask->getTaskTagList($columnItem['ID']);
                                                            $color = '#9d88bf';

                                                            foreach($taskTags as $taskTag) {
                                                                if ($taskTag["tagtype"] != 1 ) {
                                                                    continue;
                                                                }

                                                                if($taskTag['name'] == "PROJECT") {
                                                                    $color = '#302344';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "MILESTONE") {
                                                                    $color = '#98b6ea';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "TO DO") {
                                                                    $color = '#f7dd6d';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "PERMANENT") {
                                                                    $color = '#4fc6a2';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "PERIODIC") {
                                                                    $color = '#88e588';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "TRIP") {
                                                                    $color = '#a5a3aa';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "ERROR") {
                                                                    $color = '#ef6f6f';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "ALARM") {
                                                                    $color = '#f4c67d';
                                                                    break;
                                                                }
                                                            }
                                                            ?>
                                                            <div class="kt-regular-task-item thin"
                                                                         data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular" style="display: flex">
                                                                        <div class="task-status" style="background-color: <?php echo e($color); ?>; display: flex; flex-direction: column; width: 10%; justify-content: space-between; padding-top:10px">
                                                                            <div style="display: flex; flex-direction: column">
                                                                                <div><?php echo($columnItem['status_icon'])?></div>
                                                                                <div><?php echo e($columnItem['priority_title']); ?></div>
                                                                                <div><?php echo e($columnItem['weight']); ?></div>
                                                                            </div>
                                                                            <div style="position: relative; margin: 0; padding: 0">
                                                                                <?php if(in_array($columnItem['ID'],$notifications)): ?>
                                                                                    <i class="fa fa-envelope "></i>
                                                                                    <div class="blink_mark blink_mail_icon" id="blink_mail_icon_<?php echo e($columnItem['ID']); ?>">
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    <div style="width: 90%; padding: 10px; <?php if ($columnItem['overdue']) echo "background: #fff2f2";?>">
                                                                    <div class="row">
                                                                        <div class="col-lg-9 task-name">
                                                                            <?php echo e($columnItem['title']); ?>

                                                                        </div>
                                                                        <div class="col-lg-3 person-tag">
                                                                             <?php if (isset($component)) { $__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserAvatar::class, ['type' => $columnItem['avatarType'],'nameTag' => $columnItem['nameTag'],'roleID' => $columnItem['roleID'],'color' => $columnItem['avatarColor']]); ?>
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
                                                                    <div class="row mt-2">
                                                                        <div class="col-lg-12" style="display: flex; flex-wrap: wrap;"><?php

                                                                            foreach($taskTags as $taskTag) {
                                                                            ?>
                                                                            <span class="<?php if($taskTag['tagtype']==1): ?> system-span <?php elseif($taskTag['tagtype']==2): ?> organization-span <?php elseif($taskTag['tagtype']==3): ?> personal-span <?php endif; ?>" style="color:<?php echo e($taskTag['color']); ?>">
                                                                               <?php echo e($taskTag['name']); ?>

                                                                            </span> &nbsp;
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="kt-space-10"></div>
                                                                    <div class="progress" style="height: 6px;">
                                                                        <?php if($columnItem["statusID"] == 4): ?>
                                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        <?php elseif($columnItem['spentProgress'] <= $columnItem['finishProgress']): ?>
                                                                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($columnItem['finishProgress']); ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        <?php else: ?>
                                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo e($columnItem['finishProgress']); ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            <div class="progress-bar bg-dark" role="progressbar" style="width: <?php echo e($columnItem['spentProgress'] - $columnItem['finishProgress']); ?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="kt-space-5"></div>
                                                                    <div class="row kt-item-date">
                                                                        <div class="col-lg-6 task-start-date">
                                                                            <?php echo e($columnItem['datePlanStart']); ?>

                                                                        </div>
                                                                        <div class="col-lg-6 task-end-date">
                                                                            <?php echo e($columnItem['datePlanEnd']); ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="tab-pane" id="kt_extended_tab_<?php echo e($index); ?>">
                                                <?php $__currentLoopData = $taskListItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="column-body">
                                                        <?php if(isset($columnItem["ID"])): ?>
                                                            <?php $tagTask =new \App\TagTask();
                                                            $taskTags =  $tagTask->getTaskTagList($columnItem['ID']);
                                                            $color = '#9d88bf';

                                                            foreach($taskTags as $taskTag) {
                                                                if ($taskTag["tagtype"] != 1 ) {
                                                                    continue;
                                                                }

                                                                if($taskTag['name'] == "PROJECT") {
                                                                    $color = '#302344';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "MILESTONE") {
                                                                    $color = '#98b6ea';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "TO DO") {
                                                                    $color = '#f7dd6d';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "PERMANENT") {
                                                                    $color = '#4fc6a2';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "PERIODIC") {
                                                                    $color = '#88e588';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "TRIP") {
                                                                    $color = '#a5a3aa';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "ERROR") {
                                                                    $color = '#ef6f6f';
                                                                    break;
                                                                }
                                                                if($taskTag['name'] == "ALARM") {
                                                                    $color = '#f4c67d';
                                                                    break;
                                                                }
                                                            }
                                                            ?>
                                                            <div class="kt-extended-task-item"
                                                                 data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular" style="display: flex">
                                                                <div class="task-status" style="background-color: <?php echo e($color); ?>; display: flex; flex-direction: column; width: 10%; justify-content: space-between; padding-top:10px">
                                                                    <div style="display: flex; flex-direction: column">
                                                                        <div><?php echo($columnItem['status_icon'])?></div>
                                                                        <div><?php echo e($columnItem['priority_title']); ?></div>
                                                                        <div><?php echo e($columnItem['weight']); ?></div>
                                                                    </div>
                                                                    <div style="position: relative; margin: 0; padding: 0">
                                                                        <?php if(in_array($columnItem['ID'],$notifications)): ?>
                                                                            <i class="fa fa-envelope "></i>
                                                                            <div class="blink_mark blink_mail_icon" id="blink_mail_icon_<?php echo e($columnItem['ID']); ?>">
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="extand-main-content" style="width: 90%; <?php if ($columnItem['overdue']) echo "background: #fff2f2";?>">
                                                                    <div class="kt-extend-part">
                                                                        <div class="row">
                                                                            <div class="col-lg-9 task-name ">
                                                                                <div class="kt-font-task-warning">
                                                                                    <?php echo e($columnItem['title']); ?>

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3 person-tag">
                                                                                 <?php if (isset($component)) { $__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserAvatar::class, ['type' => $columnItem['avatarType'],'nameTag' => $columnItem['nameTag'],'roleID' => $columnItem['roleID'],'color' => $columnItem['avatarColor']]); ?>
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
                                                                        <div class="kt-space-10"></div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12" style="display:flex;flex-wrap: wrap;"><?php
                                                                                foreach($taskTags as $taskTag) {
                                                                                ?>
                                                                                <span class="<?php if($taskTag['tagtype']==1): ?> system-span <?php elseif($taskTag['tagtype']==2): ?> organization-span <?php elseif($taskTag['tagtype']==3): ?> personal-span <?php endif; ?>" style="color:<?php echo e($taskTag['color']); ?>">
                                                                                   <?php echo e($taskTag['name']); ?>

                                                                                </span> &nbsp;
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-space-10"></div>
                                                                        <div class="progress" style="height: 6px;">
                                                                            <?php if($columnItem["statusID"] == 4): ?>
                                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            <?php elseif($columnItem['spentProgress'] <= $columnItem['finishProgress']): ?>
                                                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($columnItem['finishProgress']); ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            <?php else: ?>
                                                                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo e($columnItem['finishProgress']); ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                <div class="progress-bar bg-dark" role="progressbar" style="width: <?php echo e($columnItem['spentProgress'] - $columnItem['finishProgress']); ?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="kt-space-5"></div>
                                                                        <div class="row kt-item-date">
                                                                            <div class="col-lg-6 task-start-date">
                                                                                <?php echo e($columnItem['datePlanStart']); ?>

                                                                            </div>
                                                                            <div class="col-lg-6 task-end-date">
                                                                                <p style="float: right"><?php echo e($columnItem['datePlanEnd']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="extand-below-content">
                                                                        <i class="fa fa-user"></i> &nbsp;&nbsp;&nbsp;<?php echo e($columnItem['fullName']); ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="tab-pane" id="kt_simple_tab_<?php echo e($index); ?>">
                                                <?php $__currentLoopData = $taskListItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="column-body">
                                                        <?php if(isset($columnItem["ID"])): ?>
                                                                <?php $tagTask =new \App\TagTask();
                                                                $taskTags =  $tagTask->getTaskTagList($columnItem['ID']);
                                                                $color = '#9d88bf';

                                                                foreach($taskTags as $taskTag) {
                                                                    if ($taskTag["tagtype"] != 1 ) {
                                                                        continue;
                                                                    }

                                                                    if($taskTag['name'] == "PROJECT") {
                                                                        $color = '#302344';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "MILESTONE") {
                                                                        $color = '#98b6ea';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "TO DO") {
                                                                        $color = '#f7dd6d';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "PERMANENT") {
                                                                        $color = '#4fc6a2';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "PERIODIC") {
                                                                        $color = '#88e588';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "TRIP") {
                                                                        $color = '#a5a3aa';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "ERROR") {
                                                                        $color = '#ef6f6f';
                                                                        break;
                                                                    }
                                                                    if($taskTag['name'] == "ALARM") {
                                                                        $color = '#f4c67d';
                                                                        break;
                                                                    }
                                                                }
                                                                ?>
                                                            <div class="kt-simple-task-item thin"
                                                                 data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="simple" style="display: flex">
                                                                <div class="task-status" style="background-color: <?php echo e($color); ?>; display: flex; flex-direction: column; width: 10%; justify-content: space-between; padding-top:10px">
                                                                    <div style="display: flex; flex-direction: column">
                                                                        <div><?php echo($columnItem['status_icon'])?></div>
                                                                    </div>
                                                                    <div style="position: relative; margin: 0; padding: 0">
                                                                    </div>
                                                                </div>
                                                                <div style="width: 90%; padding: 10px; <?php if ($columnItem['overdue']) echo "background: #fff2f2";?>">
                                                                    <div class="row">
                                                                        <div class="col-lg-9 final-sub-task-name">
                                                                            <?php echo e($columnItem['title']); ?>

                                                                        </div>
                                                                        <div class="col-lg-3 final-sub-task-name person-tag">
                                                                             <?php if (isset($component)) { $__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserAvatar::class, ['type' => $columnItem['avatarType'],'nameTag' => $columnItem['nameTag'],'roleID' => $columnItem['roleID'],'color' => $columnItem['avatarColor']]); ?>
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
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Portlet-->
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!-- end:: Content -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/components/extended/blockui.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/components/extended/sweetalert2.js')); ?>" type="text/javascript"></script>

    <script type="text/javascript">
        var base_url = "<?php echo e(URL::to('')); ?>";
        
        
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/dashboard.blade.php ENDPATH**/ ?>