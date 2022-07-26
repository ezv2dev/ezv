@extends('layouts.admin.add_listing')

@section('content')
    <style>
        .top-logo {
            position: relative;
            top: 20px;
            left: -50px;
        }

        .headingWh {
            margin-top: 50%;
        }

        .image-button {
            width: 150px;
            object-fit: cover;
            height: 150px;
            border-radius: 50%;
        }

        .pointer {
            box-shadow: 0 1px 3px rgb(214 221 237 / 50%), 0 1px 2px rgb(214 221 237 / 50%);
            transition: opacity 0.25s ease-out;
            opacity: 1;
        }

        .pointer:hover {
            cursor: pointer;
            transition: transform 0.15s ease-out, opacity 0.15s ease-out, box-shadow 0.15s ease-out;
            opacity: .5;
        }
    </style>
    <section class="h-100 w-100">
        <div class="row m-0">
            <div class="col-md-5"
                style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(255, 225, 225, 0.5)), url('https://source.unsplash.com/random/?bali,villa,hotel,adventure,restaurant'); background-size: cover; background-position: center; height: 100vh;">
                <div class="top-logo">
                    <a href="{{ route('partner_dashboard') }}" class="navbar-brand"
                        style="margin-left: 80px !important; margin-top: 100px !important;" target="_blank">
                        <img style="width: 90px;" src="{{ asset('assets/logo.png') }}" alt="oke">
                    </a>
                </div>
                <div id="text">
                    <h1 class="headingWh" style="text-align: center; color: #fff;"> What type you want to add?</h1>
                    <h4 class="d-md-block"
                        style="text-align: center; color: #fff; font-weight: 400; font-family: 'Poppins', sans-serif !important; display: none;">
                        Please Select Type First</h4>
                    <h4 class="d-md-none"
                        style="text-align: center;">
                        <a href="#type-list" class="text-decoration-none" style="color: #fff; font-weight: 400; font-family: 'Poppins', sans-serif !important;">
                            Click here to Select Type
                        </a>
                    </h4>
                </div>
            </div>
            <div class="col-md-7" id="type-list">
                <div style="padding-left: 20px; padding-right:20px; margin-top: 12.5%;">
                    <div class="form-group">
                        <div class="row my-5">
                            <div class="col-12 col-sm-6 mb-3">
                                @php
                                    $has_villa = App\Http\Controllers\ListingController::has_villa(Auth::user()->id);
                                @endphp
                                <form target="_blank"
                                    @if ($has_villa) action="{{ route('villa', $has_villa->id_villa) }}"
                                        method="GET"
                                    @else
                                        action="{{ route('admin_villa_store') }}"
                                        method="POST" @endif
                                    enctype="multipart/form-data" id="villa-form">
                                    @if (!$has_villa)
                                        @csrf
                                    @endif

                                    <div id="btn_villa" class="py-3 pointer"
                                        style="background-color : #f9f9f9; border-radius:15px;" href="javascript:void(0)">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="text-center">
                                                <img src="https://source.unsplash.com/random/?villa" class="image-button">
                                                <div class="fw-semibold mt-3 text-uppercase" style="color: #000 ">
                                                    {{ __('user_page.Homes') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12 col-sm-6 mb-3">
                                @php
                                    $has_hotel = App\Http\Controllers\ListingController::has_hotel(Auth::user()->id);
                                @endphp
                                <form target="_blank"
                                    @if ($has_hotel) action="{{ route('hotel', $has_hotel->id_hotel) }}"
                                        method="get"
                                    @else
                                        action="{{ route('admin_hotel_store') }}"
                                        method="post" @endif
                                    enctype="multipart/form-data" id="hotel-form">
                                    @if (!$has_hotel)
                                        @csrf
                                    @endif

                                    <div id="btn_hotel" class="py-3 pointer" href="javascript:void(0)"
                                        style="background-color : #f9f9f9; border-radius:15px;">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="text-center">
                                                <img src="https://source.unsplash.com/random/?hotel" class="image-button">
                                                <div class="fw-semibold mt-3 text-uppercase" style="color: #000 ">
                                                    {{ __('user_page.Hotels') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12 col-sm-6">
                                @php
                                    $has_restaurant = App\Http\Controllers\ListingController::has_restaurant(Auth::user()->id);
                                @endphp
                                <form target="_blank"
                                    @if ($has_restaurant) action="{{ route('restaurant', $has_restaurant->id_restaurant) }}"
                                        method="GET"
                                    @else
                                        action="{{ route('admin_restaurant_store') }}"
                                        method="POST" @endif
                                    enctype="multipart/form-data" id="restaurant-form">
                                    @if (!$has_restaurant)
                                        @csrf
                                    @endif

                                    <div id="btn_restaurant" class="py-3 pointer"
                                        style="background-color : #f9f9f9; border-radius:15px;" href="javascript:void(0)">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="text-center">
                                                <img src="https://source.unsplash.com/random/?restaurant"
                                                    class="image-button">
                                                <div class="fw-semibold mt-3 text-uppercase" style="color: #000 ">
                                                    {{ __('user_page.Food') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12 col-sm-6">
                                @php
                                    $has_activity = App\Http\Controllers\ListingController::has_activity(Auth::user()->id);
                                @endphp
                                <form target="_blank"
                                    @if ($has_activity) action="{{ route('activity', $has_activity->id_activity) }}" method="GET" @else action="{{ route('admin_activity_store') }}" method="POST" @endif
                                    enctype="multipart/form-data" id="activity-form">
                                    @if (!$has_activity)
                                        @csrf
                                    @endif

                                    <div id="btn_activity" class="py-3 pointer"
                                        style="background-color : #f9f9f9; border-radius:15px;" href="javascript:void(0)">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="text-center">
                                                <img src="https://source.unsplash.com/random/?activity"
                                                    class="image-button">
                                                <div class="fw-semibold mt-3 text-uppercase" style="color: #000 ">WoW
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="h1-00 w-100" style="background: #000;">
        @include('layouts.user.footer')
    </section>
@endsection

@section('scripts')
    <script>
        document.getElementById("btn_villa").onclick = function() {
            document.getElementById("villa-form").submit();
        }

        document.getElementById("btn_hotel").onclick = function() {
            document.getElementById("hotel-form").submit();
        }

        document.getElementById("btn_restaurant").onclick = function() {
            document.getElementById("restaurant-form").submit();
        }

        document.getElementById("btn_activity").onclick = function() {
            document.getElementById("activity-form").submit();
        }
    </script>
@endsection
