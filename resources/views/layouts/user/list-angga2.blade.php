<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>EZV2</title>

    <meta name="description" content="EZV2 created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="EZV2">
    <meta property="og:site_name" content="Dashmix">
    <meta property="og:description" content="EZV2 created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/list-villa.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/header-css.css') }}">
</head>

<body>
    <div id="page-container">
        <!-- Header -->
        <header>
            <div id="new-bar-black" class="page-header-fixed d-flex flex-column">
                @include('layouts.user.header-list')
            </div>
            <div class="row">
                <div id="myBtnContainer" class="menu col-12">
                    <ul>
                        <li class="button-dropdown">
                            <a href="javascript:void(0)" id="prices" onclick="prices_click()" class="dropdown-toggle "
                                style="margin-left: 20px;">
                                Price
                            </a>

                            <div class="dropdown-menu" style="width: 350px; border: 2px solid #ff7400; top: 84px; ">
                                <div class="row dropdown-pd-0">
                                    <div class="double-slider">
                                        <form action="{{ route('price') }}" method="GET">


                                            <div class="extra-controls form-inline">

                                                <div class="col-lg-12">
                                                    <p style="margin-bottom: 20px; margin-top: 6px;">Price</p>
                                                </div>
                                                <div class="form-group col-lg-12" style="display: flex;">

                                                    <div class=""
                                                        style="display: table; float: left; padding-right: 10px;">
                                                        <div class="col-lg-12"
                                                            style="border: 1px solid #ff7400; border-radius: 10px; padding-left: 8px; padding-bottom: 8px;">
                                                            <label for="min_price" style="font-size: 12px;">Min</label>
                                                            <input name="min_price" style="font-size: 12px;" type="text"
                                                                class="js-input-from form-control" value="0" />
                                                        </div>
                                                    </div>
                                                    <div class=""
                                                        style="display: flex; align-items: center; justify-content: center;">
                                                        <div style="background-color: black; width: 15px; height: 2px;">
                                                        </div>
                                                    </div>

                                                    <div class=""
                                                        style="display: table; float: left; padding-left: 10px;">
                                                        <div class="col-lg-12"
                                                            style="border: 1px solid #ff7400; border-radius: 10px; padding-left: 8px; padding-bottom: 8px;">
                                                            <label for="max_price" style="font-size: 12px;">Max</label>
                                                            <input name="max_price" style="font-size: 12px;" type="text"
                                                                class="js-input-to form-control" value="0" />
                                                        </div>
                                                    </div>

                                                </div>
                                                <input type="text" class="js-range-slider" value="" />

                                            </div>

                                            <center>
                                                <div style="margin-top: 25px; padding-bottom: 12px;"><input
                                                        type="submit" class="btn btn-choose"
                                                        style="border-radius:12px; width: 100%; padding: 10px;"
                                                        value="Filter"></div>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </li>
                        <li class="button-dropdown">
                            {{-- <a href="#" class="">Number of rooms</a> --}}
                            <a href="javascript:void(0)" id="property" onclick="property_click()"
                                class="dropdown-toggle ">
                                Property Type
                            </a>
                            <div class="propertytype-popup dropdown-menu">
                                @php
                                $property_type = App\PropertyTypeVilla::all();
                                @endphp
                                <div>
                                    <div class="propertytype-input-row">
                                        <div class="col-12 vertical-center">
                                            <div class="row">
                                                @foreach ($property_type as $item)
                                                <div class="col-6 propertytypeoption-type-container">
                                                    <a href="{{ route('property_type', $item->id_property_type) }}"
                                                        class="list-villa-nav-button">
                                                        <center>
                                                            <i class="{{ $item->icon }}"
                                                                style="font-size: 32px !important;"></i>
                                                            <div class="row" style="margin-bottom: -20px; !important">
                                                                <p>
                                                                    {{ $item->name }}
                                                                </p>
                                                            </div>
                                                        </center>
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="button-dropdown">
                            {{-- <a href="#" class="">Number of rooms</a> --}}
                            <a href="javascript:void(0)" id="rooms" onclick="rooms_click()" class="dropdown-toggle ">
                                Number of Rooms
                            </a>

                            <div class="roomnumber-popup dropdown-menu">
                                <form action="{{ route('more_filter') }}" method="GET">
                                    <div>
                                        <div class="roomnumber-input-row">
                                            <div class="col-6 vertical-center">
                                                <div class="col-12 roomnumberoption-type-container">
                                                    <p class="roomnumberoption-type-title">Bedroom</p>
                                                </div>
                                            </div>
                                            <div class="col-6 roomnumberoption-button-container">
                                                <a type="button" onclick="bedroom_decrement()"
                                                    class="roomnumberoption-button-title">
                                                    <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                                </a>
                                                <div
                                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                    <input type="number" id="bedroom_number" name="bedroom" value="1"
                                                        style="text-align: center; margin-left: 7px; border:none; width:40px;"
                                                        min="0" readonly>
                                                </div>
                                                <a type="button" onclick="bedroom_increment()"
                                                    class="roomnumberoption-button-title">
                                                    <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="roomnumber-input-row">
                                            <div class="col-6 vertical-center">
                                                <div class="col-12 roomnumberoption-type-container">
                                                    <p class="roomnumberoption-type-title">Bathroom</p>
                                                </div>
                                            </div>
                                            <div class="col-6"
                                                style="display: flex; align-items: center; justify-content: end;">
                                                <a type="button" onclick="bathroom_decrement()"
                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                                </a>
                                                <div
                                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                    <input type="number" id="bathroom_number" name="bathroom" value="1"
                                                        style="text-align: center; margin-left: 7px; border:none; width:40px;"
                                                        min="0" readonly>
                                                </div>
                                                <a type="button" onclick="bathroom_increment()"
                                                    style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="roomnumber-input-row">
                                            <div class="col-6 vertical-center">
                                                <div class="col-12 roomnumberoption-type-container">
                                                    <p class="roomnumberoption-type-title">Bed</p>
                                                </div>
                                            </div>
                                            <div class="col-6"
                                                style="display: flex; align-items: center; justify-content: end;">
                                                <a type="button" onclick="bed_decrement()"
                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                                </a>
                                                <div
                                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                    <input type="number" id="bed_number" name="beds" value="1"
                                                        style="text-align: center; border:none; margin-left: 7px; width:40px;"
                                                        min="0" readonly>
                                                </div>
                                                <a type="button" onclick="bed_increment()"
                                                    style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-12 dropdown-pd-0 text-small"
                                            style="padding: 0.8rem !important;">
                                            <input type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;" value="Search">
                                        </div>
                                </form>
                            </div>

                        </li>
                        <li class="">
                            <a href="{{ route('filter', '5') }}" id="parking" onclick="parking_click()"
                                class="">Parking</a>
                        </li>
                        <li class="">
                            <a href="{{ route('filter', '14') }}" id="kitchen" onclick="kitchen_click()"
                                class="">Kitchen</a>
                        </li>
                        <li class="">
                            <a href="{{ route('filter', '12') }}" id="ocean" onclick="ocean_click()" class="">Ocean
                                View</a>
                        </li>
                        <li class="">
                            <a href="{{ route('filter', '13') }}" id="breakfast" onclick="breakfast_click()"
                                class="">Breakfast</a>
                        </li>
                        <li class="">
                            <a href="#" id="filters" onclick="filters_click()" class=""><i class="fa fa-sliders"
                                    aria-hidden="true"></i> Filters</a>
                        </li>
                    </ul>
                </div>
            </div>
    </div>
    </header>
    <!-- END Header Content -->

    <!-- Main Container -->
    <main id="main-container">

        @yield('content')

    </main>
    <!-- END Main Container -->

    <!-- Modal -->
    <div class="modal fade" id="videomodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content video-container">
                <div class="nav-video nav-video-prev"><a type="button" id="button_prev"><span><i
                                class="fa fa-chevron-left"></i></span>Prev<br>Villa</a></div>
                <center>
                    <video controls id="video1" class="video-modal">
                        <source src="" type="video/mp4">
                        Your browser doesn't support HTML5 video tag.
                    </video>
                </center>
                <div class="overlay-social">
                    {{-- <div class="row social-share">
                        <div class="col-6 text-center icon-center">
                            @if ($villa[0]->is_favorit)
                            <p>
                                <a href="{{ route('villa_favorit', $villa[0]->id_villa) }}"><i class="fa fa-heart"
                        style="color: #f00;  font-size: 16px;"></i>
                    <span>CANCEL</span>
                    </a>
                    </p>
                    @else
                    <p>
                        <a href="{{ route('villa_favorit', $villa[0]->id_villa) }}"><i class="fa fa-heart"
                                style="color: #aaa;  font-size: 16px;"></i>
                            <span style="color: #aaa;">FAVORIT</span>
                        </a>
                    </p>
                    @endif
                </div>
                <div class="col-6 text-center icon-center">
                    <p type="button" class="expand" onclick="share()">
                        <i class="fa fa-share" style="font-size: 16px;"></i>
                        <span>SHARE</span></p>
                </div>
            </div> --}}
        </div>

        <div class="nav-video nav-video-next"><a type="button" id="button_next">Next<br>Villa<span><i
                        class="fa fa-chevron-right"></i></span></a></div>
        <div class="overlay-desc">
            <div class="overlay-desc--wrap">
                <h5 id="title"></h5>
                <!-- Villa Bed Type -->
                <p><span id="bedrooms"></span> Bedroom, <span id="bathrooms"></span> Bathroom, <span id="bedss"></span>
                    Beds</p>
                <div class="row fac" style="padding-top: 0">
                    {{-- @php $facilities = App\Http\Controllers\ViewController::amenities();
                            @endphp
                            @if(!$facilities->isEmpty())
                                @if(count($facilities) >= 3)
                                    @for($i=0; $i<=2; $i++) 
                                    <div class="col-1 right-10">
                                    <i class="fa fa-{{ $facilities[$i]->icon }}"></i>
                </div>
                @endfor
                @else
                @for($i=0; $i < count($facilities); $i++) <div class="col-1">
                    <i class="fa fa-{{ $facilities[$i]->icon }}"></i>
            </div>
            @endfor
            @endif
            <div class="col-1">
                <a type="button" class="btn-amenities btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modal-amenities-{{$data->id_villa}}">
                    MORE
                </a>
            </div>
            @endif --}}
            <div class="short-desc" id="short"></div>
            <!-- End Villa Bed Type -->
            <div class="vid-address">
                <i class="fa fa-map-pin"></i> <span id="alocation"></span>
            </div>
            {{-- <div class="review-text-vid">
                                @if($data->person != "" || $data->person != 0)
                                <span class="reviews">{{ $data->person }} Guest Reviews</span>
            @else
            <span class="reviews">0 Reviews</span>
            @endif
        </div> --}}
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Footer -->
    @include('layouts.user.footer')
    @include('user.modal.filter.filter_modal')

    <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>

    <!-- jQuery (required for Magnific Popup plugin) -->
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <script>
        function prices_click() {
            var element = document.getElementById("prices");
            element.classList.toggle("filter-active");
        }

        function property_click() {
            var element = document.getElementById("property");
            element.classList.toggle("filter-active");
        }

        function rooms_click() {
            var element = document.getElementById("rooms");
            element.classList.toggle("filter-active");
        }

        function parking_click() {
            var element = document.getElementById("parking");
            element.classList.toggle("filter-active");
        }

        function kitchen_click() {
            var element = document.getElementById("kitchen");
            element.classList.toggle("filter-active");
        }

        function ocean_click() {
            var element = document.getElementById("ocean");
            element.classList.toggle("filter-active");
        }

        function breakfast_click() {
            var element = document.getElementById("breakfast");
            element.classList.toggle("filter-active");
        }

        // function filters_click() {
        //     var element = document.getElementById("filters");
        //     element.classList.toggle("filter-active");
        // }

        function filters_click() {
            var element = document.getElementById("filters");
            element.classList.toggle("filter-active");
            $('#modal-filters').modal('show');
        }

    </script>




    <script>
        function bedroom_increment() {
            document.getElementById('bedroom_number').stepUp();
        }

        function bedroom_decrement() {
            document.getElementById('bedroom_number').stepDown();
        }

        function bathroom_increment() {
            document.getElementById('bathroom_number').stepUp();
        }

        function bathroom_decrement() {
            document.getElementById('bathroom_number').stepDown();
        }

        function bed_increment() {
            document.getElementById('bed_number').stepUp();
        }

        function bed_decrement() {
            document.getElementById('bed_number').stepDown();
        }

    </script>

    <script>
        $('#check_in2').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            mode: "range",
            showMonths: 2,
            onChange: function (selectedDates, dateStr, instance) {
                $('#check_out2').flatpickr({
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    minDate: new Date(dateStr).fp_incr(1),
                    onChange: function (selectedDates, dateStr, instance) {
                        var start = new Date($('#check_in2').val());
                        var end = new Date($('#check_out2').val());
                        var min_stay = $('#min_stay').val();
                        var minimum = new Date($('#check_in2').val()).fp_incr(min_stay);
                        if (sum_night < min_stay) {
                            alert("minimum stay is " + min_stay + " days");
                        }
                    }
                });

                $('#check_in2').val(flatpickr.formatDate(selectedDates[0], "Y-m-d"));
                $('#check_out2').val(flatpickr.formatDate(selectedDates[1], "Y-m-d"));

            }
        });

    </script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>

    <script src="{{ asset('assets/js/list-villa.js') }}"></script>

    <script>
        $("#searchbox").click(function () {
            $("#search_bar").toggleClass("active");
        });

    </script>




    @yield('scripts')
</body>

</html>
