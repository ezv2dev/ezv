@extends('layouts.admin.add_listing')

@section('content')
    <style>
        label {
            width: 100%;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
        }

        label span {
            font-size: 0.8rem;
        }

        label.error {
            color: red;
            font-size: 0.8rem;
            display: block;
            margin-top: 5px;
        }

        label.error.fail-alert {
            border: 2px solid red;
            border-radius: 4px;
            line-height: 1;
            padding: 2px 0 6px 6px;
            background: #ffe6eb;
        }

        input.valid.success-alert {
            border: 2px solid #4CAF50;
            color: green;
        }

        input.error, textarea.error, select.error {
            border: 1px dashed red;
            font-weight: 300;
            color: red;
        }
    </style>
    <div class="row" style="height: 100vh;">
        <div class="col-lg-6" style="background-color: #000;">
            <div class="row my-5">
                <div class="col-4">
                    <a href="{{ route('partner_dashboard') }}" class="navbar-brand" style="margin-left: 80px !important; margin-top: 100px !important;" target="_blank">
                        <img style="width: 90px;" src="{{ asset('assets/logo.png') }}" alt="oke">
                    </a>
                </div>
                <div class="col-8">
                    <h1 class="headingWh"
                        style="font-size: 26px; margin-top: -10px !important; padding-top:20px; padding-right:15px; text-align: center; color: #fff;">
                        What type you want to add?</h1>
                </div>
            </div>

            <div style="padding-left : 20px; padding-right:20px;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <form action="{{ route('admin_villa_store') }}" method="POST" enctype="multipart/form-data" id="villa-form" class="js-validation">
                                @csrf
                                <a id="btn_villa" class="block block-rounded text-center bg-image"
                                    style="background-color : #ff7400; border-radius:15px;" href="javascript:void(0)">
                                    <div class="block-content block-content-full ratio ratio-16x9">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div>
                                                <i class="fa fa-2x fa-home" style="color : #fff"></i>
                                                <div class="fw-semibold mt-3 text-uppercase" style="color: #fff ">
                                                    {{ $type[0]->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>

                        <div class="col-6 col-md-6">
                            <a class="block block-rounded text-center bg-image"
                                style="background-color : #ff7400; border-radius:15px;" onclick="hotel()">
                                <div class="block-content block-content-full ratio ratio-16x9">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div>
                                            <i class="fa fa-2x fa-hotel" style="color : #fff"></i>
                                            <div class="fw-semibold mt-3 text-uppercase" style="color: #fff ">
                                                {{ $type[1]->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-6">
                            <a class="block block-rounded text-center bg-image"
                                style="background-color : #ff7400; border-radius:15px;" onclick="restaurant()">
                                <div class="block-content block-content-full ratio ratio-16x9">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div>
                                            <i class="fa fa-2x fa-utensils" style="color : #fff"></i>
                                            <div class="fw-semibold mt-3 text-uppercase" style="color: #fff ">
                                                {{ $type[2]->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-6">
                            <a class="block block-rounded text-center bg-image"
                                style="background-color : #ff7400; border-radius:15px;" onclick="activity()">
                                <div class="block-content block-content-full ratio ratio-16x9">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div>
                                            <i class="fa fa-2x fa-walking" style="color : #fff"></i>
                                            <div class="fw-semibold mt-3 text-uppercase" style="color: #fff ">
                                                {{ $type[3]->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <style>
                .file-upload {
                    .image-box {
                        margin: 0 auto;
                        margin-top: 1em;
                        height: 15em;
                        width: 20em;
                        background: #d24d57;
                        cursor: pointer;
                        overflow: hidden;

                        img {
                            height: 10%;
                            display: none;
                        }

                        p {
                            position: relative;
                            top: 45%;
                        }

                    }
                }
            </style>
                <div id="text">
                    <h2 style="padding-top:50%; text-align: center;">Please Select Type First</h2>
                </div>
                {{-- VILLA FORM --}}
                <div id="villa" style="display: none">
                    <h3>Please fill out the form below</h3>

                    <form action="{{ route('admin_villa_store') }}" method="POST" enctype="multipart/form-data" id="villa-form" class="js-validation">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1">
                                <input type="text"
                                    class="form-control adminlisting-font"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Name" required maxlength="100">
                                <i class="flaticon-user"></i>
                                @error('name')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1">
                                <input type="text"
                                    class="form-control adminlisting-font"
                                    id="short_description" name="short_description" value="{{ old('short_description') }}"
                                    placeholder="Short Description" maxlength="255" required>
                                <i class="flaticon-user"></i>
                                @error('short_description')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <label for="id_location" class="form-label" style="font-size: 15px; color: grey; margin-top: 5%;">Property Type</label>
                                </div>
                                <div class="col-lg-9">
                                    <select class="js-select2 form-select" id="property_type" name="property_type" style="width: 100%;" required>
                                            <option value="default">select property type</option>
                                        @foreach ($propertyTypes as $item)
                                            <option value="{{ $item->id_property_type }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_location')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1 row">
                                <div class="col">
                                    <input type="number"
                                        class="form-control adminlisting-font"
                                        id="adult" name="adult" value="{{ old('adult') }}"
                                        placeholder="Adult" min="1" required>
                                    <i class="flaticon-user"></i>
                                    @error('adult')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="number"
                                        class="form-control adminlisting-font"
                                        id="children" name="children" value="{{ old('children') }}"
                                        placeholder="Children" min="1" required>
                                    <i class="flaticon-user"></i>
                                    @error('children')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1 row">
                                <div class="col">
                                    <input type="number"
                                        class="form-control adminlisting-font"
                                        id="bedroom" name="bedroom" value="{{ old('bedroom') }}"
                                        placeholder="Bedroom" min="1" required>
                                    <i class="flaticon-user"></i>
                                    @error('bedroom')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="number"
                                        class="form-control adminlisting-font"
                                        id="bathroom" name="bathroom" value="{{ old('bathroom') }}"
                                        placeholder="Bathroom" min="1" required>
                                    <i class="flaticon-user"></i>
                                    @error('bathroom')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <label for="id_location" class="form-label" style="font-size: 15px; color: grey; margin-top: 5%;">Villa Location</label>
                                </div>
                                <div class="col-lg-9">
                                    <select class="js-select2 form-select" id="id_location" name="id_location" style="width: 100%;" required>
                                            <option value="default">select location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id_location }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_location')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <input id="searchTextFieldVilla" name="searchTextFieldVilla" type="text" class="form-control adminlisting-font mb-3" size="50" placeholder="Enter a Location" onkeydown="preventPressEnterKey(event)">
                                    <div id="mapVilla" style="width:100%;height:280px; border-radius: 7px;"></div>
                                    <input type="hidden" class="form-control" id="latitudeVilla" name="latitude" placeholder="Enter a latitude.." required>
                                    <input type="hidden" class="form-control" id="longitudeVilla" name="longitude" placeholder="Enter a longitude.." required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1 row">
                                <div class="col">
                                    <input type="text"
                                        class="form-control adminlisting-font"
                                        id="phone" name="phone" value="{{ old('phone') }}"
                                        placeholder="Phone" maxlength="50" required>
                                    <i class="flaticon-user"></i>
                                    @error('phone')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="email"
                                        class="form-control adminlisting-font"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Email" maxlength="100" required>
                                    <i class="flaticon-user"></i>
                                    @error('email')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="file-upload" id="file-upload1">
                                <div class="image-box dropzone">
                                        <p class="dropzone-span">Upload Image</p>
                                        <img style="width: 100%" src="" alt="">
                                </div>
                                <div class="controls" style="display: none">
                                    <input type="file" id="image" name="image" accept=".jpg,.png,.jpeg" required/>
                                </div>
                            </div>
                            @error('image')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" form="villa-form">save</button>
                        </div>
                    </form>
                </div>
                {{-- END VILLA FORM --}}
                {{-- HOTEL FORM --}}
                <div id="hotel" style="display: none">
                    <span>hotel</span>
                </div>
                {{-- END HOTEL FORM --}}
                {{-- RESTAURANT FORM --}}
                <div id="restaurant" style="display: none">
                    <h3>Please fill out the form below</h3>
                    <form action="{{ route('admin_restaurant_store') }}" method="POST" enctype="multipart/form-data" id="restaurant-form" class="js-validation">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1">
                                <input type="text"
                                    class="form-control adminlisting-font"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Name" maxlength="100" required>
                                <i class="flaticon-user"></i>
                                @error('name')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1">
                                <input type="text"
                                    class="form-control adminlisting-font"
                                    id="short_description" name="short_description" value="{{ old('short_description') }}"
                                    placeholder="Short Description" maxlength="255" required>
                                <i class="flaticon-user"></i>
                                @error('short_description')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label for="id_price" class="form-label" style="font-size: 15px; color: grey; margin-top: 5%;">Rate Of Price</label>
                                </div>
                                <div class="col-lg-8">
                                    <select class="js-select2 form-select" id="id_price" name="id_price" style="width: 100%;" required>
                                        <option value="default">select rate of price</option>
                                        @forelse ($restaurantPrices as $price)
                                            <option value="{{ $price->id_price }}">{{ $price->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('id_price')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label for="id_type" class="form-label" style="font-size: 15px; color: grey; margin-top: 5%;">Restaurant Type</label>
                                </div>
                                <div class="col-lg-8">
                                    <select class="js-select2 form-select" id="id_type" name="id_type" style="width: 100%;" required>
                                        <option value="default">select restaurant type</option>
                                        @forelse ($restaurantTypes as $type)
                                            <option value="{{ $type->id_type }}">{{ $type->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('id_type')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label for="id_location" class="form-label" style="font-size: 15px; color: grey; margin-top: 5%;">Location</label>
                                </div>
                                <div class="col-lg-8">
                                    <select class="js-select2 form-select" id="id_location" name="id_location" style="width: 100%;" required>
                                            <option value="default">select location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id_location }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_location')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <input type="text" id="searchTextFieldRestaurant" name="searchTextFieldRestaurant" class="form-control mb-3 adminlisting-font" size="50" placeholder="Enter a Location" onkeydown="preventPressEnterKey(event)">
                                    <div id="mapRestaurant" style="width:100%;height:280px; border-radius:7px;"></div>
                                    <input type="hidden" class="form-control" id="latitudeRestaurant" name="latitude" placeholder="Enter a latitude.." required>
                                    <input type="hidden" class="form-control" id="longitudeRestaurant" name="longitude" placeholder="Enter a longitude.." required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1 row">
                                <div class="col">
                                    <input type="text"
                                        class="form-control adminlisting-font"
                                        id="phone" name="phone" value="{{ old('phone') }}"
                                        placeholder="Phone" maxlength="20" required>
                                    <i class="flaticon-user"></i>
                                    @error('phone')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="email"
                                        class="form-control adminlisting-font"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Email" maxlength="50" required>
                                    <i class="flaticon-user"></i>
                                    @error('email')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1 row">
                                <div class="col">
                                    <input class="opentime form-control adminlisting-font" type="time"
                                        id="open_time" name="open_time" value="{{ old('open_time') }}"
                                        placeholder="open_time" required>
                                    <i class="flaticon-user"></i>
                                    @error('open_time')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input class="closetime form-control adminlisting-font" type="time"
                                        id="closed_time" name="closed_time" value="{{ old('closed_time') }}"
                                        placeholder="closed_time" required>
                                    <i class="flaticon-user"></i>
                                    @error('closed_time')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="file-upload" id="file-upload1">
                                <div class="image-box dropzone">
                                <p class="dropzone-span">Upload Image</p>
                                        <img style="width: 100%" src="" alt="">
                                </div>
                                <div class="controls" style="display: none;">
                                    <input type="file" name="image" accept=".jpg,.jpeg,.png" required/>
                                </div>
                            </div>
                            @error('image')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" form="restaurant-form">save</button>
                        </div>
                    </form>
                </div>
                {{-- END RESTAURANT FORM --}}
                {{-- ACTIVITY FORM --}}
                <div id="activity" style="display: none">
                    <h3>Please fill out the form below</h3>

                    <form action="{{ route('admin_activity_store') }}" method="POST" enctype="multipart/form-data" id="activity-form" class="js-validation">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1">
                                <input type="text"
                                    class="form-control adminlisting-font"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Name" maxlength="100" required>
                                <i class="flaticon-user"></i>
                                @error('name')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1">
                                <input type="text"
                                    class="form-control adminlisting-font"
                                    id="short_description" name="short_description" value="{{ old('short_description') }}"
                                    placeholder="short Description" maxlength="255" required>
                                <i class="flaticon-user"></i>
                                @error('short_description')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label for="id_location" class="form-label" style="font-size: 15px; color: grey; margin-top: 5%;">Activity Location</label>
                                </div>
                                <div class="col-lg-8">
                                    <select class="js-select2 form-select" id="id_location" name="id_location" style="width: 100%;" required>
                                            <option value="default">select location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id_location }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_location')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <input id="searchTextFieldActivity" name="searchTextFieldActivity" type="text" class="form-control mb-3 adminlisting-font" size="50" placeholder="Enter a Location" onkeydown="preventPressEnterKey(event)">
                                    <div id="mapActivity" style="width:100%;height:280px; border-radius: 7px;"></div>
                                    <input type="hidden" class="form-control" id="latitudeActivity" name="latitude" placeholder="Enter a latitude.." required>
                                    <input type="hidden" class="form-control" id="longitudeActivity" name="longitude" placeholder="Enter a longitude.." required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1 row">
                                <div class="col">
                                    <input type="text"
                                        class="form-control adminlisting-font"
                                        id="phone" name="phone" value="{{ old('phone') }}"
                                        placeholder="Phone" maxlength="50" required>
                                    <i class="flaticon-user"></i>
                                    @error('phone')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="email"
                                        class="form-control adminlisting-font"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Email" maxlength="100" required>
                                    <i class="flaticon-user"></i>
                                    @error('email')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="fxt-transformY-50 fxt-transition-delay-1 row">
                                <div class="col">
                                    <input class="opentime form-control adminlisting-font" type="time"
                                        id="open_time" name="open_time" value="{{ old('open_time') }}"
                                        placeholder="open_time" required>
                                    <i class="flaticon-user"></i>
                                    @error('open_time')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input class="closetime form-control adminlisting-font" type="time"
                                        id="closed_time" name="closed_time" value="{{ old('closed_time') }}"
                                        placeholder="closed_time" required>
                                    <i class="flaticon-user"></i>
                                    @error('closed_time')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="file-upload" id="file-upload1">
                                <div class="image-box dropzone">
                                        <p class="dropzone-span">Upload Image</p>
                                        <img style="width: 100%" src="" alt="">
                                </div>
                                <div class="controls" style="display: none;">
                                        <input type="file" name="image" accept=".jpg,.jpeg,.png" required/>
                                </div>
                            </div>
                            @error('image')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary" form="activity-form">save</button>
                        </div>
                    </form>
                </div>
                {{-- END ACTIVITY FORM --}}
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById("btn_villa").onclick = function() {
        document.getElementById("villa-form").submit();
    }

    function villa() {
        document.getElementById("villa").style.display = "block";
        document.getElementById("text").style.display = "none";
        document.getElementById("hotel").style.display = "none";
        document.getElementById("restaurant").style.display = "none";
        document.getElementById("activity").style.display = "none";
    }

    function hotel() {
        document.getElementById("villa").style.display = "none";
        document.getElementById("text").style.display = "none";
        document.getElementById("hotel").style.display = "block";
        document.getElementById("restaurant").style.display = "none";
        document.getElementById("activity").style.display = "none";
    }

    function restaurant() {
        document.getElementById("villa").style.display = "none";
        document.getElementById("text").style.display = "none";
        document.getElementById("hotel").style.display = "none";
        document.getElementById("restaurant").style.display = "block";
        document.getElementById("activity").style.display = "none";
    }

    function activity() {
        document.getElementById("villa").style.display = "none";
        document.getElementById("text").style.display = "none";
        document.getElementById("hotel").style.display = "none";
        document.getElementById("restaurant").style.display = "none";
        document.getElementById("activity").style.display = "block";
    }

    $('input[name=guest]').keyup(function () {
        if ($(this).val().length) {
            $('#guest_detail').show();
            $('#adult').val($('#guest').val());
        } else {
            $('#guest_detail').hide();
        }
    });

    $('#children').keyup(function () {
        var adult = $('#guest').val();
        var child = $('#children').val();
        $('#adult').val(adult - child);
    });

</script>
<!-- GOOGLE MAPS API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
</script>

{{-- Villa Map --}}
{{-- <script>
    // variabel global marker
    var marker;

    function taruhMarker(map, posisiTitik) {

        if (marker) {
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: map
            });
        }

        // isi nilai koordinat ke form
        document.getElementById("latitude").value = posisiTitik.lat();
        document.getElementById("longitude").value = posisiTitik.lng();

    }

    // fungsi initialize untuk mempersiapkan peta
    function initialize() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -8.396658,
                lng: 115.190841
            },
            zoom: 9
        });

        var input = document.getElementById('searchTextField');

        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
        });


        // even listner ketika peta diklik
        google.maps.event.addListener(map, 'click', function (event) {
            taruhMarker(this, event.latLng);
        });
    }

    // event jendela di-load
    google.maps.event.addDomListener(window, 'load', initialize);

</script> --}}
<script>
    // variabel global marker
    var marker;

    function taruhMarkerVilla(map, posisiTitik){

        if( marker ){
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
            position: posisiTitik,
            map: map
            });
        }

         // isi nilai koordinat ke form
        document.getElementById("latitudeVilla").value = posisiTitik.lat();
        document.getElementById("longitudeVilla").value = posisiTitik.lng();

    }

    // fungsi initialize untuk mempersiapkan peta
    function initializeVilla() {
        var map = new google.maps.Map(document.getElementById('mapVilla'), {
        center: {lat: -8.396658, lng: 115.190841},
        zoom: 9
        });

        var input = document.getElementById('searchTextFieldVilla');

        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            document.getElementById('latitudeVilla').value = place.geometry.location.lat();
            document.getElementById('longitudeVilla').value = place.geometry.location.lng();
        });


        // even listner ketika peta diklik
        google.maps.event.addListener(map, 'click', function(event) {
            taruhMarkerVilla(this, event.latLng);
        });
    }

    // event jendela di-load
    google.maps.event.addDomListener(window, 'load', initializeVilla);
