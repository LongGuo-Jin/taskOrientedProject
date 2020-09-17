<div class="col-md-3" id="tagAddCard" style="display: none;">
    <div class="list-card kt-scroll" data-scroll="true" >
        <form method="post" role="form" action="<?php echo e(route('tag.add')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="personalID" value="<?php echo e($personalID); ?>">
            <input type="hidden" name="organizationID" value="<?php echo e($organizationID); ?>">
            <div class="custom-span">
                <span> Tag Name </span>
                <input name="tagName" class="form-control" style="font-size: 16px">
                <?php if($errors->has('tagName')): ?>
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong><?php echo e($errors->first('tagName')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            <div class="row mt-3">
                <div class="ml-2">
                    <div class="mb-2 custom-span">
                        Tag Type
                    </div>
                    <div class="ml-2" style="display: flex">
                        <input type="hidden" name="tagType" id="tagType">
                        <span id="tagTypeShow"> Organization Tag </span>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <span class="custom-span mb-2 ml-2">Tag Color</span>
                <div class="ml-2">
                    <input type="hidden" name="tagColor" id="tagColor" value="#4a6f4b99" class="color-picker mt-2 mb-3">
                    <input type="hidden" name="tagColorValue" id="tagColorValue" value="<?php echo e(13); ?>">
                    <?php
                    $colorValue = 13;

                    $col = ($colorValue % 8) * 1;
                    $row = (($colorValue-$col) / 8) * 1;
                    $colors = [
                        ['#FF0000','#FF000099','#FF000044'],
                        ['#d4b04d','#d4b04d99','#d4b04d44'],
                        ['#e5ff08','#e5ff0899',"#e5ff0844"],
                        ['#08ff0f','#08ff0f99','#08ff0f44'],
                        ['#4a6f4b','#4a6f4b99','#4a6f4b44'],
                        ['#277af7','#277af799','#277af744'],
                        ['#2a27f7','#2a27f799','#2a27f744'],
                        ['#f72787','#f7278799','#f7278744'],
                    ];
                    ?>
                    <?php for( $i = 0; $i < 3;  $i ++): ?>
                        <div style="display: flex; margin-left: 10px">
                            <?php for( $j = 0; $j < 8; $j ++): ?>
                                <div class="color-check-box" >
                                    <?php if($i == $row && $j == $col): ?>
                                        <input type="radio" name="radio" onclick="ColorSelect('<?php echo e($j); ?>','<?php echo e($i); ?>')"  checked>
                                    <?php else: ?>
                                        <input type="radio" name="radio" onclick="ColorSelect('<?php echo e($j); ?>','<?php echo e($i); ?>')"  >
                                    <?php endif; ?>
                                    <span class="checkmark" style="background-color: <?php echo e($colors[$j][$i]); ?>;"></span>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php endfor; ?>
                    <div style="display: flex;margin-left: 10px">
                        <input type="checkbox" style="width: 25px; height: 25px" name="showTag" checked >
                        <span class="mt-auto mb-auto ml-2 custom-span">Show Tag</span>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="mb-2 custom-span">
                    <span> Note </span>
                    <input name="tagNote" class="form-control" style="font-size: 16px">
                    <?php if($errors->has('tagNote')): ?>
                        <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong><?php echo e($errors->first('tagNote')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
                <div class="mb-2 mt-3 custom-span">
                    <span> Description </span>
                    <textarea name="tagDescription" class="form-control" style="font-size: 16px"> </textarea>
                    <?php if($errors->has('tagDescription')): ?>
                        <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong><?php echo e($errors->first('tagDescription')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div style="text-align: center; margin-top: 100px">
                <button  type="submit" class="btn btn-brand btn-icon-sm" aria-expanded="false">
                    <?php echo e(__('tag.done')); ?>

                </button>
            </div>
        </form>
    </div>
</div><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/tag/partials/add.blade.php ENDPATH**/ ?>