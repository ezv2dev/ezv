<section style="box-sizing: border-box; background-color: #000000">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        .footer-2-4 .list-space {
            margin-bottom: 0.25rem;
        }

        .footer-2-4 .footer-text-title {
            font-size: 18px;
            /* margin-bottom: 1.5rem; */
            font-weight: bold;
        }

        .footer-2-4 .list-menu {
            font-size: 14px;
            color: #999999;
            text-decoration: none !important;
        }

        .footer-2-4 .list-menu:hover {
            color: #ff7400;
        }

        .footer-2-4 .border-color {
            color: #999999;
        }

        .footer-2-4 .footer-link {
            color: #999999;
        }

        .footer-2-4 .footer-link:hover {
            color: #ff7400;
        }

        .footer-2-4 .social-media-c:hover circle,
        .footer-2-4 .social-media-p:hover path {
            fill: #ff7400;
        }

        .footer-2-4 .footer-info-space {
            padding-top: 3rem;
        }

        .footer-2-4 .list-footer {
            padding: 3rem 1rem 1rem 2rem
        }

        .footer-2-4 .info-footer {
            padding: 0 1rem 3rem;
        }

        .footer-bottom-space, .footer-space {
            display: block;
            height: 50px;
            background: transparent;
        }

        @media (min-width: 576px) {
            .footer-2-4 .list-footer {
                padding: 5rem 2rem 3rem 2rem;
            }

            .footer-2-4 .info-footer {
                padding: 0 2rem 3rem;
            }
        }

        @media (min-width: 768px) {
            .footer-2-4 .list-footer {
                padding: 5rem 4rem 6rem 4rem;
            }

            .footer-2-4 .info-footer {
                padding: 0 4rem 3rem;
            }
        }

        @media (min-width: 992px) {
            .footer-2-4 .list-footer {
                padding: 4rem 6rem 2rem 8rem;
            }

            .footer-2-4 .info-footer {
                padding: 0 6rem 3rem;
            }
        }
        .list-unstyled2 {
            margin-bottom: 1.5rem;
            padding-left: 0;
            list-style: none;
        }
        .text-copyrights p {
            color: #9b9b9b;
            line-height: 1;
            margin-top: 15px;
            font-size: 12px;
            margin-bottom: 3px;
        }
        #footer-soc-icon {
            color: #fff;
        }
        #footer-soc-icon {
            width: 35px;
            height: 35px;
            border: solid 1px #9b9b9b;
            padding: 10px 8px;
            border-radius: 50%;
            text-align: center;
            color: #9b9b9b;
            margin-right: 5px;
        }

        #footer-soc-icon:hover {
            border: solid 1px #ff7400;
            color: #ff7400;
        }
    </style>

    <div class="footer-2-4 container-xxl mx-auto position-relative p-0">
        <div class="list-footer">
            <div class="row gap-md-0 gap-5">
                <div class="col-lg-3 col-md-6">
                    <h2 class="footer-text-title text-white">EZV 2</h2>
                    <nav class="list-unstyled2">
                        <li class="list-space">
                            <a href="{{ route('list') }}" class="list-menu">{{ __('user_page.Homes') }}</a>
                        </li>
                        <li class="list-space">
                            <a href="{{ route('hotel_list') }}" class="list-menu">{{ __('user_page.Hotels') }}</a>
                        </li>
                        <li class="list-space">
                            <a href="{{ route('restaurant_list') }}" class="list-menu">{{ __('user_page.Food') }}</a>
                        </li>
                        <li class="list-space">
                            <a href="{{ route('activity_list') }}" class="list-menu">WoW</a>
                        </li>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h2 class="footer-text-title text-white">{{ __('user_page.Company') }}</h2>
                    <nav class="list-unstyled2">
                        <li class="list-space">
                            <a href="{{ route('contact_us') }}" class="list-menu">{{ __('user_page.Contact Us') }}</a>
                        </li>
                        <li class="list-space">
                            <a href="{{ route('blog') }}" class="list-menu">{{ __('user_page.Blog') }}</a>
                        </li>
                        <li class="list-space">
                            <a href="{{ route('culture') }}" class="list-menu">{{ __('user_page.Culture') }}</a>
                        </li>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h2 class="footer-text-title text-white">{{ __('user_page.Support') }}</h2>
                    <nav class="list-unstyled2">
                        <li class="list-space">
                            <a href="{{ route('getting_started') }}" class="list-menu">{{ __('user_page.Getting Started') }}</a>
                        </li>
                        <li class="list-space">
                            <a href="{{ route('help_center') }}" class="list-menu">{{ __('user_page.Help Center') }}</a>
                        </li>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h2 class="footer-text-title text-white">{{ __('user_page.Information') }}</h2>
                    <nav class="list-unstyled2">
                        <li class="list-space">
                            <a href="{{ route('privacy_policy') }}" class="list-menu">{{ __('user_page.Privacy Policy') }}</a>
                        </li>
                        <li class="list-space">
                            <a href="{{ route('terms') }}" class="list-menu">{{ __('user_page.Terms & Conditions') }}</a>
                        </li>
                        <li class="list-space">
                            <a href="{{ route('license') }}" class="list-menu">{{ __('user_page.License') }}</a>
                        </li>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 1.5rem">
            <div class="col-12">
                <div class="footer-social text-center">
                    <a href="https://www.facebook.com/ezvillasbali/" target=_blank">
                        <i id="footer-soc-icon" class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/ezv/" style="margin-left: 10px;" target=_blank">
                        <i id="footer-soc-icon" class="fab fa-instagram"></i>
                    </a>
                    <a href="mailto:info@ezv2.com" style="margin-left: 10px;" target=_blank">
                        <i id="footer-soc-icon" class="fa fa-envelope"></i>
                    </a>
                    <a href="call:+6285792260929" style="margin-left: 10px;" target=_blank">
                        <i id="footer-soc-icon" class="fa fa-phone"></i>
                    </a>
                </div>
            </div>
            <div class="col-12">
                <div class="text-copyrights text-center">
                    <p>&copy;{{ date('Y') }} EZV2</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom-space"></div>
    </div>
</section>
