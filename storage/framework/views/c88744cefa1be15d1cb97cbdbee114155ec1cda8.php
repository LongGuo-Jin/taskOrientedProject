
<?php $__env->startSection('title'); ?>
    User
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/user/user.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
        <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- end:: Header -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

            <!-- begin:: Content -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand flaticon2-line-chart"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                <?php echo e($organization); ?> >> <?php echo e(__('user.userList')); ?>

                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <div class="dropdown dropdown-inline">
                                    <a class="btn btn-brand btn-icon-sm" aria-expanded="false"  href="<?php echo e(route('user.add')); ?>">
                                        <i class="flaticon2-plus"></i> <?php echo e(__('user.addNew')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <!--begin: Datatable -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover data-table">
                                <thead class="table table-bordered table-striped table-hover data-table">
                                    <tr >
                                        <th data-field="ID" >
                                            <span ><?php echo e(__('user.id')); ?></span>
                                        </th>
                                        <th data-field="nameFirst">
                                            <span><?php echo e(__('user.firstName')); ?></span>
                                        </th>
                                        <th data-field="nameFamily">
                                            <span><?php echo e(__('user.familyName')); ?></span>
                                        </th>
                                        <th data-field="Email">
                                            <span><?php echo e(__('user.email')); ?></span>
                                        </th>
                                        <th data-field="Role">
                                            <span><?php echo e(__('user.role')); ?></span>
                                        </th>
                                        <th data-field="Actions" data-autohide-disabled="false">
                                            <span><?php echo e(__('user.actions')); ?></span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td data-field="ID">
                                                <span> <?php echo e($index + 1); ?> </span>
                                            </td>
                                            <td data-field="nameFirst">
                                                <span><?php echo e($user->nameFirst); ?></span>
                                            </td>
                                            <td data-field="nameFamily">
                                                <span> <?php echo e($user->nameFamily); ?> </span>
                                            </td>
                                            <td data-field="Email">
                                                <span><?php echo e($user->email); ?></span>
                                            </td>
                                            <td data-field="Role">
                                                <span> 
                                                    <?php switch($user->roleID ):
                                                        case (1): ?>
                                                        <?php echo e(__('user.administrator')); ?>

                                                            <?php break; ?>
                                                        <?php case (2): ?>
                                                        <?php echo e(__('user.projectManager')); ?>

                                                            <?php break; ?>
                                                        <?php case (4): ?>
                                                        <?php echo e(__('user.member')); ?>

                                                            <?php break; ?>
                                                        <?php default: ?>                                                            
                                                    <?php endswitch; ?>
                                                </span>
                                            </td>

                                            <td data-field="Actions" data-autohide-disabled="false" >
                                                <span style="overflow: visible; position: relative; width: 110px;">						
                                                <a title="Edit details" class="btn btn-sm btn-clean btn-icon btn-icon-md" href="<?php echo e(route('user.edit' , ['id'=>$user->id])); ?>">
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                    <a title="Delete" class="btn btn-sm btn-clean btn-icon btn-icon-md"  onclick="OnDelete(<?php echo e($user->id); ?>)">
                                                        <i class="la la-trash"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </tbody>
                            </table>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <form id="deleteForm" method="get" action="<?php echo e(route('user.delete')); ?>" hidden>
        <?php echo csrf_field(); ?>
        <input type="text" id="deleteID" name="id" value="" />
    </form>
    <div class="passwordrequestbackground" style="display: none">
        <div class="PasswordRequestCard">
            <p class="user-input-para text-center"> <?php echo e(__('user.adminPassword')); ?> </p>
            <div class="user-input">
                <input type="password" class="form-control" placeholder="<?php echo e(__('user.adminPassword')); ?>"  id="AdminPassword" name="AdminPassword"  required autofocus>
                <i class="fa fa-key"></i>
            </div>
            <button class="form-control btn btn-primary" onclick="AskPassword()"><?php echo e(__('user.ok')); ?></button>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/components/extended/blockui.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/components/extended/sweetalert2.js')); ?>" type="text/javascript"></script>

    <script type="text/javascript">
        function OnDelete(id) {
            $('#deleteID').val(id);
            $('.passwordrequestbackground').show();
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function AskPassword() {
            let pwd = $("#AdminPassword").val();
            let passwordForm = $('.passwordrequestbackground');
            let form = $('#deleteForm');

            console.log(pwd);
            $.ajax({
                type: 'POST',
                url: 'user/admin-password',
                data: {password: pwd},
                success : (data) => {
                    if (data.success == true) {
                        passwordForm.hide();
                        form[0].submit();
                        console.log(form)
                    } else {
                        passwordForm.hide();
                        alert("Wrong Password!");
                    }
                },
                error: (error) =>  {
                    passwordForm.hide();
                    alert("Something went Wrong!");
                }
            });
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/user/index.blade.php ENDPATH**/ ?>