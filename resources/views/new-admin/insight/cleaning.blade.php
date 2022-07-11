@extends('new-admin.layouts.admin_layout')

@section('title', 'Cleaning - EZV2')

<style>
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
        height: 4px;
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

    .menu-cleaning {
        display: flex;
        width: 100%;
        height: 100px;
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
                <li class="nav-item">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_reviews') }}">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_earnings') }}">Earnings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_views') }}">Views</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_superhost') }}">Superhost</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_cleaning') }}">Cleaning</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="col-12">
        <div class="cleaning pt-5 pb-5 text-dark">
            <div class="menu-cleaning">
                <div class="card" style="width: 18rem; height:8rem;">
                    <i class="fa-solid fa-gauge" style="margin-top: 10px; margin-left: 10px; font-size: 30px;"></i>
                    <div class="card-body">
                        <h5 class="card-title" style="margin-top: 30px; margin-left: 10px;"><b>Cleaning Overview</b>
                        </h5>
                    </div>
                </div>
                <div class="card" style="width: 18rem; height:8rem;">
                    <i class="fa-solid fa-book-open" style="margin-top: 10px; margin-left: 10px; font-size: 30px;"></i>
                    <div class="card-body">
                        <h5 class="card-title" style="margin-top: 30px; margin-left: 10px;"><b>Cleaning Checklists</b>
                        </h5>
                    </div>
                </div>
                <div class="card" style="width: 18rem; height:8rem;">
                    <i class="fa-solid fa-spray-can" style="margin-top: 10px; margin-left: 10px; font-size: 30px;"></i>
                    <div class="card-body">
                        <h5 class="card-title" style="margin-top: 30px; margin-left: 10px;"><b>Supplies and services</b>
                        </h5>
                    </div>
                </div>
                <div class="card" style="width: 18rem; height:8rem;">
                    <i class="fa-solid fa-box" style="margin-top: 10px; margin-left: 10px; font-size: 30px;"></i>
                    <div class="card-body">
                        <h5 class="card-title" style="margin-top: 30px; margin-left: 10px;"><b>Resources</b></h5>
                    </div>
                </div>
            </div>
            <div class="container my-5">
                <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                    <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                        <h1 class="display-4 fw-bold lh-1">Learn cleaning techniques for your home</h1>
                        <p class="lead">Learn more about the five-step cleaning process through this short video. We
                            cover the cleaning basics and show you how it’s done.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                            {{-- <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Primary</button> --}}
                            <button type="button" class="btn btn-outline-secondary btn-lg px-4 mt-3">Watch
                                Video</button>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                        <img class="rounded-lg-3 w-auto"
                            src="https://a0.muscache.com/4ea/air/v2/pictures/b2619492-a84a-4839-ab05-137a2a2b477c.jpg"
                            alt="" width="720">
                    </div>
                </div>
            </div>
            <div class="card-container d-inline-flex justify-content-between">
                <div class="col-4">
                    <div class="card p-2" style="width: 18rem;">
                        <img src="https://a0.muscache.com/4ea/air/v2/pictures/03b0680a-51a6-4969-96b0-b499a20ad294.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Explore the enhanced cleaning process</h5>
                            <p class="card-text">Visit the EZV Resource Center for detailed articles on enhanced
                                cleaning – from getting started to marketing your listing to guests.</p>
                            <a href="#" class="btn btn-primary">Go to Resource Center</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card p-2" style="width: 18rem;">
                        <img src="https://a0.muscache.com/4ea/air/v2/pictures/03b0680a-51a6-4969-96b0-b499a20ad294.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Stock up on Lysol disinfecting products or book a cleaning pro</h5>
                            <p class="card-text">EZV has worked with suppliers to get Hosts access to discounted
                                Lysol disinfecting products and more. Plus, if you need help cleaning, you can hire a
                                pro who can help follow the five-step enhanced cleaning process.</p>
                            <a href="#" class="btn btn-primary">Go to supplies and services</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection
