
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
                                                                <?php switch($columnItem['avatarType']):
                                                                    case (1): ?>
                                                                    <svg width="32" height="32">
                                                                        <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="<?php echo e($columnItem['avatarColor']); ?>"></circle>
                                                                        <text x="5" y="22"  style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                        <?php break; ?>
                                                                        <?php case (2): ?>
                                                                        
                                                                        <svg width="32" height="32">
                                                                            <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke-width:0;"></rect>
                                                                            <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                            <?php break; ?>
                                                                            <?php case (3): ?>
                                                                            
                                                                            <svg width="32" height="32">
                                                                                <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                <?php break; ?>
                                                                                <?php case (4): ?>
                                                                                
                                                                                <svg width="32" height="32" >
                                                                                    <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                    <?php break; ?>
                                                                                    <?php case (5): ?>
                                                                                    
                                                                                    <svg width="32" height="32">
                                                                                        <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                        <?php break; ?>
                                                                                        <?php endswitch; ?>
                                                                                        <?php switch($columnItem['roleID']):
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
                                                                    <?php switch($columnItem['avatarType']):
                                                                        case (1): ?>
                                                                        <svg width="32" height="32">
                                                                            <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="<?php echo e($columnItem['avatarColor']); ?>"></circle>
                                                                            <text x="5" y="22"  style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                            <?php break; ?>
                                                                            <?php case (2): ?>
                                                                            
                                                                            <svg width="32" height="32">
                                                                                <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke-width:0;"></rect>
                                                                                <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                <?php break; ?>
                                                                                <?php case (3): ?>
                                                                                
                                                                                <svg width="32" height="32">
                                                                                    <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                    <?php break; ?>
                                                                                    <?php case (4): ?>
                                                                                    
                                                                                    <svg width="32" height="32" >
                                                                                        <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                        <?php break; ?>
                                                                                        <?php case (5): ?>
                                                                                        
                                                                                        <svg width="32" height="32">
                                                                                            <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                            <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                            <?php break; ?>
                                                                                            <?php endswitch; ?>
                                                                                            <?php switch($columnItem['roleID']):
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
                                                                        <?php switch($columnItem['avatarType']):
                                                                            case (1): ?>
                                                                            <svg width="32" height="32">
                                                                                <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="<?php echo e($columnItem['avatarColor']); ?>"></circle>
                                                                                <text x="5" y="22"  style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                <?php break; ?>
                                                                                <?php case (2): ?>
                                                                                
                                                                                <svg width="32" height="32">
                                                                                    <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke-width:0;"></rect>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                    <?php break; ?>
                                                                                    <?php case (3): ?>
                                                                                    
                                                                                    <svg width="32" height="32">
                                                                                        <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                        <?php break; ?>
                                                                                        <?php case (4): ?>
                                                                                        
                                                                                        <svg width="32" height="32" >
                                                                                            <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                            <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                            <?php break; ?>
                                                                                            <?php case (5): ?>
                                                                                            
                                                                                            <svg width="32" height="32">
                                                                                                <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                                <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                                <?php break; ?>
                                                                                                <?php endswitch; ?>
                                                                                                <?php switch($columnItem['roleID']):
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
                                                                <?php switch($columnItem['avatarType']):
                                                                    case (1): ?>
                                                                    <svg width="32" height="32">
                                                                        <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="<?php echo e($columnItem['avatarColor']); ?>"></circle>
                                                                        <text x="5" y="22"  style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                        <?php break; ?>
                                                                        <?php case (2): ?>
                                                                        
                                                                        <svg width="32" height="32">
                                                                            <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke-width:0;"></rect>
                                                                            <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                            <?php break; ?>
                                                                            <?php case (3): ?>
                                                                            
                                                                            <svg width="32" height="32">
                                                                                <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                <?php break; ?>
                                                                                <?php case (4): ?>
                                                                                
                                                                                <svg width="32" height="32" >
                                                                                    <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                    <?php break; ?>
                                                                                    <?php case (5): ?>
                                                                                    
                                                                                    <svg width="32" height="32">
                                                                                        <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="<?php echo e($columnItem['avatarColor']); ?>" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($columnItem['nameTag']); ?></text>

                                                                                        <?php break; ?>
                                                                                        <?php endswitch; ?>
                                                                                        <?php switch($columnItem['roleID']):
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