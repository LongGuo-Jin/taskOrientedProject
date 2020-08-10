<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>

    <!--begin::Base Path (base relative path for assets of this page) -->
    <base href=".">

    <!--end::Base Path -->
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}" >

    <script src="{{asset('public/assets/js/webfont.js')}}"></script>
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

    <!--end::Fonts -->
    <!--begin:: Global Mandatory Vendors -->
    <link href="{{asset('public/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />

    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <link href="{{asset('public/assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/vendors/general/animate.css/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/vendors/general/toastr/build/toastr.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/vendors/general/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/vendors/general/sweetalert2/dist/sweetalert2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/vendors/general/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/vendors/custom/vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/vendors/custom/vendors/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />

    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{asset('public/assets/css/demo1/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{asset('public/assets/css/demo1/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/css/demo1/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/css/demo1/skins/brand/dark.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/css/demo1/skins/aside/dark.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{asset('public/assets/media/logos/favicon.ico')}}" />

    @yield('style')

</head>

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page" id="app">
            @include('layouts.withmenu')
            @yield('content')
        </div>
    </div>

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>

    <!-- end::Global Config -->

    <!--begin:: Global Mandatory Vendors -->
    <script src="{{asset('public/js/app.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/wnumb/wNumb.js')}}" type="text/javascript"></script>

    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <script src="{{asset('public/assets/vendors/general/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/custom/js/vendors/bootstrap-notify.init.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/jquery-validation/dist/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/jquery-validation/dist/additional-methods.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/custom/js/vendors/jquery-validation.init.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/general/sweetalert2/dist/sweetalert2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/custom/js/vendors/sweetalert2.init.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/vendors/custom/flot/flot.bundle.js')}}" type="text/javascript"></script>


    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="{{asset('public/assets/js/demo1/scripts.bundle.js')}}" type="text/javascript"></script>

    <!--end::Global Theme Bundle -->

    <script type="text/javascript" charset="utf-8" src="{{asset('public/assets/js/task/taskcard.js')}}"></script>

    @yield('script');

</body>
</html>
