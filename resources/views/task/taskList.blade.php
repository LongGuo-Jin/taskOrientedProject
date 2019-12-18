@extends('layouts.layout')

@section('styles')
<link rel="stylesheet" href="./css/task/tasklist.css">
@endsection

@section('title')
taskCard
@endsection

@section('content')
<!-- begin:: Page -->


<div class="kt-grid kt-grid--hor kt-grid--root">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="demo1/dashboard.html">
                Task Oriented Project
            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                                            <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                                            <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                                        </g>
                                    </svg></span>
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" />
                                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                                        </g>
                                    </svg></span>
            </button>

            <!--
<button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
-->
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="demo1/index.html" class="kt-menu__link ">
                                        <span class="kt-menu__link-icon">
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon id="Bound" points="0 0 24 0 24 24 0 24" />
                                                    <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" id="Shape" fill="#000000" fill-rule="nonzero" />
                                                    <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" id="Path" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                        </span>
                        <span class="kt-menu__link-text">Dashboard</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-icon">
                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                                        <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
                                                        <polygon id="Path" fill="#000000" opacity="0.3" points="4 19 10 11 16 19" />
                                                        <polygon id="Path-Copy" fill="#000000" points="11 19 15 14 19 19" />
                                                        <path d="M18,12 C18.8284271,12 19.5,11.3284271 19.5,10.5 C19.5,9.67157288 18.8284271,9 18,9 C17.1715729,9 16.5,9.67157288 16.5,10.5 C16.5,11.3284271 17.1715729,12 18,12 Z" id="Path" fill="#000000" opacity="0.3" />
                                                    </g>
                                                </svg>
                                            </span>
                        <span class="kt-menu__link-text">My Task</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-icon">
                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                                        <rect id="Rectangle-62-Copy" fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
                                                        <rect id="Rectangle-62-Copy-2" fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
                                                        <rect id="Rectangle-62-Copy-4" fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
                                                        <rect id="Rectangle-62-Copy-3" fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
                                                    </g>
                                                </svg>
                                            </span>
                        <span class="kt-menu__link-text">Task Doctor</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-icon">
                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                                        <rect id="Combined-Shape" fill="#000000" opacity="0.3" x="2" y="3" width="20" height="18" rx="2" />
                                                        <path d="M9.9486833,13.3162278 C9.81256925,13.7245699 9.43043041,14 9,14 L5,14 C4.44771525,14 4,13.5522847 4,13 C4,12.4477153 4.44771525,12 5,12 L8.27924078,12 L10.0513167,6.68377223 C10.367686,5.73466443 11.7274983,5.78688777 11.9701425,6.75746437 L13.8145063,14.1349195 L14.6055728,12.5527864 C14.7749648,12.2140024 15.1212279,12 15.5,12 L19,12 C19.5522847,12 20,12.4477153 20,13 C20,13.5522847 19.5522847,14 19,14 L16.118034,14 L14.3944272,17.4472136 C13.9792313,18.2776054 12.7550291,18.143222 12.5298575,17.2425356 L10.8627389,10.5740611 L9.9486833,13.3162278 Z" id="Path-108" fill="#000000" fill-rule="nonzero" />
                                                        <circle id="Oval" fill="#000000" opacity="0.3" cx="19" cy="6" r="1" />
                                                    </g>
                                                </svg>
                                            </span>
                        <span class="kt-menu__link-text">Reports</span>
                    </a>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">MY FAVORITES</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-icon">
                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                                        <path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" id="Combined-Shape" fill="#000000" />
                                                        <rect id="Rectangle-7-Copy-2" fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1" />
                                                    </g>
                                                </svg>
                                            </span>
                        <span class="kt-menu__link-text">New Website</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-icon">
                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                                        <rect id="Rectangle-7" fill="#000000" opacity="0.3" x="4" y="5" width="16" height="6" rx="1.5" />
                                                        <rect id="Rectangle-7-Copy" fill="#000000" x="4" y="13" width="16" height="6" rx="1.5" />
                                                    </g>
                                                </svg>
                                            </span>
                        <span class="kt-menu__link-text">Metalfabrike Duseldordf</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-icon">
                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
                                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" id="Rectangle-102-Copy" fill="#000000" />
                                                    </g>
                                                </svg>
                                            </span>
                        <span class="kt-menu__link-text">Take with Extremely Long</span>
                    </a>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">TAGS</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="demo1/index.html" class="kt-menu__link ">
                                        <span class="kt-menu__link-icon">
                                        </span>
                        <span class="kt-menu__link-text">Project</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-icon">
                                            </span>
                        <span class="kt-menu__link-text">Milestone</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-icon">
                                            </span>
                        <span class="kt-menu__link-text">To Do</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-icon">
                                            </span>
                        <span class="kt-menu__link-text">Customer1</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="demo1/index.html" class="kt-menu__link ">
                                        <span class="kt-menu__link-icon">
                                        </span>
                        <span class="kt-menu__link-text">Overdue</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-icon">
                                            </span>
                        <span class="kt-menu__link-text">New</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>

<!-- end:: Aside -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

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
                <li class="kt-menu__item">
                    <a href="task/taskCard" class="kt-menu__link">
                        <i class="kt-nav__link-icon flaticon2-cardiogram"></i>
                        <span class="kt-menu__link-text top-menu">Task Cards</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here kt-menu__item--active" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
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

                    <img class="kt-hidden" alt="Pic" src="./assets/media/users/300_25.jpg" />

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">AV</span>
                </div>
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>

<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

<!-- begin:: Content Head -->
<div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
    <input type="text" class="form-control" placeholder="Search order..." id="generalSearch">
									<span class="kt-input-icon__icon kt-input-icon__icon--right">
										<span><i class="flaticon2-search-1"></i></span>
									</span>
</div>

<!-- end:: Content Head -->

<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-lg-8">
        <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                <h3 class="kt-portlet__head-title">
                    Task List
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
        <thead>
        <tr>
            <th>TASK</th>
            <th>PERSON</th>
            <th>START DATE</th>
            <th>END DATE</th>
            <th>STATUS</th>
            <th>PRIORITY</th>
            <th>WEIGHT</th>
            <th>BUDGET</th>
            <th>PROGRESS</th>
        </tr>
        </thead>
        <tbody>
        <tr id="kt_quick_panel_toggler_btn">
            <td>Metalfabrike Duseldorf</td>
            <td>Marko Novak</td>
            <td>15.10.2018</td>
            <td>30.11.2019</td>
            <td>
                <i class="flaticon2-check-mark"></i>
                Finished
            </td>
            <td>High</td>
            <td>8</td>
            <td>120,350.00</td>
            <td style="vertical-align: middle">
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: 35%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Baustelle Ulm</td>
            <td>Janez Košir</td>
            <td>18.10.2018</td>
            <td>20.5.2020</td>
            <td>
                <i class="flaticon2-check-mark"></i>
                In progress
            </td>
            <td>Medium</td>
            <td>7</td>
            <td>23,730.00</td>
            <td style="vertical-align: middle">
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: 70%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Order 2019/267
            </td>
            <td>Marko Novak</td>
            <td>15.10.2018</td>
            <td>30.11.2019</td>
            <td>
                <i class="flaticon2-check-mark"></i>
                Finished
            </td>
            <td>High</td>
            <td>8</td>
            <td>120,350.00</td>
            <td style="vertical-align: middle">
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: 40%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Order 2019/286
            </td>
            <td>Janez Košir</td>
            <td>18.10.2018</td>
            <td>20.5.2020</td>
            <td>
                <i class="flaticon2-check-mark"></i>
                In progress
            </td>
            <td>Medium</td>
            <td>7</td>
            <td>23,730.00</td>
            <td style="vertical-align: middle">
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: 70%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Order 2019/286
            </td>
            <td>Janez Košir</td>
            <td>18.10.2018</td>
            <td>20.5.2020</td>
            <td>
                <i class="flaticon2-check-mark"></i>
                In progress
            </td>
            <td>Medium</td>
            <td>7</td>
            <td>23,730.00</td>
            <td style="vertical-align: middle">
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: 70%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Order 2019/286
            </td>
            <td>Janez Košir</td>
            <td>18.10.2018</td>
            <td>20.5.2020</td>
            <td>
                <i class="flaticon2-check-mark"></i>
                In progress
            </td>
            <td>Medium</td>
            <td>7</td>
            <td>23,730.00</td>
            <td style="vertical-align: middle">
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: 70%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Order 2019/286
            </td>
            <td>Janez Košir</td>
            <td>18.10.2018</td>
            <td>20.5.2020</td>
            <td>
                <i class="flaticon2-check-mark"></i>
                In progress
            </td>
            <td>Medium</td>
            <td>7</td>
            <td>23,730.00</td>
            <td style="vertical-align: middle">
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: 70%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Order 2019/286
            </td>
            <td>Janez Košir</td>
            <td>18.10.2018</td>
            <td>20.5.2020</td>
            <td>
                <i class="flaticon2-check-mark"></i>
                In progress
            </td>
            <td>Medium</td>
            <td>7</td>
            <td>23,730.00</td>
            <td style="vertical-align: middle">
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: 70%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Order 2019/286
            </td>
            <td>Janez Košir</td>
            <td>18.10.2018</td>
            <td>20.5.2020</td>
            <td>
                <i class="flaticon2-check-mark"></i>
                In progress
            </td>
            <td>Medium</td>
            <td>7</td>
            <td>23,730.00</td>
            <td style="vertical-align: middle">
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: 70%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        </tr>
        </tbody>
        </table>

        <!--end: Datatable -->
        </div>
        </div>
        </div>
        <div class="col-lg-4">
        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Details
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_information" role="tab">INFORMATION</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_logs" role="tab">BUDGET</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_settings" role="tab">STATISTICS</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
        <div class="kt-scroll" data-scroll="true" style="height: 600px">
        <div class="tab-content">
        <div class="tab-pane active" id="kt_quick_panel_tab_information">
        <div class="detail-infomation-content">
        <div class="row detail-information-title">
            Projects > Baustelle Uim
        </div>
        <div class="row detail-information-task-name">
            Order 2019/289
        </div>
        <div class="row detail-information-staus">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-2">
                        <a href="#" class="btn btn-sm btn-icon btn-label-instagram btn-pill btn-icon-md">
                            TS
                        </a>
                    </div>
                    <div class="col-lg-10">
                        <div class="detail-information-staus-title">
                            In Charge
                        </div>
                        <div class="detail-information-staus-content">
                            Tine Strehar
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" style="text-align: center">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="detail-information-staus-title">
                            Status
                        </div>
                        <div class="detail-information-staus-content">
                            <i class="flaticon2-arrow lg"></i>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="detail-information-staus-title">
                            Priority
                        </div>
                        <div class="detail-information-staus-content">
                            L
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="detail-information-staus-title">
                            Weight
                        </div>
                        <div class="detail-information-staus-content">
                            8
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row detail-information-tags">
            <div class="row col-lg-6">
                <div class="col-lg-2">
                    Tags
                </div>
                <div class="col-lg-10">
                    <span class="kt-badge kt-badge--success kt-badge--inline" style="margin-left: 4px;">PROJECT</span>
                    <span class="kt-badge kt-badge--warning  kt-badge--inline kt-badge--pill" style="margin-left: 4px;">GERMANY</span>
                </div>
            </div>
        </div>
        <div class="detail-information-task-date">
            <div class="row">
                <div class="col-lg-3 detail-label">
                    Start Date
                </div>
                <div class="col-lg-3 detail-content">
                    12.11.2019
                </div>
                <div class="col-lg-3 detail-label">
                    End Date
                </div>
                <div class="col-lg-3 detail-content">
                    12.12.2019
                </div>
            </div>
            <div class="row" style="margin-top: 15px">
                <div class="col-lg-3 detail-label">
                    Actual Start Date
                </div>
                <div class="col-lg-3 detail-content">
                    15.11.2019
                </div>
                <div class="col-lg-3 detail-label">
                    Actual End Date
                </div>
                <div class="col-lg-3 detail-content disable">
                    Set finish Status
                </div>
            </div>
        </div>
        <div class="row detail-information-description">
            <h5>Description</h5><br>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
            nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
            erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci
            tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo
            consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate
            velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis
            at vero eros et accumsan et iusto odio dignissim qui blandit
            praesent luptatum zzril delenit augue duis dolore te feugait nulla
            facilisi.
        </div>
        <div class="detail-information-task-memos">
            <h5>Memos</h5><br>
            <div class="row">
                <div class="col-lg-4 detail-content">
                    15. 11. 2019 08:12
                </div>
                <div class="col-lg-3 detail-label">
                    Tine Strehar
                </div>
                <div class="col-lg-5 detail-content">
                    Fixed!
                </div>
            </div>
            <div class="row" style="margin-top: 15px">
                <div class="col-lg-4 detail-content">
                    10. 10. 2019 07:37
                </div>
                <div class="col-lg-3 detail-label">
                    Janez Novak
                </div>
                <div class="col-lg-5">
                    Someone please fix the little wheel on the trolley. It keeps on
                    falling of if loaded.
                </div>
            </div>
        </div>
        <div class="detail-information-task-attachments">
            <div class="row">
                <div class="col-lg-6">
                    <h5>Attachmets</h5>
                </div>
                <div class="col-lg-6" style="text-align: right;">
                    <a href="#" class="btn btn-label-instagram btn-pill">
                        Add Attachment
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <div class="kt-widget4__pic kt-widget4__pic--icon">
                        <img src="./assets/media/files/pdf.svg" alt="">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <h5>
                            Contract 2019-267 - Baustelle Ulm.pdf
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 detail-label">
                            Attached:
                        </div>
                        <div class="col-lg-7 detail-content">
                            10. 10. 2019
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 detail-label">
                            Attached by:
                        </div>
                        <div class="col-lg-7 detail-content">
                            Janez Novak
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
        </div>
        <div class="detail-information-task-memos">
            <h5>History</h5><br>
            <div class="row">
                <div class="col-lg-4 detail-content">
                    15. 11. 2019 08:12
                </div>
                <div class="col-lg-3 detail-label">
                    Tine Strehar
                </div>
                <div class="col-lg-5 detail-content">
                    Status change: Active
                </div>
            </div>
            <div class="row" style="margin-top: 15px">
                <div class="col-lg-4 detail-content">
                    10. 10. 2019 07:37
                </div>
                <div class="col-lg-3 detail-label">
                    Janez Novak
                </div>
                <div class="col-lg-5">
                    Attachment added: Contract 2019-267 - Fabrike Ulm.pdf
                </div>
            </div>
            <div class="row" style="margin-top: 15px">
                <div class="col-lg-4 detail-content">
                    10. 10. 2019 07:35
                </div>
                <div class="col-lg-3 detail-label">
                    Janez Novak
                </div>
                <div class="col-lg-5">
                    Created
                </div>
            </div>
        </div>
        </div>
        </div>
        <div class="tab-pane" id="kt_quick_panel_tab_logs">

        </div>
        <div class="tab-pane" id="kt_quick_panel_tab_settings">

        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </div>
</div>

<!-- end:: Content -->
</div>

<!-- begin:: Footer -->
<div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
    <div class="kt-footer__copyright">
        2019&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic" target="_blank" class="kt-link"></a>
    </div>
    <div class="kt-footer__menu">

    </div>
</div>

<!-- end:: Footer -->
</div>
</div>
</div>

<!-- end:: Page -->

@endsection