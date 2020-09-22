@extends('layouts.layout')
@section('title')
    User | TOP
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
                                {{$organization}} >> {{__('user.userList')}}
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <div class="dropdown dropdown-inline">
                                    <a class="btn btn-brand btn-icon-sm" aria-expanded="false"  href="{{route('user.add')}}">
                                        <i class="flaticon2-plus"></i> {{__('user.addNew')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <!--begin: Datatable -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover data-table">
                                <thead class="table table-bordered table-striped table-hover data-table">
                                    <tr >
                                        <th data-field="ID" >
                                            <span >{{__('user.id')}}</span>
                                        </th>
                                        <th data-field="nameFirst">
                                            <span>{{__('user.firstName')}}</span>
                                        </th>
                                        <th data-field="nameFamily">
                                            <span>{{__('user.familyName')}}</span>
                                        </th>
                                        <th data-field="Email">
                                            <span>{{__('user.email')}}</span>
                                        </th>
                                        <th data-field="Role">
                                            <span>{{__('user.role')}}</span>
                                        </th>
                                        <th data-field="Actions" data-autohide-disabled="false">
                                            <span>{{__('user.actions')}}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index=>$user)
                                        <tr>
                                            <td data-field="ID">
                                                <span> {{$index + 1}} </span>
                                            </td>
                                            <td data-field="nameFirst">
                                                <span>{{$user->nameFirst}}</span>
                                            </td>
                                            <td data-field="nameFamily">
                                                <span> {{$user->nameFamily}} </span>
                                            </td>
                                            <td data-field="Email">
                                                <span>{{$user->email}}</span>
                                            </td>
                                            <td data-field="Role">
                                                <span> 
                                                    @switch($user->roleID )
                                                        @case(1)
                                                        {{__('user.administrator')}}
                                                            @break
                                                        @case(2)
                                                        {{__('user.projectManager')}}
                                                            @break
                                                        @case(4)
                                                        {{__('user.member')}}
                                                            @break
                                                        @default                                                            
                                                    @endswitch
                                                </span>
                                            </td>

                                            <td data-field="Actions" data-autohide-disabled="false" >
                                                <span style="overflow: visible; position: relative; width: 110px;">						
                                                <a title="Edit details" class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{route('user.edit' , ['id'=>$user->id])}}">
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                    <a title="Delete" class="btn btn-sm btn-clean btn-icon btn-icon-md"  onclick="OnDelete({{$user->id}})">
                                                        <i class="la la-trash"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <form id="deleteForm" method="get" action="{{ route('user.delete') }}" hidden>
        @csrf
        <input type="text" id="deleteID" name="id" value="" />
    </form>
    <div class="passwordrequestbackground" style="display: none">
        <div class="PasswordRequestCard">
            <p class="user-input-para text-center"> {{__('user.adminPassword')}} </p>
            <div class="user-input">
                <input type="password" class="form-control" placeholder="{{__('user.adminPassword')}}"  id="AdminPassword" name="AdminPassword"  required autofocus>
                <i class="fa fa-key"></i>
            </div>
            <button class="form-control btn btn-primary" onclick="AskPassword()">{{__('user.ok')}}</button>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/components/extended/blockui.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        function OnDelete(id) {
            $('#deleteID').val(id);
            $('.passwordrequestbackground').show();
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function AskPassword() {
            let pwd = $("#AdminPassword").val();
            let passwordForm = $('.passwordrequestbackground');
            let form = $('#deleteForm');

            console.log(pwd);
            $.ajax({
                type: 'POST',
                url: 'user/admin-password',
                data: {password: pwd},
                success : (data) => {
                    if (data.success == true) {
                        passwordForm.hide();
                        form[0].submit();
                        console.log(form)
                    } else {
                        passwordForm.hide();
                        alert("Wrong Password!");
                    }
                },
                error: (error) =>  {
                    passwordForm.hide();
                    alert("Something went Wrong!");
                }
            });
        }
    </script>

@endsection
