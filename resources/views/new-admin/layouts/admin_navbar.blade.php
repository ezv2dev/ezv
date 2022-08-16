<style>
    ul{
        padding:0;
        margin:0;
    }
    li{
        list-style:none;
    }
    a, a:hover{
        text-decoration:none;
    }

    #header{
        position:fixed;
        top:0;
        background:white;
        border-bottom:1px solid #ddd;
        z-index: 10;
        width:100%;
    }

    #navBar{
        gap:1rem;
    }
    
    #navBar, #subNav{
        padding:1rem;
        display:flex;
        justify-content:space-between;
    }

    #subNav{
        display:none;
    }

    .navbar-logo-container{
        display:flex;
        align-items:center;
        gap:1rem;
    }

    .nav-logo-img{
        width:90px;
    }

    .navbar-logo-h4{
        font-weight:600;
        display:none;
    }

    #navbarMenu{
        width:100%;
        display:flex;
        justify-content:center;
    }

    .nav-menu-container{
        display:flex;
        align-items:start;
        flex-wrap:nowrap;
        gap:1rem;
        width:100%;
        max-width:360px;
    }

    .nav-link{
        position:relative;
        display:flex;
        flex-direction:column;
        gap:.5rem;
        align-items:center;
        justify-content:center;
        color:black;
        text-align:center;
        padding:0;
        width:20%;
    }

    .nav-icon-link-container{
        border:2px solid #ff7400;
        border-radius:50%;
        width:50px;
        height:50px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:white;
    }

    .nav-icon-link{
        width:20px;
        height:auto;
    }

    .nav-icon-link:not(.no-filter){
        filter:invert(42%) sepia(93%) saturate(1352%) hue-rotate(87deg) brightness(1%) contrast(119%);
    }

    .nav-link:hover{
        cursor:pointer;
        color:black;

    }

    .nav-link:hover .nav-icon-link-container{
        background:#ff7400;
    }

    .nav-link:hover .nav-icon-link{
        filter:none;
    }

    .nav-link a{
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
    }

    #btnSwitchProfile{
        padding:.5rem .825rem;
        border:2px solid #212121;
        border-radius:.75rem;
        background:white;
        font-weight:500;
    }

    #btnSwitchProfile:hover{
        cursor:pointer;
        background:black;
        color:white;
    }


    .nav-end-container{
        display:none;
        align-items:center;
    }

    .logged-user-menu{
        width: 80px;
        background-image: linear-gradient(to right, #FEA429 , #FD6920);
        border-radius: 20px;
        padding: 5px;
        display:flex;
    }

    .button-change-language{
        color: white; 
        margin-right: 9px; 
        width:27px;"
    }

    .nav-icon-lang{
        border-radius: 3px; 
        box-shadow: 1px 1px 2px #dedede;
    }

    .logged-user-photo{
        width: 35px;
        height: 35px;
        border: solid 2px white;
        border-radius: 50%;
    }
    
    .dropdown-user-img{
        height: 2.5rem;
        width: 2.5rem;
        margin-right: 1rem;
        border-radius: 100%;
    }
    
    .logged-item{
        flex:1;
        position: relative;
    }

    .container-mode {
        position: relative;
        width: 100%;
        height: 100%;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .container-mode input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .checkmark-mode {
        position: relative;
        display: block;
        height: 100%;
        background-color: transparent;
    }

    .checkmark-mode::before {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 18px;
        height: 18px;
        content: url(../../assets/icon/menu/sun.svg);
    }

    .container-mode input:checked ~ .checkmark-mode::before {
        content: url(../../assets/icon/menu/moon.svg);
    }

    #dropdownMenuLink:hover{
        cursor:pointer;
    }

    .dropdown-menu-user{
        border-radius:1rem;
        border: 2px solid #ff7400;
        background:white;
        min-width:220px;
        display:none;
        position:absolute;
        top:150%;
        right:0;
        padding:.5rem;
        z-index:5;
    }

    .dropdown-user-details-name{
        font-size: 0.9rem;
        color: #222222;
    }

    .dropdown-user-details-email{
        color: #687281;
        font-size: 0.75rem;
    }

    .dropdown-user-details-name,
    .dropdown-user-details-email{
        font-weight: 500;
        max-width: 10rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .dropdown-item{
        font-size: 0.9rem !important;
        font-family: "Poppins" !important;
    }

    .sign-out-link{
        display:flex;
        align-items:center;
        gap:.45rem;
    }

    #navbarCollapseButton{
        display:flex;
        justify-content:end;
    }

    #expand-mobile-btn{
        font-size:30px;
        color:black;
        padding:0;
    }

    .subnav-container{
        display:flex;
        justify-content:space-between;
        align-items:center;
        width:100%;
        overflow-x:auto;
        gap:1rem;
    }
    
    .subnav-list{
        position:relative;
    }

    .subnav-list a{
       color:black;
       font-weight:500;
    }

    .subnav-list:hover{
        cursor:pointer;
    }

    @media (min-width: 992px) {
        #navBar, #subNav{
            padding:1rem 4rem;
        }

        #subNav{
            display:flex;
        }

        .nav-menu-container, 
        .nav-link{
            width:auto;
        }

        .nav-menu-container{
            max-width:none;
        }

        .navbar-logo-h4{
            display:block;
        }

        #navbarMenu{
            width:auto;
        }

        .nav-link:nth-last-child(1) {
            margin-left:20px;
        } 
        
        #btnSwitchProfile{
            margin-right:24px;
        }

        #navbarCollapseButton{
            display:none;
        }

        .nav-end-container{
            display:flex;
        }
    }
</style>



@php
    $tema = isset($_COOKIE['tema']) ? $_COOKIE['tema'] : null;
    $role = Auth::user()->role_id;
@endphp

<header id="header">
    <div class="container-xxl">
        <nav id="navBar" class="navbar navbar-expand-lg">
            <a href="{{ route('partner_dashboard') }}" class="navbar-brand navbar-logo-container" target="_blank">
                <img class="nav-logo-img" src="{{ asset('assets/logo.png') }}" alt="oke">
                <h4 class="navbar-logo-h4">Host Dashboard</h4>
            </a>
        
            <div id="navbarCollapseButton">    
                <button class="btn navbar-btn-toggler" type="button" id="expand-mobile-btn">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            
            <div id="navbarMenu">
                <ul class="nav-menu-container">
                    <li class="nav-link">
                        <a href="{{ route('list') }}" target="_blank"></a>
                        <div class="nav-icon-link-container">
                            <img src="{{ asset('assets/icon/menu/homes.svg')}}" class="nav-icon-link" alt="">
                        </div>
                        <p>Rumah</p>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('restaurant_list') }}" target="_blank"></a>
                        <div class="nav-icon-link-container">
                            <img src="{{ asset('assets/icon/menu/food.svg')}}" class="nav-icon-link" alt="">
                        </div>
                        <p>Kuliner</p>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('hotel_list') }}" target="_blank"></a>
                        <div class="nav-icon-link-container">
                            <img src="{{ asset('assets/icon/menu/hotel.svg')}}" class="nav-icon-link" alt="">
                        </div>
                        <p>Hotel</p>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('activity_list') }}" target="_blank"></a>
                        <div class="nav-icon-link-container">
                            <img src="{{ asset('assets/icon/menu/wow.svg')}}" class="nav-icon-link no-filter" alt="">
                        </div>
                        <p>Wow</p>
                    </li> 
                    <li class="nav-link">
                        <a href="{{ route('collaborator_list') }}" target="_blank"></a>
                        <div class="nav-icon-link-container">
                            <img src="{{ asset('assets/icon/menu/list.svg')}}" class="nav-icon-link" alt="">
                        </div>
                        <p>Buat Daftar</p>
                    </li> 
                </ul>
            </div>
        
            <div class="nav-end-container">
                <a id="btnSwitchProfile">Switch Profile</a>
                <a type="button" onclick="language()" class="button-change-language">
                    <img class="nav-icon-lang" src="{{ session()->has('locale')? URL::asset('assets/flags/flag_' . session('locale') . '.svg') : URL::asset('assets/flags/flag_en.svg') }}">
                </a>
                
                <div class="logged-user-menu">
                    <div class="logged-item">
                        <label class="container-mode">
                            <input type="checkbox" id="background-color-switch" onclick="changeBackgroundTrigger(this)" {{ $tema != null && $tema == 'black' ? 'checked' : '' }} class="change-mode-dekstop">
                            <span class="checkmark-mode"></span>
                        </label>
                    </div>
        
                    <div class="logged-item">
                        <a id="dropdownMenuLink">
                            <img src="{{ Auth::user()->avatar ? Auth::user()->avatar : asset('assets/icon/menu/user_default.svg') }}" class="logged-user-photo" id="dropdownMenuLinkImg" alt="">
                        </a>
                        <div class="dropdown-menu-user">
                            <h6 class="dropdown-header d-flex align-items-center">
                                @if (Auth::user()->foto_profile != null)
                                    <img class="dropdown-user-img" src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                                @elseIf (Auth::user()->avatar != null)
                                    <img class="dropdown-user-img" src="{{ Auth::user()->avatar }}">
                                @else
                                    <img class="dropdown-user-img" src="{{ asset('assets/icon/menu/user_default.svg') }}">
                                @endif
                                <div class="dropdown-user-details">
                                    <div class="dropdown-user-details-name">{{ Auth::user()->first_name }}
                                        {{ Auth::user()->last_name }}</div>
                                    <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                                </div>
                            </h6>
        
                            @if (in_array($role, [1,2,3]))
                                <a class="dropdown-item" href="{{ route('partner_dashboard') }}">
                                    {{ __('user_page.Dashboard') }}
                                </a>
                            @endif
                            @if (in_array($role, [1,2,3,5]))
                                <a class="dropdown-item" href="{{ route('collaborator_list') }}">
                                    {{ __('user_page.Collab Portal') }}
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('profile_index') }}">
                                {{ __('user_page.My Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('change_password') }}">
                                {{ __('user_page.Change Password') }}
                            </a>
                            <a class="dropdown-item sign-out-link" href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                <i data-feather="log-out"></i>
                                {{ __('user_page.Sign Out') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div id="subNav">
            <ul class="subnav-container">
                <li class="subnav-list">
                    <a href="">Listings</a>
                </li>
                <li class="subnav-list">
                    <a href="">Calendar</a>
                </li>
                <li class="subnav-list">
                    <a href="">Reservations</a>
                </li>
                <li class="subnav-list">
                    <a href="">Analytics</a>
                </li>
                <li class="subnav-list">
                    <a href="">Accounts</a>
                </li>
                <li class="subnav-list">
                    <a href="">Inbox</a>
                </li>
            </ul>
        </div>
    </div>
</header>


<script>

    // Function Dropdown
    $('#dropdownMenuLink #dropdownMenuLinkImg').on('click', function(){
        $('.dropdown-menu-user').slideToggle('fast');
    })

    $(document).on('click', function(event) {
        let arrayIDButtonDropdown = ['dropdownMenuLink', 'dropdownMenuLinkImg']
        if (!arrayIDButtonDropdown.includes(event.target.id)) {
            if ($('.dropdown-menu-user:visible').length > 0) {
                $('.dropdown-menu-user').slideUp('fast');
            }
        }
    });


</script>