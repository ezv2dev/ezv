<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <link href="{{ asset('assets/partner/css/styles.css') }}" rel="stylesheet" />
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">

    <script data-search-pseudo-elements defer
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous">
    </script>

    <style>
        .loading-splash-screen {
            background-color: white !important;
            height: 100%;
            position: fixed;
            z-index: 9999;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-1-1.navbar-light .navbar-nav .nav-link {
            color: #092a33;
            transition: 0.3s;
        }

        .navbar-1-1.navbar-light .navbar-nav .nav-link.active {
            font-weight: 500;
        }

        .navbar-1-1 .btn-get-started {
            border-radius: 20px;
            padding: 12px 30px;
            font-weight: 500;
        }

        .navbar-1-1 .btn-get-started-blue {
            background-color: #ff7400;
            transition: 0.3s;
        }

        .navbar-1-1 .btn-get-started-blue:hover {
            background-color: #FF7400;
            transition: 0.3s;
        }

        .borderr:hover {
            background-color: #eff3f9;
            border-radius: 30px;
            border-bottom: none !important;
        }

        .border-bottom {
            border-bottom: 2px solid #222222 !important;
        }

    </style>

</head>

<body class="nav-fixed">
    @component('components.loading.loading-dashboard')@endcomponent

    <nav class="navbar-1-1 navbar navbar-expand-lg navbar-light p-4 px-md-4"
        style="margin-bottom:-2%; font-family: Montreal, sans-serif;">
        <div class="container">
            <a href="{{ route('partner_dashboard') }}" class="navbar-brand mt-2 mb-n2" target="_blank">
                <img style="width: 90px;" src="{{ asset('assets/logo.png') }}" alt="oke">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mx-auto mb-lg-0">
                    @if (Request::is('account-settings*') || Request::is('referral*') || Request::is('users/edit-photo')
                    || Request::is('account-delete') || Request::is('profile*'))

                    @else

                    <li class="nav-item">
                        <a class="borderr nav-link px-md-4 {{ Request::is('dashboard') || Request::is('dashboard/arriving_soon') || Request::is('dashboard/checkout') || Request::is('dashboard/upcoming')  ? "border-bottom" : ""}}"  href="{{ route('partner_dashboard') }}"
                            style="color: #000000; {{ Request::is('dashboard') || Request::is('dashboard/arriving_soon') || Request::is('dashboard/checkout') || Request::is('dashboard/upcoming') ? "font-weight: 600;" : ""}}">Today</a>
                    </li>
                    <li class="nav-item">
                        <a class="borderr nav-link px-md-4 {{ Request::is('dashboard/inbox*')  ? "border-bottom" : ""}}" href="{{ route('partner_inbox') }}"
                            style="color: #000000; {{ Request::is('dashboard/inbox*')  ? "font-weight: 600;" : ""}}">Inbox</a>
                    </li>
                    <li class="nav-item">
                        <a class="borderr nav-link px-md-4 {{ Request::is('dashboard/calendar*')  ? "border-bottom" : ""}}" href="{{ route('calendar_index') }}"
                            style="color: #000000; {{ Request::is('dashboard/calendar*')  ? "font-weight: 600;" : ""}}">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="borderr nav-link px-md-4 {{ Request::is('dashboard/progress*')  ? "border-bottom" : ""}}" href="{{ route('insight_dashboard') }}"
                            style="color: #000000; {{ Request::is('dashboard/progress*') ? "font-weight: 600;" : ""}}">Insight</a>
                    </li>
                    <li class="nav-item dropdown no-caret mr-1 dropdown-notifications">
                        <a class="{{ Request::is('dashboard/listing') || Request::is('dashboard/reservation*') || Request::is('users/*') || Request::is('manage-guidebook') ? "border-bottom" : ""}} borderr nav-link px-md-5 btn btn-icon btn-transparent-dark dropdown-toggle"
                            id="navbarDropdownMessages" href="javascript:void(0);" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <p style="color: #000000; {{ Request::is('dashboard/listing') || Request::is('dashboard/reservation') || Request::is('users/*') || Request::is('manage-guidebook')  ? "font-weight: 600;" : ""}}">Menu <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" style="fill: rgb(113, 113, 113); height: 12px; width: 12px; stroke: currentcolor; stroke-width: 5.33333; overflow: visible;" aria-hidden="true" role="presentation" focusable="false"><g fill="none"><path d="m28 12-11.2928932 11.2928932c-.3905243.3905243-1.0236893.3905243-1.4142136 0l-11.2928932-11.2928932"></path></g></svg></p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                            aria-labelledby="navbarDropdownMessages">
                            <a class="dropdown-item dropdown-notifications-item"
                                href="{{ route('listing_dashboard') }}">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Listing</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item"
                                href="{{ route('reservations_dashboard') }}">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Reservations</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item"
                                href="{{ route('admin_add_listing') }}">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Create new listing</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="{{ route('manage_guidebook') }}">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Guidebooks</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="{{ route('completed_payouts') }}">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Transaction history</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Explore hosting resources
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Visit our community forum
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                    @if (Auth::user()->role_id == 1)
                    <li class="nav-item dropdown no-caret mr-1 dropdown-notifications">
                        <a style="padding: 0px 60px;" class="{{ Request::is('dashboard/restaurant*') ? "border-bottom" : ""}} borderr nav-link btn btn-icon btn-transparent-dark dropdown-toggle"
                            id="navbarDropdownMessages" href="javascript:void(0);" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <p style="color: #000000; {{ Request::is('dashboard/restaurant*') ? "font-weight: 600;" : ""}}">Restaurant <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" style="fill: rgb(113, 113, 113); height: 12px; width: 12px; stroke: currentcolor; stroke-width: 5.33333; overflow: visible;" aria-hidden="true" role="presentation" focusable="false"><g fill="none"><path d="m28 12-11.2928932 11.2928932c-.3905243.3905243-1.0236893.3905243-1.4142136 0l-11.2928932-11.2928932"></path></g></svg></p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                            aria-labelledby="navbarDropdownMessages">
                            <a class="dropdown-item dropdown-notifications-item" href="{{ route('admin_restaurant') }}">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">List Restaurant</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Restaurant List</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="{{ route('admin_add_listing') }}">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Create new listing</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="{{ route('manage_guidebook') }}">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Guidebooks</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="{{ route('completed_payouts') }}">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Transaction history</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Explore hosting resources
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">Visit our community forum
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                    @endif

                    @endif

                </ul>
                <ul class="navbar-nav align-items-center">
                    @if (Request::is('account-settings*') || Request::is('account-delete') || Request::is('referral*')
                    || Request::is('users/edit-photo') || Request::is('profile*'))
                    <li class="nav-item">
                        <a style="color: #524A4E;" aria-current="page" href="{{ route('partner_dashboard') }}">Switch to
                            hosting</a>
                    </li>
                    @endif
                    <li class="nav-item dropdown no-caret mr-3 d-none d-md-inline">
                        <div class="dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up"
                            aria-labelledby="navbarDropdownDocs">
                            <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro"
                                target="_blank">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="book"></i>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Documentation</div>
                                    Usage instructions and reference
                                </div>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/components"
                                target="_blank">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="code"></i>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Components</div>
                                    Code snippets and reference
                                </div>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/changelog"
                                target="_blank">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i
                                        data-feather="file-text"></i></div>
                                <div>
                                    <div class="small text-gray-500">Changelog</div>
                                    Updates and changes
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown no-caret mr-3 d-md-none">
                        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                data-feather="search"></i></a>
                        <!-- Dropdown - Search-->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--fade-in-up"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100">
                                <div class="input-group input-group-joined input-group-solid">
                                    <input class="form-control" type="text" placeholder="Search for..."
                                        aria-label="Search" aria-describedby="basic-addon2" />
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i data-feather="search"></i></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
                        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts"
                            href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i data-feather="bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                            aria-labelledby="navbarDropdownAlerts">
                            <h6 class="dropdown-header dropdown-notifications-header">
                                <i class="mr-2" data-feather="bell"></i>
                                Alerts Center
                            </h6>
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i>
                                </div>
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-details">December 29, 2019</div>
                                    <div class="dropdown-notifications-item-content-text">This is an alert message.
                                        It's nothing serious, but it requires your attention.</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-icon bg-info"><i data-feather="bar-chart"></i>
                                </div>
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-details">December 22, 2019</div>
                                    <div class="dropdown-notifications-item-content-text">A new monthly report is
                                        ready. Click here to view!</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-icon bg-danger"><i
                                        class="fas fa-exclamation-triangle"></i></div>
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-details">December 8, 2019</div>
                                    <div class="dropdown-notifications-item-content-text">Critical system failure,
                                        systems shutting down.</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-icon bg-success"><i
                                        data-feather="user-plus"></i></div>
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-details">December 2, 2019</div>
                                    <div class="dropdown-notifications-item-content-text">New user request. Woody
                                        has requested access to the organization.</div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-notifications-footer" href="#!">View All Alerts</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown no-caret mr-2 dropdown-user">
                        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                            href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            {{-- @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" class="img-fluid"
                            alt="Pict">
                            @else
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}" class="img-fluid"
                                alt="Pict">
                            @endif --}}
                            @if (Auth::user()->foto_profile != NULL)
                            <img class="img-fluid" src="{{ asset('foto_profile/'.Auth::user()->foto_profile) }} ">
                            @elseIf (Auth::user()->avatar != NULL)
                            <img class="img-fluid" src="{{ Auth::user()->avatar }}">
                            @else
                            <img class="img-fluid"
                                src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}">
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                            aria-labelledby="navbarDropdownUserImage">
                            <h6 class="dropdown-header d-flex align-items-center">
                                @if (Auth::user()->foto_profile != NULL)
                                <img class="dropdown-user-img"
                                    src="{{ asset('foto_profile/'.Auth::user()->foto_profile) }} ">
                                @elseIf (Auth::user()->avatar != NULL)
                                <img class="dropdown-user-img" src="{{ Auth::user()->avatar }}">
                                @else
                                <img class="dropdown-user-img"
                                    src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}">
                                @endif
                                {{-- @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}"
                                class="dropdown-user-img" alt="Pict">
                                @else
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}"
                                    class="dropdown-user-img" alt="Pict">
                                @endif --}}
                                <div class="dropdown-user-details">
                                    <div class="dropdown-user-details-name">{{ Auth::user()->first_name }}
                                        {{ Auth::user()->last_name }}</div>
                                    <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                                </div>
                            </h6>
                            <a class="dropdown-item" href="{{ route('profile_user') }}">
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('account_setting') }}">
                                Account
                            </a>
                            <a class="dropdown-item" href="{{ route('help_guest') }}">
                                Get Help
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="language()">
                                Language and translation
                            </a>
                            {{-- <a class="dropdown-item" href="javascript:void(0);" onclick="currency()">
                                {{ Auth::user()->currency->symbol }} {{ Auth::user()->currency->code }}
                            </a> --}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('refer_host') }}">
                                Refer a Host
                            </a>
                            <a class="dropdown-item" href="{{ route('index') }}">
                                Switch to traveling
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#!"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                Logout
                            </a>
                            <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <hr>
        @yield('content_admin')

        @include('user.modal.dashboard.modal_language')
        @include('user.modal.dashboard.modal_currency')
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/partner/js/scripts.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/partner/assets/demo/datatables-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/partner/assets/demo/date-range-picker-demo.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        function sidebarhide() {
            $("body").css({
                "height": "auto",
                "overflow": "auto"
            })
            $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
            $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
            $(".expand-navbar-mobile").attr("aria-expanded", "false");
            $("#overlay").css("display", "none");
        }
        function language() {
            sidebarhide();
            $('#ModalLanguage').modal('show');
        }

        function currency() {
            sidebarhide();
            $('#ModalCurrency').modal('show');
        }

    </script>

    @yield('scripts')
</body>

</html>
