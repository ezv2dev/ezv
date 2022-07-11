@extends('new-admin.layouts.admin_layout')

@section('title', 'Superhost - EZV2')

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

    ul.superhost-menu {
        list-style-type: none;
        display: flex;
        outline: 1px solid #FF7400;
        width: 350px;
        justify-content: center;
        border-radius: 30px;
    }

    li.superhost-list {
        padding: 10px;
        margin-right: 10px;
    }

    li.superhost-list a {
        color: #FF7400;
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
                <li class="nav-item active">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_superhost') }}">Superhost</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_cleaning') }}">Cleaning</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="col-12">
        <div class="superhost pt-5 pb-5 text-dark">
            <ul class="superhost-menu">
                <li class="superhost-list"><a href="#">Superhost</a></li>
                <li class="superhost-list"><a href="#">Basic requirement</a></li>
            </ul>
            <div class="col-6">
                <div class="title-superhost mt-5">
                    <h3 class="mb-2" style="font-size: 20pt; color: #f55454"><strong>You didn't get Superhost status
                            this April</strong></h3>
                    <p class="text-dark mb-2">We know that this can be disappointing, but you’ll have another chance to
                        become a Superhost in July.</p>
                    <a href="#" style="text-decoration: underline; color: #141E27;"><b>Learn more about the
                            program</b></a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection
