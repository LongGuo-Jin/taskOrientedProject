<!DOCTYPE html>
<html lang="en">

<head>

    <!--begin::Base Path (base relative path for assets of this page) -->
    <base href=".">

    <!--end::Base Path -->
    <meta charset="utf-8" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" >

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

    <script src="<?php echo e(asset('public/assets/js/webfont.js')); ?>"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <!--end::Fonts -->
    <link href="<?php echo e(asset('public/css/app.css')); ?>" rel="stylesheet" type="text/css" />
    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="<?php echo e(asset('public/assets/media/logos/favicon.ico')); ?>" />
    <?php echo $__env->yieldContent('style'); ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <div class="text-center" style="height: 42px; background-color: #253356; padding: 12px">
        <span class="mt-auto mb-auto" style=" font-size: 14px; color: white">Copyright © 2019 - <?php echo e(date("Y")); ?> AVG, Alfred Vesligaj s.p., All Rights Reserved</span>
    </div>
    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script src="<?php echo e(asset('public/js/app.js')); ?>" type="text/javascript"></script>
    <?php echo $__env->yieldContent('script'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/layouts/app.blade.php ENDPATH**/ ?>