</script>

{{-- Restaurant Map --}}
<script>
    // variabel global marker
    var marker;

    function taruhMarkerRestaurant(map, posisiTitik){

        if( marker ){
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
            position: posisiTitik,
            map: map
            });
        }

         // isi nilai koordinat ke form
        document.getElementById("latitudeRestaurant").value = posisiTitik.lat();
        document.getElementById("longitudeRestaurant").value = posisiTitik.lng();

    }

    // fungsi initialize untuk mempersiapkan peta
    function initializeRestaurant() {
        var map = new google.maps.Map(document.getElementById('mapRestaurant'), {
        center: {lat: -8.396658, lng: 115.190841},
        zoom: 9
        });

        var input = document.getElementById('searchTextFieldRestaurant');

        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            document.getElementById('latitudeRestaurant').value = place.geometry.location.lat();
            document.getElementById('longitudeRestaurant').value = place.geometry.location.lng();
        });


        // even listner ketika peta diklik
        google.maps.event.addListener(map, 'click', function(event) {
            taruhMarkerRestaurant(this, event.latLng);
        });
    }

    // event jendela di-load
    google.maps.event.addDomListener(window, 'load', initializeRestaurant);
</script>

{{-- Activity Map --}}
<script>
    // variabel global marker
    var marker;

    function taruhMarkerActivity(map, posisiTitik){

        if( marker ){
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
            position: posisiTitik,
            map: map
            });
        }

         // isi nilai koordinat ke form
        document.getElementById("latitudeActivity").value = posisiTitik.lat();
        document.getElementById("longitudeActivity").value = posisiTitik.lng();

    }

    // fungsi initialize untuk mempersiapkan peta
    function initializeActivity() {
        var map = new google.maps.Map(document.getElementById('mapActivity'), {
        center: {lat: -8.396658, lng: 115.190841},
        zoom: 9
        });

        var input = document.getElementById('searchTextFieldActivity');

        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            document.getElementById('latitudeActivity').value = place.geometry.location.lat();
            document.getElementById('longitudeActivity').value = place.geometry.location.lng();
        });


        // even listner ketika peta diklik
        google.maps.event.addListener(map, 'click', function(event) {
            taruhMarkerActivity(this, event.latLng);
        });
    }

    // event jendela di-load
    google.maps.event.addDomListener(window, 'load', initializeActivity);
