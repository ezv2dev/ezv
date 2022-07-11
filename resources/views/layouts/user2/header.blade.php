{{-- navbar --}}
<section class="h-100 w-100" style="box-sizing: border-box; background-color: #000000;">
    <style>
        @import  url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        .header-4-4 .modal-backdrop.show {
            background-color: #2c2c2c;
            opacity: 1;
        }

        .header-4-4 .modal-item.modal {
            top: 2rem;
        }

        .header-4-4 .navbar,
        .header-4-4 .hero {
            padding: 3rem 2rem;
        }

        .header-4-4 .navbar-dark .navbar-nav .nav-link {
            font: 300 18px/1.5rem Poppins, sans-serif;
            color: #b9b9b9;
            transition: 0.3s;
        }

        .header-4-4 .navbar-dark .navbar-nav .nav-link:hover {
            font: 600 18px/1.5rem Poppins, sans-serif;
            color: #e7e7e8;
            transition: 0.3s;
        }

        .header-4-4 .navbar-dark .navbar-nav .active>.nav-link,
        .header-4-4 .navbar-dark .navbar-nav .nav-link.active,
        .header-4-4 .navbar-dark .navbar-nav .nav-link.show,
        .header-4-4 .navbar-dark .navbar-nav .show>.nav-link {
            font-weight: 600;
            transition: 0.3s;
        }

        .header-4-4 .navbar-dark .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .header-4-4 .btn:focus,
        .header-4-4 .btn:active {
            outline: none !important;
        }

        .header-4-4 .btn-fill {
            font: 600 18px / normal Poppins, sans-serif;
            background-image: linear-gradient(rgba(255, 116, 0, 1),
                    rgba(255, 116, 0, 1));
            border-radius: 12px;
            color: #000000;
            padding: 12px 32px;
            transition: 0.3s;
        }

        .header-4-4 .btn-fill:hover {
            color: #000000;
            --tw-shadow: inset 0 0px 18px 0 rgba(0, 0, 0, 0.7);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
                var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            transition: 0.3s;
        }

        .header-4-4 .btn-no-fill {
            font: 300 18px/1.75rem Poppins, sans-serif;
            color: #e7e7e8;
            padding: 12px 32px;
            transition: 0.3s;
        }

        .header-4-4 .btn-no-fill:hover {
            color: #e7e7e8;
            transition: 0.3s;
        }

        .header-4-4 .modal-item .modal-dialog .modal-content {
            border-radius: 8px;
        }

        .header-4-4 .responsive li a {
            padding: 1rem;
            transition: 0.3s;
        }

        .header-4-4 .left-column {
            margin-bottom: 2.75rem;
            width: 100%;
        }

        .header-4-4 .text-caption {
            font: 600 0.875rem/1.625 Poppins, sans-serif;
            margin-bottom: 2rem;
            color: #c3cdfe;
        }

        .header-4-4 .title-text-big {
            font: 600 2.25rem/2.5rem Poppins, sans-serif;
            margin-bottom: 2rem;
        }

        .header-4-4 .btn-try {
            font: 600 1rem/1.5rem Poppins, sans-serif;
            color: #000000;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            background-image: linear-gradient(rgba(255, 116, 0, 1),
                    rgba(255, 116, 0, 1));
            transition: 0.3s;
        }

        .header-4-4 .btn-try:hover {
            color: #000000;
            --tw-shadow: inset 0 0px 18px 0 rgba(0, 0, 0, 0.7);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
                var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            transition: 0.3s;
        }

        .header-4-4 .btn-outline {
            font: 400 1rem/1.5rem Poppins, sans-serif;
            border: 1px solid #999999;
            color: #999999;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            background-color: transparent;
            transition: 0.3s;
        }

        .header-4-4 .btn-outline:hover {
            border: 1px solid #ffffff;
            color: #ffffff;
            transition: 0.3s;
        }

        .header-4-4 .btn-outline:hover div path {
            fill: #ffffff;
            transition: 0.3s;
        }

        .header-4-4 .right-column {
            width: 100%;
        }

        @media (min-width: 576px) {
            .header-4-4 .modal-item .modal-dialog {
                max-width: 95%;
                border-radius: 12px;
            }

            .header-4-4 .navbar {
                padding: 3rem 2rem;
            }

            .header-4-4 .hero {
                padding: 3rem 2rem 5rem;
            }

            .header-4-4 .title-text-big {
                font-size: 3rem;
                line-height: 1.2;
            }
        }

        @media (min-width: 768px) {
            .header-4-4 .navbar {
                padding: 3rem 4rem;
            }

            .header-4-4 .hero {
                padding: 3rem 4rem 5rem;
            }

            .header-4-4 .left-column {
                margin-bottom: 3rem;
            }
        }

        @media (min-width: 992px) {
            .header-4-4 .navbar-expand-lg .navbar-nav .nav-link {
                padding-right: 1.25rem;
                padding-left: 1.25rem;
            }

            .header-4-4 .navbar {
                padding: 3rem 6rem;
            }

            .header-4-4 .hero {
                padding: 3rem 6rem 5rem;
            }

            .header-4-4 .left-column {
                width: 50%;
                margin-bottom: 0;
            }

            .header-4-4 .title-text-big {
                font-size: 3.75rem;
                line-height: 1.2;
            }

            .header-4-4 .right-column {
                width: 50%;
            }
        }

    </style>
    <div class="header-4-4 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a href="#">
                <img style="margin-right: 0.75rem" src="https://ezv2.ezvillasbali.com/ezv250.png" alt="" />
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal"
                data-bs-target="#targetModal-item">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="modal-item modal fade" id="targetModal-item" tabindex="-1" role="dialog"
                aria-labelledby="targetModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content border-0" style="background-color: #000000">
                        <div class="modal-header border-0" style="padding: 2rem; padding-bottom: 0">
                            <a class="modal-title" id="targetModalLabel">
                                <img style="margin-top: 0.5rem" src="https://ezv2.ezvillasbali.com/ezv250.png" alt="" />
                            </a>
                            <button type="button" class="close btn-close text-white" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                            <ul class="navbar-nav responsive me-auto mt-2 mt-lg-0">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#" style="color: #e7e7e8">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link">Villa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Hotels</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Restaurant</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Activity</a>
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer border-0 gap-3" style="padding: 2rem; padding-top: 0.75rem">
                            <button class="btn btn-default btn-no-fill">Log In</button>
                            <button class="btn btn-fill border-0">Register</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    {{-- <li class="nav-item active">
                        <a class="nav-link" href="#" style="color: #e7e7e8">Home</a>
                    </li> --}}
                    <form action="https://ezv2.ezvillasbali.com/villa-list" method="POST" id="villa-form">
                        <input type="hidden" name="_token" value="CV3apQ70g5aMRSeZpDkdGCAtFgAwTLMs2SeEKm2v">                            <li class="nav-item">
                            <a class="nav-link" id="villa-button" href="#">Villa</a>
                        </li>
                                                    <input type="hidden" name="location" id="location" value="">
                        <input type="hidden" name="check_in" id="in" value="">
                        <input type="hidden" name="check_out" id="out" value="">
                        <input type="hidden" name="adult" id="adult" value="">
                        <input type="hidden" name="children" id="children" value="">
                    </form>
                    <form action="https://ezv2.ezvillasbali.com/hotel-list" method="POST" id="hotel-form">
                        <input type="hidden" name="_token" value="CV3apQ70g5aMRSeZpDkdGCAtFgAwTLMs2SeEKm2v">                            <li class="nav-item">
                            <a class="nav-link" id="hotel-button" href="#">Hotel</a>
                        </li>
                                                    <input type="hidden" name="location" id="location" value="">
                        <input type="hidden" name="check_in" id="in" value="">
                        <input type="hidden" name="check_out" id="out" value="">
                        <input type="hidden" name="adult" id="adult" value="">
                        <input type="hidden" name="children" id="children" value="">
                    </form>
                    <form action="https://ezv2.ezvillasbali.com/restaurant-list" method="POST" id="restaurant-form">
                        <input type="hidden" name="_token" value="CV3apQ70g5aMRSeZpDkdGCAtFgAwTLMs2SeEKm2v">                            <li class="nav-item">
                            <a class="nav-link" id="restaurant-button" href="#">Restaurant</a>
                        </li>
                                                    <input type="hidden" name="location" id="location" value="">
                        <input type="hidden" name="check_in" id="in" value="">
                        <input type="hidden" name="check_out" id="out" value="">
                        <input type="hidden" name="adult" id="adult" value="">
                        <input type="hidden" name="children" id="children" value="">
                    </form>
                    <form action="https://ezv2.ezvillasbali.com/villa-list" method="POST" id="activity-form">
                        <input type="hidden" name="_token" value="CV3apQ70g5aMRSeZpDkdGCAtFgAwTLMs2SeEKm2v">                            <li class="nav-item">
                            <a class="nav-link" id="activity-button" href="#">Activity</a>
                        </li>
                                                    <input type="hidden" name="location" id="location" value="">
                        <input type="hidden" name="check_in" id="in" value="">
                        <input type="hidden" name="check_out" id="out" value="">
                        <input type="hidden" name="adult" id="adult" value="">
                        <input type="hidden" name="children" id="children" value="">
                    </form>
                </ul>
                <div class="gap-3">
                    @auth
                    <div class="d-flex" style="display: inline-block">
                        <h5 class="mx-4" style="color: white; margin-top: 20px;">{{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}</h5>
                        <div class="d-flex user-logged nav-item dropdown no-arrow">
                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{-- Halo, {{Auth::user()->name}}! --}}
                                @if (Auth::user()->avatar)
                                <img src="{{Auth::user()->avatar}}" class="user-photo mt-n2" alt=""
                                    style="border-radius: 50%; width: 60px;">
                                @else
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}" class="user-photo" alt=""
                                    style="border-radius: 50%">
                                @endif
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                                    style="right: 0; left: auto">
                                    <li>
                                        <a href="{{route('profile_index')}}" class="dropdown-item">My Profile</a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign
                                            Out</a>
                                        <form id="logout-form" action="{{route('logout')}}" method="post"
                                            style="display: none">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </li>
                                </ul>
                            </a>
                        </div>
                    </div>

                    @else
                    <a href="{{ route('register.partner') }}" class="btn btn-fill border-0" style="color: #ffffff;">
                        Become a host
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-fill border-0" style="color: #ffffff;">
                        Log In
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-fill border-0" style="color: #ffffff;">
                        Sign Up
                    </a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</section>
{{-- end navbar --}}
