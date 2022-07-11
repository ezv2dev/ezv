@extends('layouts.user.activity')

@section('content')
<section class="photosGrid">
    @foreach($video as $item)
        <video href="#" class="photosGrid__Photo" style="object-fit: cover;"
            src="{{ URL::asset('/foto/activity/'.strtolower($activity[0]->name).'/'.$item->name)}}">
        </video>
    @endforeach
</section>
@endsection