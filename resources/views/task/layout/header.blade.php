<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

    <!-- begin:: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <i class="kt-nav__link-icon flaticon2-layers-1"></i>
                        <span class="kt-menu__link-text top-menu">Dashboard</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here kt-menu__item--active" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="task/taskCard" class="kt-menu__link">
                        <i class="kt-nav__link-icon flaticon2-cardiogram"></i>
                        <span class="kt-menu__link-text top-menu">Task Cards</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="task/taskList" class="kt-menu__link">
                        <i class="kt-nav__link-icon flaticon2-list-3"></i>
                        <span class="kt-menu__link-text top-menu">Task List</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <i class="kt-nav__link-icon flaticon-users"></i>
                        <span class="kt-menu__link-text top-menu">People</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <i class="kt-nav__link-icon flaticon2-graph-2"></i>
                        <span class="kt-menu__link-text top-menu">Organizations</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <i class="kt-nav__link-icon flaticon-price-tag"></i>
                        <span class="kt-menu__link-text top-menu">Tags</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <i class="kt-nav__link-icon flaticon-location"></i>
                        <span class="kt-menu__link-text top-menu">Locations</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        <div class="kt-header__topbar-item">
            <span style="margin-top: auto; margin-bottom: auto;">Select User:&nbsp;&nbsp;&nbsp;</span>
            <select onchange=changeUserId() id="select_user" style="font-size: 10pt;">
                @foreach($totalPersonList as $personItem)
                    <option value="{{$personItem["ID"]}}" <?php if($personItem["ID"] == Session::get("login_person_id")) echo "selected=selected"?>>
                        {{$personItem["nameFamily"]." ".$personItem["nameFirst"]."(roleID:".$personItem['roleID'].", Tag:".$PersonTagNameList[$personItem['ID']].")"}}
                    </option>
                @endforeach
            </select>
        </div>

        <!--begin: Search -->

        <!--begin: Search -->
        <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown" id="kt_quick_search_toggle">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                            <span class="kt-header__topbar-icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" id="Path-2" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" id="Path" fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg> </span>
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
                <div class="kt-header__topbar-user">
                    <img class="kt-hidden" alt="Pic" src="{{asset('public/assets/media/users/300_25.jpg')}}" />

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">AV</span>
                </div>
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>

