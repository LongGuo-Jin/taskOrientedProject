@extends('layouts.layout')
@section('title')
    User Settings | TOP
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
                                {{__('user.userSettings')}}
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <div class="dropdown dropdown-inline">
                                    <a class="btn btn-brand btn-icon-sm" aria-expanded="false"  href="{{route('dashboard')}}">
                                        <i class="flaticon2-back"></i> {{__('user.back')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__body kt-portlet__body--fit" style="display: block; min-height: 500px;">
                        <!--begin: Datatable -->
                        <form role="form" method="POST" id="UserEdit" action="{{ route('user.saveSetting') }}" class="mt-4">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-md-offset-2 mt-5 ml-auto mr-auto">
                                <span style="font-size:22px; color: #1e1e2d;"> {{$user->email}} </span>
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <p class="user-input-para"> {{__('user.firstName')}}:</p>
                                    <div class="user-input {{ $errors->has('nameFirst') ? ' has-danger' : '' }}">
                                        <input type="text" class="form-control {{ $errors->has('nameFirst') ? ' is-invalid' : '' }}" placeholder="{{__('user.firstName')}}"  name="nameFirst" value="{{ old('nameFirst', $user->nameFirst) }}" required autofocus>
                                        <i class="fa fa-user"></i>
                                    </div>
                                    @if ($errors->has('nameFirst'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('nameFirst') }}</strong>
                                        </span>
                                    @endif
                                    <p class="user-input-para"> {{__('user.familyName')}}:</p>
                                    <div class="user-input {{ $errors->has('nameFamily') ? ' has-danger' : '' }}">
                                        <input type="text" class="form-control {{ $errors->has('nameFamily') ? ' is-invalid' : '' }}" placeholder="{{__('user.familyName')}}" name="nameFamily" value="{{ old('nameFamily', $user->nameFamily) }}" required autofocus>
                                        <i class="fa fa-user"></i>
                                    </div>
                                    @if ($errors->has('nameFamily'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('nameFamily') }}</strong>
                                        </span>
                                    @endif
                                    <p class="user-input-para"> {{__('user.newPassword')}}:</p>

                                    <div class="user-input {{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{__('user.newPassword')}}" name="password"  value="">
                                        <i class="fa fa-key"></i>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="col-md-4 col-md-offset-2  mt-5 ml-auto mr-auto">
                                <span style="font-size:22px; color: #1e1e2d;margin-bottom: 50px"> {{__("user.avatarEditor")}} </span>
                                <div class="row  mt-4" >
                                    <div class="col-3">
                                        <span style="font-size:18px; color: #1e1e2d">{{__('user.initials')}}:</span>
                                    </div>
                                    <div class="col-9">
                                        <span style="font-size:18px; color: #1e1e2d">{{$user->nameTag}}</span>
                                    </div>
                                </div>
                                <div class="row  mt-4" >
                                    <div class="col-3">
                                        <span style="font-size:18px; color: #1e1e2d">{{__('user.shape')}}:</span>
                                    </div>
                                    <div class="col-9">
                                        <input type="hidden" name="avatarType" id="avatarType" value="{{$user->avatarType}}">
                                        <i class="flaticon2-back-1" onclick="avatarBack()"></i>
                                        {{--//circle--}}
                                        <svg width="32" height="32" id="avatar1">
                                            <circle cx="16" cy="16" r="16"  stroke-width="0" fill="red"></circle>
                                        </svg>

                                        {{--//rect--}}
                                        <svg width="32" height="32" id="avatar2">
                                            <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="red" style="stroke-width:0;"></rect>
                                        </svg>

                                        {{--//polygon 5--}}
                                        <svg width="32" height="32" id="avatar3">
                                            <polygon fill="red" points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " style="stroke:purple;stroke-width:0;"></polygon>
                                        </svg>

                                        {{--//polygon 6--}}
                                        <svg width="32" height="32" id="avatar4">
                                            <polygon fill="red" points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 " style="stroke:purple;stroke-width:0;"></polygon>
                                        </svg>

                                        {{--//rotated rectangle--}}
                                        <svg width="32" height="32" id="avatar5">
                                            <polygon fill="red" points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " style="stroke:purple;stroke-width:0;"></polygon>
                                        </svg>

                                        <i class="flaticon2-arrow" onclick="avatarNext()"></i>
                                    </div>
                                </div>
                                <div class="row  mt-4" >
                                    <div class="col-3">
                                        <span style="font-size:18px; color: #1e1e2d">{{__('user.color')}}:</span>
                                    </div>
                                    <div class="col-9">
                                        <input type="hidden" name="avatarColor" id="avatarColor" value="{{$user->avatarColor}}">
                                        <input type="hidden" name="avatarColorValue" id="avatarColorValue" value="{{$user->avatarColorValue}}">
                                        <?php
                                        $colorValue = $user->avatarColorValue * 1;

                                        $col = ($colorValue % 8) * 1;
                                        $row = (($colorValue-$col) / 8) * 1;
                                        $colors = [
                                            ['#FF0000','#FF000099','#FF000044'],
                                            ['#d4b04d','#d4b04d99','#d4b04d44'],
                                            ['#e5ff08','#e5ff0899',"#e5ff0844"],
                                            ['#08ff0f','#08ff0f99','#08ff0f44'],
                                            ['#4a6f4b','#4a6f4b99','#4a6f4b44'],
                                            ['#277af7','#277af799','#277af744'],
                                            ['#2a27f7','#2a27f799','#2a27f744'],
                                            ['#f72787','#f7278799','#f7278744'],
                                        ];
                                        ?>
                                        @for( $i = 0; $i < 3;  $i ++)
                                            <div style="display: flex">
                                            @for( $j = 0; $j < 8; $j ++)
                                                <div class="color-check-box" >
                                                    @if($i == $row && $j == $col)
                                                        <input type="radio" name="radio" onclick="ColorSelect('{{$j}}','{{$i}}')"  checked>
                                                    @else
                                                        <input type="radio" name="radio" onclick="ColorSelect('{{$j}}','{{$i}}')"  >
                                                    @endif
                                                    <span class="checkmark" style="background-color: {{$colors[$j][$i]}};"></span>
                                                </div>
                                            @endfor
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="row  mt-4" >
                                    <div class="col-3">
                                        <span style="font-size:18px; color: #1e1e2d">{{__('user.avatar')}}:</span>
                                    </div>
                                    <div class="col-9">
                                        {{--//circle--}}
                                        <svg width="32" height="32" id="avatarShow1">
                                            <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="red"></circle>
                                            <text x="5" y="22"  style="fill:black;font-size: 16px">{{$user->nameTag}}</text>
                                        </svg>

                                        {{--//rect--}}
                                        <svg width="32" height="32" id="avatarShow2">
                                            <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="red" style="stroke-width:0;"></rect>
                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$user->nameTag}}</text>
                                        </svg>

                                        {{--//polygon 5--}}
                                        <svg width="32" height="32" id="avatarShow3">
                                            <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="red" style="stroke:purple;stroke-width:0;"></polygon>
                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$user->nameTag}}</text>
                                        </svg>

                                        {{--//polygon 6--}}
                                        <svg width="32" height="32" id="avatarShow4">
                                            <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="red" style="stroke:purple;stroke-width:0;"></polygon>
                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$user->nameTag}}</text>
                                        </svg>

                                        {{--//rotated rectangle--}}
                                        <svg width="32" height="32" id="avatarShow5">
                                            <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="red" style="stroke:purple;stroke-width:0;"></polygon>
                                            <text x="5" y="22" style="fill:black;font-size: 16px">{{$user->nameTag}}</text>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Datatable -->
                            <button type="submit" class="form-control btn btn-primary  col-md-4 ml-auto mr-auto btn-block mt-3 mb-3">{{__('user.update')}}</button>
                        </form>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let avatarType = "{{$user->avatarType}}" * 1;
        let color = "{{$user->avatarColor}}";

        let colors = [
                        ['#FF0000','#FF0000CC','#FF000044'],
                        ['#d4b04d','#d4b04dcc','#d4b04d44'],
                        ['#e5ff08','#e5ff08cc',"#e5ff0844"],
                        ['#08ff0f','#08ff0fcc','#08ff0f44'],
                        ['#4a6f4b','#4a6f4bcc','#4a6f4b44'],
                        ['#277af7','#277af7cc','#277af744'],
                        ['#2a27f7','#2a27f7cc','#2a27f744'],
                        ['#f72787','#f72787cc','#f7278744'],
                     ];
        function avatarShow(index) {
            let avatarName = "#avatar"+ index;
            let avatarShowName = "#avatarShow"+ index;
            $("#avatarType").val(index);
            $("#avatar1").hide();
            $("#avatar2").hide();
            $("#avatar3").hide();
            $("#avatar4").hide();
            $("#avatar5").hide();
            $("#avatarShow1").hide();
            $("#avatarShow2").hide();
            $("#avatarShow3").hide();
            $("#avatarShow4").hide();
            $("#avatarShow5").hide();

            $(avatarName+">").attr({"fill":color});
            $(avatarName).show();
            $(avatarShowName+">").attr({"fill":color});
            $(avatarShowName).show();
        }

        function avatarBack() {
            if (avatarType > 1) {
                avatarType -= 1;
            } else {
                avatarType = 5;
            }
            avatarShow(avatarType);
        }

        function avatarNext() {
            console.log("avatar Next");
            if (avatarType < 5) {
                avatarType += 1;
            } else {
                avatarType = 1;
            }
            avatarShow(avatarType);
        }

        function ColorSelect(j,i) {
            $('#avatarColor').val(colors[j][i]);
            color = colors[j][i];
            avatarShow(avatarType);
            let colVal = 8 * i + j * 1;
            $('#avatarColorValue').val(colVal);
        }

        $('#avatarColor').on('change',function(){
            color = $('#avatarColor').val();
            console.log(color);
            avatarShow(avatarType);
        });

        $("input[type=radio]").on('click',function(){

        })

        $(document).ready(function() {
            avatarShow(avatarType);
        });

    </script>

@endsection
