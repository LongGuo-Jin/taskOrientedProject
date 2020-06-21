@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
    <div style="width: 100vw; height: 100vh; position: relative; background-color: #eee">
        <div class="login-box" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%)">
            <div class="aje-card text-center">
                <p class="header-title">You forgot your password? Here you can easily retrieve a new password.</p>

                <form action="{{ route('password.request') }}" method="post">
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
                            <button type="submit" class="btn btn-primary btn-block mb-3">{{ __('Request a New Password') }}</button>
                            <p class="mt-3 mb-1">
                                <a href="{{route("login")}}">Login</a>
                            </p>
                            <p class="mb-0">
                                <a href="{{route("register")}}" class="text-center">Register a new membership</a>
                            </p>
                        </div>
                    </div>
                </form>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

@endsection