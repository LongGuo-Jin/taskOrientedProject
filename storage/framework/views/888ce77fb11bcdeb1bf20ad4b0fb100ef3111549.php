<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid " style="<?php if($errors->has('email')): ?>display: block; <?php else: ?> display: none; <?php endif; ?>" id="personAddForm">
    <form class="kt-form kt-form--label-right" method="post" action="<?php echo e(route('people.add')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="organizationID" id="organizationID" value="<?php echo e(auth()->user()->organization_id); ?>">

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
                        <div class="mb-3 mt-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-2" style="color: #ca30e9"><?php echo e(__('people.tags')); ?>:</div>
                            <div class="col-lg-10 ">
                                <input type="hidden" name="personTags">
                                <p>
                                    <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="personAddTags">
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
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="firstName"><?php echo e(__('people.firstName')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="nameFirst" id="firstName" required></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="middleName"><?php echo e(__('people.middleName')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="nameMiddle" id="middleName"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="familyName"><?php echo e(__('people.lastName')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="nameFamily" id="familyName" required></div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="roleID"><?php echo e(__('people.role')); ?></label></div>
                            <div class="col-md-9">
                                <select name="roleID" id="roleID" class="form-control">
                                    <option value="1"> <?php echo e(__('people.admin')); ?> </option>
                                    <option value="2"> <?php echo e(__('people.manager')); ?> </option>
                                    <option value="4"> <?php echo e(__('people.member')); ?> </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="gender"><?php echo e(__('people.gender')); ?></label></div>
                            <div class="col-md-9">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="1"> <?php echo e(__('people.male')); ?> </option>
                                    <option value="0"> <?php echo e(__('people.female')); ?> </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="password"><?php echo e(__('people.password')); ?></label></div>
                            <div class="col-md-9"><input type="password" class="form-control" name="password" id="password" required></div>
                        </div>
                        <div class="mb-3  mt-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="birthday"><?php echo e(__('people.dateOfBirth')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="birthday" id="birthday"></div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="nationality"><?php echo e(__('people.nationality')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="nationality" id="nationality"></div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="address"><?php echo e(__('people.address')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="address" id="address"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="country"><?php echo e(__('people.country')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="country" id="country"></div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="phone"><?php echo e(__('people.phone')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="phone_number" id="phone"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="email"><?php echo e(__('people.mail')); ?></label></div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="email" id="email" required>
                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="messenger"><?php echo e(__('people.messenger')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="messenger" id="messenger"></div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="nationalID"><?php echo e(__('people.nationalID')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="nationalID" id="nationalID"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="companyID"><?php echo e(__('people.companyID')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="companyID" id="companyID"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="bankAccount"><?php echo e(__('people.bankAccount')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="bankAccount" id="bankAccount"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="bank"><?php echo e(__('people.bank')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="bank" id="bank"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="swift_bic"><?php echo e(__('people.swift')); ?>/<?php echo e(__('people.bic')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="swift_bic" id="swift_bic"></div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="family"><?php echo e(__('people.family')); ?></label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="family" id="family"></div>
                        </div>

                        <div class="mb-3  mt-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"><label for="description"><?php echo e(__('people.description')); ?></label></div>
                        </div>
                        <div class="row mt-1 mb-1">
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
</div><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/people/partials/add.blade.php ENDPATH**/ ?>