@extends('new-admin.layouts.admin_layout')

@section('title', 'Payouts - EZV2')

@section('content_admin')

<div class="page-header">
    <div class="container text-dark">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 mt-2" style="margin-left: 30px;">
                    <div class="block-content">
                        <nav aria-label="breadcrumb" style="margin-left: -10px;">
                            <ol class="breadcrumb" style="background: transparent;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('account_setting') }}" style="color: #FF7400">Account</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Payments & payouts</li>
                            </ol>
                        </nav>
                    </div>
                    <h1 style="font-weight:bold; color: #383838; font-size:25pt; margin-top: -20px;">
                        Payments & payouts
                    </h1>
                </div>

                <div class="col-12">
                    <div class="col-md-7 mt-5" style="margin-left: 20px; border-bottom: 1px solid #DFDFDE;">
                        <div class="title-bar" style="margin-right: 20px; display: inline-block;">
                            <a style="text-decoration: none;" href="{{ route('payments') }}">
                                <h6>Payments</h6>
                            </a>
                        </div>
                        <div class="title-bar"
                            style="display: inline-block; border-bottom: 2px solid #FF7400; margin-right: 20px;">
                            <a style="text-decoration: none;" href="{{ route('payouts') }}">
                                <h6><b>Payouts</b></h6>
                            </a>
                        </div>
                        <div class="title-bar" style="display: inline-block; margin-right: 20px;">
                            <a style="text-decoration: none;" href="{{ route('taxes') }}">
                                <h6>Taxes</h6>
                            </a>
                        </div>
                        <div class="title-bar" style="display: inline-block; margin-right: 20px;">
                            <a style="text-decoration: none;" href="{{ route('guest-contributions') }}">
                                <h6>Guest Contributions</h6>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="col-9" style="margin-top: -50px;">
                    <div class="col-md-10 mt-5" style="margin-left: 20px;">
                        <div>
                            <h3><b>How you’ll get paid</b></h3>
                            <p>Add at least one payout method so we know where to send your money.</p>

                            <button type="button" class="btn btn-dark mt-4">Set up payouts</button>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card p-4" style="width: 23rem; margin-top: 10px; margin-left: -80px;">
                        <div class="card-body">
                            <h3 class="card-title"><b>Need help?</b></h3>
                            <h4><a href="#">When you'll get your payout</a> ></h4>
                            <h4><a href="#">How payouts work</a> ></h4>
                            <h4><a href="#">Go to your transaction history</a> ></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('new-admin.layouts.footer')
    @endsection

    @section('scripts')
    @endsection
