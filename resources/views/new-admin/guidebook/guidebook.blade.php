@extends('new-admin.layouts.admin_layout')

@section('title', 'Guidebook - EZV2')

@section('content_admin')

<div class="container">
    <div class="row mt-5">
        <div class="col-8 mb-5">
            <h2 class="mb-4">Your guidebooks</h2>
            <p class="mb-3">Guidebooks are an easy way to share recommendations with guests. Take a few minutes to create one, it's a
                great way to win over travelers—Hosts with guidebooks tend to get more bookings.</p>
            <a href="#">Read our content policy</a>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-8 d-flex justify-content-left">
            <div class="card p-4 mr-4 bg-primary text-white text-bolder" style="width: 14rem; height: 18rem;">
                <div class="card-body">
                    <button class="btn btn-light rounded" style="width: 50px; height: 50px;">
                        <svg viewBox="0 0 24 24" fill="currentColor" fill-opacity="0" stroke="currentColor"
                            stroke-width="1" focusable="false" aria-label="Open menu" role="img" stroke-linecap="round"
                            stroke-linejoin="round"
                            style="height: 24px; width: 24px; display: block; overflow: visible;">
                            <g>
                                <path
                                    d="M14.191 22.59c-1.287-2.32-3.357-2.309-4.617.012l-.295.543a.661.661 0 0 1-.826.288l-2.197-.965a.684.684 0 0 1-.365-.805l.17-.545c.788-2.532-.647-4.03-3.213-3.343l-.615.164a.696.696 0 0 1-.806-.405l-.88-2.184a.692.692 0 0 1 .3-.852l.556-.308c2.319-1.285 2.307-3.354-.013-4.614l-.542-.294a.662.662 0 0 1-.288-.827l.962-2.196a.683.683 0 0 1 .805-.365l.545.17c2.532.788 4.03-.648 3.347-3.202l-.168-.628a.696.696 0 0 1 .405-.807l2.183-.88a.692.692 0 0 1 .852.3l.308.557c1.286 2.32 3.364 2.31 4.636-.012l.274-.5a.674.674 0 0 1 .841-.285l2.167.92a.68.68 0 0 1 .38.803l-.17.544c-.788 2.533.647 4.03 3.2 3.346l.629-.169a.697.697 0 0 1 .807.405l.882 2.182c.125.31 0 .686-.3.852l-.569.316c-2.313 1.283-2.3 3.359.023 4.63l.5.275a.674.674 0 0 1 .285.842l-.92 2.166a.682.682 0 0 1-.803.38l-.546-.168c-2.534-.783-4.032.652-3.342 3.213l.165.613a.695.695 0 0 1-.404.806l-2.182.882a.691.691 0 0 1-.853-.3z">
                                </path>
                                <circle cx="11.996" cy="11.996" r="4.5"></circle>
                            </g>
                        </svg>
                    </button>
                    <div class="row" style="margin-top: 130px;">
                        <div class="col-12">
                            <h5 class="text-white">{{ Auth::user()->first_name }}' Guidebook</h5>
                        </div>
                        <div class="col-12 d-flex">
                            <img class="img-fluid" style="width: 30px; height: 30px;" src="{{ Auth::user()->avatar }}">
                            <p class="mt-1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-4 mr-4 bg-primary text-white text-bolder" style="width: 14rem; height: 18rem;">
                <div class="card-body">
                    <button class="btn btn-light rounded" style="width: 50px; height: 50px;">
                        <svg viewBox="0 0 24 24" fill="currentColor" fill-opacity="0" stroke="currentColor"
                            stroke-width="1" focusable="false" aria-label="Open menu" role="img" stroke-linecap="round"
                            stroke-linejoin="round"
                            style="height: 24px; width: 24px; display: block; overflow: visible;">
                            <g>
                                <path
                                    d="M14.191 22.59c-1.287-2.32-3.357-2.309-4.617.012l-.295.543a.661.661 0 0 1-.826.288l-2.197-.965a.684.684 0 0 1-.365-.805l.17-.545c.788-2.532-.647-4.03-3.213-3.343l-.615.164a.696.696 0 0 1-.806-.405l-.88-2.184a.692.692 0 0 1 .3-.852l.556-.308c2.319-1.285 2.307-3.354-.013-4.614l-.542-.294a.662.662 0 0 1-.288-.827l.962-2.196a.683.683 0 0 1 .805-.365l.545.17c2.532.788 4.03-.648 3.347-3.202l-.168-.628a.696.696 0 0 1 .405-.807l2.183-.88a.692.692 0 0 1 .852.3l.308.557c1.286 2.32 3.364 2.31 4.636-.012l.274-.5a.674.674 0 0 1 .841-.285l2.167.92a.68.68 0 0 1 .38.803l-.17.544c-.788 2.533.647 4.03 3.2 3.346l.629-.169a.697.697 0 0 1 .807.405l.882 2.182c.125.31 0 .686-.3.852l-.569.316c-2.313 1.283-2.3 3.359.023 4.63l.5.275a.674.674 0 0 1 .285.842l-.92 2.166a.682.682 0 0 1-.803.38l-.546-.168c-2.534-.783-4.032.652-3.342 3.213l.165.613a.695.695 0 0 1-.404.806l-2.182.882a.691.691 0 0 1-.853-.3z">
                                </path>
                                <circle cx="11.996" cy="11.996" r="4.5"></circle>
                            </g>
                        </svg>
                    </button>
                    <div class="row" style="margin-top: 130px;">
                        <div class="col-12">
                            <h5 class="text-white">{{ Auth::user()->first_name }}' Guidebook</h5>
                        </div>
                        <div class="col-12 d-flex">
                            <img class="img-fluid" style="width: 30px; height: 30px;" src="{{ Auth::user()->avatar }}">
                            <p class="mt-1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-4 d-flex align-items-end"
                style="width: 14rem; background-color: rgb(0, 132, 137) !important;">
                <a href="#" class="btn btn-primary ">Create</a>
            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')
@endsection

@section('script')

@endsection
