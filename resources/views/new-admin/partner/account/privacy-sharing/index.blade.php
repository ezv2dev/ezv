@extends('new-admin.layouts.admin_layout')

@section('title', 'Privacy & Sharing - Account Setting - EZV2')

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
                                <li class="breadcrumb-item active" aria-current="page">Privacy & sharing</li>
                            </ol>
                        </nav>
                    </div>
                    <h1 style="font-weight:bold; color: #383838; font-size:25pt; margin-top: -20px;">
                        Privacy & sharing
                    </h1>
                </div>

                <div class="col-8 mt-3" style="margin-left: 10px;">
                    <div class="col-md-10">
                        <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <div class="row col-12" style="margin-top: 25px;">
                                <div class="col-11">
                                    <h5 class="filter-modal-row-title-secondary">
                                        <b>Share my activity on Facebook</b>
                                    </h5>
                                    <p class="modal-fiter-desc-secondary modal-margin-0">Turning this on means your
                                        activity will be shared to Facebook, which could include your username, profile
                                        photo, and locations you visited.</p>
                                </div>
                                <div class="col-1 modal-booking-checkbox">
                                    <input type="checkbox" hidden="hidden" id="" checked>
                                    <label class="switch"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <div class="row col-12" style="margin-top: 25px;">
                                <div class="col-11">
                                    <h5 class="filter-modal-row-title-secondary">
                                        <b>Include my profile and listing in search engines</b>
                                    </h5>
                                    <p class="modal-fiter-desc-secondary modal-margin-0">Turning this on means search
                                        engines, like Google, will display your profile and listing pages in search
                                        results.</p>
                                </div>
                                <div class="col-1 modal-booking-checkbox">
                                    <input type="checkbox" hidden="hidden" id="" checked>
                                    <label class="switch"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card p-4" style="width: 23rem; margin-top: 0px; margin-left: -80px;">
                        <div class="card-body">
                            <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false"
                                style="height:40px;width:40px;display:block;fill:#ff7400">
                                <path
                                    d="m17.53 9.38-.06-.06c-1.76-1.95-1.83-2.01-2.26-2.23a2.91 2.91 0 0 0 -1.11-.21 2.14 2.14 0 0 0 -1.15.31l-.14.09-.82.51-.86-.53-.11-.07a2.14 2.14 0 0 0 -1.16-.31 2.87 2.87 0 0 0 -1.1.21c-.43.22-.5.28-2.26 2.23l-1.27 1.4a4.65 4.65 0 0 1 1.05.11 4.82 4.82 0 0 1 3.63 3.78 3.96 3.96 0 0 1 3.01-.42 2.99 2.99 0 0 1 1.03.44 4.81 4.81 0 0 1 4.69-3.91c.04 0 .07.01.1.01-.47-.51-.88-.97-1.22-1.34z">
                                </path>
                                <path
                                    d="m8 14.79a.5.5 0 0 1 -.94.34 1.96 1.96 0 0 0 -.08-.18 1.87 1.87 0 0 0 -1.09-.97 1.82 1.82 0 0 0 -1.41.1 1.94 1.94 0 0 0 -.85 2.57 1.87 1.87 0 0 0 .79.83.5.5 0 1 1 -.48.88 2.87 2.87 0 0 1 -1.21-1.27 2.94 2.94 0 0 1 1.3-3.9 2.8 2.8 0 0 1 2.18-.15 2.86 2.86 0 0 1 1.67 1.48 2.79 2.79 0 0 1 .12.28zm13.39-.28a2.86 2.86 0 0 0 -1.67-1.48 2.8 2.8 0 0 0 -2.18.15 2.94 2.94 0 0 0 -1.3 3.9 2.88 2.88 0 0 0 1.21 1.27.5.5 0 0 0 .68-.2.5.5 0 0 0 -.2-.68 1.88 1.88 0 0 1 -.79-.84 1.94 1.94 0 0 1 .85-2.57 1.82 1.82 0 0 1 1.41-.1 1.87 1.87 0 0 1 1.09.97 1.96 1.96 0 0 1 .08.18.5.5 0 0 0 .94-.34 2.91 2.91 0 0 0 -.12-.28zm2.53 1.26a5.26 5.26 0 0 1 -10.49.73 2.58 2.58 0 0 0 -2.96-.01 5.47 5.47 0 0 1 -.08.46 5.34 5.34 0 0 1 -2.36 3.39 5.18 5.18 0 0 1 -3.95.68 5.38 5.38 0 0 1 -2.77-8.81.49.49 0 0 1 .09-.15c1.68-1.83 2.84-3.1 3.65-4.01 1.81-2 2.04-2.26 2.81-2.65a4.5 4.5 0 0 1 4.07.16 4.51 4.51 0 0 1 4.06-.16c.77.39 1 .65 2.81 2.65.82.91 1.97 2.18 3.65 4a .48.48 0 0 1 .06.09 5.39 5.39 0 0 1 1.41 3.62zm-11.44-7.51a2.69 2.69 0 0 0 -.51-1.35 2.7 2.7 0 0 0 -.51 1.35.5.5 0 0 0 .49.51c.01 0 .02.01.03.01s.02-.01.03-.01a.5.5 0 0 0 .49-.51zm-3.06 8.46a4.38 4.38 0 0 0 -3.25-5.23 4.24 4.24 0 0 0 -.94-.11 4.19 4.19 0 0 0 -2.25.66 4.41 4.41 0 0 0 1.32 7.99 4.18 4.18 0 0 0 3.19-.55 4.34 4.34 0 0 0 1.92-2.76zm3.98-1.38a5.31 5.31 0 0 1 5.24-4.95 5.19 5.19 0 0 1 1.04.11c-.65-.71-1.18-1.3-1.61-1.78-1.78-1.97-1.93-2.13-2.52-2.43a3.57 3.57 0 0 0 -2.83-.04 3.72 3.72 0 0 1 .76 2.01 1.5 1.5 0 0 1 -1.49 1.51c-.01 0-.02-.01-.03-.01s-.02.01-.03.01a1.5 1.5 0 0 1 -1.49-1.51 3.7 3.7 0 0 1 .74-1.99 3.57 3.57 0 0 0 -2.87.02c-.59.3-.74.45-2.52 2.43-.44.48-.98 1.08-1.63 1.8a5.16 5.16 0 0 1 2.22.01 5.36 5.36 0 0 1 4.11 4.81 3.69 3.69 0 0 1 2.9.01zm9.52.43a4.28 4.28 0 1 0 -4.28 4.38 4.34 4.34 0 0 0 4.28-4.38z"
                                    fill="#484848"></path>
                            </svg>
                            <h5 class="card-title mt-4"><b>Pick what you share</b></h5>
                            <p class="card-text">EZV cares about your privacy. Use this screen to choose how you want to
                                share your activity.</p>
                        </div>
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
