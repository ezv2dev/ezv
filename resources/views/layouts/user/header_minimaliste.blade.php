        <div class="expand-navbar-mobile" aria-expanded="false">
            <div class="px-3 pt-2">
                @auth
                    <div>
                        <div class="d-flex align-items-center">
                            <div class="flex-fill d-flex align-items-center me-3">
                                @if (Auth::user()->avatar)
                                    <img class="lozad user-avatar" src="{{ LazyLoad::show() }}"
                                        data-src="{{ Auth::user()->avatar }}" class="user-photo mt-n2" alt=""
                                        style="border-radius: 50%; width: 50px; height: 50px; border: solid 2px #ff7400;">
                                @else
                                    <img class="lozad user-avatar" src="{{ LazyLoad::show() }}"
                                        data-src="{{ asset('assets/icon/menu/user_default.svg') }}" alt=""
                                        style="border-radius: 50%">
                                @endif
                                <div class="user-details ms-2">
                                    <div class="user-details-name">
                                        {{ Auth::user()->first_name }}
                                        {{ Auth::user()->last_name }}</div>
                                    <div class="user-details-email">
                                        <p class="mb-0">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn-close-expand-navbar-mobile" aria-label="Close"
                                style="background: transparent; border: 0;">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <hr>
                        @php
                            $role = Auth::user()->role_id;
                        @endphp
                        @if ($role == 1 || $role == 2 || $role == 3)
                            <a class="d-block mb-2" href="{{ route('partner_dashboard') }}"
                                style="width: fit-content; color:#585656;">
                                {{ __('user_page.Dashboard') }}
                            </a>
                        @endif
                        {{-- @if ($role == 1 || $role == 2 || $role == 3 || $role == 5)
                            <a class="d-block mb-2 collab-expand" href="{{ route('collaborator_list') }}"
                                style="width: fit-content; color:#585656;">
                                {{ __('user_page.Collabs') }}
                            </a>
                        @endif --}}
                        <a class="d-block mb-2" href="{{ route('profile_index') }}"
                            style="width: fit-content; color:#585656;">
                            {{ __('user_page.My Profile') }}
                        </a>
                        <a class="d-block mb-2" href="{{ route('change_password') }}"
                            style="width: fit-content; color:#585656;">
                            {{ __('user_page.Change Password') }}
                        </a>
                        <a class="d-block mb-2" href="#!"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                            style="width: fit-content; color:#585656;">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            {{ __('user_page.Sign Out') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>

                        <a href="{{ route('switch') }}" class="d-block mb-2"
                            style="color:#585656; width: fit-content;">
                            {{ __('user_page.Switch to Hosting') }}
                        </a>
                        <hr>
                        <div class="d-flex align-items-center mb-2">
                            <a type="button" onclick="language()" class="navbar-gap d-flex align-items-center"
                                style="color: white;">
                                @if (session()->has('locale'))
                                    <img style="width: 27px;" src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                                @else
                                    <img style="width: 27px;" src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                                @endif
                                <p class="mb-0 ms-2" style="color: #585656">{{ __('user_page.Choose a Language') }}</p>
                            </a>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <a type="button" onclick="currency()" class="navbar-gap d-flex align-items-center" style="color: white;">
                            <img class="lozad" style=" width: 27px; border: solid 1px #858585; padding: 2px; border-radius: 3px;" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/icon/currency/dollar-sign.svg') }}">

                            @if (session()->has('currency'))
                            <p class="mb-0 ms-2" style="color: #585656">Change Currency ({{ session('currency') }})</p>
                                {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}"> --}}
                            @else
                            <p class="mb-0 ms-2" style="color: #585656">Choose Currency</p>
                                {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/flags/flag_en.svg') }}"> --}}
                            @endif

                        </a>
                        </div>

                        <div class="d-flex user-logged nav-item dropdown navbar-gap no-arrow">
                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">

                                <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                                    aria-labelledby="navbarDropdownUserImage" style="left:-210px; top: 120%;">

                                </div>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="d-flex align-items-center">
                        <div class="flex-fill d-flex align-items-center">
                            <a type="button" onclick="view_LoginModal();" href="#"
                                class="btn btn-fill border-0 d-flex align-items-center btn-login"
                                style="color: #ddd; margin-right: 0px; padding-top: 15px; padding-bottom: 7px; padding-left:7px; padding-right:8px; width: 50px; height: 50px; border-radius: 50%;"
                                id="login">
                                <i class="fa-solid fa-user"></i>
                                <p class="mb-0 ms-2" style="color:#585656">Login</p>
                            </a>
                        </div>
                        <button type="button" class="btn-close-expand-navbar-mobile" aria-label="Close"
                            style="background: transparent; border: 0;">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <a type="button" onclick="language()" class="navbar-gap d-blok d-flex align-items-center"
                            style="color: white; margin-right: 9px;" id="language">
                            @if (session()->has('locale'))
                                <img style="border-radius: 3px; width: 27px;" class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                            @else
                                <img style="border-radius: 3px; width: 27px;" class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                            @endif
                            <p class="mb-0 ms-2" style="color: #585656">{{ __('user_page.Choose a Language') }}</p>
                        </a>
                    </div>
                    <div class="d-flex align-items-center">
                        <a type="button" onclick="currency()" class="navbar-gap d-flex align-items-center" style="color: white;">
                            <img class="lozad" style=" width: 27px; border: solid 1px #858585; padding: 2px; border-radius: 3px;" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/icon/currency/dollar-sign.svg') }}">

                        @if (session()->has('currency'))
                        <p class="mb-0 ms-2" style="color: #585656">Change Currency ({{ session('currency') }})</p>
                            {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}"> --}}
                        @else
                        <p class="mb-0 ms-2" style="color: #585656">Choose Currency</p>
                            {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('assets/flags/flag_en.svg') }}"> --}}
                        @endif

                    </a>
                    </div>
                @endauth
            </div>
        </div>
        <div id="overlay"></div>
        <div class="header-4-4 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
            <nav id="nav" class="navbar navbar-expand-lg navbar-dark">
                <div class="collapse navbar-collapse navbar-dekstop" id="navbarTogglerDemo">
                    <div id="navbar-first-dekstop" class="col-lg-4 d-flex align-items-center">
                        <a href="{{ route('index') }}">
                            <img class="w-logo" src="{{ asset('assets/logo.png') }}" alt="oke">
                        </a>
                        <div id="navbar-collapse-button" class="flex-fill d-flex justify-content-end">
                            <button class="navbar-toggler" type="button" id="expand-mobile-btn">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>
                    {{-- Jangan Dihapus --}}
                    <div class="col-lg-4">
                        <div id="ul" class="ul-display-block"></div>
                    </div>
                    {{-- / Jangan Dihapus --}}

                    <div id="nav-end-dekstop" class="col-lg-4 ms-auto"
                        style="display: flex; align-items: center; justify-content: flex-end;">
                        @auth
                            <div class="d-flex" style="display: inline-block; align-items: center;">
                                <a type="button" onclick="language()" class="navbar-gap"
                                    style="color: white; width:27px;">
                                    @if (session()->has('locale'))
                                        <img src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                                    @else
                                        <img src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                                    @endif
                                </a>

                                <div class="d-flex user-logged nav-item dropdown navbar-gap no-arrow">
                                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        @if (Auth::user()->avatar)
                                            <img class="lozad" src="{{ LazyLoad::show() }}"
                                                data-src="{{ Auth::user()->avatar }}" class="user-photo mt-n2"
                                                alt=""
                                                style="border-radius: 50%; width: 50px; height: 50px; border: solid 2px #ff7400;">
                                        @else
                                            <img class="lozad" src="{{ LazyLoad::show() }}"
                                                data-src="{{ asset('assets/icon/menu/user_default.svg') }}"
                                                class="user-photo" alt=""
                                                style="border-radius: 50%; width: 50px; height: 50px;">
                                        @endif

                                        <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                                            aria-labelledby="navbarDropdownUserImage" style="left:-210px; top: 120%;">
                                            <h6 class="dropdown-header d-flex align-items-center">
                                                @if (Auth::user()->foto_profile != null)
                                                    <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}"
                                                        data-src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                                                @elseIf (Auth::user()->avatar != null)
                                                    <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}"
                                                        data-src="{{ Auth::user()->avatar }}">
                                                @else
                                                    <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}"
                                                        data-src="{{ asset('assets/icon/menu/user_default.svg') }}">
                                                @endif
                                                <div class="dropdown-user-details">
                                                    <div class="dropdown-user-details-name">
                                                        {{ Auth::user()->first_name }}
                                                        {{ Auth::user()->last_name }}</div>
                                                    <div class="dropdown-user-details-email">{{ Auth::user()->email }}
                                                    </div>
                                                </div>
                                            </h6>
                                            @php
                                                $role = Auth::user()->role_id;
                                            @endphp
                                            @if ($role == 1 || $role == 2 || $role == 3)
                                                <a class="dropdown-item" href="{{ route('partner_dashboard') }}">
                                                    {{ __('user_page.Dashboard') }}
                                                </a>
                                            @endif
                                            @if ($role == 1 || $role == 2 || $role == 3 || $role == 5)
                                                <a class="dropdown-item" href="{{ route('collaborator_list') }}">
                                                    {{ __('user_page.Collabs') }}
                                                </a>
                                            @endif
                                            <a class="dropdown-item" href="{{ route('profile_index') }}">
                                                {{ __('user_page.My Profile') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('change_password') }}">
                                                {{ __('user_page.Change Password') }}
                                            </a>
                                            <a class="dropdown-item" href="#!"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                                <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                                {{ __('user_page.Sign Out') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="post"
                                                style="display: none">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @else
                            <a type="button" onclick="language()" class="navbar-gap"
                                style="color: white; margin-right: 9px; width:27px;" id="language">
                                @if (session()->has('locale'))
                                    <img style="border-radius: 3px; height: 23px;" src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                                @else
                                    <img style="border-radius: 3px;" src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                                @endif
                            </a>
                            <!-- <a type="button" onclick="view_LoginModal();" href="#{{-- {{ route('login') }} --}}"
                                class="btn btn-fill border-0 navbar-gap"
                                style="color: #ffffff; margin-right: 0px; padding-top: 15px; padding-bottom: 7px; padding-left:7px; padding-right:8px; width: 50px; height: 50px; border-radius: 50%;"
                                id="login">
                                <i class="fa-solid fa-user"></i>
                            </a> -->
                            <div class="dropdown">
                                <button onclick="myFunction()" class="dropbtn btn border-0 navbar-gap"></button>
                                <div id="myDropdown" class="dropdown-content">
                                    <a onclick="loginForm(2)">Login</a>
                                    <a onclick="loginForm(2)">Register</a>
                                    <hr>
                                    <a href="{{ route('ahost') }}">Become a Host</a>
                                    <a href="{{ route('collaborator_list') }}">Collaborator Portal</a>
                                    <a href="{{ route('faq') }}">FAQ</a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
        <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
                }
            }
        }
        </script>
