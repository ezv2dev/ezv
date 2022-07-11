@extends('layouts.user.activity')

@section('content')
<style>
html, body {
    overflow-x: hidden;
}
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
	video.photosGrid__Photo {
	width: 100%;
	}
.video-button {
	margin-left: 130px;
	position: absolute;
	margin-top: 120px;
	color: #fff;
	font-size: 14px;
	border: solid 1px #fff;
	padding: 15px;
	border-radius: 10%;
	background: #ffffff4a;
	}
.video-button:hover {
	color: #37fb00;
	border: solid 1px #37fb00;
	background: #37fb004a;
	}
@media only screen and (max-width: 480px) {
	.photosGrid__Photo {
		width: calc(31.3% - -3.5px);
		height: 30vw;
		margin-bottom: 3px;
		margin-left: 3px;
		}
	.video-button {
		margin-left: 50px;
		margin-top: 45px;
		font-size: 12px;
		padding: 8px;
		}
	.video-grid {
		 width: calc(36% - 15px)!important;
		}
	}
.section {
	scroll-margin-top: 75px;
	}
.video-container {
	position: relative;
	}
.modal-content {
	display: flex;
	flex-direction: column;
	width: 720px;
	margin: 50px auto;
	background: none;
	border: none;
	}
.video-modal {
	border-radius: 25px; 
	position: relative; 
	display: block; 
	width: 720px; 
	height: auto;
	}
.video-title {
	color: #fff;
	text-shadow: 1px 1px 1px #000;
	top: 30px;
	position: absolute;
	left: 30px;
	text-transform: uppercase;
	font-weight: 600;
	}
@media only screen and (max-width: 768px) {
	.modal-content {
		width: 100%;
		}    
	.video-modal {
		width: 100%; 
		}
	}
.video-grid {
	width: calc(25% - 15px);
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
  <section id="gallery" class="photosGrid section">
    @foreach($photo as $item)
      <a href="{{ URL::asset('/foto/activity/'.strtolower($activity[0]->name).'/'.$item->name)}}" class="img-lightbox photosGrid__Photo"
          style="background-image: url('{{ URL::asset('/foto/activity/'.strtolower($activity[0]->name).'/'.$item->name)}}')">
      </a>
    @endforeach
    @foreach($video as $item)
      <a class="video-grid" type="button" onclick="view({{ $item->id_video }});">
        <i class="fas fa-2x fa-play video-button"></i>
        <video preload href="" class="photosGrid__Photo" style="object-fit: cover;"
            src="{{ URL::asset('/foto/activity/'.strtolower($activity[0]->name).'/'.$item->name)}}">
      </a>
    @endforeach
  </section>

  <section class="photosGrid" style="background-color:white">
      <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
          <h2 id="description">About this place</h2>
          <p style="text-align: justify; padding-top:10px; padding-bottom:10px">
              {{ $activity[0]->description }}
          </p>
          <hr>
      </div>
    </section>
</div>

@endsection

@section('scripts')

@endsection