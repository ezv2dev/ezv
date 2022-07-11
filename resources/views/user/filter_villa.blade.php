<!-- <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}"> -->

<div id="div-to-refresh">
    <div class="content" id="content">
        <!-- Simple Gallery -->
        @foreach($villa as $data)
        <input type="hidden" value="{{$data->id_villa}}" id="id_villa" name="id_villa">
        <div class="row">
            <div class="col-lg-4 col-md-3 col-sm-12">
                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="false"
                    data-arrows="true">
                    @php
                    $gallery = App\Http\Controllers\ViewController::gallery($data->id_villa);
                    @endphp
                    @foreach ($gallery as $item)
                    <div>
                        <a class="" href="{{ route('villa', $data->id_villa) }}" target="_blank">
                            <img class="img-fluid video-slider"
                                src="{{ URL::asset('/foto/gallery/'.strtolower($data->name).'/'.$item->photo)}}" alt="">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="description">
                            <div class="description-header">{{ $data->name }}</div>
                            <div>
                                @if($data->average > 4.5)
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                @elseif($data->average > 3.5)
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                @elseif($data->average > 2.5)
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                @elseif($data->average > 1.5)
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                @elseif($data->average > 0.5)
                                <span><i class="fa fa-star" style="color: orange; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                @else
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                <span><i class="fa fa-star" style="color: grey; font-size:10px"></i></span>
                                @endif
                            </div>
                            <div class="address">
                                <i class="fa fa-map-pin color-green"></i> {{ $data->address }} - <span><a
                                        href="https://maps.google.com/?q={{$data->latitude}},{{$data->longitude}}"
                                        target="_blank">See Map</a></span>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                <a type="button" style="font-size:10px;" class="btn btn-sm btn-outline-success"><i
                                        class="fa fa-gift" style="color: green;"></i> Promotion</a>
                            </div>
                            <div class="color-green">
                                <ul class="villa-description-list">
                                    <li><i class="fa fa-check"></i> Refundable</li>
                                    <li><i class="fa fa-check"></i> Giveback 2%</li>
                                    <li><i class="fa fa-check"></i> Breakfast</li>
                                </ul>
                            </div>
                            <hr>
                            <div class="row">
                                @php $facilities = App\Http\Controllers\ViewController::amenities($data->id_villa);
                                @endphp
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
                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-12">
                <a type="button" onclick="view({{ $data->id_villa }});">
                    <i class="fas fa-2x fa-play video-button"></i></a>
                <video class="photo" src="{{ URL::asset('/foto/gallery/'.strtolower($data->name).'/'.$data->video)}}"
                    alt=""></video>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="col-sm-11 rates-block">
            <div class="row">
                <div class="col-md-7 text-left">
                    <span class="reviews">Exelent</span><br />
                    @if($data->person != "" || $data->person != 0)
                    <span class="reviews">{{ $data->person }} Reviews</span>
                    @else
                    <span class="reviews">0 Reviews</span>
                    @endif
                </div>
                <div class="col-md-5">
                    @if($data->average != "")
                    <span class="reviews">{{ $data->average }}</span> <span><i
                            class="fa fa-star color-orange"></i></span>
                    @endif
                </div>
            </div>
            <div style="padding-top:10px">
                <span class="badge bg-success" style="font-size:16px;">form Rp.
                    {{ number_format($data->price, 0, ',', '.') }}</span><br />
                <span style="font-size:12px;">Price per night</span>
            </div>
            <div style="padding-top:10px">
                <a type="button" href="{{ route('villa', $data->id_villa) }}" class="btn btn-sm btn-primary"
                    target="_blank">Choose Villa</a>
            </div>
        </div>
    </div>
    <!-- Fade In Default Modal -->
    <div class="modal fade" id="modal-amenities-{{$data->id_villa}}" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">All Amenities</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    @php
                    $amenities = App\Http\Controllers\ViewController::amenities($data->id_villa);
                    $bathroom = App\Http\Controllers\ViewController::bathroom($data->id_villa);
                    $bedroom = App\Http\Controllers\ViewController::bedroom($data->id_villa);
                    $kitchen = App\Http\Controllers\ViewController::kitchen($data->id_villa);
                    $safety = App\Http\Controllers\ViewController::safety($data->id_villa);
                    $service = App\Http\Controllers\ViewController::service($data->id_villa);
                    echo '<div class="row">';
                        foreach($amenities as $item)
                        {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    <hr>';

                    echo '<h5>Bathroom</h5>';
                    echo '<div class="row">';
                        foreach($bathroom as $item)
                        {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    <hr>';

                    echo '<h5>Bedroom</h5>';
                    echo '<div class="row">';
                        foreach($bedroom as $item)
                        {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    <hr>';

                    echo '<h5>Kitchen</h5>';
                    echo '<div class="row">';
                        foreach($kitchen as $item)
                        {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    <hr>';

                    echo '<h5>Safety</h5>';
                    echo '<div class="row">';
                        foreach($safety as $item)
                        {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    <hr>';

                    echo '<h5>Service</h5>';
                    echo '<div class="row">';
                        foreach($service as $item)
                        {
                        echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    @endphp
                </div>
            </div>
        </div>
    </div>
    <!-- END Fade In Default Modal -->

    @endforeach
</div>
</div>
<script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>


<!-- <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script> -->

<script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>

<script>
    Dashmix.helpersOnLoad(['jq-slick']);

</script>
