@extends('layouts.user.villa')

@section('content')

<div class="sticky-div2">
<ul class="navigationList">
    <li class="navigationItem">
        <a class="navigationItem__Button" onClick="document.getElementById('description').scrollIntoView();">
            <i aria-label="Posts" class="far fa-newspaper navigationItem__Icon svg-icon" fill="#262626" viewBox="0 0 20 20"></i>&nbsp
            <span class="navigationItem__Text">DESCRIPTION</span>
        </a>
    </li>
    <li class="navigationItem ">
        <a class="navigationItem__Button" onClick="document.getElementById('amenities').scrollIntoView();">
            <i aria-label="Posts" class="far fa-list-alt navigationItem__Icon svg-icon" fill="#262626" viewBox="0 0 20 20"></i>&nbsp
            <span class="navigationItem__Text">AMENITIES</span>
        </a>
    </li>
    <li class="navigationItem ">
        <a class="navigationItem__Button" onClick="document.getElementById('location').scrollIntoView();">
            <i aria-label="Posts" class="far fa-compass navigationItem__Icon svg-icon" fill="#262626" viewBox="0 0 20 20"></i>&nbsp
            <span class="navigationItem__Text">LOCATION</span>
        </a>
    </li>
    <li class="navigationItem">
        <a class="navigationItem__Button" onClick="document.getElementById('availability').scrollIntoView();">
            <i aria-label="Posts" class="far fa-calendar-alt navigationItem__Icon svg-icon" fill="#262626" viewBox="0 0 20 20"></i>&nbsp
            <span class="navigationItem__Text">AVAILABILITY</span>
        </a>
    </li>
    <li class="navigationItem">
        <a class="navigationItem__Button" onClick="document.getElementById('reserve').scrollIntoView();">
            <i aria-label="Posts" class="far fa-calendar-check navigationItem__Icon svg-icon" fill="#262626" viewBox="0 0 20 20"></i>&nbsp
            <span class="navigationItem__Text">RESERVE</span>
        </a>
    </li>
</ul>
</div>
<section class="photosGrid" style="background-color:white">
    <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
        <h2 id="description">About this place</h2>
        <p style="text-align: justify; padding-top:10px; padding-bottom:10px">
            {{ $villa[0]->description }}
        </p>
        <hr>
        <h2 id="amenities">What this place offers</h2>
            <h3 style="text-align: justify; padding-top:10px;">Amenities</h3>
            <div class="row">
                @foreach ($amenities as $item)
                    <div class="col-md-4">
                        <span><i class="fa fa-{{ $item->icon }}"></i> {{ $item->name }}</span>
                    </div>
                @endforeach
            </div>
            <hr>
            <h3 style="text-align: justify; padding-top:10px;">Bathroom</h3>
            <div class="row">
                @foreach ($bathroom as $item)
                    <div class="col-md-4">
                        <span><i class="fa fa-{{ $item->icon }}"></i> {{ $item->name }}</span>
                    </div>
                @endforeach
            </div>
            <hr>
            <h3 style="text-align: justify; padding-top:10px;">Bedroom</h3>
            <div class="row">
                @foreach ($bedroom as $item)
                    <div class="col-md-4">
                        <span><i class="fa fa-{{ $item->icon }}"></i> {{ $item->name }}</span>
                    </div>
                @endforeach
            </div>
            <hr>
            <h3 style="text-align: justify; padding-top:10px;">Kitchen</h3>
            <div class="row">
                @foreach ($kitchen as $item)
                    <div class="col-md-4">
                        <span><i class="fa fa-{{ $item->icon }}"></i> {{ $item->name }}</span>
                    </div>
                @endforeach
            </div>
            <hr>
            <h3 style="text-align: justify; padding-top:10px;">Safety</h3>
            <div class="row">
                @foreach ($safety as $item)
                    <div class="col-md-4">
                        <span><i class="fa fa-{{ $item->icon }}"></i> {{ $item->name }}</span>
                    </div>
                @endforeach
            </div>
            <hr>
            <h3 style="text-align: justify; padding-top:10px;">Service</h3>
            <div class="row">
                @foreach ($service as $item)
                    <div class="col-md-4">
                        <span><i class="fa fa-{{ $item->icon }}"></i> {{ $item->name }}</span>
                    </div>
                @endforeach
            </div>
        <hr>
        <h2 id="location">Location</h2>
        <input type="hidden" value="{{$villa[0]->latitude}}" name="latitude" id="latitude">
        <input type="hidden" value="{{$villa[0]->longitude}}" name="longitude" id="longitude">
        <div id="map" style="width:100%;height:380px;" class="mb-2"></div>
        <hr>
        <h2 id="availability">Availability</h2>
        <p style="text-align: justify; padding-top:10px; padding-bottom:10px">
            
        </p>
        <hr>
        <h2 id="description">Review</h2>
        {{-- <p style="text-align: justify; padding-top:10px; padding-bottom:10px"> --}}
            <table style="width:50%">
                <tbody>
                    <tr>
                        <td>Cleanliness</td>
                        <td>{{ $detail[0]->average_clean }}</td>
                        <td>Service</td>
                        <td>{{ $detail[0]->average_service }}</td>
                    </tr>
                    <tr>
                        <td>Check In</td>
                        <td>{{ $detail[0]->average_check_in }}</td>
                        <td>Location</td>
                        <td>{{ $detail[0]->average_location }}</td>
                    </tr>
                    <tr>
                        <td>Value</td>
                        <td>{{ $detail[0]->average_value }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        {{-- </p> --}}
        <hr>
        <h2 id="reserve">Reserve</h2>
            @auth
            <!-- Dynamic Table Full -->
            <form action="{{ route('villa_booking_confirm') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" id="id_villa" name="id_villa" value="{{ $villa[0]->id_villa }}">
                <div class="block-content">            
                    <span class="content-heading border-bottom mb-4 pb-2">Booking Information</span>
                    <div class="block-content font-size-sm mb-4">
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <label class="form-label" style="font-size: 18px">{{ $villa[0]->name }}</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="block-content block-content-full ribbon ribbon-success">
                                    <div class="ribbon-box">
                                        Rp. {{ number_format($villa[0]->price, 0, ',', '.') }}<span style="font-size: 12px;">/night(s)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="form-label" for="adult">Adult <span class="text-danger">*</span></label>
                                <input type="number" max="{{ $villa[0]->adult }}" class="form-control" id="adult" name="adult" placeholder="Enter a adult number..">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="child">Children <span class="text-danger">*</span></label>
                                <input type="number" max="{{ $villa[0]->children }}" class="form-control" id="child" name="child" placeholder="Enter a children number..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" id="min_stay" name="min_stay" value="{{ $villa[0]->min_stay }}">
                            <div class="col-sm-6">
                                <label class="form-label" for="check_in">Check In <span class="text-danger">*</span></label>
                                <input type="text" class="flatpickr form-control bg-white" id="check_in" name="check_in" placeholder="Y-m-d">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="check_out">Check Out <span class="text-danger">*</span></label>
                                <input type="text" class="flatpickr form-control bg-white" id="check_out" name="check_out" placeholder="Y-m-d">
                            </div>
                            <input type="hidden" id="sum_night" name="sum_night">
                        </div>
                    </div>

                    <span class="content-heading border-bottom mb-4 pb-2">Customer Information</span>
                    <div class="block-content font-size-sm">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="form-label" for="firstname">Firstname <span class="text-danger">*</span></label>
                                @if(Auth::guest())
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter a phone firstname..">
                                @else
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ Auth::user()->name }}">
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="lastname">Lastname <span class="text-danger">*</span></label>
                                @if(Auth::guest())
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter a lastname..">
                                @else
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ Auth::user()->name }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-sm-6">
                                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                @if(Auth::guest())
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter a email..">
                                @else
                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                                @if(Auth::guest())
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter a phone number..">
                                @else
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                                @endif
                                
                            </div>
                        </div>
                    </div>
            
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-check"></i> Reserve
                            </button>
                        </div>
                    </div>
                    <!-- END Submit -->
                </div>
            </form>
            <!-- END Dynamic Table Full -->
            @endauth
            @guest
            <div class="alert alert-info alert-block">
                <strong> Login or register first to make a reservation</strong><br>
                <div class="row">
                    <div class="col-md-6">
                        <a type="button" href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-user"></i> Login
                        </a>
                        <a type="button" href="{{ route('register') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-user"></i> Register
                        </a>
                    </div>
                </div>
            </div>
            @endguest
        <hr>
    </div>
</section>
@endsection
@section('scripts')

<!-- GOOGLE MAPS API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places"></script>

<script>
    $('#check_in').flatpickr({
       enableTime: false,
       dateFormat: "Y-m-d",
       minDate: "today",
       onChange: function(selectedDates, dateStr, instance) {
           $('#check_out').flatpickr({
               enableTime: false,
               dateFormat: "Y-m-d",
               minDate: new Date(dateStr).fp_incr(1),
               onChange: function(selectedDates, dateStr, instance){
                   var start = new Date($('#check_in').val());
                   var end = new Date($('#check_out').val());
                   var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                   var min_stay = $('#min_stay').val();
                   var minimum = new Date($('#check_in').val()).fp_incr(min_stay);
                   if(sum_night < min_stay)
                   {
                       alert("minimum stay is " + min_stay + " days");
                   }
               }
           }); 
       }
    });
</script>

<script>
function initialize()  {
    var latitude = document.getElementById("latitude").value;
    var longitude = document.getElementById("longitude").value;
    const myLatLng = { lat: parseFloat(latitude), lng: parseFloat(longitude) };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: myLatLng,
    });

    new google.maps.Marker({
        position: myLatLng,
        map,
    });
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>
$("#basic-form").validate({
    errorClass: "error fail-alert",
    validClass: "valid success-alert",
    rules:{
        "firstname":{
            required:!0,
            minlength:2
        },
        "lastname":{
            required:!0,
            minlength:2
        },
        "email":{
            required:!0,
            email:!0
        },
        "phone":{
            required:!0,
            minlength:5
        },
        "id_villa":{
            required:!0,
        },
        "adult":{
            required:!0,
            number: true,
            min: 1,
        },
        "child":{
            required:!0,
            number: true,
            min: 1,
        },    
        "check_in":{
            required:!0,
        },
        "check_out":{
            required:!0,
        },        
    },
    messages:{
        "firstname":{
            required:"Please enter a firstname",
            minlength:"Your input must consist of at least 2 characters"
        },
        "lastname":{
            required:"Please enter a lastname",
            minlength:"Your input must consist of at least 2 characters"
        },
        "phone":{
            required:"Please enter a villa contact",
            minlength:"Your input must consist of at least 5 characters"
        },
        "id_villa":{
            required:"Please enter a villa"
        },
        "adult":{
            required:"Please enter max number of adult",
            number: "Please enter your input as a numerical value",
            min: "You must be enter at least 1",
            max: "Input cannot exceed maximum"
        },
        "child":{
            required:"Please enter max number of children",
            number: "Please enter your input as a numerical value",
            min: "You must be enter at least 1",
            max: "Input cannot exceed maximum"
        },
        "check_in":{
            required:"Please enter a date check in"
        },
        "check_out":{
            required:"Please enter a date check out"
        },
    }
});
</script>
@endsection