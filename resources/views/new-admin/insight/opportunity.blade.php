@extends('new-admin.layouts.admin_layout')

@section('title', 'Opportunities - EZV2')

<style>
    .card-body {
        width: 100%;
    }

    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
        /* height: 100px; */
    }

    .active{
        font-weight: 600 !important;
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

    .card-title {
        font-size: 16px;
        font-weight: 300 !important;
    }

    .card {
        border: 0 !important;
    }

    .img-opportunities {
        border-radius: 20px;
        width: 100px;
        height: 100px;
    }

</style>

@section('content_admin')

<!-- Main page content-->
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light rounded">
        <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav mr-auto nav-insight">
                <li class="nav-item active">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard') }}">Opportunities</a>
                </li>
                <li class="nav-item">
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
    <div class="opportunity pt-5 pb-5">
        <h3>Resources for hosting now</h3>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-horizontal">
                                        <img class="img-opportunities" aria-hidden="true" alt="" elementtiming="LCP-target"
                                            src="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt9eb218e60cd5c4fd/5e79062cfb0b8254963c835c/2UV4082WB2K9.jpg?crop=65p,100p,x31p,y0&amp;width=144&amp;height=144&amp;auto=webp"
                                            data-original-uri="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt9eb218e60cd5c4fd/5e79062cfb0b8254963c835c/2UV4082WB2K9.jpg?crop=65p,100p,x31p,y0&amp;width=144&amp;height=144&amp;auto=webp"
                                            style="object-fit: cover; vertical-align: bottom;">
                                        <div class="card-body">
                                            <h4 class="card-title ml-2 mt-4">Why it's smart to offer flexible cancellations
                                                right now</h4>
                                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-horizontal">
                                        <img class="img-opportunities" aria-hidden="true" alt="" elementtiming="LCP-target"
                                            src="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt320dff26e67b0d77/5ebc656870d3551b3c6637b3/color_SUB01_prepare_1920x1080.jpg?crop=56.31p,100p,x22.98p,y0&amp;width=144&amp;height=144&amp;auto=webp"
                                            data-original-uri="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt320dff26e67b0d77/5ebc656870d3551b3c6637b3/color_SUB01_prepare_1920x1080.jpg?crop=56.31p,100p,x22.98p,y0&amp;width=144&amp;height=144&amp;auto=webp"
                                            style="object-fit: cover; vertical-align: bottom;">
                                        <div class="card-body">
                                            <h4 class="card-title ml-2 mt-4">Getting started with EZV’s cleaning protocol
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-horizontal">
                                        <img class="img-opportunities" aria-hidden="true" alt="" elementtiming="LCP-target"
                                            src="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt9dbecfa9bdb7d4a2/5f0774165d2aac609a336bf7/2UV9LO7P97QP.jpg?crop=100p,66.66p,x0,y33.33p&amp;width=144&amp;height=144&amp;auto=webp"
                                            data-original-uri="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt9dbecfa9bdb7d4a2/5f0774165d2aac609a336bf7/2UV9LO7P97QP.jpg?crop=100p,66.66p,x0,y33.33p&amp;width=144&amp;height=144&amp;auto=webp"
                                            style="object-fit: cover; vertical-align: bottom;">
                                        <div class="card-body">
                                            <h4 class="card-title ml-2 mt-4">The do's and don’ts of providing self check-in
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-horizontal">
                                        <img class="img-opportunities" aria-hidden="true" alt="" elementtiming="LCP-target"
                                            src="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt80cc33ff9a705fc5/5f07739a2c573e7f04e7cc1a/2UV408PJAI5MH.jpg?crop=66.66p,100p,x23.5p,y0&amp;width=144&amp;height=144&amp;auto=webp"
                                            data-original-uri="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt80cc33ff9a705fc5/5f07739a2c573e7f04e7cc1a/2UV408PJAI5MH.jpg?crop=66.66p,100p,x23.5p,y0&amp;width=144&amp;height=144&amp;auto=webp"
                                            style="object-fit: cover; vertical-align: bottom;">
                                        <div class="card-body">
                                            <h4 class="card-title ml-2 mt-4">What you need to know about hosting families and
                                                pets</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-horizontal">
                                        <img class="img-opportunities" aria-hidden="true" alt="" elementtiming="LCP-target"
                                            src="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt51bf8d36a542f03d/5f0772f755c7a40486617c60/2UV408P43D5YC.jpg?crop=66.66p,100p,x21.92p,y0&amp;width=144&amp;height=144&amp;auto=webp"
                                            data-original-uri="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt51bf8d36a542f03d/5f0772f755c7a40486617c60/2UV408P43D5YC.jpg?crop=66.66p,100p,x21.92p,y0&amp;width=144&amp;height=144&amp;auto=webp"
                                            style="object-fit: cover; vertical-align: bottom;">
                                        <div class="card-body">
                                            <h4 class="card-title ml-2 mt-4">How to make your space comfortable for remote
                                                workers</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-horizontal">
                                        <img class="img-opportunities" aria-hidden="true" alt="" elementtiming="LCP-target"
                                            src="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt3b9034773f581845/5ee790ce3ed6ab53e03a290e/2UV408L92Z3WU.jpg?crop=66.66p,100p,x33.33p,y0&amp;width=144&amp;height=144&amp;auto=webp"
                                            data-original-uri="https://images.contentstack.io/v3/assets/bltb428ce5d46f8efd8/blt3b9034773f581845/5ee790ce3ed6ab53e03a290e/2UV408L92Z3WU.jpg?crop=66.66p,100p,x33.33p,y0&amp;width=144&amp;height=144&amp;auto=webp"
                                            style="object-fit: cover; vertical-align: bottom;">
                                        <div class="card-body">
                                            <h4 class="card-title ml-2 mt-4">The best amenities to offer right now</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection
