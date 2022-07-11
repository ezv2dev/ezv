@extends('layouts.user.restaurant')

@section('content')
<section class="photosGrid">
    @foreach($video as $item)
        <video href="#" class="photosGrid__Photo" style="object-fit: cover;"
            src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant[0]->name).'/'.$item->name)}}">
        </video>
    @endforeach
</section>
@endsection