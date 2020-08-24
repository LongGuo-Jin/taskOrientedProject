
<?php $__env->startSection('title'); ?>
    Add User 
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
                                <?php echo e($organization); ?> >> <?php echo e(__('user.editUser')); ?>

                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">                           
                                <div class="dropdown dropdown-inline">
                                    <a class="btn btn-brand btn-icon-sm" aria-expanded="false"  href="<?php echo e(route('user')); ?>">
                                        <i class="flaticon2-back"></i> <?php echo e(__('user.back')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
 
                    <div class="kt-portlet__body kt-portlet__body--fit" style="display: block; min-height: 500px;">
                        <!--begin: Datatable -->
                        <div> 
                            <div class="col-md-4  mt-5 ml-auto mr-auto">
                                <form role="form" method="POST" id="UserEdit" action="<?php echo e(route('user.update')); ?>">
                                    <?php echo csrf_field(); ?>                                     
                                    <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                                    <p class="user-input-para"> <?php echo e(__('user.firstName')); ?>:</p>
                                    <div class="user-input <?php echo e($errors->has('nameFirst') ? ' has-danger' : ''); ?>">
                                        <input type="text" class="form-control <?php echo e($errors->has('nameFirst') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('user.firstName')); ?>" type="text" name="nameFirst" value="<?php echo e(old('nameFirst', $user->nameFirst)); ?>" required autofocus>
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <?php if($errors->has('nameFirst')): ?>
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong><?php echo e($errors->first('nameFirst')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                    <p class="user-input-para"> <?php echo e(__('user.familyName')); ?>:</p>
                                    <div class="user-input <?php echo e($errors->has('nameFamily') ? ' has-danger' : ''); ?>">
                                        <input type="text" class="form-control <?php echo e($errors->has('nameFamily') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('user.familyName')); ?>" type="text" name="nameFamily" value="<?php echo e(old('nameFamily', $user->nameFamily)); ?>" required autofocus>
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <?php if($errors->has('nameFamily')): ?>
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong><?php echo e($errors->first('nameFamily')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                    <p class="user-input-para"> <?php echo e(__('user.email')); ?>:</p>
                                    <div class="user-input <?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
                                        <input type="email" class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('user.email')); ?>" type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required autofocus>
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                    <?php endif; ?>

                                    <p class="user-input-para"> <?php echo e(__('user.userRole')); ?>:</p>
                                    <select class = "form-control" style="margin-bottom: 20px;" name="roleID">
                                        <option value="1" <?php $user->roleID==1? print_r("selected"): print_r(""); ?> > <?php echo e(__('user.administrator')); ?> </option>
                                        <option value="2" <?php $user->roleID==2? print_r("selected"): print_r(""); ?> > <?php echo e(__('user.projectManager')); ?> </option>
                                        <option value="4" <?php $user->roleID==4? print_r("selected"): print_r(""); ?> > <?php echo e(__('user.member')); ?> </option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-block mb-3"><?php echo e(__('user.update')); ?></button>
                                </form>
                            </div>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="passwordrequestbackground" style="display: none">
        <div class="PasswordRequestCard">
            <p class="user-input-para text-center"> <?php echo e(__('user.adminPassword')); ?> </p>
            <div class="user-input <?php echo e($errors->has('nameFirst') ? ' has-danger' : ''); ?>">
                <input type="password" class="form-control" placeholder="<?php echo e(__('user.adminPassword')); ?>"  id="AdminPassword" name="AdminPassword"  required autofocus>
                <i class="fa fa-key"></i>
            </div>
            <button class="form-control btn btn-primary" onclick="AskPassword()"><?php echo e(__('user.adminPassword')); ?></button>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/components/extended/blockui.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/components/extended/sweetalert2.js')); ?>" type="text/javascript"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $("form").submit(function(e) {
            e.preventDefault();
            $('.passwordrequestbackground').show();
        })

        function AskPassword() {
            let pwd = $("#AdminPassword").val();
            let passwordForm = $('.passwordrequestbackground');
            let form = $('#UserEdit');

            $.ajax({
                type: 'POST',
                url: 'admin-password',
                data: {password: pwd},
                success: function(data) {
                    if (data.success == true) {
                        passwordForm.hide();
                        form[0].submit();
                        console.log(form)
                    } else {
                        passwordForm.hide();
                        alert("Wrong Password!");
                    }
                },
                error: function(error) {
                    $('.passwordrequestbackground').hide();
                    alert("Something went Wrong!");
                }
            });
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/user/edit.blade.php ENDPATH**/ ?>