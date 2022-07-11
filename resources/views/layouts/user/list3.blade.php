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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/list-villa.css') }}">
</head>

<body>
    <div id="page-container">
        <!-- Header -->
        <header>
            <div class="page-header-fixed d-flex flex-column">
                @include('layouts.user.header')
            </div>
            <div class="row">
                <div id="myBtnContainer" class="menu col-12">
                    <ul>
                        <li class="drop-down">
                            <a href="#">RATES</a>
                            <div class="mega-menu fadeIn animated">
                                <div class="double-slider">
                                    <form action="{{ route('price') }}" method="GET">
                                        <input type="text" class="js-range-slider" value="" />
                                        <hr>
                                        <div class="extra-controls form-inline">
                                            <div class="form-group">
                                                <label for="min_price">Min. Price</label><br>
                                                <input name="min_price" type="text" class="js-input-from form-control"
                                                    value="0" />
                                                <label for="max_price">Max. Price</label><br>
                                                <input name="max_price" type="text" class="js-input-to form-control"
                                                    value="0" />
                                            </div>
                                        </div>
                                        <center>
                                            <div style="margin-top:10px;"><input type="submit" class="btn btn-choose"
                                                    style="border-radius:25px;" value="Filter"></div>
                                        </center>
                                    </form>
                                </div>
                            </div>
                        </li>
                        <li class="drop-down2">
                            <a href="#">AMENITIES</a>
                            <div class="mega-menu2 fadeIn animated ml-2" style="text-align: left">
                                @php
                                $amenities2 = App\Amenities::all();
                                @endphp
                                <form action="{{ route('box_filter') }}" method="GET">
                                    @foreach ($amenities2 as $item)
                                    @php
                                    $checked = [];
                                    if(isset($_GET['filterAmenities'])){
                                    $checked = $_GET['filterAmenities'];
                                    }
                                    @endphp
                                    <div>
                                        <input type="checkbox" name="filterAmenities[]"
                                            value="{{ $item->id_amenities }}" @if(in_array($item->id_amenities,
                                        $checked)) checked @endif>
                                        {{ $item->name }}
                                    </div>
                                    @endforeach
                                    <center>
                                        <div style="margin-top:10px;"><button type="submit"
                                                class="btn btn-sm btn-choose"
                                                style="border-radius:25px;">SEARCH</button></div>
                                    </center>
                                </form>
                            </div>
                        </li>
                        <li class="drop-down4">
                            <a href="#">&nbsp;SORT</a>
                            <div class="mega-menu4 fadeIn animated">
                                <form action="{{ route('sort_low_to_high') }}" method="GET">
                                    <center>
                                        <div><input class="btn" type="submit" value="Price Low to High"></div>
                                    </center>
                                </form>
                                <form action="{{ route('sort_high_to_low') }}" method="GET">
                                    <center>
                                        <div><input class="btn" type="submit" value="Price High to Low"></div>
                                    </center>
                                </form>
                                <form action="{{ route('sort_popularity') }}" method="GET">
                                    <center>
                                        <div><input class="btn" type="submit" value="Popularity"></div>
                                    </center>
                                </form>
                                <form action="{{ route('sort_newest') }}" method="GET">
                                    <center>
                                        <div><input class="btn" type="submit" value="Newest"></div>
                                    </center>
                                </form>
                            </div>
                        </li>
                        <li class="drop-down3">
                            <a href="#">&nbsp;MORE<span> FILTERS</span></a>
                            <div class="mega-menu3 fadeIn animated">
                                <form action="{{ route('more_filter') }}" method="GET">
                                    <div class="more-filters">
                                        <p><label for="bedroom">Bedroom:</label> <span><input type="number" id="bedroom"
                                                    name="bedroom" value="1" min="1" max="5"
                                                    style="width: 50px;"></span></p>
                                        <p><label for="bathroom">Bathroom:</label> <span><input type="number"
                                                    id="bathroom" name="bathroom" value="1" min="1" max="5"
                                                    style="width: 50px;"></span></p>
                                        <p><label for="beds">Bed:</label> <span><input type="number" id="beds"
                                                    name="beds" value="1" min="1" max="5" style="width: 50px;"></span>
                                        </p>
                                    </div>
                                    <p><input type="submit" class="btn btn-choose" style="border-radius:25px;"
                                            value="Search"></p>
                                </form>
                            </div>
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
    {{-- <div class="modal fade" id="videomodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content video-container">
                <div class="nav-video nav-video-prev"><a type="button" id="button_prev"><span><i class="fa fa-chevron-left"></i></span>Prev<br>Villa</a></div>
                <center>
                    <video controls id="video1" class="video-modal">
                        <source src="" type="video/mp4">
                        Your browser doesn't support HTML5 video tag.
                    </video>
                </center>
                <div class="overlay-social">
                    <div class="row social-share">
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
                    </div>
                </div>

                <div class="nav-video nav-video-next"><a type="button" id="button_next">Next<br>Villa<span><i class="fa fa-chevron-right"></i></span></a></div>
                <div class="overlay-desc">
                    <div class="overlay-desc--wrap">
                        <h5 id="title"></h5>
                        <!-- Villa Bed Type -->
                        <p><span id="bedrooms"></span> Bedroom, <span id="bathrooms"></span> Bathroom, <span id="bedss"></span> Beds</p>
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
                                    @for($i=0; $i < count($facilities); $i++)
                                    <div class="col-1">
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
                            <div class="review-text-vid">
                                @if($data->person != "" || $data->person != 0)
                                <span class="reviews">{{ $data->person }} Guest Reviews</span>
                                @else
                                <span class="reviews">0 Reviews</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div> --}}
    </div>
    <!-- Footer -->
    @include('layouts.user.footer')
    <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>

    <!-- jQuery (required for Magnific Popup plugin) -->
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

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
