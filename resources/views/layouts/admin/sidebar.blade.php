<!-- Sidebar -->
<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header (mini Sidebar mode) -->
    <div class="smini-visible-block">
        <div class="content-header">
            <!-- Logo -->
            <a class="fw-semibold text-white tracking-wide" href="{{ route('index') }}">
                EZV<span class="opacity-75">2</span>
            </a>
            <!-- END Logo -->
        </div>
    </div>
    <!-- END Side Header (mini Sidebar mode) -->

    <!-- Side Header (normal Sidebar mode) -->
    <div class="smini-hidden">
        <div class="content-header justify-content-lg-center">
            <!-- Logo -->
            <a class="fw-semibold text-white tracking-wide" href="{{ route('index') }}">
                EZV<span class="opacity-75">2</span>
                <span class="fw-normal">V 1.0</span>
            </a>
            <!-- END Logo -->

            <!-- Options -->
            <div class="d-lg-none">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout"
                    data-action="sidebar_close">
                    <i class="fa fa-times-circle"></i>
                </button>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Options -->
        </div>
    </div>
    <!-- END Side Header (normal Sidebar mode) -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Actions -->
        {{-- <div class="content-side content-side-full bg-black-10 text-center">
        <div class="smini-hide">
            <button type="button" class="btn btn-sm btn-secondary">
            <i class="fa fa-fw fa-user-circle"></i>
            </button>
            <button type="button" class="btn btn-sm btn-secondary">
            <i class="fa fa-fw fa-pencil-alt"></i>
            </button>
            <button type="button" class="btn btn-sm btn-secondary">
            <i class="fa fa-fw fa-file-alt"></i>
            </button>
            <button type="button" class="btn btn-sm btn-secondary">
            <i class="fa fa-fw fa-envelope"></i>
            </button>
            <button type="button" class="btn btn-sm btn-secondary">
            <i class="fa fa-fw fa-cog"></i>
            </button>
        </div>
        </div> --}}
        <!-- END Side Actions -->

        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                @if (Auth::user()->role_id == 1)
                    <li class="nav-main-heading sidebar-light">Permission Setting</li>
                    <li
                        class="nav-main-item {{ request()->routeIs('admin_permission') || request()->routeIs('admin_permission_role_index') ? 'open' : '' }}">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                            aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-cogs"></i>
                            <span class="nav-main-link-name sidebar-light">Permission</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_permission') ? 'active' : '' }}"
                                    href="{{ route('admin_permission') }}">
                                    <span class="nav-main-link-name sidebar-light">Permission</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_permission_role_index') ? 'active' : '' }}"
                                    href="{{ route('admin_permission_role_index') }}">
                                    <span class="nav-main-link-name sidebar-light">Role Permission</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <li class="nav-main-heading sidebar-light">Main Setting</li>

                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('index') }}">
                            <i class="nav-main-link-icon fa fa-globe"></i>
                            <span class="nav-main-link-name sidebar-light">Go to Website</span>
                        </a>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->routeIs('admin_dashboard') ? 'active' : '' }}"
                            href="{{ route('admin_dashboard') }}">
                            <i class="nav-main-link-icon fa fa-chart-bar"></i>
                            <span class="nav-main-link-name sidebar-light">Dashboard</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->routeIs('admin_user') ? 'active' : '' }}"
                            href="{{ route('admin_user') }}">
                            <i class="nav-main-link-icon fa fa-user"></i>
                            <span class="nav-main-link-name sidebar-light">User</span>
                        </a>
                    </li>
                @endif

                <li
                    class="nav-main-item {{ request()->routeIs('admin_villa') ||request()->routeIs('admin_villa_booking') ||request()->routeIs('admin_villa_booking_list') ||request()->routeIs('admin_villatype') ||request()->routeIs('admin_no_bedroom') ||request()->routeIs('admin_bedroom') ||request()->routeIs('admin_bathroom') ||request()->routeIs('admin_kitchen') ||request()->routeIs('admin_service') ||request()->routeIs('admin_safety') ||request()->routeIs('admin_amenities')? 'open': '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-home"></i>
                        <span class="nav-main-link-name sidebar-light">Villa</span>
                    </a>
                    <ul class="nav-main-submenu">
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_villa') ? 'active' : '' }}"
                                    href="{{ route('admin_villa') }}">
                                    <span class="nav-main-link-name sidebar-light">List Villa</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_villa_booking') ? 'active' : '' }}"
                                    href="{{ route('admin_villa_booking') }}">
                                    <span class="nav-main-link-name sidebar-light">Add Booking Villa</span>
                                </a>
                            </li>
                        @endif
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('admin_villa_booking_list') ? 'active' : '' }}"
                                href="{{ route('admin_villa_booking_list') }}">
                                <span class="nav-main-link-name sidebar-light">Villa Booking</span>
                            </a>
                        </li>
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_villatype') ? 'active' : '' }}"
                                    href="{{ route('admin_villatype') }}">
                                    <span class="nav-main-link-name sidebar-light">Villa Type</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_no_bedroom') ? 'active' : '' }}"
                                    href="{{ route('admin_no_bedroom') }}">
                                    <span class="nav-main-link-name sidebar-light">No Of Bedroom</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_bedroom') ? 'active' : '' }}"
                                    href="{{ route('admin_bedroom') }}">
                                    <span class="nav-main-link-name sidebar-light">Bedroom</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_bathroom') ? 'active' : '' }}"
                                    href="{{ route('admin_bathroom') }}">
                                    <span class="nav-main-link-name sidebar-light">Bathroom</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_kitchen') ? 'active' : '' }}"
                                    href="{{ route('admin_kitchen') }}">
                                    <span class="nav-main-link-name sidebar-light">Kitchen</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_service') ? 'active' : '' }}"
                                    href="{{ route('admin_service') }}">
                                    <span class="nav-main-link-name sidebar-light">Service</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_safety') ? 'active' : '' }}"
                                    href="{{ route('admin_safety') }}">
                                    <span class="nav-main-link-name sidebar-light">Safety</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_amenities') ? 'active' : '' }}"
                                    href="{{ route('admin_amenities') }}">
                                    <span class="nav-main-link-name sidebar-light">General Amenities</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-utensils"></i>
                        <span class="nav-main-link-name sidebar-light">Restaurant</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('admin_restaurant') ? 'active' : '' }}"
                                href="{{ route('admin_restaurant') }}">
                                <span class="nav-main-link-name sidebar-light">List Restaurant</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#">
                                <span class="nav-main-link-name sidebar-light">Restaurant Booking</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('restaurant_type') }}">
                                <span class="nav-main-link-name sidebar-light">Restaurant Type</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('restaurant_facilities') ? 'active' : '' }}"
                                href="{{ route('restaurant_facilities') }}">
                                <span class="nav-main-link-name sidebar-light">Restaurant Facilities</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('restaurant_meal') ? 'active' : '' }}"
                                href="{{ route('restaurant_meal') }}">
                                <span class="nav-main-link-name sidebar-light">Restaurant Meal</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('restaurant_price') ? 'active' : '' }}"
                                href="{{ route('restaurant_price') }}">
                                <span class="nav-main-link-name sidebar-light">Restaurant Price</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('restaurant_cuisine') ? 'active' : '' }}"
                                href="{{ route('restaurant_cuisine') }}">
                                <span class="nav-main-link-name sidebar-light">Restaurant Cuisine</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('restaurant_dishes') ? 'active' : '' }}"
                                href="{{ route('restaurant_dishes') }}">
                                <span class="nav-main-link-name sidebar-light">Restaurant Dishes</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('restaurant_dietary_food') ? 'active' : '' }}"
                                href="{{ route('restaurant_dietary_food') }}">
                                <span class="nav-main-link-name sidebar-light">Restaurant Dietary Food</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('restaurant_goodfor') ? 'active' : '' }}"
                                href="{{ route('restaurant_goodfor') }}">
                                <span class="nav-main-link-name sidebar-light">Restaurant Good For</span>
                            </a>
                        </li>
                    </ul>
                </li>

                @if (auth()->user()->role->name === 'partner')
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                            aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-utensils"></i>
                            <span class="nav-main-link-name sidebar-light">Messages</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('owner_villa_get_messages') ? 'active' : '' }}"
                                    href="{{ route('owner_villa_get_messages') }}">
                                    <span class="nav-main-link-name sidebar-light">List Villa Messages</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="#">
                                    <span class="nav-main-link-name sidebar-light">Restaurant Booking</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']))
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                            aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-utensils"></i>
                            <span class="nav-main-link-name sidebar-light">Messages</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->routeIs('admin_villa_get_messages') ? 'active' : '' }}"
                                    href="{{ route('admin_villa_get_messages') }}">
                                    <span class="nav-main-link-name sidebar-light">List Villa Messages</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="#">
                                    <span class="nav-main-link-name sidebar-light">Restaurant Booking</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-walking"></i>
                        <span class="nav-main-link-name sidebar-light">Activity</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('admin_activity') ? 'active' : '' }}"
                                href="{{ route('admin_activity') }}">
                                <span class="nav-main-link-name sidebar-light">List Activity</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#">
                                <span class="nav-main-link-name sidebar-light">Activity Booking</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('activity_facilities') ? 'active' : '' }}"
                                href="{{ route('activity_facilities') }}">
                                <span class="nav-main-link-name sidebar-light">Activity Facilities</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('activity_category') ? 'active' : '' }}"
                                href="{{ route('activity_category') }}">
                                <span class="nav-main-link-name sidebar-light">Activity Category</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('activity_subcategory') ? 'active' : '' }}"
                                href="{{ route('activity_subcategory') }}">
                                <span class="nav-main-link-name sidebar-light">Activity Sub-Category</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-hotel"></i>
                        <span class="nav-main-link-name sidebar-light">Hotel</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link " href="#">
                                <span class="nav-main-link-name sidebar-light">List Hotel</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#">
                                <span class="nav-main-link-name sidebar-light">Add Booking Hotel</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#">
                                <span class="nav-main-link-name sidebar-light">Hotel Booking</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->routeIs('admin_location') ? 'active' : '' }}"
                            href="{{ route('admin_location') }}">
                            <i class="nav-main-link-icon fa fa-map-marker-alt"></i>
                            <span class="nav-main-link-name sidebar-light">Location</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->
