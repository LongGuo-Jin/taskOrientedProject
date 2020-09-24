<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid " style="display: none" id="companyAddForm">
    <form class="kt-form kt-form--label-right" method="post" action="<?php echo e(route('company.add')); ?>">
        <?php echo csrf_field(); ?>
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" data-toggle="tab" id="tab_information" href="#kt_quick_panel_tab_information" role="tab"><?php echo e(__('task.information')); ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-scroll" data-scroll="true">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_quick_panel_tab_information">
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-2" style="color: #ca30e9"><?php echo e(__('people.tags')); ?>:</div>
                            <div class="col-lg-10 ">
                                <input type="hidden" name="addTags">
                                <p id="organization-add-tags">
                                    <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="orgAddTags">
                                        <?php $__currentLoopData = $tagList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tagItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-content='<span class="<?php if($tagItem['tagtype']==1): ?> system-span <?php elseif($tagItem['tagtype']==2): ?> organization-span <?php elseif($tagItem['tagtype']==3): ?> personal-span <?php endif; ?>" style="color:<?php echo e($tagItem['color']); ?>">
                                                    <?php echo e($tagItem['tagtype']==1?__('tag.'.$tagItem['name']):$tagItem['name']); ?>

                                                    </span>' value="<?php echo e($tagItem['ID']); ?>">
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="shortName"><?php echo e(__('people.shortName')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="shortName" id="shortName"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="longName"><?php echo e(__('people.longName')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="longName" id="longName"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="type"><?php echo e(__('people.type')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="type" id="type"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="industry"><?php echo e(__('people.industry')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="industry" id="industry"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="country"><?php echo e(__('people.country')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="country" id="country"></div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"><label for="address"><?php echo e(__('people.address')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="address" id="address"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="registrationNumber"><?php echo e(__('people.registrationNo')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="registrationNumber" id="registrationNumber"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="vatNumber"><?php echo e(__('people.vatNo')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="vatNumber" id="vatNumber"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><label for="taxPayer"><?php echo e(__('people.taxPayer')); ?></label></div>
                            <div class="col-md-9">
                                <select class="form-control" name="taxPayer" id="taxPayer">
                                    <option value="0"><?php echo e(__('people.yes')); ?></option>
                                    <option value="1"><?php echo e(__('people.no')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="phone"><?php echo e(__('people.phone')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="phone" id="phone"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="email"><?php echo e(__('people.mail')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="email" id="email"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="messenger"><?php echo e(__('people.messenger')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="messenger" id="messenger"></div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"><label for="companyID"><?php echo e(__('people.companyID')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="companyID" id="companyID"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="bankAccount"><?php echo e(__('people.bankAccount')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="bankAccount" id="bankAccount"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="bank"><?php echo e(__('people.bank')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="bank" id="bank"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="swift_bic"><?php echo e(__('people.swift')); ?>/<?php echo e(__('people.bic')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="swift_bic" id="swift_bic"></div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"><label for="description"><?php echo e(__('people.description')); ?></label></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <textarea class="form-control" rows="10" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-6 ml-auto mr-auto">
                                <button type="submit" class="form-control btn btn-success"><?php echo e(__('people.add')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/company/partials/add.blade.php ENDPATH**/ ?>