@extends('layouts.user.restaurant')

@section('content')
<style>
    #lightbox {
      position:fixed; /* keeps the lightbox window in the current viewport */
      top:0;
      left:0;
      width:100%;
      height:100%;
      background:url(https://assets.codepen.io/210284/overlay.png) repeat;
      text-align:center;
    }
    #lightbox p {
      text-align:right;
      color:#fff;
      margin-right:20px;
      font-size:12px;
    }
    #lightbox img {
      box-shadow:0 0 25px #111;
      max-width:940px;
    }
</style>

{{-- <div class="row items-push js-gallery img-fluid-100">
  <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
    <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="assets/media/photos/photo10@2x.jpg">
      <img class="img-fluid" src="{{ asset('') }}" alt="">
    </a>
  </div>
  <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
    <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="assets/media/photos/photo11@2x.jpg">
      <img class="img-fluid" src="assets/media/photos/photo11.jpg" alt="">
    </a>
  </div>
  <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
    <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="assets/media/photos/photo12@2x.jpg">
      <img class="img-fluid" src="assets/media/photos/photo12.jpg" alt="">
    </a>
  </div>
</div> --}}

<div class="js-gallery">
  <section class="photosGrid">
    @foreach($photo as $item)
      <a href="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant[0]->name).'/'.$item->name)}}" class="img-lightbox photosGrid__Photo"
          style="background-image: url('{{ URL::asset('/foto/restaurant/'.strtolower($restaurant[0]->name).'/'.$item->name)}}')">
      </a>
    @endforeach
  </section>
</div>

@endsection

@section('scripts')

@endsection
