
<?php $__env->startSection('title'); ?>
    Calendar
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/task/taskcard.css')); ?>">
    <style>
        .radio_span {
            font-size: 18px;
        }
        .check-span {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- end:: Header -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
            <!-- begin:: Content -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                <div class="row">
                    <div class="content-calendar row">
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
                                        <h5><?php echo e(__('calendar.yesterday')); ?></h5>
                                    </div>
                                </div>
                                <?php $__currentLoopData = $taskList['yesterday']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnClass => $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="column-body" data-column_id="<?php echo e($columnClass); ?>">
                                        <?php if(isset($columnItem["ID"])): ?>

                                            <div class="tab-content">
                                                <div class="kt-regular-task-item thin"
                                                     data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular" style="display: flex">
                                                    <div class="task-status pt-2" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%">
                                                        <div><?php echo($columnItem['status_icon'])?></div>
                                                        <div><?php echo e($columnItem['priority_title']); ?></div>
                                                        <div><?php echo e($columnItem['weight']); ?></div>
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
                                        <h5><?php echo e(__('calendar.today')); ?></h5>
                                    </div>
                                </div>
                                <?php $__currentLoopData = $taskList['today']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnClass => $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="column-body" data-column_id="<?php echo e($columnClass); ?>">
                                        <?php if(isset($columnItem["ID"])): ?>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="kt_regular_tab_<?php echo e($columnClass); ?>">
                                                    <div class="kt-regular-task-item thin"
                                                         data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular" style="display: flex">
                                                        <div class="task-status pt-2" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%">
                                                            <div><?php echo($columnItem['status_icon'])?></div>
                                                            <div><?php echo e($columnItem['priority_title']); ?></div>
                                                            <div><?php echo e($columnItem['weight']); ?></div>
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
                                            <h5><?php echo e(__('calendar.tomorrow')); ?></h5>
                                        </div>
                                    </div>
                                    <?php $__currentLoopData = $taskList['tomorrow']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnClass => $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="column-body" data-column_id="<?php echo e($columnClass); ?>">
                                            <?php if(isset($columnItem["ID"])): ?>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="kt_regular_tab_<?php echo e($columnClass); ?>">
                                                        <div class="kt-regular-task-item thin"
                                                             data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular" style="display: flex">
                                                            <div class="task-status pt-2" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%">
                                                                <div><?php echo($columnItem['status_icon'])?></div>
                                                                <div><?php echo e($columnItem['priority_title']); ?></div>
                                                                <div><?php echo e($columnItem['weight']); ?></div>
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
                                        <h5><?php echo e(__('calendar.theNextDay')); ?></h5>
                                    </div>
                                </div>
                                <?php $__currentLoopData = $taskList['theNextDay']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnClass => $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="column-body" data-column_id="<?php echo e($columnClass); ?>">
                                        <?php if(isset($columnItem["ID"])): ?>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="kt_regular_tab_<?php echo e($columnClass); ?>">
                                                    <div class="kt-regular-task-item thin"
                                                         data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular">
                                                        <div class="row">
                                                            <div class="col-lg-2 task-status">
                                                                <?php echo($columnItem['status_icon'])?>
                                                            </div>
                                                            <div class="col-lg-7">
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
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <!--end::Portlet-->
                        </div>
                    </div>
                    <div class="calendar-filter">
                        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid calendar-box">
                            <div id="datepicker" class="ml-auto mr-auto mb-5"></div>

                            <div style="height: 2px; width: 100%; background-color: grey">
                            </div>
                            <div class="ml-3 mt-2">
                                <h4> <?php echo e(__('calendar.showStatus')); ?></h4>
                                <div>
                                    <input type="radio"  class="mr-3" id="radio_onHold"> <i class="fa fa-circle mr-2"></i> <span class="radio_span"><?php echo e(__('calendar.onHold')); ?></span>
                                </div>
                                <div>
                                    <input type="radio" class="mr-3" id="radio_active"> <i class='flaticon2-arrow lg mr-2'></i> <span class="radio_span"><?php echo e(__('calendar.active')); ?></span>
                                </div>
                                <div>
                                    <input type="radio" class="mr-3" id="radio_paused"> <i class='fa fa-pause mr-2'></i> <span class="radio_span"><?php echo e(__('calendar.paused')); ?></span>
                                </div>
                                <div>
                                    <input type="radio" class="mr-3" id="radio_finished"> <i class='flaticon2-check-mark mr-2'></i> <span class="radio_span"><?php echo e(__('calendar.finished')); ?></span>
                                </div>
                                <div>
                                    <input type="radio" class="mr-3" id="radio_canceled"> <i class='flaticon2-hexagonal mr-2'></i> <span class="radio_span"><?php echo e(__('calendar.canceled')); ?></span>
                                </div>
                            </div>
                            <div style="margin-top: 20px;height: 2px; width: 100%; background-color: grey">
                            </div>
                            <div class="ml-3 mt-2">
                                    <h4>Show  Priority</h4>
                                <div>
                                    <input type="checkbox"  class="mr-3" id="check_high"> <span class="check-span mr-2">H</span> <span class="radio_span"><?php echo e(__('calendar.high')); ?></span>
                                </div>
                                <div>
                                    <input type="checkbox" class="mr-3" id="check_medium"> <span class='check-span mr-2'>M</span><span class="radio_span"><?php echo e(__('calendar.medium')); ?></span>
                                </div>
                                <div>
                                    <input type="checkbox" class="mr-3" id="check_low"> <span class='check-span mr-2'>L</span><span class="radio_span"><?php echo e(__('calendar.low')); ?></span>
                                </div>
                                <div>
                                    <input type="checkbox" class="mr-3" id="check_ness"> <span class='check-span mr-2'>O</span><span class="radio_span"><?php echo e(__('calendar.ness')); ?></span>
                                </div>
                            </div>
                        </div>
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
        
        
        var filter_status = "<?php echo e($status); ?>";
        var H = "<?php echo e($H); ?>";
        var M = "<?php echo e($M); ?>";
        var L = "<?php echo e($L); ?>";
        var O = "<?php echo e($O); ?>";



        switch (filter_status) {
            case '1':
                $('#radio_onHold').attr('checked',true);
                break;
            case '2':
                $('#radio_active').attr('checked',true);
                break;
            case '3':
                $('#radio_paused').attr('checked',true);
                break;
            case '4':
                $('#radio_finished').attr('checked',true);
                break;
            case '5':
                $('#radio_canceled').attr('checked',true);
                break;
        }

        if (H!="") {
            $('#check_high').attr('checked',true);
        }
        if (M!="") {
            $('#check_medium').attr('checked',true);
        }
        if (L!="") {
            $('#check_low').attr('checked',true);
        }
        if (O!="") {
            $('#check_ness').attr('checked',true);
        }

        $("input[type='radio']").change(function (e) {
            switch (e.target.id) {
                case "radio_onHold":
                    window.location.href = base_url + "/calendar?status=" + 1 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_active":
                    window.location.href = base_url + "/calendar?status=" + 2 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_paused":
                    window.location.href = base_url + "/calendar?status=" + 3 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_finished":
                    window.location.href = base_url + "/calendar?status=" + 4 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_canceled":
                    window.location.href = base_url + "/calendar?status=" + 5 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
            }
        })

        $("input[type='checkbox']").change(function (e) {
            switch (e.target.id) {
                case "check_high":
                    (H == "")?H=1:H="";
                    break;
                case "check_medium":
                    (M == "")?M=1:M="";
                    break;
                case "check_low":
                    (L == "")?L=1:L="";
                    break;
                case "check_ness":
                    (O == "")?O=1:O="";
                    break;
            }

            window.location.href = base_url + "/calendar?status=" + filter_status + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
        })

        $(document).ready(function(){
            // $('#datepicker').datepicker({
            //     todayHighlight: true,
            //     onSelect: (e) => {
            //         console.log(e.target,"date picker date");
            //     }
            // });

            $('#datepicker').datepicker({
                todayHighlight: true,
                format: 'YY-mm-dd',
            });
        })
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/calendar.blade.php ENDPATH**/ ?>