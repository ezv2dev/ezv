@extends('new-admin.layouts.admin_layout')

@section('title', 'Listing Dashboard - EZV2')

@section('content_admin')
    {{-- CONTENT --}}
    <div class="container">
        <!-- Example DataTable for Dashboard Demo-->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light" style="margin-top: 103px; z-index: -1;">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                                Listing details
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                    <a class="nav-link" href="index.html">
                                        Photos
                                    </a>
                                    <a class="nav-link" href="dashboard-2.html">
                                        Listing basics
                                    </a>
                                    <a class="nav-link" href="dashboard-3.html">
                                        Amenities
                                    </a>
                                    <a class="nav-link" href="dashboard-3.html">
                                        Location
                                    </a>
                                    <a class="nav-link" href="dashboard-3.html">
                                        Property and rooms
                                    </a>
                                    <a class="nav-link" href="dashboard-3.html">
                                        Accessibility
                                    </a>
                                    <a class="nav-link" href="dashboard-3.html">
                                        Guest safety
                                    </a>
                                </nav>
                            </div>

                        </div>
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content" style="margin-top: 60px; padding-left: 210px">
                <div class="container-fluid">
                    <div class="page-header-content" class="mb-4">
                        <div class="row align-items-center justify-content-between pt-3">
                            <div class="col-auto mb-3">
                                <h1 class="page-header-title">
                                    <strong>House in Canggu</strong>
                                </h1>
                            </div>
                            <div class="col-auto mb-3 text-dark">
                                <a href="" class="mr-3">Unlisted</a>
                                <a href="" class="mr-3">Instant Book</a>
                                <a href="" class="btn btn-outline-danger">Preview Listing</a>
                            </div>
                        </div>
                    </div>
                    <div class="listing basics">
                        <h3 class="mb-4"><strong>Listing basics</strong></h3>
                        <div class="item-listing-basic" style="margin-bottom: 30px; border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <span class="lead">Listing name</span>
                            <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);"
                            onclick="#">Edit</a>
                            <p class="text-muted">Hotel in canggu</p>
                        </div>
                        <div class="item-listing-basic" style="margin-bottom: 30px; border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <span class="lead">Listing description</span>
                            <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);"
                            onclick="#">Edit</a>
                            <p class="text-muted">You'll have a great time at this comfortable place to stay.</p>
                        </div>
                        <div class="item-listing-basic" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <span class="lead">Custom Link</span>
                            <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);"
                            onclick="#">Edit</a>
                            <p class="text-muted">Not Set</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- END CONTENT --}}
@endsection

@section('scripts')

@endsection
