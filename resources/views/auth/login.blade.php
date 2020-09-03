@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
    <div class="content">
        <nav class="navbar navbar-fixed-top aje-navbar">
            <div class="container top">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars"></i>
                    </button>
                    <a href="/">
                    <img src="{{asset('public/images/logo-03.png')}}" class="mt-auto mb-auto" alt="logo" height="40">
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
        <div style="background-size:cover; min-height: 70vh; background-image: url('{{asset("public/images/login_bg.png")}}')">
            {{--<img style="width: 100%; min-height: 40vh" src="{{asset("public/images/login_back.jpg")}}">--}}
            <div class="container">
                <div class="col-md-5 col-sm-6" style="margin-top: 20vh">
                    <span class="brand-text-lg" > Focus on your project, not your project management <br/> software </span>
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
                            <p class="aje-name-text" style="text-align: right">John Smith, Smith & Co.</p>
                        </div>
                        <img class="aje-avatar" src="{{asset("public/assets/media/users/100_12.jpg")}}">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 aje-login-card-align">
                    <form role="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="aje-card">
                            <div class="header-title">
                                <p>Login</p>
                            </div>
                            <div class="card-body ">
                                <div class="aje-card-input {{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email', '') }}" required autofocus>
                                    <i class="fa fa-envelope"></i>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                <div class="aje-card-input {{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <input  class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" value="" required>
                                    <i class="fa fa-key"></i>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="aje-card-footer" >
                                <button type="submit" class="btn btn-primary btn-block mb-3">{{ __('Get Started') }}</button>
                                <div class="aje-footer-link">
                                    <a href="{{ route('register') }}" class="text-center">{{ __('Create Account') }}</a>
                                    <a href="{{ route('password.request') }}" class="text-center">{{ __('Forgot Password?') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
