    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid " style="<?php if($errors->has('email')): ?>display: none; <?php else: ?> display: block; <?php endif; ?>" id="personDetails">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" data-toggle="tab" id="tab_information" href="#kt_quick_panel_tab_information" role="tab"><?php echo e(__('task.information')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" id="tab_time" href="#kt_quick_panel_tab_time" role="tab"><?php echo e(__('task.time')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="text-transform: uppercase" data-toggle="tab"  id="tab_statistics" href="#kt_quick_panel_tab_statistics" role="tab"><?php echo e(__('task.statistics')); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-scroll taskAddBody" data-scroll="true">
                    <div class="tab-content">
                            <div class="tab-pane active" id="kt_quick_panel_tab_information">
                                <form method="post" action="<?php echo e(route('people.update')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" value="<?php echo e($selected_person['id']); ?>" name="selectedID">
                            <div class="row mb-3">
                                <div class="col-8">
                                   <h4><?php echo e($selected_person['nameFirst'].' '.$selected_person['nameMiddle'].' '.$selected_person['nameFamily']); ?></h4>
                                </div>
                                <div class="col-4 text-right">
                                 <?php echo $__env->make('people.partials.details_avatar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2"><?php echo e(__('people.tags')); ?>:</div>
                                <div class="col-lg-10 ">
                                    <div id="people-tags" style="display: flex; flex-wrap: wrap;"><?php
                                        foreach($peopleTagList as $taskTag) {
                                        ?>
                                            <span class="<?php if($taskTag['tagtype']==1): ?> system-span <?php elseif($taskTag['tagtype']==2): ?> organization-span <?php elseif($taskTag['tagtype']==3): ?> personal-span <?php endif; ?>" style="color:<?php echo e($taskTag['color']); ?>">
                                                <?php echo e($taskTag['tagtype']==1?__('tag.'.$taskTag['name']):$taskTag['name']); ?>

                                            </span> &nbsp;
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <input type="hidden" name="tags">
                                    <p id="people-edit-tags" <?php if(count($peopleTagList) != 0): ?> style="display: none;" <?php endif; ?>>
                                        <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="peopleTags">
                                            <?php $__currentLoopData = $tagList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tagItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option data-content='<span class="<?php if($tagItem['tagtype']==1): ?> system-span <?php elseif($tagItem['tagtype']==2): ?> organization-span <?php elseif($tagItem['tagtype']==3): ?> personal-span <?php endif; ?>" style="color:<?php echo e($tagItem['color']); ?>">
                                                    <?php echo e($tagItem['tagtype']==1?__('tag.'.$tagItem['name']):$tagItem['name']); ?>

                                                        </span>' value="<?php echo e($tagItem['ID']); ?>"
                                                    <?php
                                                    foreach($peopleTagList as $taskTag) {
                                                        if ($taskTag['ID'] == $tagItem['ID'])
                                                        {
                                                            echo 'selected';
                                                            break;
                                                        }
                                                    }
                                                    ?>
                                                   >
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </p>
                                </div>
                            </div>
                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row mb-1">
                                <div class="col-6" >
                                    <div  class="people_details_text">
                                        <p><?php echo e(__('people.firstName')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['nameFirst']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['nameFirst']!=""): ?> none <?php endif; ?>" value="<?php echo e($selected_person['nameFirst']); ?>" name="nameFirst">
                                    </div>
                                    <div  class="people_details_text">
                                        <p><?php echo e(__('people.middleName')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['nameMiddle']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['nameMiddle']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['nameMiddle']); ?>" name="nameMiddle">
                                    </div>
                                    <div class="people_details_text">
                                        <p><?php echo e(__('people.lastName')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['nameFamily']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['nameFamily']!=""): ?> none <?php endif; ?>" value="<?php echo e($selected_person['nameFamily']); ?>" name="nameFamily">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="people_details_text">
                                        <p><?php echo e(__('people.gender')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php if ($selected_person['gender'] == 1) echo __('people.male'); else echo __('people.female'); ?></p>
                                        <select class="form-control people_input_field" name="gender"  style="display:none;" >
                                            <option value="1" <?php if($selected_person['gender'] == 1): ?> selected <?php endif; ?>><?php echo e(__('people.male')); ?></option>
                                            <option value="0" <?php if($selected_person['gender'] == 0): ?> selected <?php endif; ?>><?php echo e(__('people.female')); ?></option>
                                        </select>
                                    </div>
                                    <div class="people_details_text">
                                        <p><?php echo e(__('people.dateOfBirth')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['birthday']); ?></p>
                                        <input type="text" class="form-control people_input_field date-picker" style="display: <?php if($selected_person['birthday']!=""): ?> none <?php endif; ?>" value="<?php echo e($selected_person['birthday']); ?>" name="birthday">
                                    </div>
                                    <div class="people_details_text">
                                        <p><?php echo e(__('people.nationality')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['nationality']); ?></p>
                                        <input type="text" class="form-control people_input_field"  style="display: <?php if($selected_person['nationality']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['nationality']); ?>" name="nationality">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row mb-3">
                                <div class="col-12" >
                                    <div class="people_details_text">
                                        <p><?php echo e(__('people.address')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['address']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['address']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['address']); ?>" name="address">
                                    </div>
                                    <div class="people_details_text">
                                        <p ><?php echo e(__('people.country')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['country']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['country']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['country']); ?>" name="country">
                                    </div>
                                    <div class="people_details_text">
                                        <p ><?php echo e(__('people.phone')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['phone_number']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['phone_number']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['phone_number']); ?>" name="phone_number">
                                    </div>
                                    <div class="people_details_text">
                                        <p ><?php echo e(__('people.mail')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['email']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['email']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['email']); ?>" name="email">
                                    </div>
                                    <div class="people_details_text">
                                        <p ><?php echo e(__('people.messenger')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['messenger']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['messenger']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['messenger']); ?>" name="messenger">
                                    </div>
                                    <div  class="people_details_text">
                                        <p><?php echo e(__('people.organization')); ?></p>
                                        <p><?php echo e($selected_person['organization']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row mb-3">
                                <div class="col-6" >
                                    <div class="people_details_text">
                                        <p><?php echo e(__('people.companyID')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['companyID']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['companyID']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['companyID']); ?>" name="companyID">
                                    </div>
                                    <div class="people_details_text">
                                        <p><?php echo e(__('people.bankAccount')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['bankAccount']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['bankAccount']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['bankAccount']); ?>" name="bankAccount">
                                    </div>
                                    <div class="people_details_text">
                                        <p><?php echo e(__('people.bank')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['bank']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['bank']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['bank']); ?>" name="bank">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="people_details_text">
                                        <p><?php echo e(__('people.nationalID')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['nationalID']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['nationalID']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['nationalID']); ?>" name="nationalID">
                                    </div>
                                    <div class="people_details_text">
                                        <p><?php echo e(__('people.swift')); ?>/<?php echo e(__('people.bic')); ?></p>
                                        <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['swift_bic']); ?></p>
                                        <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['swift_bic']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['swift_bic']); ?>" name="swift_bic">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row mt-0 ml-0 mr-0 mb-3">
                                <div class="col-md-6 people_details_text m-0 p-0">
                                <p> <?php echo e(__('people.family')); ?> </p>
                                <p class="people_P_Field people_P_Field_text"><?php echo e($selected_person['family']); ?></p>
                                <input type="text" class="form-control people_input_field" style="display: <?php if($selected_person['family']!=""): ?> none <?php endif; ?>"  value="<?php echo e($selected_person['family']); ?>" name="family">
                                </div>
                            </div>
                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row m-0" style="display: flex; flex-direction: column">
                                <p class="people_P_Field_text"> <?php echo e(__('people.description')); ?> </p>
                                <p class="people_P_Field"> <?php echo e($selected_person['description']); ?> </p>
                                <textarea name="description" class="form-control people_input_field mb-5"  rows="10"  style="width: 100% !important;display: <?php if($selected_person['description']!=""): ?> none <?php endif; ?>" ><?php echo e($selected_person['description']); ?></textarea>
                            </div>
                            <button type="submit" class="form-control btn btn-primary" disabled id="peopleUpdate"><?php echo e(__('people.update')); ?></button>
                            
                            
                                
                                

                                
                            
                            
                            
                                
                                

                                
                            
                                </form>
                        </div>

                        <div class="tab-pane" id="kt_quick_panel_tab_time">
                            <div class="row mb-3">
                                <div class="col-8">
                                    <h4><?php echo e($selected_person['nameFirst'].' '.$selected_person['nameMiddle'].' '.$selected_person['nameFamily']); ?></h4>
                                </div>
                                <div class="col-4 text-right">
                                    <?php echo $__env->make('people.partials.details_avatar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-3"><?php echo e(__('people.tags')); ?>:</div>
                            </div>
                            <div class="mb-2 mt-2" style="width: 100%; height: 1px; background-color: grey"></div>
                            <?php $cc = 0?>
                            <?php $__currentLoopData = $workTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($cc++ == 3): ?>
                                    <div class="mb-2 mt-2" style="width: 100%; height: 1px; background-color: grey"></div>
                                <?php endif; ?>
                                <div class="row" style="font-size: 16px">
                                    <div class="col-5">
                                        <?php echo e($index); ?>

                                    </div>
                                    <div class="col-7">
                                        <?php echo floor($item/8).'d '.fmod($item,8).'h'; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="tab-pane" id="kt_quick_panel_tab_statistics">
                            <div class="row mb-3">
                                <div class="col-8">
                                    <h4><?php echo e($selected_person['nameFirst'].' '.$selected_person['nameMiddle'].' '.$selected_person['nameFamily']); ?></h4>
                                </div>
                                <div class="col-4 text-right">
                                    <?php echo $__env->make('people.partials.details_avatar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-3"><?php echo e(__('people.tags')); ?>:</div>
                            </div>
                            <div class="row m-0">
                                <table style="width: 100%; font-size: 16px">
                                    <tr>
                                        <th></th>
                                        <th><?php echo e(__('people.success')); ?></th>
                                        <th><i class="fa fa-circle"></i>    </th>
                                        <th><i class='flaticon2-arrow lg'></i></th>
                                        <th><i class='fa fa-pause'></i></th>
                                        <th><i class='flaticon2-check-mark'></i></th>
                                        <th><i class='flaticon2-delete'></i></th>
                                        <th><i class='fa fa-star'></i></th>
                                    </tr>
                                    <?php $cc = 0; ?>
                                    <?php $__currentLoopData = $statistics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr <?php if ($cc == 0 || $cc == 3){
                                              echo 'style="border-top: solid 1px grey;"';
                                        } $cc += 1; ?> >

                                            <td><?php echo e($index); ?></td>
                                            <td><?php echo round($item['success'] * 100,2); ?> %</td>
                                            <td><?php echo e($item[1]); ?></td>
                                            <td><?php echo e($item[2]); ?></td>
                                            <td><?php echo e($item[3]); ?></td>
                                            <td><?php echo e($item[4]); ?></td>
                                            <td><?php echo e($item[5]); ?></td>
                                            <td><?php echo e($item[7]); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/people/partials/details.blade.php ENDPATH**/ ?>