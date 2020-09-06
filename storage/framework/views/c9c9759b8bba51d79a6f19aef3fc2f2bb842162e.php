
<?php $__env->startSection('title'); ?>
    Dashboard
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

                                        </li>
                                    </ul>
                                </div>
                                <div class="kt-portlet__head-actions">
                                    <h5><?php echo e(__('dashboard.newTasks')); ?></h5>
                                </div>
                            </div>
                         <?php $__currentLoopData = $taskList['new']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnClass => $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="column-body" data-column_id="<?php echo e($columnClass); ?>">
                                    <?php if(isset($columnItem["ID"])): ?>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="kt_regular_tab_<?php echo e($columnClass); ?>">
                                                    <div class="kt-regular-task-item thin"
                                                         data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular" style="display: flex">
                                                        <div class="task-status pt-2" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%; justify-content: space-between">
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
                                                        <div style="width: 90%; padding: 10px">
                                                            <div class="row m-2">
                                                                  <div class="col-lg-9">
                                                                    <div class="row task-name">
                                                                        <?php echo e($columnItem['title']); ?>

                                                                    </div>
                                                                    <div class="row project-name">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
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
                                                </div>
                                            </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <!--end::Portlet-->
                        </div>
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

                                        </li>
                                    </ul>
                                </div>
                                <div class="kt-portlet__head-actions">
                                    <h5><?php echo e(__('dashboard.activeTasks')); ?></h5>
                                </div>
                            </div>
                            <?php $__currentLoopData = $taskList['active']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnClass => $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="column-body" data-column_id="<?php echo e($columnClass); ?>">
                                    <?php if(isset($columnItem["ID"])): ?>

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="kt_regular_tab_<?php echo e($columnClass); ?>">
                                                <div class="kt-regular-task-item thin"
                                                     data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular" style="display: flex">
                                                    <div class="task-status pt-2" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%; justify-content: space-between">
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
                                                    <div style="width: 90%; padding: 10px">
                                                        <div class="row m-2">
                                                            <div class="col-lg-9">
                                                                <div class="row task-name">
                                                                    <?php echo e($columnItem['title']); ?>

                                                                </div>
                                                                <div class="row project-name">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
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
                                            </div>

                                        </div>

                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!--end::Portlet-->
                    </div>
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
                                        </li>
                                    </ul>
                                </div>
                                <div class="kt-portlet__head-actions">
                                    <h5><?php echo e(__('dashboard.overdueTasks')); ?></h5>
                                </div>
                            </div>
                            <?php $__currentLoopData = $taskList['overdue']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnClass => $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="column-body" data-column_id="<?php echo e($columnClass); ?>">
                                    <?php if(isset($columnItem["ID"])): ?>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="kt_regular_tab_<?php echo e($columnClass); ?>">
                                                <div class="kt-regular-task-item thin"
                                                     data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular" style="display: flex">
                                                    <div class="task-status pt-2" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%; justify-content: space-between">
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
                                                    <div style="width: 90%; padding: 10px">
                                                        <div class="row m-2">
                                                            <div class="col-lg-9">
                                                                <div class="row task-name">
                                                                    <?php echo e($columnItem['title']); ?>

                                                                </div>
                                                                <div class="row project-name">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
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
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!--end::Portlet-->
                    </div>
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
                                        </li>
                                    </ul>
                                </div>
                                <div class="kt-portlet__head-actions">
                                    <h5><?php echo e(__('dashboard.unreadMessages')); ?></h5>
                                </div>
                            </div>
                            <?php $__currentLoopData = $taskList['unread']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnClass => $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="column-body" data-column_id="<?php echo e($columnClass); ?>">
                                    <?php if(isset($columnItem["ID"])): ?>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="kt_regular_tab_<?php echo e($columnClass); ?>">
                                                <div class="kt-regular-task-item thin"
                                                     data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular" style="display: flex">
                                                    <div class="task-status pt-2" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%; justify-content: space-between">
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
                                                    <div style="width: 90%; padding: 10px">
                                                        <div class="row m-2">
                                                            <div class="col-lg-9">
                                                                <div class="row task-name">
                                                                    <?php echo e($columnItem['title']); ?>

                                                                </div>
                                                                <div class="row project-name">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
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
<?php endif; ?>                                                             </div>
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
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!--end::Portlet-->
                    </div>
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