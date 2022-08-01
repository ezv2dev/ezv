@extends('new-admin.layouts.admin_layout')

@section('title', 'Transaction History - EZV2')

@section('content_admin')
<style>
    .banner-information-container{
        display:flex;
        flex-direction:column;
        gap:.75rem;
    }

    @media (min-width: 768px){
        .banner-information-container{
            flex-direction:row;
        }
    }
</style>
<div class="container container-dashboard px-4">
    <div class="row mx-0 px-0">
        <div class="col-md-8 mx-0 px-0">
            <div class="pt-4 pb-3 px-4 border banner-information-container">
                <div class="w-auto">
                    <button class="btn btn-warning rounded-circle" style="width: 50px; height: 50px;">
                        <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                            style="display:block;height:16px;width:16px;fill:currentColor" aria-hidden="true"
                            role="presentation" focusable="false">
                            <path
                                d="M7.237.21c.347-.206.76-.263 1.148-.16.34.092.637.3.841.586l.082.128 6.487 11.318a1.564 1.564 0 0 1 .004 1.544 1.53 1.53 0 0 1-.554.566 1.497 1.497 0 0 1-.599.2l-.159.008H1.514c-.334 0-.659-.113-.924-.32a1.558 1.558 0 0 1-.452-1.863l.069-.135L6.692.764c.132-.23.32-.42.545-.555zM8 10.2a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm.8-6.6H7.2v5.2h1.6z">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="w-100">
                    <b>Add a payout method</b>
                    <p>You'll need to set up your payouts in order to get paid.</p>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="#"><u>Learn More</u></a>
                        <div class="btn btn-primary">Get Started</div>
                    </div>
                </div>
            </div>

            <h1 class="mt-4 mt-md-5 mb-3 px-0" style="font-weight: 600;">Transaction History</h1>

            <div class="mb-4 tab-bar px-0">
                <a class="title-bar" href="{{ route('completed_payouts') }}">Completed Payouts</a>
                <a class="title-bar active" href="{{ route('upcoming_payouts') }}">Upcoming Payouts</a>
                <a class="title-bar" href="{{ route('gross_earnings') }}">Gross Earnings</a>
            </div>

            <div class="px-0 mx-0">
                <select class="form-control">
                    <option>All Listings</option>
                </select>
            </div>

            <div class="px-0 d-flex justify-content-between align-items-center mt-4">
                <p class="m-0"><b>Pending Payouts: </b> IDR 0.00</p>
                <select class="form-control w-auto">
                    <option>Export CSV</option>
                </select>
            </div>

            <div class="mt-4 border p-4">
                <p>You do not have any upcoming payouts</p>
                <p>For the listings, and payout method currently selected</p>
            </div>
        </div>
    </div>

</div>

@include('new-admin.layouts.footer')
@endsection

@section('script')

@endsection
