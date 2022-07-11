@extends('layouts.user.list')

@section('content')
{{-- function get data --}}
    @php
        $list = array();
        foreach($villa as $item)
        {
            array_push($list, $item->id_villa);
        }
    @endphp
{{-- function get data --}}

<div class="bg-body-black">
    <!-- Page Content -->
    <div id="div-to-refresh">
        <div class="col-lg-12 grid-container-43">
            @foreach($villa as $data)
            <input type="hidden" value="{{$data->id_villa}}" id="id_villa" name="id_villa">
            <a href="{{ route('villa', $data->id_villa) }}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="grid-image" style="display: block;" src="{{ URL::asset('/foto/gallery/'.strtolower($data->name).'/'.$data->image)}}" alt="{{ $data->name }}">
            </a>
         
            <div class="col-lg-6 grid-image-container grid-desc-container">
                <a href="{{ route('villa', $data->id_villa) }}" target="_blank" class="col-lg-6" style="position: absolute; width: 100%; left: 0%; height: 278px; top: 0px;"></a>
                <div class="">
                    <div class="col-lg-9" style="float: left;">
                        <p class="villa-list-name" style="color: #ff7400;">{{ $data->name }}</p>
                        <div class="villa-list-title"><span style="margin-right: 4px;">{{ $data->adult }} Guests</span><span>{{ $data->bedroom }} Bedroom</span><span>{{ $data->bathroom }} Bath</span><span>2 Parking</span></div>
                        <p class="villa-list-promotion"></p>
                    </div>
                    <div class="col-lg-3" style="float: left; text-align: right;">
                        <div class="villa-list-video-container">
                        <a type="button" onclick="view({{ $item->id_video }});">
                            <i class="fas fa-2x fa-play video-button"></i>
                            <video class="villa-list-video" src="{{ URL::asset('/foto/gallery/'.strtolower($data->name).'/'.$data->video)}}#t=0.1" alt="Best villa in Bali"></video>
                        </div>
                    </a>
                    </div>
                    <div class="col-lg-12 villa-list-description-container">
                        <p class="col-lg-12 villa-list-title">{{ $data->short_description }}</p>
                    </div>
                    <div class="col-lg-12 villa-list-desc-container">
                    
                    <div class="col-lg-12 villa-list-price">
                        <span style="color: #ff7400; font-size: 20px;">
                            $520 / night
                        </span>
                        <span style="color: white; font-size: 12px; margin-left: 8px;">
                            5.0 Reviews
                        </span>
                    </div>

                    <div class="villa-list-location">
                        <span style="color: white;">
                            5 minute to beach
                        </span>
                        <span style="color: #ff7400;">
                            <a><i class="fa-solid fa-location-dot margin-right-5px"></i>View Maps</a>
                        </span>
                    </div>

                    <!--
                    <p class="villa-list-location">Villa | <i class="fa-solid fa-location-dot villa-list-location-icon"></i><a
                        href="javascript.void(0)" data-bs-toggle="modal"
                        data-bs-target="#modal-map-{{$data->id_villa}}">{{ $data->location_name }}</a> | 5 minute to beach</p>
                    -->
                    
                        <!--
                    <p class="col-lg-12 villa-list-title">Rp {{ number_format($data->price, 0, ',', '.') }} / night</p>
                    <p class="villa-list-location">Villa | <i class="fa-solid fa-location-dot villa-list-location-icon"></i><a
                        href="javascript.void(0)" data-bs-toggle="modal"
                        data-bs-target="#modal-map-{{$data->id_villa}}">{{ $data->location_name }}</a> | 5 minute to beach</p>
                        -->
                    </div>
                </div>
            </div>  
            <hr style="color:#ff7400; opacity: .5 !important; border:none; margin-left: 53px; margin-right: 53px; height: 2px;">
            @endforeach 
        </div>
    </div>
</div>

    {{-- MODAL VIDEO --}}
    <div class="modal fade" id="videomodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-content video-container">
                <center>
                    <video controls id="video1" class="video-modal">
                        <source src="">
                        Your browser doesn't support HTML5 video tag.
                    </video>
                    <h5 class="video-title" id="title"></h5><br>
            </div>
            </center>
        </div>
    </div>
