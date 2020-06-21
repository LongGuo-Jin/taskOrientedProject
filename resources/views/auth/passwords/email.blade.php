@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
<div style="width: 100vw; height: 100vh; position: relative; background-color: #eee">
    <div class="login-box" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%)">

        <!-- /.login-logo -->
            <div class="aje-card text-center">
                <p class="header-title">You forgot your password? <br> Here you can easily retrieve a new password.</p>

                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="aje-card-input {{ $errors->has('email') ? ' has-danger' : '' }}">
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email', 'admin@example.com') }}" required autofocus>
                        <i class="fa fa-envelope"></i>
                    </div>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                    <div class="aje-card-footer">

                        <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                        <p class="mt-3 mb-1">
                            <a href="{{route("login")}}">Login</a>
                        </p>
                        <p class="mb-0">
                            <a href="{{route("register")}}" class="text-center">Register a new membership</a>
                        </p>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection