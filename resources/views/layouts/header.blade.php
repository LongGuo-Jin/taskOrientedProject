<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed border-0" style="box-shadow: none">
    <!-- begin:: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            <ul class="kt-menu__nav " >

                <li class="kt-menu__item {{isset($taskCard)?"header_menu_item_active":""}} header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="{{route('task.taskCard')}}" class="header_menu_item_link">
                        <span class="kt-menu__link-text top-menu"><i class="la la-credit-card header_menu_item_icon"></i>{{__('main.tasks')}}</span>
                    </a>
                </li>
                {{--<li class="kt-menu__item  header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">--}}
                    {{--<a href="javascript:;" class="header_menu_item_link">--}}
                        {{--<span class="kt-menu__link-text top-menu"><i class="fa fa-th-list header_menu_item_icon"></i>{{__('main.taskList')}}</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li class="kt-menu__item {{isset($calendar)?"header_menu_item_active":""}} header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="{{route('CalendarView')}}" class="header_menu_item_link">
                        <span class="kt-menu__link-text top-menu"><i class="fa fa-calendar header_menu_item_icon"></i>{{__('calendar.calendar_title')}}</span>
                    </a>
                </li>
                <li class="kt-menu__item {{isset($people)?"header_menu_item_active":""}} header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="{{route('people')}}" class="header_menu_item_link">
                        <span class="kt-menu__link-text top-menu"><i class="fa fa-users header_menu_item_icon"></i>{{__('main.people')}}</span>
                    </a>
                </li>
                <li class="kt-menu__item {{isset($organization)?"header_menu_item_active":""}}  header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="{{route('company')}}" class="header_menu_item_link">
                        <span class="kt-menu__link-text top-menu"><i class="la la-building header_menu_item_icon"></i>{{__('main.organizations')}}</span>
                    </a>
                </li>
                <li class="kt-menu__item header_menu_item {{isset($TagManager)?"header_menu_item_active":""}}" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="{{route('tag')}}" class="header_menu_item_link ">
                        <span class="kt-menu__link-text top-menu"><i class="fa fa-tag header_menu_item_icon"></i>{{__('main.tags')}}</span>
                    </a>
                </li>
                {{--<li class="kt-menu__item header_menu_item" data-ktmenu-submenu-toggle="click" aria-haspopup="true">--}}
                    {{--<a href="javascript:;" class="header_menu_item_link kt-menu__toggle">--}}
                        {{--<span class="kt-menu__link-text top-menu"><i class="fa fa-map-marker-alt header_menu_item_icon"></i>{{__('main.locations')}}</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>

    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">
        @if(isset($taskCard) || isset($dashboard))
            <?php

            $filter_order = auth()->user()->filter_order;

            $filter_orders = [ ['First' , 'Second','Third','Fourth','Fifth','Sixth'],[
                "I",
                "II",
                "III",
                "IV",
                "V",
                "VI",
            ] ];

            ?>
            <div class="kt-header__topbar-item dropdown mt-auto mb-auto">
                <div class="" data-toggle="dropdown" data-offset="0px,0px" aria-expanded="true">
                    <div class="kt-header__topbar-user header_menu_item">
                        <span class="kt-header__topbar-icon">
                            <i class="fa fa-filter"></i>
                        </span>
                    </div>
                </div>
                <div id="filter_manage" class="dropdown-menu dropdown-menu-fit dropdown-menu-left dropdown-menu-anim dropdown-menu-top-unround">
                    <form method="post" action="{{route('filter.update')}}">
                        @csrf
                        <input type="hidden" name="task_filter_order" id="task_filter_order" value="{{$filter_order}}">
                        <input type="hidden" value="{{$personalID}}" name="user_id">
                        <div class="filter-box">
                            <div>
                                <div class="filter-column">
                                    <input type="hidden" name="statusFilter" id="statusFilter" value="{{$filters['status']}}">
                                    <div style="display:flex; justify-content: space-between">
                                        <h3 class="mt-auto mb-auto">Status</h3>
                                        <div class="kt-header__topbar-item dropdown mt-auto mb-auto">
                                            <div class="task-order-item" id="statusOrderMenu" onclick="StatusOrderMenu()" data-offset="0px,0px" aria-expanded="true" style="font-size: 20px">
                                                <span>
                                                    {{$filter_orders[1][$filter_order[0]-1]}}
                                                </span>
                                                <span>
                                                    @if ($filters['status'][11] == '1')
                                                        <i class="fa fa-caret-up"></i>
                                                    @else
                                                        <i class="fa fa-caret-down"></i>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-left dropdown-menu-anim dropdown-menu-top-unround"  id="statusOrderDropDownMenu" style="border-radius: 10px; min-width: 1rem !important; transform: translateX(-80%);">
                                                <div class="filter-order-box">
                                                    @foreach($filter_orders[0] as $index => $item)
                                                        <div class="row filter-order-item" onclick="StatusOrderSelect({{$index}})">
                                                            <div class="col-lg-3 kt-notification__item">
                                                                {{$filter_orders[1][$index]}}
                                                            </div>
                                                            <div class="col-lg-9 kt-notification__item">
                                                                {{$item}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div style="width: 100%; height: 1px; background-color: whitesmoke;"></div>
                                                    <div class="row filter-order-item" onclick="StatusScending(true)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-up"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Ascending
                                                        </div>
                                                    </div>
                                                    <div class="row filter-order-item" onclick="StatusScending(false)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-down"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Descending
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $status = [ ['Created' , 'Active','Paused','Finished','Canceled','Reviewed',
                                        'Confirmed','Refused','Failed','Removed','Deleted'],[
                                        "<i class='fa fa-circle'></i>",
                                        "<i class='flaticon2-arrow lg'></i>",
                                        "<i class='fa fa-pause'></i>",
                                        "<i class='flaticon2-check-mark'></i>",
                                        "<i class='flaticon2-hexagonal'></i>",
                                        "<i class='fa fa-check-circle'></i>",
                                        "<i class='fa fa-star'></i>",
                                        "<i class='fa fa-star'></i>",
                                        "<i class='fa fa-times-circle'></i>",
                                        "<i class='fa fa-star'></i>",
                                        "<i class='fa fa-trash'></i>",
                                    ] ];

                                    ?>
                                    @foreach ($status[0] as $index => $state)
                                        <div class="row filter-column-item">
                                            <div class="col-lg-3"><i class="fa fa-eye  <?php if($filters['status'][$index] == '0') { echo 'eye-deselect'; } ?>" onclick="StatusFilter(this,{{$index}})"></i></div>
                                            <div class="col-lg-3"><?php echo $status[1][$index]; ?></div>
                                            <div class="col-lg-3"><span>{{$state}}</span></div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div>
                                <div class="filter-column">
                                    <input type="hidden" name="priorityFilter" id="priorityFilter" value="{{$filters['priority']}}">
                                    <div style="display:flex; justify-content: space-between">
                                        <h3 class="mt-auto mb-auto">Priority</h3>
                                        <div class="kt-header__topbar-item dropdown mt-auto mb-auto">
                                            <div class="task-order-item" id="priorityOrderMenu" onclick="PriorityOrderMenu()" data-offset="0px,0px" aria-expanded="true" style="font-size: 20px">
                                                <span>
                                                    {{$filter_orders[1][$filter_order[1]-1]}}
                                                </span>
                                                <span>
                                                    @if ($filters['priority'][5] == '1')
                                                        <i class="fa fa-caret-up"></i>
                                                    @else
                                                        <i class="fa fa-caret-down"></i>
                                                    @endif
                                               </span>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-left dropdown-menu-anim dropdown-menu-top-unround"  id="priorityOrderDropDownMenu" style="border-radius: 10px; min-width: 1rem !important; transform: translateX(-70%);">
                                                <div class="filter-order-box">
                                                    @foreach($filter_orders[0] as $index => $item)
                                                        <div class="row filter-order-item" onclick="PriorityOrderSelect({{$index}})">
                                                            <div class="col-lg-3 kt-notification__item">
                                                                {{$filter_orders[1][$index]}}
                                                            </div>
                                                            <div class="col-lg-9 kt-notification__item">
                                                                {{$item}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div style="width: 100%; height: 1px; background-color: whitesmoke;"></div>
                                                    <div class="row filter-order-item" onclick="PriorityScending(true)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-up"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Ascending
                                                        </div>
                                                    </div>
                                                    <div class="row filter-order-item" onclick="PriorityScending(false)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-down"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Descending
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $priorities = [ ['Critical' , 'High','Medium','Low','Optional'],[
                                        "<i class='fa fa-exclamation' style='color: darkred'></i>",
                                        "H",
                                        "M",
                                        "L",
                                        "O",
                                    ] ];

                                    ?>
                                    @foreach ($priorities[0] as $index => $priority)
                                        <div class="row filter-column-item">
                                            <div class="col-lg-3"><i class="fa fa-eye <?php if($filters['priority'][$index] == '0') { echo 'eye-deselect'; } ?>" onclick="PriorityFilter(this,{{$index}})"></i></div>
                                            <div class="col-lg-3"><?php echo $priorities[1][$index]; ?></div>
                                            <div class="col-lg-3"><span>{{$priority}}</span></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <div class="filter-column">
                                    <input type="hidden" name="weightFilter" id="weightFilter" value="{{$filters['weight']}}">
                                    <div style="display:flex; justify-content: space-between">
                                        <h3 class="mt-auto mb-auto">Weight</h3>
                                        <div class="kt-header__topbar-item dropdown mt-auto mb-auto">
                                            <div class="task-order-item" id="weightOrderMenu" onclick="WeightOrderMenu()" data-offset="0px,0px" aria-expanded="true" style="font-size: 20px">
                                                <span>
                                                    {{$filter_orders[1][$filter_order[2]-1]}}
                                                </span>
                                                <span>
                                                    @if ($filters['weight'][10] == '1')
                                                        <i class="fa fa-caret-up"></i>
                                                    @else
                                                        <i class="fa fa-caret-down"></i>
                                                    @endif
                                               </span>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-left dropdown-menu-anim dropdown-menu-top-unround"  id="weightOrderDropDownMenu" style="border-radius: 10px; min-width: 1rem !important; transform: translateX(-70%);">
                                                <div class="filter-order-box">
                                                    @foreach($filter_orders[0] as $index => $item)

                                                        <div class="row filter-order-item" onclick="WeightOrderSelect({{$index}})">
                                                            <div class="col-lg-3 kt-notification__item">
                                                                {{$filter_orders[1][$index]}}
                                                            </div>
                                                            <div class="col-lg-9 kt-notification__item">
                                                                {{$item}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div style="width: 100%; height: 1px; background-color: whitesmoke;"></div>
                                                    <div class="row filter-order-item" onclick="WeightScending(true)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-up"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Ascending
                                                        </div>
                                                    </div>
                                                    <div class="row filter-order-item" onclick="WeightScending(false)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-down"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Descending
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $weights = [ ['Complex' , '','','','Medium','','','','Simple','UnWeighted'],[
                                        "9", "8", "7", "6", "5","4", "3", "2", "1", "0",
                                    ] ];

                                    ?>
                                    @foreach ($weights[0] as $index => $weight)
                                        <div class="row filter-column-item">
                                            <div class="col-lg-3"><i class="fa fa-eye <?php if($filters['weight'][$index] == '0') { echo 'eye-deselect'; } ?>" onclick="WeightFilter(this,{{$index}})"></i></div>
                                            <div class="col-lg-3"><?php echo $weights[1][$index]; ?></div>
                                            <div class="col-lg-3"><span>{{$weight}}</span></div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; justify-content: space-between">
                                <div class="filter-column">
                                    <input type="hidden" name="dateFilter" id="dateFilter" value="{{$filters['date']}}">
                                    <div style="display:flex; justify-content: space-between">
                                        <h3  class="mt-auto mb-auto">Date</h3>
                                        <div class="kt-header__topbar-item dropdown mt-auto mb-auto">
                                            <div class="task-order-item" id="dateOrderMenu" onclick="DateOrderMenu()" data-offset="0px,0px" aria-expanded="true" style="font-size: 20px">
                                                <span>
                                                    {{$filter_orders[1][$filter_order[3]-1]}}
                                                </span>
                                                <span>
                                                    @if ($filters['date'][2] == '1')
                                                        <i class="fa fa-caret-up"></i>
                                                    @else
                                                        <i class="fa fa-caret-down"></i>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-left dropdown-menu-anim dropdown-menu-top-unround"  id="dateOrderDropDownMenu" style="border-radius: 10px; min-width: 1rem !important; transform: translateX(-70%);">
                                                <div class="filter-order-box">
                                                    @foreach($filter_orders[0] as $index => $item)

                                                        <div class="row filter-order-item" onclick="DateOrderSelect({{$index}})">
                                                            <div class="col-lg-3 kt-notification__item">
                                                                {{$filter_orders[1][$index]}}
                                                            </div>
                                                            <div class="col-lg-9 kt-notification__item">
                                                                {{$item}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div style="width: 100%; height: 1px; background-color: whitesmoke;"></div>
                                                    <div class="row filter-order-item" onclick="DateScending(true)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-up"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Ascending
                                                        </div>
                                                    </div>
                                                    <div class="row filter-order-item" onclick="DateScending(false)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-down"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Descending
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $dates = [ 'Date Created','Date Start','Date End','Date Actual Start','Date Actual End' ];

                                    ?>
                                    @foreach ($dates as $index => $date)
                                        <div class="row filter-column-item">
                                            <div class="col-lg-3">
                                                <div class="check-box" >
                                                    <input type="radio" name="radio-status" onclick="DateFilter({{$index}})" <?php if($filters['date'][0] == $index + 1) {echo 'checked'; } ?>>
                                                    <span class="check-mark" style="background-color: rgba(0,0,0,0);"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9  mt-auto mb-auto"><span>{{$date}}</span></div>
                                        </div>
                                    @endforeach
                                    <div style="width: 100%; height: 1px; background-color: whitesmoke"></div>
                                    <div class="row filter-column-item">
                                        <div class="col-lg-3">
                                            <div class="check-box" >
                                                <input type="checkbox" onclick="DateFilter(6)" <?php if($filters['date'][2] == '1') {echo 'checked'; } ?>>
                                                <span class="check-mark" style="background-color: rgba(0,0,0,0);"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-9  mt-auto mb-auto"><span>Show Undated</span></div>
                                    </div>
                                </div>
                                <a href="{{route('filter.reset',['user_id'=>$personalID])}}" type="button" class="btn btn-default m-2" id="taskFilterReset">
                                    <i class="fa fa-reply mb-1"  > </i>Reset Default
                                </a>
                            </div>
                            <div style="display: flex; flex-direction: column;">
                                <div class="filter-column">
                                    <input type="hidden" name="workTimeFilter" id="workTimeFilter" value="{{$filters['workTime']}}">
                                    <div style="display:flex; justify-content: space-between">
                                        <h3  class="mt-auto mb-auto">WorkTime</h3>
                                        <div class="kt-header__topbar-item dropdown mt-auto mb-auto">
                                            <div class="task-order-item" id="workTimeOrderMenu" onclick="WorkTimeOrderMenu()" data-offset="0px,0px" aria-expanded="true" style="font-size: 20px">
                                                <span>
                                                    {{$filter_orders[1][$filter_order[4]-1]}}
                                                </span>
                                                <span>
                                                    @if ($filters['workTime'][1] == '1')
                                                        <i class="fa fa-caret-up"></i>
                                                    @else
                                                        <i class="fa fa-caret-down"></i>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-left dropdown-menu-anim dropdown-menu-top-unround"  id="workTimeOrderDropDownMenu" style="border-radius: 10px; min-width: 1rem !important; transform: translateX(-70%);">
                                                <div class="filter-order-box">
                                                    @foreach($filter_orders[0] as $index => $item)

                                                        <div class="row filter-order-item" onclick="WorkTimeOrderSelect({{$index}})">
                                                            <div class="col-lg-3 kt-notification__item">
                                                                {{$filter_orders[1][$index]}}
                                                            </div>
                                                            <div class="col-lg-9 kt-notification__item">
                                                                {{$item}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div style="width: 100%; height: 1px; background-color: whitesmoke;"></div>
                                                    <div class="row filter-order-item" onclick="WorkTimeScending(true)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-up"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Ascending
                                                        </div>
                                                    </div>
                                                    <div class="row filter-order-item" onclick="WorkTimeScending(false)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-down"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Descending
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $workTime_items = [ 'Time Allocated','Time Spent','Time Remaining'];

                                    ?>
                                    @foreach ($workTime_items as $index => $workTime_item)
                                        <div class="row filter-column-item">
                                            <div class="col-lg-3">
                                                <div class="check-box" >
                                                    <input type="radio" name="radio-workTime" onclick="WorkTimeFilter({{$index}})" <?php if($filters['workTime'][0] == $index + 1) {echo 'checked'; } ?>>
                                                    <span class="check-mark" style="background-color: rgba(0,0,0,0);"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9  mt-auto mb-auto"><span>{{$workTime_item}}</span></div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="filter-column">
                                    <input type="hidden" name="budgetFilter" id="budgetFilter" value="{{$filters['budget']}}">
                                    <div style="display:flex; justify-content: space-between">
                                        <h3 class="mt-auto mb-auto">Budget</h3>
                                        <div class="kt-header__topbar-item dropdown mt-auto mb-auto">
                                            <div class="task-order-item" id="budgetOrderMenu" onclick="BudgetOrderMenu()" data-offset="0px,0px" aria-expanded="true" style="font-size: 20px">
                                                <span>
                                                    {{$filter_orders[1][$filter_order[5]-1]}}
                                                </span>
                                                <span>
                                                    @if ($filters['budget'][1] == '1')
                                                        <i class="fa fa-caret-up"></i>
                                                    @else
                                                        <i class="fa fa-caret-down"></i>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-left dropdown-menu-anim dropdown-menu-top-unround"  id="budgetOrderDropDownMenu" style="border-radius: 10px; min-width: 1rem !important; transform: translateX(-70%);">
                                                <div class="filter-order-box">
                                                    @foreach($filter_orders[0] as $index => $item)

                                                        <div class="row filter-order-item" onclick="BudgetOrderSelect({{$index}})">
                                                            <div class="col-lg-3 kt-notification__item">
                                                                {{$filter_orders[1][$index]}}
                                                            </div>
                                                            <div class="col-lg-9 kt-notification__item">
                                                                {{$item}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div style="width: 100%; height: 1px; background-color: whitesmoke;"></div>
                                                    <div class="row filter-order-item" onclick="BudgetScending(true)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-up"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Ascending
                                                        </div>
                                                    </div>
                                                    <div class="row filter-order-item" onclick="BudgetScending(false)">
                                                        <div class="col-lg-3">
                                                            <i class="fa fa-caret-down"></i>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Descending
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $budget_items = [ 'Budget','Expense','Balance'];
                                    ?>
                                    @foreach ($budget_items as $index => $budget_item)
                                        <div class="row filter-column-item">
                                            <div class="col-lg-3">
                                                <div class="check-box" >
                                                    <input type="radio" name="radio-budget" onclick="BudgetFilter({{$index}})" <?php if($filters['budget'][0] == $index + 1) {echo 'checked'; } ?>>
                                                    <span class="check-mark" style="background-color: rgba(0,0,0,0);"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 mt-auto mb-auto"><span>{{$budget_item}}</span></div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-success m-2" id="taskFilter"> Filter </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        @endif
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
                    <?php $user = auth()->user(); ?>
                    <x-user-avatar :type="$user['avatarType']" :nameTag="$user['nameTag']" :roleID="$user['roleID']" :color="$user['avatarColor']" />
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-color: #0a6aa1">

                    <div class="kt-user-card__name">
                        {{ $user->nameFamily }} &nbsp; {{$user->nameFirst}}
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

