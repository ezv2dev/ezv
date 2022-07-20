@extends('layouts.user.list')

@section('title', 'List of Homes - EZV2')

@section('content')
    {{-- function get data --}}
    @php
    $villas = $villa->shuffle()->sortBy('grade');
    $list = [];
    foreach ($villas as $item) {
        array_push($list, $item->id_villa);
    }

    $scenic_views = App\ScenicViews::all();
    $get_check_in = app('request')->input('sCheck_in');
    $get_check_out = app('request')->input('sCheck_out');

    function dateDiff($get_check_in, $get_check_out)
    {
        $date1_ts = strtotime($get_check_in);
        $date2_ts = strtotime($get_check_out);
        $diff = $date2_ts - $date1_ts;
        return round($diff / 86400);
    }

    if ($get_check_in == null) {
        $get_dates = Translate::translate('Add Date');
    } else {
        if ($get_check_out == $get_check_in) {
            $dateDiff = '1 ' . Translate::translate('day');
        } else {
            $dateDiff = dateDiff($get_check_in, $get_check_out);
        }
    }

    if (request()->fCategory) {
        $fCategory = request()->fCategory;
    } else {
        $fCategory = '';
    }

    // set theme color
    $bgColor = 'bg-body-light';
    $textColor = 'font-black';
    $rowLineColor = 'row-line-white';
    $listColor = 'listoption-light';
    $shadowColor = 'box-shadow-light';
    if (isset($_COOKIE['tema'])) {
        if ($_COOKIE['tema'] == 'black') {
            $bgColor = 'bg-body-black';
            $textColor = 'font-light';
            $rowLineColor = 'row-line-grey';
            $listColor = '{{ $listColor }}';
            $shadowColor = 'box-shadow-dark';
        }
    }
    @endphp
    {{-- function get data --}}

    <style>
        .sub-icon:hover {
            color: #ff7400 !important;
            cursor: pointer;
        }
    </style>

    <div id="body-color" class="{{ $bgColor }}">
        <!-- Page Content -->
        <div id="div-to-refresh">
            <!-- Refresh Page -->
            <div id="villa-search-data" class="col-lg-12 grid-container-43" style="position: relative;">
                <div class="w-84" id="view-map-button-float">
                    <div class="map-floating-button skeleton skeleton-h-4 skeleton-w-4 {{ $shadowColor }}">
                        <button onclick="view_main_map()" style="height:inherit;">
                            <div class="notice">
                                <span class="world">
                                    <span class="images" style="color: #52EB35;">
                                        <img src="{{ asset('assets/earth.svg') }}" alt="Earth SVG">
                                    </span>
                                </span>
                            </div>
                            <!-- partial -->
                        </button>
                    </div>
                </div>

                <div id="filter-cat-bg-color" class="container-grid-cat translate-text-group {{ $bgColor }}"
                    style="width: 100%;">
                    @foreach ($villaCategory->take(6) as $item)
                        <div class="skeleton skeleton-h-4 skeleton-w-100">
                            <a href="#" class="grid-img-container"
                                onclick="homesFilter({{ $item->id_villa_category }}, null)">
                                <img class="grid-img-filter lozad"
                                    @if ($fCategory == $item->id_villa_category) style="border: 5px solid #ff7400;" @endif
                                    src="https://source.unsplash.com/random/?{{ $item->name }}" data-loaded="true">
                                <div class="grid-text">
                                    {{ $item->name }}
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <div style="cursor:pointer;" onclick="moreCategory()" class="skeleton skeleton-h-4 skeleton-w-100">
                        <a class="grid-img-container">
                            <img class="grid-img-filter lozad" src="https://source.unsplash.com/random/?bali"
                                data-loaded="true">
                            <div class="grid-text">
                                {{ __('user_page.More') }}
                            </div>
                        </a>
                    </div>
                </div>

                <div id="filter-subcat-bg-color" class="container-grid-sub-cat translate-text-group {{ $bgColor }}"
                    style="width: 100%;">
                    @foreach ($villaFilter->sortBy('order')->take(8) as $item)
                        <div class="skeleton skeleton-h-3 skeleton-w-100">
                            <div class="grid-sub-cat-content-container text-13"
                                onclick="homesFilter({{ request()->get('fCategory') ?? 'null' }}, {{ $item->id_villa_filter }})">
                                <div>
                                    <i class="{{ $item->icon }} text-18 list-description  {{ $textColor }} sub-icon"
                                        @php
                                            $isChecked = '';
                                            $filterIds = explode(',', request()->get('filter'));
                                        @endphp @if (in_array($item->id_villa_filter, $filterIds))
                                        style="color: #ff7400 !important;"
                    @endif>
                    </i>
                </div>
                <div class="list-description  {{ $textColor }}">{{ $item->name }}</div>
            </div>
        </div>
        @endforeach

        <div style="cursor:pointer;" class="grid-sub-cat-content-container  skeleton skeleton-h-3 skeleton-w-100"
            onclick="moreSubCategory()">
            <div>
                <i class="fa-solid fa-ellipsis text-18 list-description  {{ $textColor }} sub-icon"></i>
            </div>
            <p class="list-description text-13 {{ $textColor }}">
                {{ __('user_page.More') }}
            </p>
        </div>
    </div>

    <div id="villa-data">
        @include('user.data_list_villa')
    </div>

    {{-- <div class="ajax-load text-center" style="display:none;">
                    <p class="list-loading font-light">
                        Loading More
                    </p>
                </div>
                <!-- End Grid 43 -->
                <div style="height: 35px;">&nbsp;</div> --}}
    </div>
    {{-- Pagination --}}
    <div class="d-flex justify-content-center" id="footer">
        <div class="mt-3">
            {{ $villa->onEachSide(0)->appends(Request::all())->links() }}
        </div>
    </div>
    {{-- End Pagination --}}
    <!-- End Refresh Page -->
    </div>
    <!-- End Page Content -->
    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    @include('user.modal.auth.login_register')
    @include('user.modal.villa.filter')
    @include('user.modal.villa.category')
    {{-- modal laguage and currency --}}
    </div>

    {{-- VIEW VIDEO --}}
    @include('user.modal.villa.list.video')
    {{-- END VIEW VIDEO --}}
