
<?php $__env->startSection('title'); ?>
    Calendar
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/task/taskcard.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/calendar/vanilla-calendar.css')); ?>">
    <style>
        .radio_span {
            font-size: 14px;
        }
        .check-span {
            font-size: 14px;
            font-weight: bold;
        }
    </style>
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
                <div style="display: flex">
                    <div class="content-calendar" >
                        <?php $__currentLoopData = $taskList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $taskListItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="margin-left: 10px; margin-right: 10px; flex: 0 0 25%;  box-sizing:border-box;">
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
                                            
                                                
                                            
                                                
                                            
                                                
                                            
                                                
                                            
                                            <h5>
                                                <?php
                                                    $dt = date('d.m.Y',strtotime($index));
                                                    $today = date('d.m.Y');
                                                    $tomorrow = date('d.m.Y',strtotime('tomorrow'));
                                                    $yesterday = date('d.m.Y',strtotime('yesterday'));
                                                    if ($dt == $today) {
                                                        echo "Today";
                                                    } else if ($dt == $tomorrow) {
                                                        echo "Tomorrow";
                                                    } else if ($dt == $yesterday) {
                                                        echo "Yesterday";
                                                    } else {
                                                        echo $dt;
                                                    }
                                                ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body active">
                                        <div class="kt-scroll " data-scroll="true" style="width: 250px">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="kt_regular_tab_<?php echo e($index); ?>">
                                                    <?php $__currentLoopData = $taskListItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="column-body">
                                                            <?php if(isset($columnItem["ID"])): ?>
                                                                <div class="kt-regular-task-item thin"
                                                                     data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular" style="display: flex">
                                                                    <div class="task-status" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%; justify-content: space-between; padding-top:10px">
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
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <div class="tab-pane" id="kt_extended_tab_<?php echo e($index); ?>">
                                                    <?php $__currentLoopData = $taskListItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="column-body">
                                                            <?php if(isset($columnItem["ID"])): ?>
                                                                <div class="kt-extended-task-item"
                                                                     data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="regular" style="display: flex">
                                                                    <div class="task-status" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%; justify-content: space-between; padding-top:10px">
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
                                                                <div class="kt-simple-task-item thin"
                                                                     data-task_id="<?php echo e($columnItem['ID']); ?>" data-show_type="simple" style="display: flex">
                                                                    <div class="task-status" style="background-color: #c97acb; display: flex; flex-direction: column; width: 10%; justify-content: space-between; padding-top:10px">
                                                                        <div style="display: flex; flex-direction: column">
                                                                            <div><?php echo($columnItem['status_icon'])?></div>
                                                                        </div>
                                                                        <div style="position: relative; margin: 0; padding: 0">
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 90%;">
                                                                        <div class="row ml-2">
                                                                            <div class="col-lg-9 final-sub-task-name">
                                                                                <?php echo e($columnItem['title']); ?>

                                                                            </div>
                                                                            <div class="col-lg-3 final-sub-task-name">
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
                    <div class="calendar-filter">
                        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                        <div class="kt-portlet  kt-portlet--tabs calendar-box">
                            <div class="kt-portlet__body active">
                                <div class="kt-scroll taskAddBody" data-scroll="true">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="kt_quick_panel_tab_information">
                                            <div id="myCalendar" class="vanilla-calendar ml-auto mr-auto mb-2"></div>
                                            <div style="height: 1px; width: 100%; background-color: grey">
                                            </div>
                                            
                                                
                                                
                                                    
                                                
                                                
                                                    
                                                
                                                
                                                    
                                                
                                                
                                                    
                                                
                                                
                                                    
                                                
                                            
                                            
                                            
                                            <div class="ml-3 mt-3">
                                                <h6>Show  Priority</h6>
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
                            </div>
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
    <script src="<?php echo e(asset('public/assets/js/calendar/vanilla-calendar.js')); ?>" type="text/javascript"></script>

    <script type="text/javascript">
        let base_url = "<?php echo e(URL::to('')); ?>";
        
        
        let filter_status = "<?php echo e($status); ?>";
        let H = "<?php echo e($H); ?>";
        let M = "<?php echo e($M); ?>";
        let L = "<?php echo e($L); ?>";
        let O = "<?php echo e($O); ?>";
        let date ="<?php echo e($date); ?>";
        const slider = document.querySelector('.content-calendar');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', (e) => {
            if(!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 3; //scroll-fast
            slider.scrollLeft = scrollLeft - walk;
            console.log(walk);
        });

        switch (filter_status) {
            case '1':
                $('#radio_created').attr('checked',true);
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
                case "radio_created":
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + 1 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_active":
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + 2 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_paused":
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + 3 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_finished":
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + 4 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
                case "radio_canceled":
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + 5 + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                    break;
            }
        });

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

            window.location.href = base_url + "/calendar?date="+date+"&status=" + filter_status + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
        });

        $(document).ready(function(){
            // $('#datepicker').datepicker({
            //     todayHighlight: true,
            //     onSelect: (e) => {
            //         console.log(e.target,"date picker date");
            //     }
            // });
            let calendar = new VanillaCalendar({
                selector: "#myCalendar",
                date:new Date(date),
                todaysDate: new Date(date),
                onSelect: (data, elem) => {
                    let selectedDate = new Date(data.date);

                    date = selectedDate.getFullYear()+'/'+(selectedDate.getMonth() + 1) +'/'+selectedDate.getDate();
                    // console.log(date);
                    window.location.href = base_url + "/calendar?date="+date+"&status=" + filter_status + "&H="+ H +"&M="+ M +"&L="+ L +"&O="+ O;
                }
            });

        })
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/calendar.blade.php ENDPATH**/ ?>