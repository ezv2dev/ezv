@extends('new-admin.layouts.admin_layout')

@section('title', 'Payouts - EZV2')

<style>
    @media only screen and (max-width: 767px) {
        .card-pay-info-container {
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
            margin-top: 1rem !important;
        }
        .card-pay-info {
            width: 100% !important;
        }
        .ml-max-md-10p {
            margin-left: 10px !important;
        }
        .ml-max-md-0p {
            margin-left: 0px !important;
        }
    }
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .card-pay-info-container {
            position: absolute !important;
            top: 200px !important;
            right: 7rem !important;
        }
    }
    @media only screen and (min-width: 768px) {
        .mb-md-3r {
            margin-bottom: 3rem !important;
        }
    }
    @media only screen and (min-width: 768px) and (max-width: 1199px) {
        .card-pay-info {
            width: 18rem !important;
        }
    }
    @media only screen and (min-width: 992px) {
        .card-pay-info-container {
            position: absolute !important;
            top: 180px !important;
            right: 7rem !important;
        }
    }
    @media only screen and (min-width: 1200px) {
        .card-pay-info-container {
            position: absolute !important;
            top: 180px !important;
            right: 7rem !important;
        }
        .card-pay-info {
            width: 23rem !important;
        }
    }
</style>

@section('content_admin')

<div class="page-header">
    <div class="container text-dark mb-md-3r">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between" style="position: relative;">
                <div class="col-12 mt-2 ml-max-md-10p" style="margin-left: 30px;">
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
                    <div class="col-md-7 mt-5 ml-max-md-0p" style="margin-left: 20px; border-bottom: 1px solid #DFDFDE;">
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

                <div class="col-12 col-md-9">
                    <div class="col-md-10 mt-5 ml-max-md-0p" style="margin-left: 20px;">
                        <div>
                            <h3><b>How you’ll get paid</b></h3>
                            <p>Add at least one payout method so we know where to send your money.</p>

                            <button type="button" class="btn btn-dark mt-4">Set up payouts</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 card-pay-info-container">
                    <div class="card p-4 card-pay-info">
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
