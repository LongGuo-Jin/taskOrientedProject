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
                    <img src="{{asset('public/images/logo.png')}}" alt="logo" height="45"></a>
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
                <div class="col-md-4 col-sm-6" style="margin-top: 20vh">
                    <span class="brand-text-lg" > Focus on your Project ,&nbsp;  not your project management software </span>
                </div>
            </div>
        </div>
        <div class="container" >
            <div class="row">
                <div class="col-md-4 col-sm-6  aje-testimonial" style="margin-top: 40px">
                    <div style="display: flex">
                        <i class="fa fa-quote-left"></i>
                        <div style="font-family: 'Cormorant', serif; font-weight: bold">
                            <span>Easy to learn and Pleasure to work with.</span>
                            <p class="aje-name-text" style="text-align: right">john Smith , Smith & Co.</p>
                        </div>
                        <img class="aje-avatar" src="{{asset("public/images/user5.jpg")}}">
                    </div>
                </div>
                <div class="col-md-4  aje-login-card-align">
                    <form role="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="aje-card">
                            <div class="header-title">
                                <p>Register</p>
                            </div>
                            <div class="card-body ">
                                <div class="aje-card-input {{ $errors->has('nameFirst') ? ' has-danger' : '' }}">
                                    <input type="text" class="form-control {{ $errors->has('nameFirst') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}" type="text" name="nameFirst" value="{{ old('nameFirst', '') }}" required autofocus>
                                    <i class="fa fa-user"></i>
                                </div>
                                @if ($errors->has('nameFirst'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('nameFirst') }}</strong>
                                    </span>
                                @endif
                                <div class="aje-card-input {{ $errors->has('nameFamily') ? ' has-danger' : '' }}">
                                    <input type="text" class="form-control {{ $errors->has('nameFamily') ? ' is-invalid' : '' }}" placeholder="{{ __('Family Name') }}" type="text" name="nameFamily" value="{{ old('nameFamily', '') }}" required autofocus>
                                    <i class="fa fa-user"></i>
                                </div>
                                @if ($errors->has('nameFamily'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('nameFamily') }}</strong>
                                    </span>
                                @endif
                                <div class="aje-card-input {{ $errors->has('organization') ? ' has-danger' : '' }}">
                                    <input type="text" class="form-control {{ $errors->has('organization') ? ' is-invalid' : '' }}" placeholder="{{ __('Organization Name') }}" type="text" name="organization" value="{{ old('organization', '') }}" required autofocus>
                                    <i class="fa fa-group"></i>
                                </div>
                                @if ($errors->has('organization'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                @endif

                                <div class="aje-card-input {{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email', '') }}" required autofocus>
                                    <i class="fa fa-envelope"></i>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                <div class="aje-card-input {{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" name="password" placeholder="{{ __('Password') }}" type="password" value="" required>
                                    <i class="fa fa-key"></i>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                <div class="aje-card-input">
                                    <input type="password" class="form-control" placeholder="{{ __('Retype Password') }}" name="password_confirmation" placeholder="{{ __('Retype Password') }}" type="password" value="" required>
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="aje-card-footer" >
                                <button type="submit" class="btn btn-primary btn-block mb-3">{{ __('Get Started') }}</button>
                                <div class="text-center">
                                    <a href="{{ route('login') }}" class="text-center">{{ __('I already have a membership') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
