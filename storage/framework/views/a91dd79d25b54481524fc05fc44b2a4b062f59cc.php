<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>TaskOrientedProjects</title>


    <style>
        /*
    ################
                   Email page style
    ################
    */
        body{

        }
        .section-gap {
            padding: 40px; }
        @media (max-width: 419px) {
            .section-gap {
                padding: 20px 0px; } }
        @media (min-width: 420px) and (max-width: 767px) {
            .section-gap {
                padding: 20px 0; } }
        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        @media (min-width: 768px){
            .container {
                max-width: 720px;
            }
        }

        @media (min-width: 992px){
            .container {
                max-width: 960px;
            }
        }

        #email_section {
            margin-top: -30px;
            background-size: cover;
            background-color: #bebec2;
            background-position: center;
            background-repeat: no-repeat; }
        @media (max-width: 420px) {
            #email_section {
                margin-top: -20px;
                min-height: 10rem;
            }
            #email_section #email_detail_home {
                position: relative;
                background-color: #fff;
                border-radius: 5px;
                min-height: 10rem;
            }
        }
        #email_section #email_detail_home {
            position: relative;
            background-color: #fff;
            border-radius: 5px;
            min-height: 20rem;
        }
        #email_section #email_detail_home img {
            max-height: 35px; }
        @media (max-width: 420px) {
            #email_section #email_detail_home img {
                max-height: 30px; } }
        #email_section #email_detail_home hr {
            border: solid 1.2px #9600b3; }
        #email_section #email_detail_home #email_footer {
            margin-top: 20rem;
            padding-bottom: 20px; }
        #email_section #email_detail_home #email_footer p {
            font-size: 14px; }
        @media (max-width: 420px) {
            #email_section #email_detail_home #email_footer {
                margin-top: 5rem; } }
        #email_section #email_detail_home p {
            font-style: normal;
            font-size: 18px;
            line-height: 1.3;
        }
        @media (max-width: 420px) {
            #email_section #email_detail_home {
                display: block !important;
                margin-top: 20px !important; } }
        .mt-40 {
            margin-top: 40px;
        }
        .p-20 {
            padding: 20px;
        }

        .text-center {
            text-align: center !important;
        }

        .align-items-center {
            -ms-flex-align: center !important;
            align-items: center !important;
        }

        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .mt-15 {
            margin-top: 15px;
        }

        @media (min-width: 768px){
            .col-md-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
        }

        @media (min-width: 576px){
            .col-sm-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%;
            }
        }

        .col-10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }

        .save-btn {
            background: #9600b3;
            color: #fff;
            line-height: 24px;
            border-radius: 25px;
            border: 1px solid #9600b3;
            display: inline-block;
            padding: 5px 30px;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            position: relative;
        }

        .save-btn:hover {
            background: #fff;
            color: #9600b3;
        }

        .text-left {
            text-align: left !important;
        }

        a, a:focus, a:hover {
            color: #9600b3;
            font-weight: normal;
            font-size: 17px;
            text-decoration: none;
            outline: 0;
        }

        h3 {
            font-size: 24px;
        }

        h1, h2, h3, h4, h5, h6 {
            line-height: 1.2em;
        }
    </style>
</head>

<body>
<!-- Start main body Area -->
<div class="text-center" style="height: 80px; background-color: #253356; padding: 12px">
    <img id="logo" src="http://localhost/taskOriented/public/images/logo-03.png" height="60%" alt="Logo" style="text-align: center">
</div>
<div id="email_section" class="section-gap">
    <div class="container">
        <div id="email_detail_home" class="mt-40 p-20">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10 col-sm-10 col-10 text-left mt-20">
                    <h3><?php echo e($subject ?? ''); ?></h3>
                    <p class="mt-20">
                    <?php
                        $length = count( $messages ?? []); ?>
                        Following tasks have the End date due today: <br/>
                        <ul>
                            <?php for($i = 0; $i < $length; $i ++): ?>
                                <li>
                                <?php for($j = count($messages[$i]) -1; $j >= 0; $j --): ?>
                                    <a href="https://taskorientedprojects.com/task/taskCard?task_id=<?php echo e($messages[$i][$j]['ID']); ?>"><?php echo e($messages[$i][$j]['title']); ?></a>
                                    <?php if($j != 0): ?>
                                        &nbsp;>&nbsp;
                                    <?php endif; ?>
                                <?php endfor; ?>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-center" style="height: 25px; background-color: #253356; padding: 12px">
    <span class="mt-auto mb-auto" style=" font-size: 14px; color: white">Copyright © 2019 - <?php echo e(date("Y")); ?> AVG, Alfred Vesligaj s.p., All Rights Reserved</span>
</div>

</body>

</html><?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/mail/overdue.blade.php ENDPATH**/ ?>