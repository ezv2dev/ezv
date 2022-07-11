@extends('layouts.user.villa')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">


<section class="photosGrid" style="background-color:white">
    <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
        <h2 id="description">Availabality</h2>
        <p style="text-align: justify; padding-top:10px; padding-bottom:10px">
            {{ $villa[0]->description }}
        </p>
        <hr>
    </div>
</section>
@endsection
@section('scripts')
 
@endsection