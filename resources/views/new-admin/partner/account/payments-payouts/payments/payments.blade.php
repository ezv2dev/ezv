@extends('new-admin.layouts.admin_layout')

@section('title', 'Payments - EZV2')

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
                        <div class="title-bar"
                            style="margin-right: 20px; border-bottom: 2px solid #FF7400; display: inline-block;">
                            <a style="text-decoration: none;" href="{{ route('payments') }}">
                                <h6><b>Payments</b></h6>
                            </a>
                        </div>
                        <div class="title-bar" style="display: inline-block; margin-right: 20px;">
                            <a style="text-decoration: none;" href="{{ route('payouts') }}">
                                <h6>Payouts</h6>
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

                <div class="col-9">
                    <div class="col-md-9 mt-5" style="margin-left: 20px;">
                        <div>
                            <h3><b>Your Payments</b></h3>
                            <p>Keep track of all your payments and refunds.</p>

                            <button type="button" class="btn btn-dark mt-4">Manage payments</button>

                            <h3 class="mt-5"><b>Payment Methods</b></h3>
                            <p>Add a payment method using our secure payment system, then start planning your next trip.
                            </p>
                            <hr>

                            <button type="button" class="btn btn-dark mt-3">Add payment method</button>

                            <h3 class="mt-5"><b>EZV gift credit</b></h3>

                            <p>Redeem a gift card and look up your credit balance.<a href="#"><u>Terms apply</u></a></p>
                            <hr>
                            <div class="row">
                                <div class="col-10">
                                    <p>Current credit balance</p>
                                </div>
                                <div class="col-2">
                                    <p>$ 0.00</p>
                                </div>
                            </div>
                            <hr>

                            <button type="button" class="btn btn-dark mt-3">Add gift card</button>

                            <h3 class="mt-5"><b>Coupons</b></h3>
                            <p>Add a coupon and save on your next trip.</p>
                            <hr>

                            <div class="row">
                                <div class="col-10">
                                    <p>Your coupons</p>
                                </div>
                                <div class="col-2">
                                    <p>0</p>
                                </div>
                            </div>
                            <hr>

                            <button type="button" class="btn btn-dark mt-3">Add coupon</button>



                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card p-4" style="width: 23rem; margin-top: -440px; margin-left: -80px;">
                        <div class="card-body">
                            <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                role="presentation" focusable="false"
                                style="display: block; height: 48px; width: 48px; fill: rgb(255, 115, 0); stroke: currentcolor;">
                                <g>
                                    <g stroke="none">
                                        <path
                                            d="m41.999 10v24h-4.287l1.01-.6546823c.242375-.158375.3706719-.3933125.3998895-.6646172l.0064994-.1183828c.004513-1.4230639-2.4648559-3.6737529-5.4115565-1.9238459l-.1928324.1198459-5.278 3.2416823-2.2539866.0005578c.1712874-1.0118843-.1666572-1.9090959-.8837185-1.9909612l-.1084949-.0060789-19.0018-.0005177.001-22.003z"
                                            fill-opacity=".2"></path>
                                        <path
                                            d="m44 6c1.0543618 0 1.9181651.81587779 1.9945143 1.85073766l.0054857.14926234v28c0 1.0543618-.8158778 1.9181651-1.8507377 1.9945143l-.1492623.0054857h-12.446l3.079-2h9.367v-28h-40v24.0033177c-.51283584 0-.93550716.3860402-.99327227.8833788l-.00672773.1166212-.00007248 4.729076c-.55177975-.3192182-.93689844-.8944853-.9928825-1.5633277l-.00704502-.169066v-28c0-1.0543618.81587779-1.91816512 1.85073766-1.99451426l.14926234-.00548574zm-20 9c3.8659932 0 7 3.1340068 7 7s-3.1340068 7-7 7-7-3.1340068-7-7 3.1340068-7 7-7zm0 2c-2.7614237 0-5 2.2385763-5 5s2.2385763 5 5 5 5-2.2385763 5-5-2.2385763-5-5-5zm-15-5c.55228475 0 1 .4477153 1 1s-.44771525 1-1 1-1-.4477153-1-1 .44771525-1 1-1z">
                                        </path>
                                    </g>
                                    <g fill="none" stroke-width="2">
                                        <path
                                            d="m24.9998 32.0035177c1.3716282 0 1.5099129 2.8120004-.3683588 4.2183752l8.8925588-5.4635752c3.031-1.968 5.609.35 5.6043889 1.804-.0013889.321-.1293889.602-.4063889.783l-17.2344901 11.1920163c-.947203.6151103-2.110299.8011277-3.2021.5121216l-14.54130246-3.8491683c-.43862489-.1161066-.74410744-.5129735-.74410744-.9667052v-7.2302644c0-.5522848.44771525-1 1-1z">
                                        </path>
                                        <path
                                            d="m13.9998 37.0035177h8.051c1.2682235 0 2.2021119-.4127594 2.8457108-1.0010914">
                                        </path>
                                    </g>
                                </g>
                            </svg>

                            <h5 class="card-title mt-4"><b>Make all payments through EZV</b></h5>
                            <p class="card-text">Always pay and communicate through EZV to ensure you're protected under
                                our <a href="#"><u>Terms of Service</u></a>, <a href="#"><u>Payments Terms of
                                        Service</u></a>,
                                cancellation, and other safeguards. <a href="#"><u>Learn more</u></a></p>
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
