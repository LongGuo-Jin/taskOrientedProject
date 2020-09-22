@extends('layouts.layout')
@section('title')
    People | TOP
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css/people/people.css')}}">
@endsection

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" style="padding-top: 90px !important;" id="kt_wrapper">
    @include('layouts.header')
        <div class="row m-0">
            <div class="col-lg-8">
                <div style="display: flex">
                    <div class="filter_menu">
                        <?php
                            $alphas = ['All','A','B','C','D','E','F','G',
                                'H','I','J','K','L','M','N','O','P','Q','R','S',
                                'T','U','V','W','X','Y','Z']
                        ?>
                        @foreach($alphas as $alpha_item)
                            <a href="{{route('people',['alpha' => $alpha_item])}}">
                                @if($alpha == $alpha_item)
                                    <div class="filter_item_selected"> {{$alpha_item}} </div>
                                @else
                                    <div class="filter_item"> {{$alpha_item}} </div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                        <?php
                            $sections = ['Employees' , 'Partners' , 'Customers' , 'Contacts'];
                            $index = 0;
                        ?>
                    <div class="people_outer">
                        <div class="people_inner">
                            <div class="people_element">
                                @foreach($people as $index1=>$item)
                                    @if(is_array($item))
                                        <div style="display: flex; justify-content: space-between">
                                            <div style="display: flex">
                                                <h3> <i class="fa fa-eye person_eye_icon" id="{{$sections[$index]."eye"}}" onclick="section({{$index}})"></i> {{$sections[$index]}}</h3>
                                                &nbsp;&nbsp;&nbsp;<h4> {{count($item)}} of {{$people[$index1.'_count']}}</h4>
                                            </div>
                                            @if($sections[$index] == "Employees")<button class="form-control btn btn-primary" style="width: 20%;" id="addPerson"> Add Person </button>@endif
                                        </div>
                                        <div style="width: 100%; height: 1px; background-color: rgba(99,99,99,0.72)"></div>
                                        <div class="people_section" id="{{$sections[$index ++]}}">
                                            @foreach($item as $person)
                                                <a href="{{route('people',['alpha' => $alpha,'select'=>$person['id']])}}">
                                                    <div class="<?php if ($person['id'] == $selectedID) echo 'person_card_selected'; else echo 'person_card'; ?>">
                                                        <div style="width: 10%; background-color: #d1ffa7; border-bottom-left-radius: 10px; border-top-left-radius: 10px;"></div>
                                                        <div style="width: 77%; padding: 10px">
                                                            <div style="font-size: 20px; margin-bottom: 5px">
                                                                {{$person['nameFirst'].' '.$person['nameMiddle'].' '.$person['nameFamily']}}
                                                            </div>
                                                            <div style="font-size: 16px; margin-bottom: 5px">
                                                                EMPLOYEE,@if($person['roleID']==1) ADMIN @elseif($person['roleID']==2) Manager @elseif($person['roleID']==4) Member @endif
                                                            </div>
                                                            <div class="people_card_text">
                                                                <div>
                                                                    From:&nbsp;
                                                                </div>
                                                                <div> {{$person['address']}} </div>
                                                            </div>
                                                            <div class="people_card_text">
                                                                <div>
                                                                    Org:&nbsp;
                                                                </div>
                                                                <div> {{$person['organization']}} </div>
                                                            </div>
                                                            <div class="people_card_text">
                                                                <div>
                                                                    Phone:&nbsp;
                                                                </div>
                                                                <div> {{$person['phone_number']}} </div>
                                                            </div>
                                                            <div class="people_card_text">
                                                                <div>
                                                                    Mail:&nbsp;
                                                                </div>
                                                                <div> {{$person['email']}} </div>
                                                            </div>
                                                        </div>
                                                        <div style="width: 13%; padding-top: 10px" >
                                                            <x-user-avatar :type="$person['avatarType']" :nameTag="$person['nameTag']" :roleID="$person['roleID']" :color="$person['avatarColor']" />
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @if($selected_person != null)
                    @include('people.partials.details')
                @endif
                @include('people.partials.add')
            </div>
        </div>
    </div>
@endsection
@section('script')

<script src="{{asset('public/assets/js/people/people.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>

<script>
    let alpha = "{{$alpha}}";
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