@extends('layouts.user.restaurant')

@section('content')

<section class="photosGrid" style="background-color:white">
    <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
        <h2 id="description">Menu</h2>
        @foreach($menu as $item)
            <table>
                <tr>
                    <td style="width:15%">
                        <a class="" href="">
                        <img class="img-fluid" style="height:125px; width:150px; border-radius:25px; object-fit: cover;" src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant[0]->name).'/menu'.'/'.$item->foto)}}" alt="">
                        </a>
                    </td>
                    <td>
                        <span style="font-size:24px; font-weight: bold;">{{ $item->name }}</span>
                        <div>
                            <p style="text-align:justify;">
                                {{ $item->description }}
                            </p>
                        </div>
                    </td>
                    <td style="width:15%; text-align:right;">
                        <span class="badge bg-success" style="font-size:16px;" >Rp. {{ number_format($item->price, 0, ',', '.') }}</span>
                    </td>
                </tr>
            </table>
            <hr>
        @endforeach
    </div>
</section>
@endsection
@section('scripts')

@endsection