@extends('layouts.user.list')

@section('title', 'List of Homes - EZV2')

@section('content')
    {{-- function get data --}}
    @php
    // $villas = $villa->shuffle()->sortBy('grade');
    $villas = $villa->shuffle()->sortBy('grade');
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
        <div id="div-to-refresh" class="container__list">
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

                <div id="filter-cat-bg-color" class="container-grid-cat {{ $bgColor }} top-min-10p pb-10p"
                    style="width: 100%;" data-isshow="true">
                    @foreach ($villaCategory->take(6) as $item)
                        <div>
                            <a href="#" class="grid-img-container"
                                onclick="homesFilter({{ $item->id_villa_category }}, null, true)">
                                <img class="grid-img-filter lozad" src="{{ LazyLoad::show() }}"
                                    @if ($fCategory == $item->id_villa_category) style="border: 2px solid #ff7400;" @endif
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

                <div id="filter-subcat-bg-color"
                    class="container-grid-sub-cat {{ $bgColor }} stickySubCategory pt-15p pb-15p" style="width: 100%;"
                    data-isshow="true">
                    <div class="button-dropdown grid-sub-cat-content-container text-13">
                        <a href="javascript:void(0)" id="sortBy" style="cursor:pointer;" class="dropdown-toggle">
                            <div>
                                <i class="fa fa-solid fa-sliders text-18 list-description  {{ $textColor }} sub-icon">
                                </i>
                            </div>
                            <div class="list-description {{ $textColor }}">Sort by</div>
                        </a>
                        <div class="sort-popup dropdown-menu text-center">
                            <h5 style="margin-bottom: 0;">Sort by</h5>
                            <label class="checkdesign checkdesign-modal-filter mt-1">EZV Top Pick
                                <input type="checkbox" class="fSort" name="fSort[]" value="ezv_top_pick"
                                    onchange="homesFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('fAmenities') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'ezv_top_pick') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Highest to Lowest Price
                                <input type="checkbox" class="fSort" name="fSort[]" value="highest"
                                    onchange="homesFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('fAmenities') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'highest') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Lowest to Highest Price
                                <input type="checkbox" class="fSort" name="fSort[]" value="lowest"
                                    onchange="homesFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('fAmenities') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'lowest') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Popularity
                                <input type="checkbox" class="fSort" name="fSort[]" value="popularity"
                                    onchange="homesFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('fAmenities') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'popularity') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Best Reviewed
                                <input type="checkbox" class="fSort" name="fSort[]" value="best_reviewed"
                                    onchange="homesFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('fAmenities') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'best_reviewed') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Closest to the Beach
                                <input type="checkbox" class="fSort" name="fSort[]" value="beach"
                                    onchange="homesFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('fAmenities') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'beach') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13"
                        onclick="modalFiltersHomes()">
                        <div>
                            <i class="fas fa-dollar-sign text-18 list-description {{ $textColor }} sub-icon"></i>
                        </div>
                        <div class="list-description {{ $textColor }}">Price</div>
                    </div>
                    <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13"
                        onclick="modalFiltersHomes()">
                        <div>
                            <i class="fas fa-bed text-18 list-description {{ $textColor }} sub-icon"></i>
                        </div>
                        <div class="list-description {{ $textColor }}">Bedrooms</div>
                    </div>
                    @foreach ($amenities->sortBy('order')->take(4) as $item)
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
                <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13"
                    onclick="modalFiltersHomes()">
                    <div>
                        <i class="fas fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
                    </div>
                    <div class="list-description {{ $textColor }}">Filters</div>
                </div>
                <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13"
                    onclick="modalFiltersHomes()">
                    <div>
                        <i class="fas fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
                    </div>
                    <div class="list-description {{ $textColor }}">Filters</div>
                </div>
            </div>

            <div id="villa-data" class="grid-container-43 container__grid">
                @include('user.data_list_villa')
            </div>
            <div></div>

            {{-- TODO comment when lazy load, start --}}
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
    {{-- Pagination --}}
    <div class="mt-3 d-flex justify-content-center" id="footer">
        <div class="mt-3">
            {{ $villa->onEachSide(0)->appends(Request::all())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    {{-- End Pagination --}}
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
            $(window).on("resize", function(e) {
                var windowWidth = $(this).width();
                if (windowWidth >= 800 && windowWidth <= 949) {
                    var gap = ((windowWidth - 768) / 2) + 20;
                    var navGap = ((windowWidth - 768) / 2) + 30;
                    $(".page-header-fixed .nav-row").attr("style", "padding-left: " + navGap +
                        "px !important;" + "padding-right: " + navGap + "px !important");
                    $("#filter-cat-bg-color").css("padding-left", gap + "px");
                    $("#filter-cat-bg-color").css("padding-right", gap + "px");
                } else if (windowWidth >= 950 && windowWidth <= 991) {
                    var gap = ((windowWidth - 768) / 2) + 40;
                    var navGap = ((windowWidth - 768) / 2) + 40;
                    $(".page-header-fixed .nav-row").attr("style", "padding-left: " + navGap +
                        "px !important;" + "padding-right: " + navGap + "px !important");
                    $("#filter-cat-bg-color").css("padding-left", gap + "px");
                    $("#filter-cat-bg-color").css("padding-right", gap + "px");
                } else if (windowWidth <= 1360) {
                    $(".page-header-fixed .nav-row").attr("style", "");
                    $("#filter-cat-bg-color").css("padding-left", "");
                    $("#filter-cat-bg-color").css("padding-right", "");
                }
            })
            var windowWidth = $(window).width();
            if (windowWidth >= 800 && windowWidth <= 949) {
                var gap = ((windowWidth - 768) / 2) + 20;
                var navGap = ((windowWidth - 768) / 2) + 30;
                $(".page-header-fixed .nav-row").attr("style", "padding-left: " + navGap + "px !important;" +
                    "padding-right: " + navGap + "px !important");
                $("#filter-cat-bg-color").css("padding-left", gap + "px");
                $("#filter-cat-bg-color").css("padding-right", gap + "px");
            } else if (windowWidth >= 950 && windowWidth <= 991) {
                var gap = ((windowWidth - 768) / 2) + 40;
                var navGap = ((windowWidth - 768) / 2) + 40;
                $(".page-header-fixed .nav-row").attr("style", "padding-left: " + navGap + "px !important;" +
                    "padding-right: " + navGap + "px !important");
                $("#filter-cat-bg-color").css("padding-left", gap + "px");
                $("#filter-cat-bg-color").css("padding-right", gap + "px");
            } else if (windowWidth <= 1360) {
                $(".page-header-fixed .nav-row").attr("style", "");
                $(".page-header-fixed .nav-row").css("padding-right", navGap + "px");
                $("#filter-cat-bg-color").css("padding-left", "");
                $("#filter-cat-bg-color").css("padding-right", "");
            }

            $(".js-slider-2").each(function(i, el) {
                var sliderLength = 0;
                $(this).find(".slick-slide").each(function(i, el) {
                    if (!$(this).hasClass("slick-cloned")) {
                        sliderLength = parseInt($(this).attr("data-slick-index"));
                        maxSlickIndex = sliderLength;
                    }
                })
                var dotsContainer = $(this).parent().find(".dots-container");
                if (sliderLength >= 4) {
                    for (var j = 0; j <= 4; j++) {
                        if (j == 0) {
                            dotsContainer.append('<div class="circle activeIndicator" data-index=' + j +
                                '></div>');
                        } else {
                            dotsContainer.append('<div class="circle" data-index=' + j + '></div>');
                        }
                    }
                } else if (sliderLength > 0 && sliderLength <= 4 && sliderLength != 0) {
                    for (var j = 0; j <= sliderLength; j++) {
                        if (j == 0) {
                            dotsContainer.append('<div class="circle activeIndicator" data-index=' + j +
                                '></div>');
                        } else {
                            dotsContainer.append('<div class="circle" data-index=' + j + '></div>');
                        }
                    }
                }
            });
            $('.js-slider-2').on("afterChange", function(e) {
                var currSlickIndex = parseInt($(this).find(".slick-current").attr("data-slick-index"));
                var maxSlickIndex = 0;
                $(this).find(".slick-slide").each(function(i, el) {
                    if (!$(this).hasClass("slick-cloned")) {
                        maxSlickIndex = parseInt($(this).attr("data-slick-index"));
                    }
                })
                var allDots = $(this).parent().find(".dots-container").find(".circle");
                var dots = $(this).parent().find(".dots-container").find(".circle");
                if (maxSlickIndex > 5) {
                    if (currSlickIndex > 1 && currSlickIndex <= maxSlickIndex - 2) {
                        allDots.removeClass("activeIndicator");
                        dots[2].classList.add("activeIndicator");
                    } else if (currSlickIndex <= 1) {
                        allDots.removeClass("activeIndicator");
                        dots[currSlickIndex].classList.add("activeIndicator");
                    } else if (currSlickIndex == maxSlickIndex - 1) {
                        allDots.removeClass("activeIndicator");
                        dots[3].classList.add("activeIndicator");
                    } else if (currSlickIndex == maxSlickIndex) {
                        allDots.removeClass("activeIndicator");
                        dots[4].classList.add("activeIndicator");
                    }
                } else {
                    allDots.removeClass("activeIndicator");
                    dots[currSlickIndex].classList.add("activeIndicator");
                }
            });
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
        function villaRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/homes/search?${suburl}`;
        }

        $("input[name='fSort[]']").on('click', function() {
            var $box = $(this);
            if ($box.is(":checked")) {
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });

        function homesFilter(valueCategory, valueClick, unCheckCategory) {
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

            var fMaxPriceFormInput = $("input[name='fMaxPrice']").val();
            var fMinPriceFormInput = $("input[name='fMinPrice']").val();
            var fBedroomFormInput = $("input[name='fBedroom']:checked").val();
            var fBathroomFormInput = $("input[name='fBathroom']:checked").val();
            var fSortFormInput = $('.fSort:checked').val();
            if (fSortFormInput == undefined) {
                var fSortFormInput = '';
            }

            const urlParams = new URLSearchParams(window.location.search);
            const fSort = urlParams.get('fSort')
            if (fSortFormInput == fSort) {
                var fSortFormInput = '';
            }

            var fBedsFormInput = $("input[name='fBeds']:checked").val();
            var fAmenitiesFormInput = [];
            var fCategoryFormInput = [];

            if (unCheckCategory == true) {
                var url_homes = window.location.href;
                var url2 = new URL(url_homes);

                if (url2.searchParams.get('fCategory') == valueCategory) {
                    valueCategory = '';
                }
            }

            if (valueCategory != null) {
                $("input[name='fCategory[]']").prop("checked", false);
                $("input[name='fCategory[]']:checked").each(function() {
                    fCategoryFormInput.push(parseInt($(this).val()));
                });
                if (fCategoryFormInput.includes(valueCategory) == true) {
                    var filterCheck = fCategoryFormInput.filter(unCheck);

                    function unCheck(dataCheck) {
                        return dataCheck != valueCategory;
                    }

                    var filteredCategory = filterCheck.filter(function(item, pos) {
                        return filterCheck.indexOf(item) == pos;
                    });
                } else {
                    fCategoryFormInput.push(valueCategory);

                    var filteredCategory = fCategoryFormInput.filter(function(item, pos) {
                        return fCategoryFormInput.indexOf(item) == pos;
                    });
                }
            } else {
                $("input[name='fCategory[]']:checked").each(function() {
                    fCategoryFormInput.push(parseInt($(this).val()));
                });

                var filteredCategory = fCategoryFormInput.filter(function(item, pos) {
                    return fCategoryFormInput.indexOf(item) == pos;
                });
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
                `sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}&fMinPrice=${fMinPriceFormInput}&fMaxPrice=${fMaxPriceFormInput}&fBedroom=${fBedroomFormInput}&fBathroom=${fBathroomFormInput}&fBeds=${fBedsFormInput}&fCategory=${filteredCategory}&fAmenities=${filteredArray}&fSort=${fSortFormInput}`;

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
