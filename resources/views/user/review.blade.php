@extends('layouts.user.villa')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
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
    background: #ffe6eb;
}

input.valid.success-alert {
    border: 2px solid #4CAF50;
    color: green;
}

input.error, textarea.error {
    font-weight: 300;
    color: red;
}
</style>

<section class="photosGrid" style="background-color:white">
    <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
        <h2 id="description">Make a Review</h2>
        <p style="text-align: justify; padding-top:10px; padding-bottom:10px">
            {{ $villa[0]->description }}
            
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
        @foreach($review as $data)
            <h4>{{ $data->name }}</h4>
            <span>{{ $data->created_at }}</span>
            <p>{{ $data->comment }}</p>
            <hr>
        @endforeach
       
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

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