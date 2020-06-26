@extends('layouts.layout')
@section('title')
    Add User 
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css/user/user.css')}}">
@endsection


@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
        @include('layouts.header')
        <!-- end:: Header -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

            <!-- begin:: Content -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand flaticon2-line-chart"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Add User
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">                           
                                <div class="dropdown dropdown-inline">
                                    <a class="btn btn-brand btn-icon-sm" aria-expanded="false"  href="{{route('user')}}">
                                        <i class="flaticon2-back"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
 
                    <div class="kt-portlet__body kt-portlet__body--fit" style="display: block; min-height: 500px;">
                        <!--begin: Datatable -->
                        <div> 
                            <div class="col-md-4  ml-auto mr-auto">
                                <form role="form" method="POST" action="{{ route('user.update') }}">
                                    @csrf                                     
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <div class="user-input {{ $errors->has('nameFirst') ? ' has-danger' : '' }}">
                                        <input type="text" class="form-control {{ $errors->has('nameFirst') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}" type="text" name="nameFirst" value="{{ old('nameFirst', $user->nameFirst) }}" required autofocus>
                                        <i class="fa fa-user"></i>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <div class="user-input {{ $errors->has('nameFamily') ? ' has-danger' : '' }}">
                                        <input type="text" class="form-control {{ $errors->has('nameFamily') ? ' is-invalid' : '' }}" placeholder="{{ __('Family Name') }}" type="text" name="nameFamily" value="{{ old('nameFamily', $user->nameFamily) }}" required autofocus>
                                        <i class="fa fa-user"></i>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <div class="user-input {{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email', $user->email) }}" required autofocus>
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
    
                                    <div class="user-input {{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" name="password" placeholder="{{ __('New Password') }}" type="password" value="" required>
                                        <i class="fa fa-key"></i>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
    
                                    <div class="user-input">
                                        <input type="password" class="form-control" placeholder="{{ __('Retype Password') }}" name="password_confirmation" placeholder="{{ __('Retype Password') }}" type="password" value="" required>
                                        <i class="fa fa-key"></i>
                                    </div>
                                    
                                    <select class = "form-control" style="margin-bottom: 20px;" name="roleID">
                                        <option value="1" <?php $user->roleID==1? print_r("selected"): print_r(""); ?> > Administrator </option>
                                        <option value="2" <?php $user->roleID==2? print_r("selected"): print_r(""); ?> > Project Manager </option>
                                        <option value="4" <?php $user->roleID==4? print_r("selected"): print_r(""); ?> > Memeber </option>
                                    </select>


                                    <button type="submit" class="btn btn-primary btn-block mb-3">{{ __('Update') }}</button>                                    
                                </form>
                            </div>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/components/extended/blockui.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
      
    </script>

@endsection
