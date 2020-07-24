<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed border-0" style="box-shadow: none">
    <!-- begin:: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            <ul class="kt-menu__nav " >

                <li class="kt-menu__item {{isset($dashboard)?"header_menu_item_active":""}}  header_menu_item " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="{{route('dashboard')}}" class="header_menu_item_link">
                        <span class="kt-menu__link-text top-menu "><i class="fa fa-dot-circle header_menu_item_icon"></i>{{__('main.dashboard')}}</span>
                    </a>
                </li>
                <li class="kt-menu__item {{isset($taskCard)?"header_menu_item_active":""}} header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="{{route('task.taskCard')}}" class="header_menu_item_link">
                        <span class="kt-menu__link-text top-menu"><i class="la la-credit-card header_menu_item_icon"></i>{{__('main.taskCard')}}</span>
                    </a>
                </li>
                <li class="kt-menu__item  header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="header_menu_item_link">
                        <span class="kt-menu__link-text top-menu"><i class="fa fa-th-list header_menu_item_icon"></i>{{__('main.taskList')}}</span>
                    </a>
                </li>
                <li class="kt-menu__item {{isset($calendar)?"header_menu_item_active":""}} header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="{{route('CalendarView')}}" class="header_menu_item_link">
                        <span class="kt-menu__link-text top-menu"><i class="fa fa-calendar header_menu_item_icon"></i>{{__('calendar.calendar_title')}}</span>
                    </a>
                </li>
                <li class="kt-menu__item  header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="header_menu_item_link kt-menu__toggle">
                        <span class="kt-menu__link-text top-menu"><i class="fa fa-users header_menu_item_icon"></i>{{__('main.people')}}</span>
                    </a>
                </li>
                <li class="kt-menu__item header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="header_menu_item_link kt-menu__toggle">
                        <span class="kt-menu__link-text top-menu"><i class="la la-building header_menu_item_icon"></i>{{__('main.organizations')}}</span>
                    </a>
                </li>
                <li class="kt-menu__item header_menu_item {{isset($TagManager)?"header_menu_item_active":""}}" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="{{route('tag')}}" class="header_menu_item_link ">
                        <span class="kt-menu__link-text top-menu"><i class="fa fa-tag header_menu_item_icon"></i>{{__('main.tags')}}</span>
                    </a>
                </li>
                <li class="kt-menu__item header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="header_menu_item_link kt-menu__toggle">
                        <span class="kt-menu__link-text top-menu"><i class="fa fa-map-marker-alt header_menu_item_icon"></i>{{__('main.locations')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        <div class="kt-header__topbar-item kt-header__topbar-item--user">  
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user header_menu_item">
                    

                </div>
            </div>
        </div>

        <!--begin: Search -->
        <!--begin: Language bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--langs">
            <div class="kt-header__topbar-wrapper header_menu_item" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon">
                    @if (app()->getLocale() == "en")
                        <img class="" src="{{asset('public/flags/020-flag.svg')}}" alt="" />
                    @elseif(app()->getLocale() == "si")
                        <img class="" src="{{asset('public/flags/021-slovenia.png')}}" alt="" />
                    @endif
                </span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
                <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                    <li class="kt-nav__item kt-nav__item--active">
                        <a href="{{url('locale/en')}}" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><img src="{{asset('public/flags/020-flag.svg')}}" alt="" /></span>
                            <span class="kt-nav__link-text">English</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="{{url('locale/si')}}" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><img src="{{asset('public/flags/021-slovenia.png')}}" alt="" /></span>
                            <span class="kt-nav__link-text">Slovenia</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <!--end: Language bar -->
        <!--begin: Search -->
        <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown" id="kt_quick_search_toggle">
            <div class="kt-header__topbar-wrapper header_menu_item" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect id="bound" x="0" y="0"  rx="10px"  ry="10px" width="24" height="24" />
                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" id="Path-2" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" id="Path" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                </span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                <div class="kt-quick-search kt-quick-search--inline" id="kt_quick_search_inline">
                    <form method="get" class="kt-quick-search__form">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
                            <input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
                            <div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span></div>
                        </div>
                    </form>
                    <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                    </div>
                </div>
            </div>
        </div>

        <!--end: Search -->

        <!--end: Search -->

        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user header_menu_item">
                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    {{--<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">--}}
                        {{--{{$PersonTagNameList[auth()->user()->id]}}--}}
                    {{--</span>--}}


                    @switch(auth()->user()->avatarType)
                    @case (1)
                        <svg width="32" height="32">
                            <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="{{auth()->user()->avatarColor}}"></circle>
                            <text x="5" y="22"  style="fill:black;font-size: 16px">{{auth()->user()->nameTag}}</text>

                        @break
                    @case (2)
                        {{--//rect--}}
                        <svg width="32" height="32">
                            <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="{{auth()->user()->avatarColor}}" style="stroke-width:0;"></rect>
                            <text x="5" y="22" style="fill:black;font-size: 16px">{{auth()->user()->nameTag}}</text>

                        @break
                    @case (3)
                        {{--//polygon 5--}}
                        <svg width="32" height="32">
                            <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="{{auth()->user()->avatarColor}}" style="stroke:purple;stroke-width:0;"></polygon>
                            <text x="5" y="22" style="fill:black;font-size: 16px">{{auth()->user()->nameTag}}</text>

                        @break
                    @case (4)
                        {{--//polygon 6--}}
                        <svg width="32" height="32" >
                            <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="{{auth()->user()->avatarColor}}" style="stroke:purple;stroke-width:0;"></polygon>
                            <text x="5" y="22" style="fill:black;font-size: 16px">{{auth()->user()->nameTag}}</text>

                        @break
                    @case (5)
                    {{--//rotated rectangle--}}
                        <svg width="32" height="32">
                            <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="{{auth()->user()->avatarColor}}" style="stroke:purple;stroke-width:0;"></polygon>
                            <text x="5" y="22" style="fill:black;font-size: 16px">{{auth()->user()->nameTag}}</text>

                        @break
                    @endswitch
                    @switch(auth()->user()->roleID)
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
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-color: #0a6aa1">

                    <div class="kt-user-card__name">
                        {{ auth()->user()->nameFamily }} &nbsp; {{auth()->user()->nameFirst}}
                    </div>

                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">
                    <a href="{{route('user.setting')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details" >
                            <div class="kt-notification__item-title kt-font-bold">
                                {{__('main.myProfile')}}
                            </div>
                            <div class="kt-notification__item-time">
                                {{__('main.myProfileText')}}
                            </div>
                        </div>
                    </a>

                    <a href="javascript:;" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-hourglass kt-font-brand"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                {{__('main.myTasks')}}
                            </div>
                            <div class="kt-notification__item-time">
                                {{__('main.myTasksText')}}
                            </div>
                        </div>
                    </a>

                    <div class="kt-notification__custom" style="justify-content: center">
                        <a href="{{ route('logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{__('main.signOut')}}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
                <!--end: Navigation -->
            </div>
        </div>
        <!--end: User Bar -->
    </div>
    <!-- end:: Header Topbar -->
</div>

