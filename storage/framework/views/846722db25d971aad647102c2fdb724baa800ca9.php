
<?php $__env->startSection('title'); ?>
    Organization | TOP
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/company/company.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" style="padding-top: 90px !important;" id="kt_wrapper">
        <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row m-0">
            <div class="col-lg-8">
                <div style="display: flex">
                    <div style="width: 80%; height: 1px; margin-top: auto;background-color: rgba(99,99,99,0.72)"></div>
                    <button class="form-control btn btn-primary" style="width: 20%;" id="addCompany"><?php echo e(__('people.addOrganization')); ?> </button>
                </div>
                <div class="company_outer">
                    <div class="company_inner">
                        <div class="company_element">
                            <div style="display:flex; flex-wrap: wrap">
                            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('company',['select' => $company['id']])); ?>">
                                    <div class="<?php if ($company['id'] == $selectedID) echo 'company_card_selected'; else echo 'company_card'; ?>">
                                        <div style="width: 10%; background-color: #377aff; border-bottom-left-radius: 10px; border-top-left-radius: 10px;"></div>
                                        <div style="width: 90%; padding: 10px">
                                            <div style="font-size: 20px; margin-bottom: 5px">
                                                <?php echo e($company['short_name']); ?>

                                            </div>
                                            <div class="mt-1 mb-1">
                                                <?php echo e($company['country']); ?>

                                            </div>
                                            <div class="company_card_text">
                                                <div>
                                                    <?php echo e(__('people.from')); ?>:&nbsp;
                                                </div>
                                                <div> <?php echo e($company['address']); ?> </div>
                                            </div>
                                            <div class="company_card_text">
                                                <div>
                                                    <?php echo e(__('people.mgr')); ?>:&nbsp;
                                                </div>
                                                <div>  </div>
                                            </div>
                                            <div class="company_card_text">
                                                <div>
                                                    <?php echo e(__('people.contact')); ?>:&nbsp;
                                                </div>
                                                <div>  </div>
                                            </div>
                                            <div class="company_card_text">
                                                <div>
                                                    <?php echo e(__('people.phone')); ?>:&nbsp;
                                                </div>
                                                <div> <?php echo e($company['phone']); ?> </div>
                                            </div>
                                            <div class="company_card_text">
                                                <div>
                                                    <?php echo e(__('people.mail')); ?>:&nbsp;
                                                </div>
                                                <div> <?php echo e($company['email']); ?> </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <?php if($selected_company != null): ?>
                    <?php echo $__env->make('company.partials.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                    <?php echo $__env->make('company.partials.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

    <script src="<?php echo e(asset('public/assets/js/company/company.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')); ?>" type="text/javascript"></script>

    <script>

        function section(id) {
            switch (id) {
                case 0:
                    $('#Employees').toggle();
                    if($('#Employeeseye').hasClass('person_eye_icon')) {
                        $('#Employeeseye').removeClass('person_eye_icon');
                        $('#Employeeseye').addClass('person_eye_icon_selected');
                    } else {
                        $('#Employeeseye').addClass('person_eye_icon');
                        $('#Employeeseye').removeClass('person_eye_icon_selected');
                    }
                    break;
                case 1:
                    $('#Partners').toggle();
                    if($('#Partnerseye').hasClass('person_eye_icon')) {
                        $('#Partnerseye').removeClass('person_eye_icon');
                        $('#Partnerseye').addClass('person_eye_icon_selected');
                    } else {
                        $('#Partnerseye').addClass('person_eye_icon');
                        $('#Partnerseye').removeClass('person_eye_icon_selected');
                    }
                    break;
                case 2:
                    $('#Customers').toggle();
                    if($('#Customerseye').hasClass('person_eye_icon')) {
                        $('#Customerseye').removeClass('person_eye_icon');
                        $('#Customerseye').addClass('person_eye_icon_selected');
                    } else {
                        $('#Customerseye').addClass('person_eye_icon');
                        $('#Customerseye').removeClass('person_eye_icon_selected');
                    }
                    break;
                case 3:
                    $('#Contacts').toggle();
                    if($('#Contactseye').hasClass('person_eye_icon')) {
                        $('#Contactseye').removeClass('person_eye_icon');
                        $('#Contactseye').addClass('person_eye_icon_selected');
                    } else {
                        $('#Contactseye').addClass('person_eye_icon');
                        $('#Contactseye').removeClass('person_eye_icon_selected');
                    }
                    break;
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/company/index.blade.php ENDPATH**/ ?>