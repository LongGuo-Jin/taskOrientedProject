<!DOCTYPE html>
<html lang="en">

<head>

    <!--begin::Base Path (base relative path for assets of this page) -->
    <base href=".">

    <!--end::Base Path -->
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}" >

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

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

    <link href="{{asset('public/css/app.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/css/adminlte.css')}}" rel="stylesheet" type="text/css" />
    {{--<link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />--}}

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{asset('public/assets/media/logos/favicon.ico')}}" />

    @yield('style')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        {{--@include('partials.sidebar')--}}
        {{--@include('partials.nav')--}}
        @yield('content')
    </div>

<!-- begin::Global Config(global config for global JS sciprts) -->

<script src="{{asset('public/js/app.js')}}" type="text/javascript"></script>

@yield('script')

</body>
</html>
