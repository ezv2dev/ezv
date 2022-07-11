@extends('new-admin.layouts.admin_layout')

@section('title', 'Guest Contributions - EZV2')

<style>
    .switch {
        display: inline-block;
        position: relative;
        width: 50px;
        height: 25px;
        border-radius: 20px;
        background: #dfd9ea;
        transition: background 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        vertical-align: middle;
        cursor: pointer;
    }

    .switch::before {
        content: '';
        position: absolute;
        top: 1px;
        left: 2px;
        width: 22px;
        height: 22px;
        background: #fafafa;
        border-radius: 50%;
        transition: left 0.28s cubic-bezier(0.4, 0, 0.2, 1), background 0.28s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .switch:active::before {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.28), 0 0 0 20px rgba(128, 128, 128, 0.1);
    }

    input:checked+.switch {
        background: #ff7400;
    }

    input:checked+.switch::before {
        left: 27px;
        background: #fff;
        font-family: "Font Awesome 5 Free";
        font-weight: 600;
        font-size: 15px;
        content: "\f00c";
        text-align: center;
    }

    input:checked+.switch:active::before {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.28), 0 0 0 20px rgba(0, 150, 136, 0.2);
    }

    .font-16 {
        font-size: 16px;
    }

    .font-14 {
        font-size: 14px;
    }

    p {
        font-family: 'Montreal Light', sans-serif !important;
        margin-top: -20px;
    }

    .orange {
        color: #FF7400;
    }

</style>

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
                        <div class="title-bar"
                            style="display: inline-block; border-bottom: 2px solid #FF7400; margin-right: 20px;">
                            <a style="text-decoration: none;" href="{{ route('guest-contributions') }}">
                                <h6><b>Guest Contributions</b></h6>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="col-9">
                    <div class="col-md-9" style="margin-left: 20px; margin-top: -80px;">
                        <div>
                            <h3><b>Guest contributions</b></h3>
                            <p>To show their appreciation for great hospitality, guests can send an optional financial
                                contribution to a host after completing a stay or an EZV Experience. You can choose to
                                automatically allow or decline future contributions from guests.</p>

                            <div class="row mt-5">
                                <div class="col-10">
                                    <p style="font-size: 20px !important;">Allow contributions</p>
                                </div>
                                <div class="col-2">
                                    <input type="checkbox" hidden="hidden" name="allow" id="allow">
                                    <label class="switch" for="allow"></label>
                                </div>
                            </div>
                            <hr>
                            <p>100% of all contributions will be deposited into your payout account, unless you have an
                                account balance. Your payout is subject to the <a href="#"><u>Payment Terms of
                                        Service.</u></a> Please note that contributions may not be tax deductible or
                                eligible for tax credits.</p>
                            <p>To learn more about guest contributions visit the <a href="#"><u>Help Center.</u></a></p>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card p-4" style="width: 23rem; margin-top: 0px; margin-left: -80px;">
                        <div class="card-body">
                            <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false"
                                style="height: 48px; width: 48px; display: block; fill: rgb(255, 115, 0);">
                                <path
                                    d="m17.102 17.642a4.353 4.353 0 01-.875.669 6.413 6.413 0 01-2.395.83 7.707 7.707 0 01-6.061-2.075.672.672 0 01-.162-.207c-.141-.324.117-.867.244-1.166a8.437 8.437 0 01 .684-1.23.598.598 0 01 .994-.13 7.892 7.892 0 005.295 2.614 8.495 8.495 0 001.365-.014 3.525 3.525 0 00 .735-.095c.596-.186.596.41.176.804zm-1.923-12.222a2 2 0 10-.001 0z">
                                </path>
                                <path
                                    d="m17.596 7.174a.5.5 0 11-.001 0zm-11.346-3.174h.75v.75a.5.5 0 001 0v-.75h.75a.5.5 0 000-1h-.75v-.75a.5.5 0 00-1 0v .75h-.75a.5.5 0 000 1zm8.187 3.26a3.18 3.18 0 002.513-5.1.5.5 0 00-.797.604 2.142 2.142 0 11-1.006-.736.5.5 0 00 .33-.944 3.138 3.138 0 00-1.04-.176 3.177 3.177 0 000 6.353zm6.609 8.079a6.215 6.215 0 01-2.371 4.453l-.018.018a6.308 6.308 0 00-.06 1.029c-.012.98-.038 1.597-.414 1.9-.587.473-3.11.624-3.76-.04-.09-.093-.192-.196-.444-1.181a9.884 9.884 0 01-1.115.021c-.178.882-.277 1.043-.391 1.16a2.764 2.764 0 01-1.788.447 3.848 3.848 0 01-1.971-.408c-.395-.317-.403-.942-.413-1.666a5.331 5.331 0 00-.046-.778 9.863 9.863 0 01-2.548-1.9 2.453 2.453 0 00-.402-.065 1.354 1.354 0 01-1.159-.566 10.044 10.044 0 01-.137-3.644 1.226 1.226 0 011.131-.718.94.94 0 00 .357-.08 12.637 12.637 0 00 .826-1.12c.266-.382.563-.808.869-1.218-1.476-2.543-1.37-2.912-1.023-3.203a4.004 4.004 0 013.744-.23 4.236 4.236 0 011.158.948c3.085-.596 6.384.188 8.117 1.947l.043.05a1.518 1.518 0 00 .39-1.211.502.502 0 01 .398-.583.496.496 0 01 .584.389 2.52 2.52 0 01-.73 2.18 6.194 6.194 0 011.173 4.069zm-.997-.07a5.3 5.3 0 00-1.574-4.122c-1.538-1.56-4.687-2.237-7.488-1.61a.501.501 0 01-.505-.182 3.42 3.42 0 00-1.047-.927 3.121 3.121 0 00-2.424.015 16.838 16.838 0 001.212 2.323.5.5 0 01-.035.56 36.1 36.1 0 00-1.045 1.447 5.468 5.468 0 01-1.143 1.413 1.782 1.782 0 01-.753.21c-.278.029-.282.038-.327.136a13.736 13.736 0 00 .117 2.776 2.265 2.265 0 01 .384.028 1.564 1.564 0 011.012.37 8.915 8.915 0 002.379 1.751.493.493 0 01 .065.04c.405.26.414.867.423 1.562a3.64 3.64 0 00 .083.945 4.884 4.884 0 002.34.012 9.564 9.564 0 00 .24-1.091.5.5 0 01 .533-.408 9.127 9.127 0 001.804-.036.43.43 0 01 .06-.003.5.5 0 01 .487.383 7.055 7.055 0 00 .341 1.202 4.952 4.952 0 002.373-.108c.024-.096.03-.741.036-1.128.01-.882.018-1.536.43-1.798a5.216 5.216 0 002.022-3.76zm-3.86-4.352a6.302 6.302 0 00-4.546-.588.5.5 0 00 .268.963 5.33 5.33 0 013.762.482.5.5 0 00 .515-.857z"
                                    fill="#484848"></path>
                            </svg>
                            <h5 class="card-title mt-4"><b>Don't want to keep a contribution?</b></h5>
                            <p class="card-text">If you’ve already received a contribution that you don’t want to keep, consider making a donation of the same amount to your charity of choice.</p>
                            <p class="card-text">Need some ideas? Here are some non-profit organizations working to help with the COVID-19 crisis:</p>
                            <ul class="mt-3 ml-n3">
                                <li><a href="#"><u>International Medical Corps</u></a></li>
                                <li><a href="#"><u>International Rescue Committee</u></a></li>
                                <li><a href="#"><u>The International Federation of Red Cross and Red Crescent Societies</u></a></li>
                            </ul>
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
