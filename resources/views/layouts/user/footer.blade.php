{{-- footer --}}
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/footer.css') }}">
<div class="footer bg-body-black">
    <div class="footer-space"></div>
    <div class="footer-block">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-xs-12">
            <p class="footer-header font-light">EZV2</p>
                <ul>
                    <li>
                        <a class="footer-link footer-link-dark" href="{{ route('list') }}" target="_blank">
                            {{ __('user_page.Homes') }}
                        </a>
                        {{-- <form action="{{ route('list') }}" method="POST" id="villa-form2" target="_blank">
                            @csrf
                            <a href="javascript:$('#villa-form2').submit();">Villa</a>
                        </form> --}}
                    </li>
                    <li>
                        <a class="footer-link footer-link-dark" href="{{ route('hotel_list') }}" target="_blank">
                            {{ __('user_page.Hotels') }}
                        </a>
                        {{-- <form action="{{ route('hotel_list') }}" method="POST" id="hotel-form2" target="_blank">
                            @csrf
                            <a href="javascript:$('#hotel-form2').submit();">Hotel</a>
                        </form> --}}
                    </li>
                    <li>
                        <a class="footer-link footer-link-dark" href="{{ route('restaurant_list') }}" target="_blank">
                            {{ __('user_page.Food') }}
                        </a>
                        {{-- <form action="{{ route('restaurant_list') }}" method="POST" id="restaurant-form2" target="_blank">
                            @csrf
                            <a href="javascript:$('#restaurant-form2').submit();">Restaurant</a>
                        </form> --}}
                    </li>
                    <li>
                        <a class="footer-link footer-link-dark" href="{{ route('activity_list') }}" target="_blank">
                            {{-- {{ __('user_page.Things to do') }} --}}
                            WoW
                        </a>
                        {{-- <form action="{{ route('activity_list') }}" method="POST" id="activity-form2" target="_blank">
                            @csrf
                            <a href="javascript:$('#activity-form2').submit();">Activity</a>
                        </form> --}}
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-12">
            <p class="footer-header font-light">
                {{ __('user_page.Company') }}
            </p>
                <ul>
                    <li>
                        <a class="footer-link footer-link-dark" href="">
                            {{ __('user_page.Contact Us') }}
                        </a>
                    </li>
                    <li>
                        <a class="footer-link footer-link-dark" href="">
                            {{ __('user_page.Blog') }}
                        </a>
                    </li>
                    <li>
                        <a class="footer-link footer-link-dark" href="">
                            {{ __('user_page.Culture') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-12">
            <p class="footer-header font-light">
                {{ __('user_page.Support') }}
            </p>
                <ul>
                    <li>
                        <a class="footer-link footer-link-dark" href="">
                            {{ __('user_page.Getting Started') }}
                        </a>
                    </li>
                    <li>
                        <a class="footer-link footer-link-dark" href="">
                            {{ __('user_page.Help Center') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-12">
            <p class="footer-header font-light">
                {{ __('user_page.Information') }}
            </p>
                <ul>
                    <li>
                        <a class="footer-link footer-link-dark" href="{{ route('privacy_policy') }}">
                            {{ __('user_page.Privacy Policy') }}
                        </a>
                    </li>
                    <li>
                        <a class="footer-link footer-link-dark" href="{{ route('terms') }}">
                            {{ __('user_page.Terms & Conditions') }}
                        </a>
                    </li>
                    <li>
                        <a class="footer-link footer-link-dark" href="{{ route('license') }}">
                            {{ __('user_page.License') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="footer-social text-center">
                    <a href="https://www.facebook.com/" target=_blank"><i class="fa fa-facebook"></i></a> <a href="https://www.instagram.com/" target=_blank"><i class="fa fa-instagram"></i></a> <a href="mailto:info@ezv2.com" target=_blank"><i class="fa fa-envelope"></i></a> <a href="call:+63361123456" target=_blank"><i class="fa fa-phone"></i></a>
                </div>
            </div>
            <div class="col-12">
                <div class="text-copyrights text-center">
                    <p>&copy;{{ date('Y') }} EZV2</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-space"></div>
</div>
<script>
        $(".text-align-center p").text(function(index, currentText) {
            var maxLength = $(this).parent().attr('data-maxlength');
            console.log(currentText.length);
            if (currentText.length > maxLength) {
                return currentText.substr(0, maxLength) + "...";
            } else {
                return currentText
            }
    });
</script>
{{-- end footer --}}
