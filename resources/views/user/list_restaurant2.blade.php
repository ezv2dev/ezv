<style>
    .btn {
        font-weight: 400 !important;
        line-height: 1.5;
        padding: .175rem .75rem;
        font-size: .9rem !important;
        border-radius: .25rem;
    }

    .video-slider {
        width: 100%;
        min-height: 250px;
        max-height: 250px;
        object-fit: cover;
        border-radius: 15px;
    }

    .description {
        width: 100%;
    }

    .description-header {
        font-size: 24px;
        font-weight: 600;
    }

    .address {
        font-size: 16px;
    }

    .address span {
        font-size: 12px;
    }

    .fa-green {
        font-size: 15px;
        color: green;
        max-width: 30px;
    }

    .color-green {
        font-size: 15px;
        color: green;
    }

    .photo {
        height: 70px;
        width: 70px;
        border-radius: 100%;
        object-fit: cover;
        display: block;
        margin-left: 80px;
        margin-top: 30px;
    }

    .amenities-button {
        margin-top: 0;
    }

    @media only screen and (max-width: 480px) {
        .amenities-button {
            margin-top: 10px;
        }

        .photo {
            height: 80px;
            width: 80px;
            margin-left: 270px;
            margin-top: -65px;
        }

        .video-button {
            margin-top: -39px !important;
            margin-left: 297px !important;
        }

        .rates-block {
            text-align: center !important;
            border-left: none !important;
            margin-top: 20px !important;
        }

        .text-left {
            text-align: center !important;
            margin-top: -90px;
        }

        .btn {
            font-size: .8rem;
        }
    }

    .video-button {
        margin-left: 100px;
        position: absolute;
        margin-top: 50px;
        color: #fff;
        font-size: 12px !important;
        border: solid 1px #fff;
        padding: 8px;
        border-radius: 10%;
        background: #ffffff4a;
    }

    .video-button:hover {
        color: #37fb00;
        border: solid 1px #37fb00;
        background: #37fb004a;
    }

    .bg-body-light {
        padding-bottom: 20px;
    }

    .rates-block {
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 5px;
        text-align: right;
        border-left: solid 1px #c0c0c0;
        margin-top: 30px;
    }

    .text-left {
        text-align: left;
    }

    .reviews {
        font-size: 16px;
        color: green;
    }

    .reviews-quote {
        background-image: url("https://static.travala.com/resources/images-pc/group.svg");
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        padding: 5px 10px 15px 10px;
        display: inline-block;
    }

    .list-facilities {
        display: block;
        font-size: 14px;
        color: green;
        margin-bottom: 10px;
    }

    .review-text-list,
    .entire-text-list {
        margin-top: 10px;
        display: block;
    }

    .bg-green {
        background-color: green;
    }

    .btn-promo {
        border: solid 1px green;
        display: inline-block;
        font-size: 12px !important;
        font-weight: 600;
    }

    ol,
    ul {
        list-style: none;
    }

    nav.menu {
        background: none;
        position: relative;
        min-height: 45px;
        height: 100%;
    }

    .menu>ul>li {
        display: inline-block;
        list-style: none;
        font-size: 12px;
        line-height: 2;
    }

    .menu>ul li a {
        text-decoration: none;
        color: #3e2c2c;
        display: block;
        background: #edf0f7;
        border-radius: 15px;
        border: solid 1px #3e2c2c;
        line-height: 15px;
        padding: 6px 10px;
        font-size: 12px;
    }

    .menu>ul li a:hover {
        background: #444;
        color: #fff;
        transition-duration: 0.3s;
        -moz-transition-duration: 0.3s;
        -webkit-transition-duration: 0.3s;
    }

    .mega-menu,
    .mega-menu2,
    .mega-menu3 {
        background: none repeat scroll 0 0 #fff;
        margin-top: 0;
        position: absolute;
        width: auto;
        padding: 15px;
        display: none;
        transition-duration: 0.9s;
        z-index: 999;
        border-radius: 25px;
    }

    .display-on {
        display: block;
        transition-duration: 0.9s;
    }

    .drop-down>a:after,
    .drop-down2>a:after {
        content: '\f103';
        font-weight: 900;
        color: #3e2c2c;
        font-family: 'Font Awesome\ 5 Free';
        font-style: normal;
        margin-left: 5px;
    }

    .drop-down3>a:before {
        content: "\f1de";
        font-weight: 900;
        color: #3e2c2c;
        font-family: 'Font Awesome\ 5 Free';
        font-style: normal;
        margin-left: 5px;
    }

    .drop-down>a:hover:after,
    .drop-down2>a:hover:after,
    .drop-down3>a:hover:before {
        color: #fff;
    }

    /*Animation--*/
    .animated {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    @-webkit-keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .fadeIn {
        -webkit-animation-name: fadeIn;
        animation-name: fadeIn;
    }

    .content-bar {
        width: 100%;
        margin: 20px 50px;
        display: block;
    }

    .more {
        max-width: 150px;
    }

</style>

@extends('layouts.user.list')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content-bar content-full">
        <div class="menu">
            <ul>
                <li class="drop-down">
                    <a href="#">TYPE OF CUISINE</a>
                    <div class="mega-menu fadeIn animated">
                        <form method="post">
                            <div><input type="checkbox" name="language[]" value="C" /> EUROPE</div>
                            <div><input type="checkbox" name="language[]" value="C++" /> ASIAN</div>
                            <div><input type="checkbox" name="language[]" value="C#" /> JAPANESE</div>
                            <div><input type="checkbox" name="language[]" value="Java" /> MEXICAN</div>
                            <div><input type="checkbox" name="language[]" value="PHP" /> TRADITIONAL</div>
                            <div style="text-align: right; margin-top:20px;"><button type="button"
                                    class="btn btn-alt-secondary" style="border-radius:25px;">SEARCH</button></div>
                        </form>
                    </div>
                </li>
                <li class="drop-down2">
                    <a href="#">TYPE OF RESTAURANT</a>
                    <div class="mega-menu2 fadeIn animated">
                        <form method="post">
                            <div><input type="checkbox" name="language[]" value="C" /> FAST FOOD</div>
                            <div><input type="checkbox" name="language[]" value="C++" /> TAKE AWAY</div>
                            <div><input type="checkbox" name="language[]" value="C#" /> IN HOTEL</div>
                            <div><input type="checkbox" name="language[]" value="Java" /> WARONG</div>
                            <div><input type="checkbox" name="language[]" value="PHP" /> CAFE</div>
                            <div style="text-align: right; margin-top:20px;"><button type="button"
                                    class="btn btn-alt-secondary" style="border-radius:25px;">SEARCH</button></div>
                        </form>
                    </div>
                </li>
                <li>
                    <a href="#">BEACH FRONT</a>
                </li>
                <li>
                    <a href="#">CLUB RESTAURANT</a>
                </li>
                <li>
                    <a href="#">FREE DRINKS</a>
                </li>
                <li class="drop-down3">
                    <a href="#">&nbsp;MORE FILTERS</a>
                    <div class="mega-menu3 fadeIn animated">
                        <form action="/action_page.php">
                            <div class="row more">
                                <div class="col-lg-6 col-md-6">
                                    <label for="bedroom">ADULT:</label>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <input type="number" id="bedroom" name="bedroom" value="1" min="1" max="5"
                                        style="width: 50px;">
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label for="bed">TEEN:</label>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <input type="number" id="bed" name="bed" value="1" min="1" max="5"
                                        style="width: 50px;">
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label for="bathroom">CHILDREN:</label>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <input type="number" id="bathroom" name="bathroom" value="1" min="1" max="5"
                                        style="width: 50px;">
                                </div>
                                <div class="col-lg-12 col-md-12" style="text-align: right; margin-top:20px;"><button
                                        type="button" class="btn btn-alt-secondary"
                                        style="border-radius:25px;">SEARCH</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content" id="content">
    <!-- Simple Gallery -->
    @foreach($restaurant as $data)
    <input type="hidden" value="{{$data->id_restaurant}}" id="id_restaurant" name="id_restaurant">
    <!-- Start Edit Here -->
    <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-12">
            <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="false"
                data-arrows="true">
                @php
                $gallery = App\Http\Controllers\ViewController::restaurant_gallery($data->id_restaurant);
                @endphp
                @foreach ($gallery as $item)
                <div>
                    <a class="" href="{{ route('restaurant', $data->id_restaurant) }}" target="_blank">
                        <img class="img-fluid video-slider"
                            src="{{ URL::asset('/foto/restaurant/'.strtolower($data->name).'/'.$item->photo)}}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="description">
                        <span class="description-header">{{ $data->name }}</span>
                        <!-- Restaurant Facilitie Type -->
                        <div class="list-facilities">{{ $data->bedroom }} Chef, {{ $data->bathroom }} Waiters,
                            {{ $data->beds }} Seats</div>
                        <div class="row">
                            @php $facilities = App\Http\Controllers\ViewController::amenities($data->id_villa); @endphp
                            @if(!$facilities->isEmpty())
                            @if(count($facilities) >= 3)
                            @for($i=0; $i<=2; $i++) <div class="col-md-1 col-xs-6 fa-green">
                                <i class="fa fa-{{ $facilities[$i]->icon }}" style="color: green"></i>
                        </div>
                        @endfor
                        @else
                        @for($i=0; $i < count($facilities); $i++) <div class="col-md-1 col-xs-6 fa-green">
                            <i class="fa fa-{{ $facilities[$i]->icon }}" style="color: green"></i>
                    </div>
                    @endfor
                    @endif
                    <div class="col-md-1 col-xs-6 amenities-button">
                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#modal-amenities-{{$data->id_villa}}">
                            Amenities
                        </button>
                    </div>
                    @endif
                </div>
                <hr>
                <!-- End Restaurant Facilities Type -->
                <div class="address">
                    <i class="fa fa-map-pin color-green"></i> {{ $data->address }} - <span><a
                            href="https://maps.google.com/?q={{$data->latitude}},{{$data->longitude}}"
                            target="_blank">See Map</a></span>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <a type="button" class="btn-promo btn-sm btn-outline-success"><i class="fa fa-gift"
                            style="color: green;"></i> Promotion</a>
                </div>
                <div class="entire-text-list">Entire Restaurant in Bali</div>
                <div class="review-text-list">
                    @if($data->person != "" || $data->person != 0)
                    <span class="reviews">{{ $data->person }} Guest Reviews</span>
                    @else
                    <span class="reviews">0 Reviews</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-12">
            <a type="button" onclick="view({{ $data->id_restaurant }});">
                <i class="fas fa-2x fa-play video-button"></i></a>
            <video class="photo" src="{{ URL::asset('/foto/restaurant/'.strtolower($data->name).'/'.$data->video)}}"
                alt=""></video>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-12">
    <div class="col-sm-11 rates-block">
        <div class="reviews">Exelent
            @if($data->average != "")
            <span class="reviews-quote">{{ $data->average }}</span>
            <!-- <span><i class="fa fa-star color-orange"></i></span> -->
            @endif
        </div>
        <div style="padding-top:10px">
            <span class="badge bg-green" style="font-size:16px;">form Rp.
                {{ number_format($data->price, 0, ',', '.') }}</span><br />
            <span style="font-size:12px;">Price per night</span>
        </div>
        <div style="padding-top:10px">
            <a type="button" href="{{ route('restaurant', $data->id_restaurant) }}" class="btn btn-sm btn-primary"
                target="_blank">Choose Restaurant</a>
        </div>
    </div>
</div>
<!-- End Edit Here -->

<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-amenities-{{$data->id_restaurant}}" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">All Amenities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                {{-- @php
                    $amenities = App\Http\Controllers\ViewController::amenities($data->id_villa);
                    $bathroom = App\Http\Controllers\ViewController::bathroom($data->id_villa);
                    $bedroom = App\Http\Controllers\ViewController::bedroom($data->id_villa);
                    $kitchen = App\Http\Controllers\ViewController::kitchen($data->id_villa);
                    $safety = App\Http\Controllers\ViewController::safety($data->id_villa);
                    $service = App\Http\Controllers\ViewController::service($data->id_villa);
                    echo '<div class="row">';
                    foreach($amenities as $item)
                    {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                    }
                    echo '</div>';
                    echo '<hr>';

                    echo '<h5>Bathroom</h5>';
                    echo '<div class="row">';
                    foreach($bathroom as $item)
                    {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                    }
                    echo '</div>';
                    echo '<hr>';

                    echo '<h5>Bedroom</h5>';
                    echo '<div class="row">';
                    foreach($bedroom as $item)
                    {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                    }
                    echo '</div>';
                    echo '<hr>';

                    echo '<h5>Kitchen</h5>';
                    echo '<div class="row">';
                    foreach($kitchen as $item)
                    {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                    }
                    echo '</div>';
                    echo '<hr>';

                    echo '<h5>Safety</h5>';
                    echo '<div class="row">';
                    foreach($safety as $item)
                    {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                    }
                    echo '</div>';
                    echo '<hr>';

                    echo '<h5>Service</h5>';
                    echo '<div class="row">';
                    foreach($service as $item)
                    {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                    }
                    echo '</div>';
                @endphp --}}
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->

@endforeach
</div>
<!-- END Page Content -->
@endsection

@section('scripts')
<script>
    function view(id) {
        $.ajax({
            type: "GET",
            url: "/restaurant-list/video/" + id,
            dataType: "JSON",
            success: function (data) {
                var video = document.getElementById('video1');
                var public = '/foto/restaurant/';
                var slash = '/';
                var name = data[0].name;
                video.src = public + data[0].name + slash + data[0].video;
                video.load();
                video.play();
                $("#title").html(name);
                $('#videomodal').modal('show');
            }
        });
    }

    $("#video1").on("ended", function () {
        // $('#videomodal').modal('hide');
        $.ajax({
            type: "GET",
            url: "/restaurant/video/next",
            dataType: "JSON",
            success: function (data) {
                var video = document.getElementById('video1');
                var public = '/foto/restaurant/';
                var slash = '/';
                video.src = public + data[0].name + slash + data[0].video;
                video.load();
                video.play();
                $("#title").html(data[0].name);
                $('#videomodal').modal('show');
            }
        });
    });

    $(function () {
        $('#videomodal').modal({
            show: false
        }).on('hidden.bs.modal', function () {
            $(this).find('video')[0].pause();
        });
    });

</script>
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

    });

</script>
@endsection
