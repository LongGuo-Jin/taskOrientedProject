
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
                                <?php echo e($organization); ?> >> <?php echo e(__('user.addUser')); ?>

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
                            <div class="col-md-4  ml-auto mr-auto mt-5">
                                <form role="form" method="POST" id="UserCreate" action="<?php echo e(route('user.save')); ?>">
                                    <?php echo csrf_field(); ?>

                                    <div class="user-input <?php echo e($errors->has('nameFirst') ? ' has-danger' : ''); ?>">

                                        <input type="text" class="form-control <?php echo e($errors->has('nameFirst') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('user.firstName')); ?>" type="text" name="nameFirst" value="<?php echo e(old('nameFirst', '')); ?>" required autofocus>
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <?php if($errors->has('nameFirst')): ?>
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong><?php echo e($errors->first('nameFirst')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                    <div class="user-input <?php echo e($errors->has('nameFamily') ? ' has-danger' : ''); ?>">
                                        <input type="text" class="form-control <?php echo e($errors->has('nameFamily') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('user.familyName')); ?>" type="text" name="nameFamily" value="<?php echo e(old('nameFamily', '')); ?>" required autofocus>
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <?php if($errors->has('nameFamily')): ?>
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong><?php echo e($errors->first('nameFamily')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                    <div class="user-input <?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
                                        <input type="email" class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('user.email')); ?>" type="email" name="email" value="<?php echo e(old('email', '')); ?>" required autofocus>
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                    <?php endif; ?>
    
                                    <div class="user-input <?php echo e($errors->has('password') ? ' has-danger' : ''); ?>">
                                        <input type="password" class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('user.password')); ?>" name="password" placeholder="<?php echo e(__('Password')); ?>" type="password" value="" required>
                                        <i class="fa fa-key"></i>
                                    </div>
                                    <?php if($errors->has('password')): ?>
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                    <?php endif; ?>

                                    <select class = "form-control" style="margin-bottom: 20px;" name="roleID">
                                        <option value="1" selected> <?php echo e(__('user.administrator')); ?> </option>
                                        <option value="2"> <?php echo e(__('user.projectManager')); ?> </option>
                                        <option value="4"> <?php echo e(__('user.member')); ?> </option>
                                    </select>

                                    <button type="submit" class="btn btn-primary btn-block mb-3"><?php echo e(__('user.save')); ?></button>
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
            <p class="user-input-para text-center"> <?php echo e(__('user.adminPassword')); ?></p>
            <div class="user-input <?php echo e($errors->has('nameFirst') ? ' has-danger' : ''); ?>">
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
           let form = $('#UserCreate');

            console.log(pwd);
           $.ajax({
               type: 'POST',
               url: 'admin-password',
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
                   $('.passwordrequestbackground').hide();
                   alert("Something went Wrong!");
               }
           });
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/user/create.blade.php ENDPATH**/ ?>