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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/m-list-villa.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/m-list-activity.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/header-css.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/pagination-css.css') }}">
</head>

<body style="background-color: black;">
    @component('components.loading.loading-type2')
    @endcomponent
    @php
        $property_type = App\PropertyTypeVilla::all();
        $villa_suitable = App\VillaSuitable::whereIn('id_suitable', ['2'])->get();

        $villaFacilities = App\Amenities::whereIn('id_amenities', [5, 14, 12, 13])->get();

        $condition_villa = Route::is('list') || Route::is('property_type') || Route::is('filter') || Route::is('price') || Route::is('more_filter') || Route::is('box_filter') || Route::is('sort_low_to_high') || Route::is('sort_high_to_low') || Route::is('sort_popularity') || Route::is('sort_newest') || Route::is('sort_highest_rating') || Route::is('filter_activity') || Route::is('filter_activity_get_subcategory') || Route::is('search_villa') || Route::is('amenities_filter') || Route::is('filters');

        $condition_restaurant = Route::is('restaurant_list') || Route::is('search_restaurant') || Route::is('filter_restaurant');

        $condition_things_to_do = Route::is('activity_list') || Route::is('search_activity');
    @endphp
    <div id="page-container">
        <!-- Header -->
        <header>
            <div id="new-bar-black" class="page-header-fixed d-flex flex-column">
                @include('layouts.user.header-list')
                <div class="header-mobile">
                    <div class="row">
                        <div class="col-3">
                            <a class="text-white" type="button" href="{{ route('index') }}"><i
                                    class="fa fa-chevron-left"></i> EZV2</a>
                        </div>
                        <div class="col-6">
                            <div class="add-guest">
                                <form action="" method="POST" target="_self">
                                    <input class="date-filter" placeholder="Date" type="text"
                                        onfocus="(this.type = 'date')" id="date">
                                </form>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="price-filter" id="filters" onclick="filters_click()">
                                <i class="far fa-sliders-h"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($condition_villa)
                <div class="row row-cat-container">
                    <div id="myBtnContainer" class="menu col-12">
                        <ul class="cat-container">
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" id="prices" class="dropdown-toggle">
                                    Price
                                </a>
                                <div class="price-popup dropdown-menu">
                                    <div class="dropdown-pd-0">
                                        <div class="double-slider">
                                            <form action="{{ route('price') }}" method="GET">
                                                <div class="extra-controls form-inline">
                                                    <div class="col-lg-12">
                                                        <p class="price-popup-title">Price</p>
                                                    </div>
                                                    <div class="form-group col-lg-12 price-popup-display-container">
                                                        <div class="price-popup-display-wrap1">
                                                            <div class="col-lg-12 price-popup-display">
                                                                <label for="min_price"
                                                                    class="price-popup-label">Min</label>
                                                                <input name="min_price" type="text"
                                                                    class="js-input-from form-control price-popup-label"
                                                                    value="0" />
                                                            </div>
                                                        </div>
                                                        <div class="price-popup-display-gap-container">
                                                            <div></div>
                                                        </div>
                                                        <div class="price-popup-display-wrap2">
                                                            <div class="col-lg-12 price-popup-display">
                                                                <label for="max_price"
                                                                    class="price-popup-label">Max</label>
                                                                <input name="max_price" type="text"
                                                                    class="js-input-to form-control price-popup-label"
                                                                    value="0" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="js-range-slider" value="" />
                                                </div>
                                                <center>
                                                    <div style="margin-top: 25px;"><input type="submit"
                                                            class="btn btn-choose"
                                                            style="border-radius:12px; width: 100%; padding: 10px;"
                                                            value="Save"></div>
                                                </center>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" id="property" class="dropdown-toggle">
                                    Property Type
                                </a>
                                <div class="propertytype-popup dropdown-menu">
                                    <div>
                                        <form action="{{ route('box_filter') }}" method="GET">

                                            <div class="propertytype-input-row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        @foreach ($property_type as $item)
                                                            @php
                                                                $checked = [];
                                                                if (isset($_GET['filterProperty'])) {
                                                                    $checked = $_GET['filterProperty'];
                                                                }
                                                            @endphp
                                                            <div class="col-6 mb-3">
                                                                <label class="checkdesign">{{ $item->name }}
                                                                    <input type="checkbox" name="filterProperty[]"
                                                                        value="{{ $item->id_property_type }}"
                                                                        @if (in_array($item->id_property_type, $checked)) checked @endif>
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-top: 25px;">
                                                <button type="submit" class="btn btn-choose"
                                                    style="border-radius:12px; width: 100%; padding: 10px;">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" id="rooms" class="dropdown-toggle">
                                    Number of rooms
                                </a>

                                <div class="roomnumber-popup dropdown-menu">
                                    <form action="{{ route('more_filter') }}" method="GET">
                                        <div class="numberofrooms-input-row">
                                            <div class="col-lg-12">
                                                <p class="roomnumber-input-row">Number of rooms</p>
                                            </div>
                                            <div class="roomnumber-input-row">
                                                <div class="col-6 vertical-center">
                                                    <div class="col-12 roomnumberoption-type-container">
                                                        <p class="roomnumberoption-type-title">Bedrooms</p>
                                                    </div>
                                                </div>
                                                <div class="col-6 roomnumberoption-button-container">
                                                    <a type="button" onclick="bedroom_decrement()"
                                                        class="roomnumberoption-button-title">
                                                        <i
                                                            class="fa-solid fa-minus guests-style roomnumberoption-button-icon"></i>
                                                    </a>
                                                    <div class="roomnumber-popup-display-container">
                                                        <input class="roomnumber-popup-display" type="number"
                                                            id="bedroom_number" name="bedroom" value="0" min="0"
                                                            readonly>
                                                    </div>
                                                    <a type="button" onclick="bedroom_increment()"
                                                        class="roomnumberoption-button-title">
                                                        <i class="fa-solid fa-plus roomnumberoption-button-icon"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="roomnumber-input-row">
                                                <div class="col-6 vertical-center">
                                                    <div class="col-12 roomnumberoption-type-container">
                                                        <p class="roomnumberoption-type-title">Bathrooms</p>
                                                    </div>
                                                </div>
                                                <div class="col-6"
                                                    style="display: flex; align-items: center; justify-content: end;">
                                                    <a type="button" onclick="bathroom_decrement()"
                                                        class="roomnumberoption-button-title">
                                                        <i
                                                            class="fa-solid fa-minus guests-style roomnumberoption-button-icon"></i>
                                                    </a>
                                                    <div class="roomnumber-popup-display-container">
                                                        <input class="roomnumber-popup-display" type="number"
                                                            id="bathroom_number" name="bathroom" value="0" min="0"
                                                            readonly>
                                                    </div>
                                                    <a type="button" onclick="bathroom_increment()"
                                                        class="roomnumberoption-button-title">
                                                        <i class="fa-solid fa-plus roomnumberoption-button-icon"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="roomnumber-input-row">
                                                <div class="col-6 vertical-center">
                                                    <div class="col-12 roomnumberoption-type-container">
                                                        <p class="roomnumberoption-type-title">Beds</p>
                                                    </div>
                                                </div>
                                                <div class="col-6"
                                                    style="display: flex; align-items: center; justify-content: end;">
                                                    <a type="button" onclick="bed_decrement()"
                                                        class="roomnumberoption-button-title">
                                                        <i
                                                            class="fa-solid fa-minus guests-style roomnumberoption-button-icon"></i>
                                                    </a>
                                                    <div class="roomnumber-popup-display-container">
                                                        <input class="roomnumber-popup-display" type="number"
                                                            id="bed_number" name="beds" value="0" min="0" readonly>
                                                    </div>
                                                    <a type="button" onclick="bed_increment()"
                                                        class="roomnumberoption-button-title">
                                                        <i class="fa-solid fa-plus"
                                                            class="roomnumberoption-button-icon"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-12 dropdown-pd-0 text-small">
                                                <input type="submit"
                                                    class="btn btn-choose roomnumber-popup-button-search" value="Save">
                                            </div>
                                    </form>
                                </div>

                            </li>
                            <li>
                                <form id="form" method="get" action="{{ route('amenities_filter') }}">
                                    @foreach ($villaFacilities as $item)
                                        {{-- <a href="" id="parking" onclick="parking_click()" class="">{{ $item->name }}</a> --}}
                                        <div class="cat action cat-gap">
                                            <label>
                                                @php
                                                    $checked2 = [];
                                                    if (isset($_GET['filterAmenities'])) {
                                                        $checked2 = $_GET['filterAmenities'];
                                                    }
                                                @endphp
                                                <input type="checkbox" onchange="$('#form').submit();"
                                                    name="filterAmenities[]" value="{{ $item->id_amenities }}"
                                                    @if (in_array($item->id_amenities, $checked2)) checked @endif><span
                                                    class="cat-span">{{ $item->name }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                    @foreach ($villa_suitable as $item2)
                                        <div class="cat action cat-gap">
                                            <label>
                                                @php
                                                    $checked3 = [];
                                                    if (isset($_GET['filterSuitable'])) {
                                                        $checked3 = $_GET['filterSuitable'];
                                                    }
                                                @endphp
                                                <input type="checkbox" onchange="$('#form').submit();"
                                                    name="filterSuitable[]" value="{{ $item2->id_suitable }}"
                                                    @if (in_array($item2->id_suitable, $checked3)) checked @endif><span
                                                    class="cat-span">{{ $item2->name }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </form>
                            </li>
                            <li class="cat-gap">
                                <a href="#" id="filters" onclick="filters_click()" class=""><i
                                        class="fa fa-sliders" aria-hidden="true"></i> Filters</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

            @if ($condition_restaurant)
                @php
                    $amenities = App\Amenities::all();
                    $locations = App\Location::all();
                    $types = App\RestaurantType::all();
                    $facilities = App\RestaurantFacilities::all();
                    $meals = App\RestaurantMeal::all();
                    $prices = App\RestaurantPrice::all();
                    $cuisines = App\RestaurantCuisine::all();
                    $dishes = App\RestaurantDishes::all();
                    $dietaryfoods = App\RestaurantDietaryFood::all();
                    $goodfors = App\RestaurantGoodfor::all();
                @endphp


                <div class="row row-cat-container">
                    <div id="myBtnContainer" class="menu col-12">
                        <ul class="cat-container">
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle">
                                    Restaurant Type
                                </a>
                                <div class="restauranttype-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="type-form">
                                                <div class="row">
                                                    @forelse ($types as $type)
                                                        @php
                                                            $isChecked = '';
                                                            $typesIds = explode(',', request()->get('fType'));
                                                            if (in_array($type->id_type, $typesIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $type->name }}
                                                                <input type="checkbox" class="type-form-input"
                                                                    name="fType[]" value="{{ $type->id_type }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        {{--  --}}
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle">
                                    Rate of Price
                                </a>
                                <div class="rateofprice-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="price-form">
                                                <div class="row">
                                                    @forelse ($prices as $price)
                                                        @php
                                                            $isChecked = '';
                                                            $pricesIds = explode(',', request()->get('fPrice'));
                                                            if (in_array($price->id_price, $pricesIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $price->name }}
                                                                <input type="checkbox" class="price-form-input"
                                                                    name="fPrice[]" value="{{ $price->id_price }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        {{--  --}}
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle">
                                    Facilities
                                </a>
                                <div class="facilities-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="facilities-form">
                                                <div class="row">
                                                    @forelse ($facilities as $facility)
                                                        @php
                                                            $isChecked = '';
                                                            $facilitiesIds = explode(',', request()->get('fFacilities'));
                                                            if (in_array($facility->id_facilities, $facilitiesIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $facility->name }}
                                                                <input type="checkbox" class="facilities-form-input"
                                                                    name="fFacilities[]"
                                                                    value="{{ $facility->id_facilities }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        {{--  --}}
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle">
                                    Meal
                                </a>
                                <div class="meal-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="meal-form">
                                                <div class="row">
                                                    @forelse ($meals as $meal)
                                                        @php
                                                            $isChecked = '';
                                                            $mealsIds = explode(',', request()->get('fMeal'));
                                                            if (in_array($meal->id_meal, $mealsIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $meal->name }}
                                                                <input type="checkbox" class="meal-form-input"
                                                                    name="fMeal[]" value="{{ $meal->id_meal }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        {{--  --}}
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle">
                                    Dishes
                                </a>
                                <div class="dishes-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="dishes-form">
                                                <div class="row">
                                                    @forelse ($dishes as $dish)
                                                        @php
                                                            $isChecked = '';
                                                            $dishesIds = explode(',', request()->get('fDishes'));
                                                            if (in_array($dish->id_dishes, $dishesIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $dish->name }}
                                                                <input type="checkbox" class="dishes-form-input"
                                                                    name="fDishes[]" value="{{ $dish->id_dishes }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        {{--  --}}
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle">
                                    Dietary Food
                                </a>
                                <div class="dietaryfood-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="dietaryfood-form">
                                                <div class="row">
                                                    @forelse ($dietaryfoods as $dietaryfood)
                                                        @php
                                                            $isChecked = '';
                                                            $dietaryfoodsIds = explode(',', request()->get('fDietaryfood'));
                                                            if (in_array($dietaryfood->id_dietaryfood, $dietaryfoodsIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $dietaryfood->name }}
                                                                <input type="checkbox" class="dietaryfood-form-input"
                                                                    name="fDietaryfood[]"
                                                                    value="{{ $dietaryfood->id_dietaryfood }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        {{--  --}}
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle">
                                    Good For
                                </a>
                                <div class="goodfor-popup dropdown-menu">

                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="goodfor-form">
                                                <div class="row">
                                                    @forelse ($goodfors as $goodfor)
                                                        @php
                                                            $isChecked = '';
                                                            $goodforsIds = explode(',', request()->get('fGoodfor'));
                                                            if (in_array($goodfor->id_goodfor, $goodforsIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $goodfor->name }}
                                                                <input type="checkbox" class="goodfor-form-input"
                                                                    name="fGoodfor[]"
                                                                    value="{{ $goodfor->id_goodfor }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        {{--  --}}
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

            @if ($condition_things_to_do)
                @php
                    $amenities = App\Amenities::all();
                    $locations = App\Location::all();
                    $facilities = App\ActivityFacilities::all();
                    $categories = App\ActivityCategory::all();
                    $subcategories = App\ActivitySubcategory::all();
                @endphp

                <div class="row row-cat-container">
                    <div id="myBtnContainer" class="menu col-12">
                        <ul class="cat-container">
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle">
                                    Category
                                </a>
                                <div class="propertytype-popup dropdown-menu" style="left: 340px !important;">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="category-form">
                                                <div class="row">
                                                    @forelse ($categories as $category)
                                                        @php
                                                            $isChecked = '';
                                                            $categoryIds = explode(',', request()->get('fCategory'));
                                                            if (in_array($category->id_category, $categoryIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3"
                                                            id="category-form-input{{ $category->id_category }}">
                                                            <label class="checkdesign"
                                                                for="{{ $category->id_category }}">{{ $category->name }}
                                                                <input type="checkbox" class="category-form-input"
                                                                    name="fCategory[]"
                                                                    id="{{ $category->id_category }}"
                                                                    value="{{ $category->id_category }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        {{--  --}}
                                                    @endforelse
                                                    <input type="submit" onclick="activityFilter()"
                                                        class="btn btn-choose roomnumber-popup-button-search"
                                                        value="Search">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle">
                                    Time of Day
                                </a>
                                <div class="propertytype-popup dropdown-menu" style="left: 455px !important;">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="timeofday-form">
                                                <div class="row">
                                                    @php
                                                        $isChecked = '';
                                                        $timeofdayIds = explode(',', request()->get('fTimeofday'));
                                                        if (in_array('morning', $timeofdayIds)) {
                                                            $isChecked = 'checked';
                                                        }
                                                    @endphp
                                                    <div class="col-6 mb-3" id="timeofday-form-input">
                                                        <label class="checkdesign">Morning
                                                            <input type="checkbox" class="timeofday-form-input"
                                                                name="fTimeofday[]" value="morning"
                                                                {{ $isChecked }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>

                                                    @php
                                                        $isChecked = '';
                                                        $timeofdayIds = explode(',', request()->get('fTimeofday'));
                                                        if (in_array('afternoon', $timeofdayIds)) {
                                                            $isChecked = 'checked';
                                                        }
                                                    @endphp
                                                    <div class="col-6 mb-3" id="timeofday-form-input">
                                                        <label class="checkdesign">Afternoon
                                                            <input type="checkbox" class="timeofday-form-input"
                                                                name="fTimeofday[]" value="afternoon"
                                                                {{ $isChecked }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>

                                                    @php
                                                        $isChecked = '';
                                                        $timeofdayIds = explode(',', request()->get('fTimeofday'));
                                                        if (in_array('evening', $timeofdayIds)) {
                                                            $isChecked = 'checked';
                                                        }
                                                    @endphp
                                                    <div class="col-6 mb-3" id="timeofday-form-input">
                                                        <label class="checkdesign">Evening
                                                            <input type="checkbox" class="timeofday-form-input"
                                                                name="fTimeofday[]" value="evening"
                                                                {{ $isChecked }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <input type="submit" onclick="activityFilter()"
                                                        class="btn btn-choose roomnumber-popup-button-search"
                                                        value="Search">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle">
                                    Facilities
                                </a>
                                <div class="propertytype-popup dropdown-menu" style="left: 570px;">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="facilities-form">
                                                <div class="row">
                                                    @forelse ($facilities as $facility)
                                                        @php
                                                            $isChecked = '';
                                                            $facilitiesIds = explode(',', request()->get('fFacilities'));
                                                            if (in_array($facility->id_facilities, $facilitiesIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $facility->name }}
                                                                <input type="checkbox" class="facilities-form-input"
                                                                    name="fFacilities[]"
                                                                    value="{{ $facility->id_facilities }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        {{--  --}}
                                                    @endforelse
                                                    <input type="submit" onclick="activityFilter()"
                                                        class="btn btn-choose roomnumber-popup-button-search"
                                                        value="Search">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
    </div>
    </header>
    <!-- END Header Content -->

    <!-- Main Container -->
    <main id="main-container">

        @yield('content')

    </main>
    <!-- END Main Container -->

    {{-- MODAL SHARE --}}
    <div class="modal fade" id="modal-share" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">Share</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="fs-3 fw-bold mb-0">Share this page with your friend and family</p>
                    <div>
                        <div class="row row-cols-1 row-cols-lg-2">
                            <div class="col-lg col-12 p-3 border share-med">
                                <a type="button" class="d-flex p-0" onclick="copy_link()">
                                    <div class="pr-5"><i class="fas fa-copy"></i> <span
                                            class="fw-normal">Copy Link</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&display=popup"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                            class="fw-normal">Facebook</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="#" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-facebook-messenger"></i> <span
                                            class="fw-normal">Facebook Messenger</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank"
                                    class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                            class="fw-normal">WhatsApp</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="https://telegram.me/share/url?url={{ url()->current() }}&text={{ url()->current() }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                            class="fw-normal">Telegram</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="mailto:?subject=I wanted you to see this site&amp;body={{ url()->current() }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fas fa-envelope"></i> <span
                                            class="fw-normal">Email</span></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copy_link() {
            alert('link has been copied');
            navigator.clipboard.writeText(window.location.href);
        }
    </script>
    {{-- Video Modal --}}
    <div class="modal fade" id="videomodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content video-container">
                <div class="nav-video nav-video-prev"><a type="button" id="button_prev"><span><i
                                class="fa fa-chevron-left"></i></span>Prev</a></div>
                <center>
                    <video controls id="video1" class="video-modal">
                        <source src="" type="video/mp4">
                        Your browser doesn't support HTML5 video tag.
                    </video>
                </center>
                <div class="overlay-social">
                    <div class="row social-share">
                        <div class="col-6 text-center icon-center">
                            @if ($activity[0]->is_favorit)
                                <p>
                                    <a href="{{ route('activity_favorit', $activity[0]->id_activity) }}"><i
                                            class="fa fa-heart" style="color: #f00;  font-size: 10px;"></i>
                                        {{-- <span>CANCEL</span> --}}
                                    </a>
                                </p>
                            @else
                                <p>
                                    <a href="{{ route('activity_favorit', $activity[0]->id_activity) }}"><i
                                            class="fa fa-heart" style="color: #aaa;  font-size: 10px;"></i>
                                        {{-- <span style="color: #aaa;">FAVORIT</span> --}}
                                    </a>
                                </p>
                            @endif
                        </div>
                        <div class="col-6 text-center icon-center">
                            <p type="button" class="expand" onclick="share()">
                                <i class="fa fa-share" style="font-size: 10px;"></i>
                                {{-- <span>SHARE</span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer -->
    @include('layouts.user.footer')
    @include('user.modal.filter.activity_modal')
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

    <style>
        .flat-margin {
            margin-top: 30px;
        }
    </style>

    <script>
        $("#dates").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            mode: "range",
            showMonths: 2,
            onReady(_, __, fp) {
                fp.calendarContainer.classList.add("flat-margin");
            },
            onChange: function(selectedDates, dateStr, instance) {
                $('#dates').val("");
                $('#check_in2').val(flatpickr.formatDate(selectedDates[0], "Y-m-d"));
                $('#check_out2').val(flatpickr.formatDate(selectedDates[1], "Y-m-d"))
            }
        });
    </script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>

    <script src="{{ asset('assets/js/list-villa.js') }}"></script>

    <script>
        $("#searchbox").click(function() {
            $("#search_bar").toggleClass("active");
        });
    </script>

    <script src="{{ asset('assets/js/price-range.js') }}"></script>

    @yield('scripts')
</body>

</html>
