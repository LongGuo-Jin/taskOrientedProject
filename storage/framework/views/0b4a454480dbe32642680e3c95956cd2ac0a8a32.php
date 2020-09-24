
<?php $__env->startSection('title'); ?>
    Tag | TOP
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/task/taskcard.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
        <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- end:: Header -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                <!-- begin:: Content -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="column-body">
                                <!--begin::Portlet-->
                                <div class="kt-portlet  kt-portlet--tabs">
                                    <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-toolbar">
                                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-primary list-nav-tab" role="tablist">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="la flaticon-background"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a onclick="tagDisplayType(0,1)"  class="dropdown-item" data-toggle="tab" href="#system_tag_occurrence">
                                                            <i class="fa fa-align-justify"></i>occurrence
                                                        </a>
                                                        <a onclick="tagDisplayType(0,0)"  class="dropdown-item" data-toggle="tab" href="#system_tag_color">
                                                            <i class="flaticon-laptop"></i>color
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="kt-portlet__head-actions">
                                            <div class="list-header-title">
                                                <?php echo e(__('tag.systemTag')); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body">
                                        <div class="kt-scroll" data-scroll="true">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="system_tag_occurrence">
                                                    <?php $__currentLoopData = $tags['system']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a onclick='tag("<?php echo e($tag['ID']); ?>", "1")'>
                                                            <div class="row system-tag <?php echo e($selected==$tag['ID']?"selected":""); ?>">
                                                                <div class="col-md-4">
                                                                    <span class="system-span" style="color: <?php echo e($tag['color']); ?>">
                                                                        <?php echo __('tag.'.$tag['name']); ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span> <?php echo e($tag['use_count']); ?></span>
                                                                </div>
                                                                <div class="col-md-7" style="font-size: 11px;color: <?php echo e($tag['show']==0?'gray':'black'); ?>">
                                                                    <?php echo __('tag.'.$tag['name'].'_D'); ?>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <div class="tab-pane" id="system_tag_color">
                                                    <?php $__currentLoopData = $tags['system_color']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a onclick='tag("<?php echo e($tag['ID']); ?>", "1")'>
                                                            <div class="row system-tag <?php echo e($selected==$tag['ID']?"selected":""); ?>">
                                                                <div class="col-md-4">
                                                            <span class="system-span" style="color: <?php echo e($tag['color']); ?>">
                                                                <?php echo __('tag.'.$tag['name']); ?>
                                                            </span>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span> <?php echo e($tag['use_count']); ?></span>
                                                                </div>
                                                                <div class="col-md-7" style="font-size: 11px;color: <?php echo e($tag['show']==0?'gray':'black'); ?>">
                                                                    <?php echo $tag['note']; ?>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="column-body">
                                <!--begin::Portlet-->
                                <div class="kt-portlet  kt-portlet--tabs">
                                    <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-toolbar">
                                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-primary list-nav-tab" role="tablist">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="la flaticon-background"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a onclick="tagDisplayType(1,1)"  class="dropdown-item" data-toggle="tab" href="#organization_tag_occurrence">
                                                            <i class="fa fa-align-justify"></i>occurrence
                                                        </a>
                                                        <a onclick="tagDisplayType(1,0)"  class="dropdown-item" data-toggle="tab" href="#organization_tag_color">
                                                            <i class="flaticon-laptop"></i>color
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="kt-portlet__head-actions">
                                            <div class="list-header-title">
                                                <?php echo e(__('tag.organizationTag')); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body">
                                        <div class="kt-scroll" data-scroll="true">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="organization_tag_occurrence">
                                                    <?php $__currentLoopData = $tags['organization']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a onclick='tag("<?php echo e($tag['ID']); ?>", "2")'>
                                                            <div class="row system-tag <?php echo e($selected==$tag['ID']?"selected":""); ?>">
                                                                <div class="col-md-4">
                                                                    <span class="organization-span" style="color: <?php echo e($tag['color']); ?>">
                                                                        <?php echo $tag['name']; ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span> <?php echo e($tag['use_count']); ?></span>
                                                                </div>
                                                                <div class="col-md-7" style="font-size: 11px;color: <?php echo e($tag['show']==0?'gray':'black'); ?>">
                                                                    <?php echo $tag['note']; ?>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <div class="tab-pane" id="organization_tag_color">
                                                    <?php $__currentLoopData = $tags['organization_color']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a onclick='tag("<?php echo e($tag['ID']); ?>", "2")'>
                                                            <div class="row system-tag <?php echo e($selected==$tag['ID']?"selected":""); ?>">
                                                                <div class="col-md-4">
                                                                    <span class="organization-span" style="color: <?php echo e($tag['color']); ?>">
                                                                        <?php echo $tag['name']; ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span> <?php echo e($tag['use_count']); ?></span>
                                                                </div>
                                                                <div class="col-md-7" style="font-size: 11px;color: <?php echo e($tag['show']==0?'gray':'black'); ?>">
                                                                    <?php echo $tag['note']; ?>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <?php if($roleID == 1): ?>
                                                    <div class="text-center mt-4">
                                                        <button class="btn btn-brand btn-icon-sm" aria-expanded="false" onclick="AddNewTag('organization')">
                                                            <i class="flaticon2-plus"></i> <?php echo e(__('tag.addNew')); ?>

                                                        </button>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="column-body">
                                <!--begin::Portlet-->
                                <div class="kt-portlet  kt-portlet--tabs">
                                    <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-toolbar">
                                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-primary list-nav-tab" role="tablist">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="la flaticon-background"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a onclick="tagDisplayType(2,1)"  class="dropdown-item" data-toggle="tab" href="#personal_tag_occurrence">
                                                            <i class="fa fa-align-justify"></i>occurrence
                                                        </a>
                                                        <a onclick="tagDisplayType(2,0)"  class="dropdown-item" data-toggle="tab" href="#personal_tag_color">
                                                            <i class="flaticon-laptop"></i>color
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="kt-portlet__head-actions">
                                            <div class="list-header-title">
                                                <?php echo e(__('tag.personalTag')); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body">
                                        <div class="kt-scroll" data-scroll="true">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="personal_tag_occurrence">
                                                    <?php $__currentLoopData = $tags['personal']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a onclick='tag("<?php echo e($tag['ID']); ?>", "3")'>
                                                            <div class="row system-tag <?php echo e($selected==$tag['ID']?"selected":""); ?>">
                                                                <div class="col-md-4">
                                                                    <span class="personal-span" style="color: <?php echo e($tag['color']); ?>">
                                                                        <?php echo $tag['name']; ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span> <?php echo e($tag['use_count']); ?></span>
                                                                </div>
                                                                <div class="col-md-7" style="font-size: 11px;color: <?php echo e($tag['show']==0?'gray':'black'); ?>">
                                                                    <?php echo $tag['note']; ?>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <div class="tab-pane" id="personal_tag_color">
                                                    <?php $__currentLoopData = $tags['personal_color']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a onclick='tag("<?php echo e($tag['ID']); ?>", "1")'>
                                                            <div class="row system-tag <?php echo e($selected==$tag['ID']?"selected":""); ?>">
                                                                <div class="col-md-4">
                                                                    <span class="personal-span" style="color: <?php echo e($tag['color']); ?>">
                                                                        <?php echo $tag['name']; ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span> <?php echo e($tag['use_count']); ?></span>
                                                                </div>
                                                                <div class="col-md-7" style="font-size: 11px;color: <?php echo e($tag['show']==0?'gray':'black'); ?>">
                                                                    <?php echo $tag['note']; ?>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <div class="text-center mt-4">
                                                    <button class="btn btn-brand btn-icon-sm" aria-expanded="false" onclick="AddNewTag('personal')">
                                                        <i class="flaticon2-plus"></i> <?php echo e(__('tag.addNew')); ?>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo $__env->make('tag.partials.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php if($tags['selected']): ?>
                            <?php echo $__env->make('tag.partials.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <script src="<?php echo e(asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/components/extended/blockui.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/assets/js/demo1/pages/components/extended/sweetalert2.js')); ?>" type="text/javascript"></script>

    <script type="text/javascript">
        let base_url = "<?php echo e(URL::to('')); ?>";
        
        
        let locale = "<?php echo e(app()->getLocale()); ?>";
        let roleID = "<?php echo e($roleID); ?>";
        let system = "<?php echo e($system); ?>";
        let displayType = '<?php echo e($displayType); ?>';
        let dType = [displayType[0],displayType[1],displayType[2]];
        let colors = [
            ['#FF0000','#FF0000CC','#FF000044'],
            ['#d4b04d','#d4b04dcc','#d4b04d44'],
            ['#e5ff08','#e5ff08cc',"#e5ff0844"],
            ['#08ff0f','#08ff0fcc','#08ff0f44'],
            ['#4a6f4b','#4a6f4bcc','#4a6f4b44'],
            ['#277af7','#277af7cc','#277af744'],
            ['#2a27f7','#2a27f7cc','#2a27f744'],
            ['#f72787','#f72787cc','#f7278744'],
        ];

        $('#organization_tag_occurrence').removeClass('active');
        $('#organization_tag_color').removeClass('active');
        $('#system_tag_occurrence').removeClass('active');
        $('#system_tag_color').removeClass('active');
        $('#personal_tag_color').removeClass('active');
        $('#personal_tag_occurrence').removeClass('active');
        if (dType[0]=='1') {
            $('#system_tag_occurrence').addClass('active')
        } else {
            $('#system_tag_color').addClass('active');
        }
        if (dType[1]=='1') {
            $('#organization_tag_occurrence').addClass('active')
        } else {
            console.log("active");
            $('#organization_tag_color').addClass('active');
        }

        if (dType[2]=='1') {
            $('#personal_tag_occurrence').addClass('active')
        } else {
            $('#personal_tag_color').addClass('active');
        }

        function tag(val,system) {
            window.location.href = base_url + "/tag?tagID="+ val + "&system=" + system + "&displayType="+dType[0]+dType[1]+dType[2];
        }

        function tagDisplayType(order , val) {
            dType[order] = val;
        }

        function ColorSelect(j,i) {
            $('#tagColor').val(colors[j][i]);
            color = colors[j][i];
            let colVal = 8 * i + j * 1;
            $('#tagColorValue').val(colVal);
        }

        function ColorSelectEdit(j,i) {
            if (roleID !=='1' && system === "1")
                return;
            if (system === '2' && roleID !== '1')
                return;
            $('#tagUpdate').show();

            $('#tagColorEdit').val(colors[j][i]);
            color = colors[j][i];

            let colVal = 8 * i + j * 1;
            $('#tagColorValueEdit').val(colVal);
            if (system === "1") {
                console.log("system 1");
                return;
            }
            $('#tagDelete').show();

        }

        function AddNewTag(tagType) {

            let orgTag = "<?php echo e(__('tag.orgTag')); ?>";
            let personTag = "<?php echo e(__('tag.perTag')); ?>";

            if (tagType === 'organization') {
                $('#tagTypeShow').html( '<h6>'+orgTag+'</h6>');
                $('#tagType').val('organization');
            } else if (tagType === 'personal') {
                console.log(tagType);
                $('#tagTypeShow').html( '<h6>'+personTag+'</h6>');
                $('#tagType').val('personal');
            }
            $('#tagEditCard').hide();
            $('#tagAddCard').show();

        }

        $(document).ready(function() {
            $('span').on('click' ,function (e){
                if (roleID !=='1' && system === "1")
                    return;
                if (system === '2' && roleID !== '1')
                    return;
                targetID = e.target.id;
                switch (targetID) {
                    case "tagNameEdit":
                        $('#tagNameEdit').hide();
                        $('#tagName').show();
                        break;
                    case "tagNoteEdit":
                        $('#tagNoteEdit').hide();
                        $('#tagNote').show();
                        break;
                    case "tagDescriptionEdit":
                        $('#tagDescriptionEdit').hide();
                        $('#tagDescription').show();
                        break;
                    default:
                        break;
                }
                $('#tagUpdate').show();
                if (system === "1") {
                    console.log("system 1")

                    return;
                }
                $('#tagDelete').show();

            });
            $('#tagColorEdit').on('click',function(){


            });
            $('#tagShowEdit').on('click',function() {
                if (roleID !=='1' && system === "1")
                    return;
                if (system === '2' && roleID !== '1')
                    return;
                $('#tagUpdate').show();
                if (system === "1") {
                    console.log("system 1")

                    return;
                }
                $('#tagDelete').show();

            });

        });
    </script>
    <script type="text/javascript" charset="utf-8" src="<?php echo e(asset('public/assets/js/task/taskcard.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/tag/index.blade.php ENDPATH**/ ?>