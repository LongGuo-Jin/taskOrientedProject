@extends('layouts.layout')
@section('title')
    Tag
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css/task/taskcard.css')}}">
@endsection

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
        @include('layouts.header')
        <!-- end:: Header -->
        <div style="margin: 20px;">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-card">
                        <div class="list-head">
                            <div>
                               <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-primary list-nav-tab" role="tablist">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="la flaticon-background"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="list-header-title">
                                {{__('tag.systemTag')}}
                            </div>
                        </div>
                        <div class="mt-4  mb-4">
                            @foreach($tags['system'] as $tag)
                                <a href="{{route('tag',['tagID' => $tag['ID'] , 'selected' => 1,'system'=>1])}}">
                                    <div class="row system-tag {{$selected==$tag['ID']?"selected":""}}">
                                        <div class="col-md-4">
                                        <span class="system-span" style="background-color: {{$tag['color']}}">
                                            <?php echo $tag['name']; ?>
                                        </span>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                        <div class="col-md-7" style="color: {{$tag['show']==0?'gray':'black'}}">
                                            <?php echo $tag['note']; ?>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="list-card">
                        <div class="list-head">
                            <div>
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-primary list-nav-tab" role="tablist">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="la flaticon-background"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="list-header-title">
                                {{__('tag.organizationTag')}}
                            </div>
                        </div>
                        <div class="mt-4 mb-4">
                            @foreach($tags['organization'] as $tag)
                                <a href="{{route('tag',['tagID' => $tag['ID'] , 'selected' => 1,'system'=>2])}}">
                                <div class="row system-tag {{$selected==$tag['ID']?"selected":""}}">
                                    <div class="col-md-4">
                                    <span class="organization-span" style="background-color: {{$tag['color']}}">
                                        <?php echo $tag['name']; ?>
                                    </span>
                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-7" style="color: {{$tag['show']==0?'gray':'black'}}">
                                        <?php echo $tag['note']; ?>
                                    </div>
                                </div>
                                </a>
                            @endforeach
                        </div>
                        @if ($roleID == 1)
                        <div class="text-center mt-4">
                            <button class="btn btn-brand btn-icon-sm" aria-expanded="false" onclick="AddNewTag('organization')">
                                <i class="flaticon2-plus"></i> {{__('tag.addNew')}}
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="list-card">
                        <div class="list-head">
                            <div>
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-primary list-nav-tab" role="tablist">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="la flaticon-background"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="list-header-title">
                                {{__('tag.personalTag')}}
                            </div>
                        </div>
                        <div class="mt-4  mb-4">
                            @foreach($tags['personal'] as $tag)
                                <a href="{{route('tag',['tagID' => $tag['ID'] , 'selected' => 1,'system'=>3])}}">
                                <div class="row system-tag {{$selected==$tag['ID']?"selected":""}}">
                                    <div class="col-md-4">
                                    <span class="personal-span" style="border-color: {{$tag['color']}}">
                                        <?php echo $tag['name']; ?>
                                    </span>
                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-7"  style="color: {{$tag['show']==0?'gray':'black'}}">
                                        <?php echo $tag['note']; ?>
                                    </div>
                                </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="text-center mt-4">
                            <button class="btn btn-brand btn-icon-sm" aria-expanded="false" onclick="AddNewTag('personal')">
                                <i class="flaticon2-plus"></i> {{__('tag.addNew')}}
                            </button>
                        </div>
                    </div>
                </div>
                @include('tag.partials.add')
                @if($tags['selected'])
                    @include('tag.partials.edit')
                @endif
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
        let base_url = "{{URL::to('')}}";
        {{--var task_id = "{{$taskId}}";--}}
        {{--var showType = "{{$showType}}";--}}
        let roleID = "{{$roleID}}";
        let system = "{{$system}}";

        function AddNewTag(tagType) {
            if (tagType === 'organization') {

                $('#tagTypeShow').html( '<h5>Organization Tag</h5>');
                $('#tagType').val('organization');
            } else if (tagType === 'personal') {
                console.log(tagType);
                $('#tagTypeShow').html( '<h5>Personal Tag</h5>');
                $('#tagType').val('personal');
            }
            $('#tagAddCard').show();
        }

        $(document).ready(function() {
            $('span').on('click' ,function (e){
                if (roleID !=='1' && system === "1")
                    return;
                if (system === '2' && roleID !== '1')
                    return;
                targetID = e.target.id;
                switch (targetID) {
                    case "tagNameEdit":
                        $('#tagNameEdit').hide();
                        $('#tagName').show();
                        break;
                    case "tagNoteEdit":
                        $('#tagNoteEdit').hide();
                        $('#tagNote').show();
                        break;
                    case "tagDescriptionEdit":
                        $('#tagDescriptionEdit').hide();
                        $('#tagDescription').show();
                        break;
                    default:
                        break;
                }
                $('#tagUpdate').show();
                $('#tagDelete').show();
            });
            $('#tagColorEdit').on('click',function(){
                if (roleID !=='1' && system === "1")
                    return;
                if (system === '2' && roleID !== '1')
                    return;
                $('#tagUpdate').show();
                $('#tagDelete').show();
            });
            $('#tagShowEdit').on('click',function() {
                if (roleID !=='1' && system === "1")
                    return;
                if (system === '2' && roleID !== '1')
                    return;
                $('#tagUpdate').show();
                $('#tagDelete').show();
            });

        });
    </script>
    <script type="text/javascript" charset="utf-8" src="{{asset('public/assets/js/task/taskcard.js')}}"></script>

@endsection