@endsection

@section('scripts')
    @include('user.modal.villa.list.map')

    {{-- <script>
        function loadMoreData(page) {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const fMinPrice = urlParams.get('fMinPrice');
            const fMaxPrice = urlParams.get('fMaxPrice');
            const fBedroom = urlParams.get('fBedroom');
            const fBathroom = urlParams.get('fBathroom');
            const fBeds = urlParams.get('fBeds');
            const fProperty = urlParams.get('fProperty');
            const fViews = urlParams.get('fViews');
            const fAmenities = urlParams.get('fAmenities');
            const sLocation = urlParams.get('sLocation');
            const sCheck_in = urlParams.get('sCheck_in');
            const sCheck_out = urlParams.get('sCheck_out');
            const sAdult = urlParams.get('sAdult');
            const sChild = urlParams.get('sChild');

            console.log(window.location.search);
            console.log('villa-search?fMinPrice=' + fMinPrice + '&fMaxPrice=' + fMaxPrice + '&fBedroom=' + fBedroom +
                '&fBathroom=' +
                fBathroom + '&fBeds=' + fBeds + '&fProperty=' + fProperty + '&fViews=' + fViews +
                '&fAmenities=' +
                fAmenities + '&sLocation=' + sLocation + '&sCheck_in=' + sCheck_in + '&sCheck_out=' +
                sCheck_out +
                '&sAdult=' + sAdult + '&sChild=' + sChild + '&page=' + page);

            $.ajax({
                    url: 'villa-search?fMinPrice=' + fMinPrice + '&fMaxPrice=' + fMaxPrice + '&fBedroom=' + fBedroom +
                        '&fBathroom=' +
                        fBathroom + '&fBeds=' + fBeds + '&fProperty=' + fProperty + '&fViews=' + fViews +
                        '&fAmenities=' +
                        fAmenities + '&sLocation=' + sLocation + '&sCheck_in=' + sCheck_in + '&sCheck_out=' +
                        sCheck_out +
                        '&sAdult=' + sAdult + '&sChild=' + sChild + '&page=' + page,
                    type: 'get',
                    beforeSend: function() {
                        $(".ajax-load").show();
                    }
                })
                .done(function(data) {
                    // append data to element
                    if (data.html == " ") {
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#villa-data").append(data.html);

                    // rerun slick
                    $(".js-slider-2").not('.slick-initialized').slick({
                        rtl: false,
                        autoplay: false,
                        autoplaySpeed: 5000,
                        speed: 800,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        variableWidth: true,
                        pauseOnHover: false,
                        easing: "linear",
                        arrows: true
                    });
                    // rerun change background
                    changebackground();
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert("Server not responding");
                });
        }

        var page = 1;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });
    </script> --}}

    <script src="{{ asset('assets/js/list-villa-extend.js') }}"></script>

    {{-- Search --}}
    <script>
        $(document).ready(function() {
            $(".drop-down").hover(function() {
                $('.mega-menu').addClass('display-on');
            });
            $(".drop-down").mouseleave(function() {
                $('.mega-menu').removeClass('display-on');
            });

            $(".drop-down2").hover(function() {
                $('.mega-menu2').addClass('display-on');
            });
            $(".drop-down2").mouseleave(function() {
                $('.mega-menu2').removeClass('display-on');
            });

            $(".drop-down3").hover(function() {
                $('.mega-menu3').addClass('display-on');
            });
            $(".drop-down3").mouseleave(function() {
                $('.mega-menu3').removeClass('display-on');
            });

            $(".drop-down4").hover(function() {
                $('.mega-menu4').addClass('display-on');
            });
            $(".drop-down4").mouseleave(function() {
                $('.mega-menu4').removeClass('display-on');
            });

            $(".drop-down5").hover(function() {
                $('.mega-menu5').addClass('display-on');
            });
            $(".drop-down5").mouseleave(function() {
                $('.mega-menu5').removeClass('display-on');
            });

        });
    </script>

    {{-- SEARCH FUNCTION --}}
    <script>
        function villaRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/villa-search?${suburl}`;
        }
    </script>

    <script>
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        var url_string2 = window.location.href
        var url2 = new URL(url_string2);

        if (url2.searchParams.get('sLocation')) {
            setCookie("sLocation", url2.searchParams.get('sLocation'), 1);
        }

        if (url2.searchParams.get('sCheck_in')) {
            setCookie("sCheck_in", url2.searchParams.get('sCheck_in'), 1);
        }

        if (url2.searchParams.get('sCheck_out')) {
            setCookie("sCheck_out", url2.searchParams.get('sCheck_out'), 1);
        }
    </script>

    <script>
        function villaFilter() {
            var fMaxPriceFormInput = $("input[name='fMaxPrice']").val();

            var fMinPriceFormInput = $("input[name='fMinPrice']").val();

            var fPropertyFormInput = [];
            $("input[name='fProperty[]']:checked").each(function() {
                fPropertyFormInput.push(parseInt($(this).val()));
            });

            var fBedroomFormInput = $("input[name='fBedroom']:checked").val();
            var fBathroomFormInput = $("input[name='fBathroom']:checked").val();
            var fBedsFormInput = $("input[name='fBeds']:checked").val();

            var fFacilitiesFormInput = [];
            $("input[name='fFacilities[]']:checked").each(function() {
                fFacilitiesFormInput.push(parseInt($(this).val()));
            });

            var fSuitableFormInput = [];
            $("input[name='fSuitable[]']:checked").each(function() {
                fSuitableFormInput.push(parseInt($(this).val()));
            });

            var fViewsFormInput = [];
            $("input[name='fViews[]']:checked").each(function() {
                fViewsFormInput.push(parseInt($(this).val()));
            });

            var fAmenitiesFormInput = [];
            $("input[name='fAmenities[]']:checked").each(function() {
                fAmenitiesFormInput.push(parseInt($(this).val()));
            });

            var sLocationFormInput = $("input[name='sLocation']").val();
            var sCheck_inFormInput = $("input[name='sCheck_in']").val();
            var sCheck_outFormInput = $("input[name='sCheck_out']").val();
            var sAdultFormInput = $("input[name='sAdult']").val();
            var sChildFormInput = $("input[name='sChild']").val();

            function setCookie2(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            setCookie2("sLocation", sLocationFormInput, 1);
            setCookie2("sCheck_in", sCheck_inFormInput, 1);
            setCookie2("sCheck_out", sCheck_outFormInput, 1);
            setCookie2("sAdult", sAdultFormInput, 1);
            setCookie2("sChild", sChildFormInput, 1);

            var subUrl =
                `fMinPrice=${fMinPriceFormInput}&fMaxPrice=${fMaxPriceFormInput}&fBedroom=${fBedroomFormInput}&fBathroom=${fBathroomFormInput}&fBeds=${fBedsFormInput}&fProperty=${fPropertyFormInput}&fViews=${fViewsFormInput}&fAmenities=${fAmenitiesFormInput}&sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}`;
            villaRefreshFilter(subUrl);
        }
    </script>

    {{-- <script>
        function filters_click() {
            var element = document.getElementById("filters");
            element.classList.toggle("filter-active");
            $('#modal-filters').modal('show');
        }
    </script> --}}

    <script>
        function moreCategory() {
            $('#categoryModal').modal('show');
        }

        function moreSubCategory() {
            $('#modalSubCategory').modal('show');
        }

        function villaRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/homes/search?${suburl}`;
        }
    </script>

    <script>
        function homesFilter(valueCategory, valueClick) {
            var sLocationFormInput = $("input[name='sLocation']").val();
            var sCheck_inFormInput = $("input[name='sCheck_in']").val();
            var sCheck_outFormInput = $("input[name='sCheck_out']").val();
            var sAdultFormInput = $("input[name='sAdult']").val();
            var sChildFormInput = $("input[name='sChild']").val();

            var url_homes = window.location.href;
            var url2 = new URL(url_homes);

            if (url2.searchParams.get('fCategory') == valueCategory) {
                valueCategory = '';
            }

            function setCookie2(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            setCookie2("sLocation", sLocationFormInput, 1);
            setCookie2("sCheck_in", sCheck_inFormInput, 1);
            setCookie2("sCheck_out", sCheck_outFormInput, 1);

            var filterFormInput = [];
            $("input[name='filter[]']:checked").each(function() {
                filterFormInput.push(parseInt($(this).val()));
            });

            if (filterFormInput.includes(valueClick) == true) {
                var filterCheck = filterFormInput.filter(unCheck);

                function unCheck(dataCheck) {
                    return dataCheck != valueClick;
                }

                var filteredArray = filterCheck.filter(function(item, pos) {
                    return filterCheck.indexOf(item) == pos;
                });
            } else {
                filterFormInput.push(valueClick);

                var filteredArray = filterFormInput.filter(function(item, pos) {
                    return filterFormInput.indexOf(item) == pos;
                });
            }

            if (valueCategory == null) {
                var subUrl =
                    `sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}&fCategory=&filter=${filteredArray}`;
            } else {
                var subUrl =
                    `sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}&fCategory=${valueCategory}&filter=${filteredArray}`;
            }

            villaRefreshFilter(subUrl);
        }
    </script>

    @auth
        <script>
            function likeFavorit(value) {

                $.ajax({
                    type: "GET",
                    url: `/like/favorit/${value}`,
                    data: {
                        villa: value,
                        user: `{{ Auth::user()->id }}`,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        if (data == 1) {
                            console.log(`sat ${value}`);
                            $(`#likeButton${value}`).removeClass('list-like-button');
                            $(`#likeButton${value}`).addClass('list-like-button-active');
                            $(`#unlikeButton${value}`).removeClass('list-like-button');
                            $(`#unlikeButton${value}`).addClass('list-like-button-active');
                        } else if (data == 0) {
                            $(`#likeButton${value}`).removeClass('list-like-button-active');
                            $(`#likeButton${value}`).addClass('list-like-button');
                            $(`#unlikeButton${value}`).removeClass('list-like-button-active');
                            $(`#unlikeButton${value}`).addClass('list-like-button');
                        }
                    },
                });
            }
        </script>

    @endauth

    {{-- END SEARCH FUNCTION --}}

    {{-- REDIRECT TO NEW PAGE WHEN SCREEN SIZE IS UNDER 1024 --}}
    {{-- <script>
        var search = new URLSearchParams(window.location.search);
        $(window).on('resize', () => {
            if ($(window).width() < 1024 && '{{ request()->screen ?? '' }}' != 'mobile') {
                search.set('screen', 'mobile');
                window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
            }
            if ($(window).width() > 1024 && '{{ request()->screen ?? '' }}' != 'desktop') {
                search.set('screen', 'desktop');
                window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
            }
        });
        $(document).ready(() => {
            if ($(window).width() < 1024 && '{{ request()->screen ?? '' }}' != 'mobile') {
                search.set('screen', 'mobile');
                window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
            }
            if ($(window).width() > 1024 && '{{ request()->screen ?? '' }}' != 'desktop') {
                search.set('screen', 'desktop');
                window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
            }
        });
    </script> --}}
    {{-- END REDIRECT TO NEW PAGE WHEN SCREEN SIZE IS UNDER 900 --}}
@endsection
