@extends('layouts.user.list')

@section('title', 'List of Homes - EZV2')

@section('content')
    {{-- function get data --}}
    @php
    // $villas = $villa->shuffle()->sortBy('grade');
    $villas = $villa;
    $list = [];
    foreach ($villas as $item) {
        array_push($list, $item->id_villa);
    }

    $scenic_views = App\Models\ScenicViews::all();
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
    @endphp

    @php
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
            $listColor = 'listoption-dark';
            $shadowColor = 'box-shadow-dark';
        }
    }
    @endphp

    <style>
        .sub-icon:hover {
            color: #ff7400 !important;
            cursor: pointer;
        }
    </style>
    {{-- function get data --}}

    <div id="body-color" class="{{ $bgColor }}">
        <!-- Page Content -->
        <div id="div-to-refresh">
            <!-- Refresh Page -->
            <div class="col-lg-12" style="position: relative; min-height: 100px;">
                <div class="w-100" id="view-map-button-float">
                    <div class="map-floating-button skeleton skeleton-h-4 skeleton-w-4 {{ $shadowColor }}">
                        <button onclick="view_main_map()" style="height:inherit;">
                            <!-- partial:index.partial.html -->
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

                <div id="filter-cat-bg-color" class="container-grid-cat {{ $bgColor }}" style="width: 100%;"
                    data-isshow="true">
                    @foreach ($villaCategory->take(6) as $item)
                        <div>
                            <a href="#" class="grid-img-container"
                                onclick="homesFilter({{ $item->id_villa_category }}, null)">
                                <img class="grid-img-filter lozad" src="{{ LazyLoad::show() }}"
                                    @if ($fCategory == $item->id_villa_category) style="border: 5px solid #ff7400;" @endif
                                    data-src="https://source.unsplash.com/random/?{{ $item->name }}">
                                <div class="grid-text translate-text-group-items">
                                    {{ $item->name }}
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <a href="#" class="grid-img-container" onclick="moreCategory()">
                        <img class="grid-img-filter lozad" src="{{ LazyLoad::show() }}"
                            data-src="https://source.unsplash.com/random/?bali">
                        <div class="grid-text">
                            {{ __('user_page.More') }}
                        </div>
                    </a>
                </div>

                <div id="filter-subcat-bg-color" class="container-grid-sub-cat {{ $bgColor }}" style="width: 100%;"
                    data-isshow="true">
                    <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13" onclick="filterMain()">
                        <div>
                            <i class="fas fa-dollar-sign text-18 list-description {{ $textColor }} sub-icon"></i>
                        </div>
                        <div class="list-description {{ $textColor }}">Price</div>
                    </div>
                    <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13" onclick="filterMain()">
                        <div>
                            <i class="fas fa-bed text-18 list-description {{ $textColor }} sub-icon"></i>
                        </div>
                        <div class="list-description {{ $textColor }}">Bedrooms</div>
                    </div>
                    @foreach ($amenities->sortBy('order')->take(5) as $item)
                        <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13"
                            onclick="homesFilter({{ request()->get('fCategory') ?? 'null' }}, {{ $item->id_amenities }})">
                            <i class="fas fa-{{ $item->icon }} text-18 list-description {{ $textColor }} sub-icon"
                                @php
                                    $amenitiesIds = explode(',', request()->get('fAmenities'));
                                @endphp @if (in_array($item->id_amenities, $amenitiesIds))
                                style="color: #ff7400;"
                    @endif></i>
                    <div class="list-description {{ $textColor }}">{{ $item->name }}</div>
                </div>
                @endforeach
                <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13" onclick="filterMain()">
                    <div>
                        <i class="fas fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
                    </div>
                    <div class="list-description {{ $textColor }}">Filters</div>
                </div>
                <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13" onclick="filterMain()">
                    <div>
                        <i class="fas fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
                    </div>
                    <div class="list-description {{ $textColor }}">Filters</div>
                </div>
            </div>

            <div id="villa-data" class="grid-container-43">
                @include('user.data_list_villa')
            </div>
            <div></div>

            {{-- TODO comment when lazy load, start --}}
            {{-- Pagination --}}
            <div class="mt-5 d-flex justify-content-center" id="footer">
                <div class="mt-3">
                    {{ $villa->onEachSide(1)->appends(Request::all())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
            {{-- End Pagination --}}
            {{-- TODO end --}}

            {{-- TODO uncomment when lazy load, start --}}
            {{-- <div class="ajax-load text-center" style="display: none">
                    <p class="list-loading {{ $textColor }}">
                        {{ __('user_page.Loading More') }}
                    </p>
                </div> --}}

            {{-- <div id="lazy-show-more" class="text-center d-none">
                    <button onclick="loadMoreData(page)" class="btn btn-primary rounded-pill fw-bold" style="font-family:'poppins'">Show More</button>
                </div> --}}
            {{-- TODO end --}}

            <!-- End Grid 43 -->
            <div style="height: 35px;">&nbsp;</div>
        </div>
    </div>
    <!-- End Page Content -->
    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    @include('user.modal.auth.login_register')
    @include('user.modal.villa.category')
    @include('user.modal.filter.filter_modal')
    {{-- modal laguage and currency --}}
    </div>

    {{-- VIEW VIDEO --}}
    @include('user.modal.villa.list.video')
    {{-- END VIEW VIDEO --}}
@endsection

@section('scripts')
    @include('user.modal.villa.list.map')

    {{-- TODO uncomment when lazy load, start --}}
    {{-- @include('components.lazy-load-list.lazy-load-list') --}}
    {{-- TODO end --}}

    <script src="{{ asset('assets/js/list-villa-extend.js') }}"></script>
    <script src="{{ asset('assets/js/price-range.js') }}"></script>

    {{-- Search --}}
    <script>
        $(document).ready(function() {
            $('.js-slider-2 .slick-next').css('display', 'none');
            $('.js-slider-2 .slick-prev').css('display', 'none');
            $('.js-slider-2').mouseenter(function(e) {
                $(this).children('.slick-prev').css('display', 'block');
                $(this).children('.slick-next').css('display', 'block');
            })
            $('.js-slider-2').mouseleave(function(e) {
                $(this).children('.slick-prev').css('display', 'none');
                $(this).children('.slick-next').css('display', 'none');
            })
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
        function moreCategory() {
            $('#categoryModal').modal('show');
        }

        function moreSubCategory() {
            $('#modalSubCategory').modal('show');
        }

        function filterMain() {
            $('#modalFiltersHome').modal('show');
        }

        function villaRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/homes/search?${suburl}`;
        }
    </script>

    {{-- <script>
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

            var subUrl =
                `fMinPrice=${fMinPriceFormInput}&fMaxPrice=${fMaxPriceFormInput}&fBedroom=${fBedroomFormInput}&fBathroom=${fBathroomFormInput}&fBeds=${fBedsFormInput}&fProperty=${fPropertyFormInput}&fViews=${fViewsFormInput}&fAmenities=${fAmenitiesFormInput}&sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}`;
            villaRefreshFilter(subUrl);
        }
    </script> --}}

    <script>
        function homesFilter(valueCategory, valueClick) {
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

            // var filterFormInput = [];
            // $("input[name='filter[]']:checked").each(function() {
            //     filterFormInput.push(parseInt($(this).val()));
            // });

            var fMaxPriceFormInput = $("input[name='fMaxPrice']").val();
            var fMinPriceFormInput = $("input[name='fMinPrice']").val();
            var fBedroomFormInput = $("input[name='fBedroom']:checked").val();
            var fBathroomFormInput = $("input[name='fBathroom']:checked").val();
            var fBedsFormInput = $("input[name='fBeds']:checked").val();
            var fAmenitiesFormInput = [];

            var fCategoryFormInput = [];
            $("input[name='fCategory[]']:checked").each(function() {
                fCategoryFormInput.push(parseInt($(this).val()));
            });
            if (valueCategory != null) {
                fCategoryFormInput.push(valueCategory);
            }
            if (valueClick != null) {
                $("input[name='fAmenities[]']:checked").each(function() {
                    fAmenitiesFormInput.push(parseInt($(this).val()));
                });
                if (fAmenitiesFormInput.includes(valueClick) == true) {
                    var filterCheck = fAmenitiesFormInput.filter(unCheck);

                    function unCheck(dataCheck) {
                        return dataCheck != valueClick;
                    }

                    var filteredArray = filterCheck.filter(function(item, pos) {
                        return filterCheck.indexOf(item) == pos;
                    });
                } else {
                    fAmenitiesFormInput.push(valueClick);

                    var filteredArray = fAmenitiesFormInput.filter(function(item, pos) {
                        return fAmenitiesFormInput.indexOf(item) == pos;
                    });
                }
            } else {
                $("input[name='fAmenities[]']:checked").each(function() {
                    fAmenitiesFormInput.push(parseInt($(this).val()));
                });

                var filteredArray = fAmenitiesFormInput.filter(function(item, pos) {
                    return fAmenitiesFormInput.indexOf(item) == pos;
                });
            }

            var subUrl =
                `sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}&fMinPrice=${fMinPriceFormInput}&fMaxPrice=${fMaxPriceFormInput}&fBedroom=${fBedroomFormInput}&fBathroom=${fBathroomFormInput}&fBeds=${fBedsFormInput}&fCategory=${fCategoryFormInput}&fAmenities=${filteredArray}`;

            villaRefreshFilter(subUrl);
        }
    </script>

    <script>
        function filters_click() {
            var element = document.getElementById("filters");
            element.classList.toggle("filter-active");
            $('#modal-filters').modal('show');
        }
    </script>

    @auth
        @include('components.favorit.like-favorit')
    @endauth
    <script src="{{ asset('assets/js/translate.js') }}"></script>
    {{-- END SEARCH FUNCTION --}}
@endsection
