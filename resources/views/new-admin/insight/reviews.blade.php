@extends('new-admin.layouts.admin_layout')

@section('title', 'Reviews - EZV2')

<style>
    .menu-rating {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .active{
        font-weight: 600 !important;
    }

    .color-black {
        color: black;
        border-bottom: 1px solid red;
    }

    .item-rating a {
        color: black;
    }

    .item-rating {
        float: left;
        padding: 8px;
        border: 1px solid #EBEBEB;
    }

    li.active a.nav-link-insight:before,
    a.nav-link-insight:hover:before {
        visibility: visible;
        -webkit-transform: scaleX(1);
        transform: scaleX(1);
    }

    ul.nav-insight {
        list-style-type: none;
    }

    a.nav-link-insight {
        position: relative;
        color: #FF7400;
        text-decoration: none;
    }

    a.nav-link-insight:visited {
        color: #FF7400;
        text-decoration: none;
    }

    a.nav-link-insight:hover {
        color: #FF7400;
        text-decoration: none;
    }

    a.nav-link-insight:before {
        content: "";
        position: absolute;
        width: 100%;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: #FF7400;
        visibility: hidden;
        -webkit-transform: scaleX(0);
        transform: scaleX(0);
        -webkit-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
    }

    li.active a:before,
    a.nav-link-insight:hover:before {
        visibility: visible;
        -webkit-transform: scaleX(1);
        transform: scaleX(1);
    }

    .card-rating {
        width: 100%;
        height: 100px;
        background: #dddddd;
        opacity: 0.3;
        /* margin-left:25px; */
        margin-top: 20px;
        display: block;
    }

    .sidebar-right-rating {
        margin-top: 80px;
    }

    .text-overal-rating {
        font-size: 13pt;
    }

</style>

@section('content_admin')

<!-- Main page content-->
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light rounded">
        <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav mr-auto nav-insight">
                <li class="nav-item">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard') }}">Opportunites</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_reviews') }}">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_earnings') }}">Earnings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_views') }}">Views</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="reviews" class="pt-5 pb-5 text-dark">
        <div class="col-12">
            <div class="col-4 float-right sidebar-right-rating">
                <div class="d-inline-flex" style="margin-top: -80px !important;">
                    <div class="col-6 mr-5">
                        <span style="font-size: 50px !important;"
                            class="overal-rating"><b>{{ number_format($avg, 1) }}</b></span> <i
                            class="text-warning fa fa-star" style="font-size: 30px !important;"></i>
                        <p class="text-overal-rating">Overall rating</p>
                    </div>
                    <div class="col-6">
                        <span style="font-size: 50px !important;" class="overal-rating"><b>{{ $count }}</b></span>
                        <p class="text-overal-rating">Total reviews</p>
                    </div>
                </div>
            </div>
            <div class="col-8 mt-n4">
                {{-- <div class="nav-rating">
                    <ul class="menu-rating">
                        <a href="" class="color-black">
                            <li class="item-rating px-3">All</li>
                        </a>
                        <a href="" class="color-black">
                            <li class="item-rating px-3">5<i class="text-warning fa fa-star"></i></li>
                        </a>
                        <a href="" class="color-black">
                            <li class="item-rating px-3">4<i class="text-warning fa fa-star"></i></li>
                        </a>
                        <a href="" class="color-black">
                            <li class="item-rating px-3">3<i class="text-warning fa fa-star"></i></li>
                        </a>
                        <a href="" class="color-black">
                            <li class="item-rating px-3">2<i class="text-warning fa fa-star"></i></li>
                        </a>
                        <a href="" class="color-black">
                            <li class="item-rating px-3">1<i class="text-warning fa fa-star"></i></li>
                        </a>
                    </ul>
                </div> --}}

                @forelse ($createdBy as $item)
                <div class="card p-4 mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 d-flex">
                                <img style="max-width: 15% !important;" class="img-fluid" src="{{ $item->avatar }}">
                                <h5 class="mt-2 ml-2"><b>{{ $item->first_name }} {{ $item->last_name }}</b></h5>
                            </div>
                            <div class="col-7 d-flex mt-2 justify-content-end">
                                <b>{{ $item->value }}&nbsp;</b>
                                <i class="text-warning fa fa-star" style="margin-top: 3px;"></i>
                            </div>
                        </div>
                        <p class="mt-2">{{ $item->created_at->format('d/m/Y') }}</p>
                        <p class="mt-1 text-justify">{{ $item->comment }}</p>
                    </div>
                </div>

                @empty
                <div class="rating-overview">
                    <h3><b>No reviews yet</b></h3>
                    <p>Once you get your first review, it’ll appear here.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-center">
        {!! $createdBy->appends(Request::all())->links() !!}
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection
