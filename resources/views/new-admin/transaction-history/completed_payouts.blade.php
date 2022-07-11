@extends('new-admin.layouts.admin_layout')

@section('title', 'Transaction History - EZV2')

@section('content_admin')
<div class="container mb-10">
    <div class="row mt-5">
        <div class="col-8 p-0">
            <div class="card p-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
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
                        <div class="col-11">
                            <b>Add a payout method</b>
                            <p>You'll need to set up your payouts in order to get paid.</p>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="#"><u>Learn More</u></a>
                                    <div class="btn btn-primary">Get Started</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-8 p-0">
            <h1 style="font-weight: 600;">Transaction History</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-8 mt-4" style="border-bottom: 1px solid #DFDFDE;">
            <div class="title-bar p-0" style="margin-right: 20px; display: inline-block; border-bottom: 2px solid #FF7400;">
                <a style="text-decoration: none;" href="{{ route('completed_payouts') }}">
                    <h6><b>Completed Payouts</b></h6>
                </a>
            </div>
            <div class="title-bar" style="margin-right: 20px; display: inline-block;">
                <a style="text-decoration: none;" href="{{ route('upcoming_payouts') }}">
                    <h6>Upcoming Payouts</h6>
                </a>
            </div>
            <div class="title-bar" style="margin-right: 20px; display: inline-block;">
                <a style="text-decoration: none;" href="{{ route('gross_earnings') }}">
                    <h6>Gross Earnings</h6>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 d-flex justify-content-between mt-3 p-0">
            <div class="col-6 py-0 pl-0 pr-1">
                <select class="form-control">
                    <option>All Payouts Methods</option>
                </select>
            </div>
            <div class="col-6 py-0 pl-1 pr-0">
                <select class="form-control">
                    <option>All Listings</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 d-flex justify-content-between mt-2 p-0">
            <div class="col-4 py-0 pl-0 pr-1">
                <select class="form-control">
                    <option><b>Form:</b> January</option>
                </select>
            </div>
            <div class="col-2 py-0 pl-1 pr-1">
                <select class="form-control">
                    <option>2022</option>
                </select>
            </div>
            <div class="col-4 py-0 pl-1 pr-1">
                <select class="form-control">
                    <option><b>To:</b> April</option>
                </select>
            </div>
            <div class="col-2 py-0 pl-1 pr-0">
                <select class="form-control">
                    <option>2022</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-8 mt-2 d-flex justify-content-between px-0">
            <div class="col-9 px-0 d-flex justify-content-left">
                <b>Paid Out:</b>
                <p>&nbsp; IDR 0.00</p>
            </div>
            <div class="col-3 px-0">
                <select class="form-control">
                    <option>Export CSV</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-8 px-0">
            <div class="card p-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <p>We're unable to process your payouts</p>
                            <p><span class="text-primary">Add a payout method</span> to your account to start receiving your payouts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')
@endsection

@section('script')

@endsection
