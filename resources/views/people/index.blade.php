@extends('layouts.layout')
@section('title')
    People
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css/people/people.css')}}">
@endsection

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" style="padding-top: 90px !important;" id="kt_wrapper">
    @include('layouts.header')
        <div class="row m-0">
            <div class="col-lg-7">
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
                                        <div style="display: flex">
                                            <h3> <i class="fa fa-eye person_eye_icon" id="{{$sections[$index]."eye"}}" onclick="section({{$index}})"></i> {{$sections[$index]}}</h3>
                                            &nbsp;&nbsp;&nbsp;<h4> {{count($item)}} of {{$people[$index1.'_count']}}</h4>
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
                                                            @switch($person['avatarType'])
                                                                @case (1)
                                                                <svg width="32" height="32">
                                                                    <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="{{$person['avatarColor']}}"></circle>
                                                                    <text x="5" y="22"  style="fill:black;font-size: 16px">{{$person['nameTag']}}</text>
                                                                    @break
                                                                    @case (2)
                                                                    {{--//rect--}}
                                                                    <svg width="32" height="32">
                                                                        <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="{{$person['avatarColor']}}" style="stroke-width:0;"></rect>
                                                                        <text x="5" y="22" style="fill:black;font-size: 16px">{{$person['nameTag']}}</text>

                                                                        @break
                                                                        @case (3)
                                                                        {{--//polygon 5--}}
                                                                        <svg width="32" height="32">
                                                                            <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="{{$person['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$person['nameTag']}}</text>

                                                                            @break
                                                                            @case (4)
                                                                            {{--//polygon 6--}}
                                                                            <svg width="32" height="32" >
                                                                                <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="{{$person['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                <text x="5" y="22" style="fill:black;font-size: 16px">{{$person['nameTag']}}</text>

                                                                                @break
                                                                                @case (5)
                                                                                {{--//rotated rectangle--}}
                                                                                <svg width="32" height="32">
                                                                                    <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="{{$person['avatarColor']}}" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                    <text x="5" y="22" style="fill:black;font-size: 16px">{{$person['nameTag']}}</text>

                                                                                    @break
                                                                                    @endswitch
                                                                                    @switch($person['roleID'])
                                                                                        @case (1)
                                                                                        <circle cx="28" cy="4" r="3" stroke="black" stroke-width="0" fill="black"></circle>
                                                                                        <rect height="8" width="2" x="27" y="0" fill="black"></rect>
                                                                                        <polygon points="25.145898644316,1.1974823013079 24.145898266966,2.9295328910135 30.854099523987,6.802519564103 31.854101033387,5.0704696279878 " fill = "black" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                        <polygon points="24.14589756732,5.0704645899847 25.14589681262,6.8025158332799 31.854103132324,2.9295379290175 30.854105019076,1.1974860321334 " fill = "black" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                        @break
                                                                                        @case (2)
                                                                                        <polygon points="28,0 25.648857298782,7.2360667481539 31.804227357789,2.7639360007462 24.195775873739,2.7639260551337 30.35113424097,7.2360728948744 " fill = "black" style="stroke:purple;stroke-width:0;"></polygon>
                                                                                        @break
                                                                                        @case (4)
                                                                                        <circle cx="28" cy="4" r="4" stroke="black" stroke-width="0" fill = "black" style="stroke-width:0;"></circle>
                                                                                        @break
                                                                                    @endswitch
                                                                                </svg>
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
            <div class="col-lg-5">
                @if($selected_person != null)
                    @include('people.partials.details')
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')

<script src="{{asset('public/assets/js/people/people.js')}}" type="text/javascript"></script>
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