<!-- END Page Content -->

@endsection

@section('scripts')
<script src="{{ asset('assets/js/view-villa-extend.js') }}"></script>
{{-- Video --}}
<script>
    function view(id) {
        var list = @json($list);
        var now = list.indexOf(id);
        var next = list[now += 1];
        var prev = list[now -= 2];
        console.log(prev);
        document.getElementById('button_next').setAttribute('onclick','next_villa('+next+')');
        document.getElementById('button_prev').setAttribute('onclick','next_villa('+prev+')');
        $.ajax({
            type: "GET",
            url: "/villa-list/video/" + id,
            dataType: "JSON",
            success: function (data) {
                var video = document.getElementById('video1');
                var public = '/foto/gallery/';
                var slash = '/';
                var name = data[0].name;
                var lowerCaseName = name.toLowerCase();
                var location = data[0].location;
                var short = data[0].short;
                video.src = public + lowerCaseName + slash + data[0].video;
                video.load();
                video.play();
                $("#title").html(name);
                $('#alocation').html(location);
                $('#short').html(short);
                $('#bedrooms').html(data[0].bedroom);
                $('#bathrooms').html(data[0].bathroom);
                $('#bedss').html(data[0].beds);
                $('#id_villas').html(data[0].id_villas);
                $('#test2').append(`<?php $key = array_search('${data[0]}', $list); echo $key; ?>`)
                $('#videomodal').modal('show');
            }
        });
    }

    function next_villa(id) {
        var list = @json($list);
        var now = list.indexOf(id);
        var next = list[now += 1];
        var prev = list[now -= 2];
        document.getElementById('button_next').setAttribute('onclick','next_villa('+next+')');
        document.getElementById('button_prev').setAttribute('onclick','next_villa('+prev+')');
        $.ajax({
            type: "GET",
            url: "/villa-list/video/" + id,
            dataType: "JSON",
            success: function (data) {
                var video = document.getElementById('video1');
                var public = '/foto/gallery/';
                var slash = '/';
                var name = data[0].name;
                var lowerCaseName = name.toLowerCase();
                var location = data[0].location;
                var short = data[0].short;
                video.src = public + lowerCaseName + slash + data[0].video;
                video.load();
                video.play();
                $("#title").html(name);
                $('#alocation').html(location);
                $('#short').html(short);
                $('#bedrooms').html(data[0].bedroom);
                $('#bathrooms').html(data[0].bathroom);
                $('#bedss').html(data[0].beds);
                $('#id_villas').html(data[0].id_villas);
                $('#videomodal').modal('show');
            }
        });
    }

    $(function () {
        $('#videomodal').modal({
            show: false
        }).on('hidden.bs.modal', function () {
            $(this).find('video')[0].pause();
        });
    });

</script>
{{-- Search --}}
<script>
    $(document).ready(function () {
        $(".drop-down").hover(function () {
            $('.mega-menu').addClass('display-on');
        });
        $(".drop-down").mouseleave(function () {
            $('.mega-menu').removeClass('display-on');
        });

        $(".drop-down2").hover(function () {
            $('.mega-menu2').addClass('display-on');
        });
        $(".drop-down2").mouseleave(function () {
            $('.mega-menu2').removeClass('display-on');
        });

        $(".drop-down3").hover(function () {
            $('.mega-menu3').addClass('display-on');
        });
        $(".drop-down3").mouseleave(function () {
            $('.mega-menu3').removeClass('display-on');
        });

        $(".drop-down4").hover(function () {
            $('.mega-menu4').addClass('display-on');
        });
        $(".drop-down4").mouseleave(function () {
            $('.mega-menu4').removeClass('display-on');
        });

        $(".drop-down5").hover(function () {
            $('.mega-menu5').addClass('display-on');
        });
        $(".drop-down5").mouseleave(function () {
            $('.mega-menu5').removeClass('display-on');
        });

    });

</script>

@endsection