</script>

{{-- image upload --}}
<script>
    $(".image-box").click(function (event) {
        var previewImg = $(this).children("img");

        $(this)
            .siblings()
            .children("input")
            .trigger("click");

        $(this)
            .siblings()
            .children("input")
            .change(function () {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var urll = e.target.result;
                    $(previewImg).attr("src", urll);
                    previewImg.parent().css("background", "transparent");
                    previewImg.show();
                    previewImg.siblings("p").hide();
                };
                reader.readAsDataURL(this.files[0]);
            });
    });

</script>

{{-- disable enter button --}}
<script>
    function preventPressEnterKey(event){
        if (event.which == '13') {
            event.preventDefault();
            // return false;
        }
    };
</script>

{{-- validation --}}
<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script>
    // custom validation for select input
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg !== value;
    }, "This field is required.");

    // villa validation
    $("#villa-form").validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules:{
            "name":{
                required:true,
                minlength:5,
                maxlength:100
            },
            "short_description":{
                required: true,
                minlength: 5,
                maxlength: 255
            },
            "property_type":{
                valueNotEquals: "default"
            },
            "adult":{
                required: true,
                min: 1
            },
            "children":{
                required: true,
                min: 1
            },
            "bedroom":{
                required: true,
                min: 1
            },
            "searchTextFieldVilla":{
                required:true,
                minlength:5,
            },
            "latitudeVilla":{
                required: true,
                number: true
            },
            "longitudeVilla":{
                required: true,
                number: true
            },
            "bathroom":{
                required: true,
                min: 1
            },
            "id_location":{
                valueNotEquals: "default"
            },
            "phone":{
                required: true,
                number: true,
                minlength: 5,
                maxlength: 15
            },
            "email":{
                required: true,
                email: true,
                minlength: 5,
                maxlength: 100
            },
            "image":{
                required:true,
                extension:"jpg|png|jpeg",
            },
        },
        messages:{
            "phone":{
                number: "Your input type must be numbers"
            },
            "image":{
                extension: "Your file type must be jpg, png or jpeg"
            },
        }
    });

    // restaurant validation
    $("#restaurant-form").validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules:{
            "name":{
                required:true,
                minlength:5,
                maxlength:100
            },
            "short_description":{
                required: true,
                minlength: 5,
                maxlength: 255
            },
            "id_price":{
                valueNotEquals: "default"
            },
            "id_type":{
                valueNotEquals: "default"
            },
            "searchTextFieldRestaurant":{
                required:true,
                minlength:5,
            },
            "latitudeRestaurant":{
                required: true,
                number: true
            },
            "longitudeRestaurant":{
                required: true,
                number: true
            },
            "id_location":{
                valueNotEquals: "default"
            },
            "phone":{
                required: true,
                number: true,
                minlength: 5,
                maxlength: 15
            },
            "email":{
                required: true,
                email: true,
                minlength: 5,
                maxlength: 50
            },
            "open_time":{
                required: true,
            },
            "closed_time ":{
                required: true,
            },
            "image":{
                required:true,
                extension:"jpg|png|jpeg",
            },
        },
        messages:{
            "phone":{
                number: "Your input type must be numbers"
            },
            "image":{
                extension: "Your file type must be jpg, png or jpeg"
            },
        }
    });

    // activity validation
    $("#activity-form").validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules:{
            "name":{
                required:true,
                minlength:5,
                maxlength:100
            },
            "short_description":{
                required: true,
                minlength: 5,
                maxlength: 255
            },
            "searchTextFieldActivity":{
                required:true,
                minlength:5,
            },
            "latitudeActivity":{
                required: true,
                number: true
            },
            "longitudeActivity":{
                required: true,
                number: true
            },
            "id_location":{
                valueNotEquals: "default"
            },
            "phone":{
                required: true,
                number: true,
                minlength: 5,
                maxlength: 15
            },
            "email":{
                required: true,
                email: true,
                minlength: 5,
                maxlength: 50
            },
            "open_time":{
                required: true,
            },
            "closed_time ":{
                required: true,
            },
            "image":{
                required:true,
                extension:"jpg|png|jpeg",
            },
        },
        messages:{
            "phone":{
                number: "Your input type must be numbers"
            },
            "image":{
                extension: "Your file type must be jpg, png or jpeg"
            },
        }
    });
</script>
@endsection
