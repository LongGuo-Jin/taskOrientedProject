

<?php $__env->startSection('title'); ?>
    Login
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <nav class="navbar navbar-fixed-top aje-navbar">
            <div class="container top">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars"></i>
                    </button>
                    <a href="/">
                    <img src="<?php echo e(asset('public/images/logo-03.png')); ?>" class="mt-auto mb-auto" alt="logo" height="40">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="aje-nav-link">About</a>
                        </li>
                        <li>
                            <a href="#" class="aje-nav-link">Pricing</a>
                        </li>
                        <li>
                            <a href="#" class="aje-nav-link">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div style="background-size:cover; min-height: 70vh; background-image: url('<?php echo e(asset("public/images/login_bg.png")); ?>')">
            
            <div class="container">
                <div class="col-md-5 col-sm-6" style="margin-top: 20vh">
                    <span class="brand-text-lg" > Focus on your project , not your project management <br/> software </span>
                </div>
            </div>
        </div>
        <div class="container" >
            <div class="row">
                <div class="col-md-4 col-sm-6  aje-testimonial" style="margin-top: 40px">
                    <div style="display: flex">
                        <i class="fa fa-quote-left"></i>
                        <div style="font-family: 'Cormorant', serif; font-weight: bold">
                            <span>Easy to learn and pleasure to work with.</span>
                            <p class="aje-name-text" style="text-align: right">john Smith , Smith & Co.</p>
                        </div>
                        <img class="aje-avatar" src="<?php echo e(asset("public/assets/media/users/100_12.jpg")); ?>">
                    </div>
                </div>
                <div class="col-md-4  aje-login-card-align">
                    <form role="form" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="aje-card">
                            <div class="header-title">
                                <p>Register</p>
                            </div>
                            <div class="card-body ">
                                <div class="aje-card-input <?php echo e($errors->has('nameFirst') ? ' has-danger' : ''); ?>">
                                    <input type="text" class="form-control <?php echo e($errors->has('nameFirst') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('First Name')); ?>" type="text" name="nameFirst" value="<?php echo e(old('nameFirst', '')); ?>" required autofocus>
                                    <i class="fa fa-user"></i>
                                </div>
                                <?php if($errors->has('nameFirst')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('nameFirst')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <div class="aje-card-input <?php echo e($errors->has('nameFamily') ? ' has-danger' : ''); ?>">
                                    <input type="text" class="form-control <?php echo e($errors->has('nameFamily') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Family Name')); ?>" type="text" name="nameFamily" value="<?php echo e(old('nameFamily', '')); ?>" required autofocus>
                                    <i class="fa fa-user"></i>
                                </div>
                                <?php if($errors->has('nameFamily')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('nameFamily')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <div class="aje-card-input <?php echo e($errors->has('organization') ? ' has-danger' : ''); ?>">
                                    <input type="text" class="form-control <?php echo e($errors->has('organization') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Organization Name')); ?>" type="text" name="organization" value="<?php echo e(old('organization', '')); ?>" required autofocus>
                                    <i class="fa fa-group"></i>
                                </div>
                                <?php if($errors->has('organization')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('organization')); ?></strong>
                                    </span>
                                <?php endif; ?>

                                <div class="aje-card-input <?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
                                    <input type="email" class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Email')); ?>" type="email" name="email" value="<?php echo e(old('email', '')); ?>" required autofocus>
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>

                                <div class="aje-card-input <?php echo e($errors->has('password') ? ' has-danger' : ''); ?>">
                                    <input type="password" class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Password')); ?>" name="password" placeholder="<?php echo e(__('Password')); ?>" type="password" value="" required>
                                    <i class="fa fa-key"></i>
                                </div>
                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>

                                <div class="aje-card-input">
                                    <input type="password" class="form-control" placeholder="<?php echo e(__('Retype Password')); ?>" name="password_confirmation" placeholder="<?php echo e(__('Retype Password')); ?>" type="password" value="" required>
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="aje-card-footer" >
                                <button type="submit" class="btn btn-primary btn-block mb-3"><?php echo e(__('Get Started')); ?></button>
                                <div class="text-center">
                                    <a href="<?php echo e(route('login')); ?>" class="text-center"><?php echo e(__('I already have a membership')); ?></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/auth/register.blade.php ENDPATH**/ ?>