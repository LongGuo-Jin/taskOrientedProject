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
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="aje-nav-link">Home</a>
                        </li>
                        <li>
                            <a href="#" class="aje-nav-link">Contact</a>
                        </li>
                        <li>
                            <a href="#" class="aje-nav-link">About US</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div style="min-height: 50vh; background-image: url('{{asset("public/images/login_back.jpg")}}')">
            {{--<img style="width: 100%; min-height: 40vh" src="{{asset("public/images/login_back.jpg")}}">--}}
            <div class="container">
                <div class="col-md-4 col-sm-6" style="margin-top: 150px">
                    <span class="brand-text-lg" > Focus on your Project ,&nbsp;  not your project management software </span>
                </div>
            </div>
        </div>
        <div class="container" >
            <div class="row">
                <div class="col-md-4 aje-testimonial" style="margin-top: 40px">
                    <div style="display: flex">
                        <i class="fa fa-quote-left"></i>
                        <div>
                            <p></p><span>Easy to learn and Pleasure to work with.</span>
                            <p class="aje-name-text" style="text-align: right">john Smith , Smith & Co.</p>
                        </div>
                        <img class="aje-avatar" src="{{asset("public/images/user5.jpg")}}">
                    </div>

                </div>
                <div class="col-md-4" style="float:right; transform: translate(0px,-15vh)">
                    <form role="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="aje-card">
                            <div class="header-title">
                                <p>Register</p>
                            </div>
                            <div class="card-body ">
                                <div class="aje-card-input {{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" type="text" name="name" value="{{ old('name', 'John Doe') }}" required autofocus>
                                    <i class="fa fa-user"></i>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                                <div class="aje-card-input {{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email', 'admin@nowui.com') }}" required autofocus>
                                    <i class="fa fa-envelope"></i>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                <div class="aje-card-input {{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" name="password" placeholder="{{ __('Password') }}" type="password" value="secret" required>
                                    <i class="fa fa-key"></i>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                <div class="aje-card-input">
                                    <input type="password" class="form-control" placeholder="{{ __('Retype Password') }}" name="password_confirmation" placeholder="{{ __('Retype Password') }}" type="password" value="secret" required>
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
