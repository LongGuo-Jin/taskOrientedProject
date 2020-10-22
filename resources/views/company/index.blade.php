@extends('layouts.layout')
@section('title')
    Organization | TOP
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css/company/company.css')}}">
@endsection

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" style="padding-top: 90px !important;" id="kt_wrapper">
        @include('layouts.header')
        <div class="row m-0">
            <div class="col-lg-8">
                <div style="display: flex">
                    <div style="width: 80%; height: 1px; margin-top: auto;background-color: rgba(99,99,99,0.72)"></div>
                    <button class="form-control btn btn-primary" style="width: 20%;" id="addCompany">{{__('people.addOrganization')}} </button>
                </div>
                <div class="company_outer">
                    <div class="company_inner">
                        <div class="company_element">
                            <div style="display:flex; flex-wrap: wrap">
                            @foreach($companies as $company)
                                    <div data-select = {{$company['id']}} class="<?php if ($company['id'] == $selectedID) echo 'company_card_selected'; else echo 'company_card'; ?>">
                                        <div style="width: 10%; background-color: #377aff; border-bottom-left-radius: 10px; border-top-left-radius: 10px;"></div>
                                        <div style="width: 90%; padding: 10px">
                                            <div style="font-size: 20px; margin-bottom: 5px">
                                                {{$company['short_name']}}
                                            </div>
                                            <div class="mt-1 mb-1">
                                                {{$company['country']}}
                                            </div>
                                            <div class="company_card_text">
                                                <div>
                                                    {{__('people.from')}}:&nbsp;
                                                </div>
                                                <div> {{$company['address']}} </div>
                                            </div>
                                            <div class="company_card_text">
                                                <div>
                                                    {{__('people.mgr')}}:&nbsp;
                                                </div>
                                                <div>  </div>
                                            </div>
                                            <div class="company_card_text">
                                                <div>
                                                    {{__('people.contact')}}:&nbsp;
                                                </div>
                                                <div>  </div>
                                            </div>
                                            <div class="company_card_text">
                                                <div>
                                                    {{__('people.phone')}}:&nbsp;
                                                </div>
                                                <div> {{$company['phone']}} </div>
                                            </div>
                                            <div class="company_card_text">
                                                <div>
                                                    {{__('people.mail')}}:&nbsp;
                                                </div>
                                                <div> {{$company['email']}} </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @if($selected_company != null)
                    @include('company.partials.edit')
                @endif
                    @include('company.partials.add')
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script src="{{asset('public/assets/js/company/company.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>

    <script>
        let base_url = "{{URL::to('')}}";
        function section(id) {
            switch (id) {
                case 0:
                    $('#Employees').toggle();
                    if($('#Employeeseye').hasClass('person_eye_icon')) {
                        $('#Employeeseye').removeClass('person_eye_icon');
                        $('#Employeeseye').addClass('person_eye_icon_selected');
                    } else {
                        $('#Employeeseye').addClass('person_eye_icon');
                        $('#Employeeseye').removeClass('person_eye_icon_selected');
                    }
                    break;
                case 1:
                    $('#Partners').toggle();
                    if($('#Partnerseye').hasClass('person_eye_icon')) {
                        $('#Partnerseye').removeClass('person_eye_icon');
                        $('#Partnerseye').addClass('person_eye_icon_selected');
                    } else {
                        $('#Partnerseye').addClass('person_eye_icon');
                        $('#Partnerseye').removeClass('person_eye_icon_selected');
                    }
                    break;
                case 2:
                    $('#Customers').toggle();
                    if($('#Customerseye').hasClass('person_eye_icon')) {
                        $('#Customerseye').removeClass('person_eye_icon');
                        $('#Customerseye').addClass('person_eye_icon_selected');
                    } else {
                        $('#Customerseye').addClass('person_eye_icon');
                        $('#Customerseye').removeClass('person_eye_icon_selected');
                    }
                    break;
                case 3:
                    $('#Contacts').toggle();
                    if($('#Contactseye').hasClass('person_eye_icon')) {
                        $('#Contactseye').removeClass('person_eye_icon');
                        $('#Contactseye').addClass('person_eye_icon_selected');
                    } else {
                        $('#Contactseye').addClass('person_eye_icon');
                        $('#Contactseye').removeClass('person_eye_icon_selected');
                    }
                    break;
            }
        }
    </script>
@endsection