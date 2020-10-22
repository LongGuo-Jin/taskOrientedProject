
<?php $__env->startSection('title'); ?>
    People | TOP
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/people/people.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" style="padding-top: 90px !important;" id="kt_wrapper">
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row m-0">
            <div class="col-lg-8">
                <div style="display: flex">
                    <div class="filter_menu">
                        <?php
                            $alphas = ['All','A','B','C','D','E','F','G',
                                'H','I','J','K','L','M','N','O','P','Q','R','S',
                                'T','U','V','W','X','Y','Z']
                        ?>
                        <?php $__currentLoopData = $alphas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alpha_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if( $alpha == $alpha_item ): ?>
                                <div data-alpha = <?php echo e($alpha_item); ?> class="filter_item_selected"> <?php echo e($alpha_item); ?> </div>
                            <?php else: ?>
                                <div data-alpha = <?php echo e($alpha_item); ?> class="filter_item"> <?php echo e($alpha_item); ?> </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                        <?php
                            $sections = [__('people.employees') , __('people.partners') , __('people.customers') , __('people.contacts')];
                            $index = 0;
                        ?>
                    <div class="people_outer">
                        <div class="people_inner">
                            <div class="people_element">
                                <?php $__currentLoopData = $people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index1=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(is_array($item)): ?>
                                        <div style="display: flex; justify-content: space-between">
                                            <div style="display: flex">
                                                <h3> <i class="fa fa-eye person_eye_icon" id="<?php echo e($sections[$index]."eye"); ?>" onclick="section(<?php echo e($index); ?>)"></i> <?php echo e($sections[$index]); ?></h3>
                                                &nbsp;&nbsp;&nbsp;<h4> <?php echo e(count($item)); ?> of <?php echo e($people[$index1.'_count']); ?></h4>
                                            </div>
                                            <?php if($sections[$index] == __('people.employees')): ?><button class="form-control btn btn-primary" style="width: 20%;" id="addPerson"> <?php echo e(__('people.addPerson')); ?> </button><?php endif; ?>
                                        </div>
                                        <div style="width: 100%; height: 1px; background-color: rgba(99,99,99,0.72)"></div>
                                        <div class="people_section" id="<?php echo e($sections[$index ++]); ?>">
                                            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                    <div data-alpha = <?php echo e($alpha); ?> data-select=<?php echo e($person['id']); ?> class="person_info_card <?php if ($person['id'] == $selectedID) echo 'person_card_selected'; else echo 'person_card'; ?>">
                                                        <div style="width: 10%; background-color: #d1ffa7; border-bottom-left-radius: 10px; border-top-left-radius: 10px;"></div>
                                                        <div style="width: 77%; padding: 10px">
                                                            <div style="font-size: 20px; margin-bottom: 5px">
                                                                <?php echo e($person['nameFirst'].' '.$person['nameMiddle'].' '.$person['nameFamily']); ?>

                                                            </div>
                                                            <div style="font-size: 16px; margin-bottom: 5px">
                                                                <?php echo e(__('people.employee')); ?>,<?php if($person['roleID']==1): ?> ADMIN <?php elseif($person['roleID']==2): ?> Manager <?php elseif($person['roleID']==4): ?> Member <?php endif; ?>
                                                            </div>
                                                            <div class="people_card_text">
                                                                <div>
                                                                    <?php echo e(__('people.from')); ?>:&nbsp;
                                                                </div>
                                                                <div> <?php echo e($person['address']); ?> </div>
                                                            </div>
                                                            <div class="people_card_text">
                                                                <div>
                                                                    <?php echo e(__('people.org')); ?>:&nbsp;
                                                                </div>
                                                                <div> <?php echo e($person['organization']); ?> </div>
                                                            </div>
                                                            <div class="people_card_text">
                                                                <div>
                                                                    <?php echo e(__('people.phone')); ?>:&nbsp;
                                                                </div>
                                                                <div> <?php echo e($person['phone_number']); ?> </div>
                                                            </div>
                                                            <div class="people_card_text">
                                                                <div>
                                                                    <?php echo e(__('people.mail')); ?>:&nbsp;
                                                                </div>
                                                                <div> <?php echo e($person['email']); ?> </div>
                                                            </div>
                                                        </div>
                                                        <div style="width: 13%; padding-top: 10px" >
                                                             <?php if (isset($component)) { $__componentOriginal44db2fd38a5a2ed593dece4b684aa7914ca664da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserAvatar::class, ['type' => $person['avatarType'],'nameTag' => $person['nameTag'],'roleID' => $person['roleID'],'color' => $person['avatarColor']]); ?>
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

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <?php if($selected_person != null): ?>
                    <?php echo $__env->make('people.partials.details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <?php echo $__env->make('people.partials.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<script src="<?php echo e(asset('public/assets/js/people/people.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')); ?>" type="text/javascript"></script>

<script>
    let alpha = "<?php echo e($alpha); ?>";
    let base_url = "<?php echo e(URL::to('')); ?>";

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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/people/index.blade.php ENDPATH**/ ?>