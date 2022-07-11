@extends('new-admin.layouts.admin_layout')

@section('title', 'Account Setting - EZV2')

@section('content_admin')

<div class="page-header page-header-dark">
    <div class="container text-dark">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 mt-2" style="margin-left: 20px;">
                    <h1 style="font-weight:bold; color: #383838; font-size:25pt;">
                        Account
                    </h1>
                    <span style="color: #383838;"><b>{{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}</b></span> <span>{{ Auth::user()->email }}</span> <a
                        class="text-dark" style="text-decoration: underline;" href="{{ route('profile_user') }}"><b>Go
                            to Profile</b></a>
                </div>
                <div class="col-12 mt-5 justify-content-center d-flex">
                    <div class="col-md-4">
                        <a href="{{ route('personal_info') }}" class="text-dark" style="text-decoration: none;">
                            <div class="card pb-4 shadow" style="height: 180px;">
                                <div class="card-block" style="padding: 25px;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        style="display: block; height: 32px; width: 32px; fill: currentcolor;">
                                        <path
                                            d="m29 5c1.0543618 0 1.9181651.81587779 1.9945143 1.85073766l.0054857.14926234v18c0 1.0543618-.8158778 1.9181651-1.8507377 1.9945143l-.1492623.0054857h-26c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623v-18c0-1.0543618.81587779-1.91816512 1.85073766-1.99451426l.14926234-.00548574zm0 2h-26v18h26zm-3 12v2h-8v-2zm-16-8c1.6568542 0 3 1.3431458 3 3 0 .6167852-.1861326 1.1900967-.5052911 1.6668281 1.4972342.8624949 2.5052911 2.4801112 2.5052911 4.3331719h-2c0-1.3058822-.8343774-2.4168852-1.9990993-2.8289758l-.0009007-3.1710242c0-.5522847-.4477153-1-1-1-.51283584 0-.93550716.3860402-.99327227.8833789l-.00672773.1166211.00008893 3.1706743c-1.16523883.4118113-2.00008893 1.5230736-2.00008893 2.8293257h-2c0-1.8530607 1.00805693-3.470677 2.50570706-4.3343854-.3195745-.4755179-.50570706-1.0488294-.50570706-1.6656146 0-1.6568542 1.34314575-3 3-3zm16 4v2h-8v-2zm0-4v2h-8v-2z">
                                        </path>
                                    </svg>
                                    <h4 class="card-title pt-4"><b>Personal Info</b></h4>
                                    <p class="card-subtitle text-muted p-y-1">Provide personal details and how we can
                                        reach you.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('login_security') }}" class="text-dark" style="text-decoration: none;">
                            <div class="card shadow" style="height: 180px;">
                                <div class="card-block" style="padding: 25px;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        style="display: block; height: 32px; width: 32px; fill: currentcolor;">
                                        <path
                                            d="M16 .798l.555.37C20.398 3.73 24.208 5 28 5h1v12.5C29 25.574 23.21 31 16 31S3 25.574 3 17.5V5h1c3.792 0 7.602-1.27 11.445-3.832L16 .798zm-1 3.005c-3.2 1.866-6.418 2.92-9.648 3.149L5 6.972V17.5c0 6.558 4.347 10.991 10 11.459zm2 0V28.96c5.654-.468 10-4.901 10-11.459V6.972l-.352-.02c-3.23-.23-6.448-1.282-9.647-3.148z">
                                        </path>
                                    </svg>
                                    <h4 class="card-title pt-4"><b>Login & security</b></h4>
                                    <p class="card-subtitle text-muted p-y-1">Update your password and secure your
                                        account.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('payments') }}" class="text-dark" style="text-decoration: none;">
                            <div class="card shadow" style="height: 180px;">
                                <div class="card-block" style="padding: 25px;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        style="display: block; height: 32px; width: 32px; fill: currentcolor;">
                                        <path
                                            d="M25 4a2 2 0 0 1 1.995 1.85L27 6v2h2.04c1.042 0 1.88.824 1.955 1.852L31 10v16c0 1.046-.791 1.917-1.813 1.994L29.04 28H6.96c-1.042 0-1.88-.824-1.955-1.852L5 26v-2H3a2 2 0 0 1-1.995-1.85L1 22V6a2 2 0 0 1 1.85-1.995L3 4zm2 18a2 2 0 0 1-1.85 1.995L25 24H7v2h22V10h-2zM25 6H3v16h22zm-3 12a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm-8-8a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM6 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                        </path>
                                    </svg>
                                    <h4 class="card-title pt-4"><b>Payments & payouts</b></h4>
                                    <p class="card-subtitle text-muted p-y-1">Review payments, payouts, coupons, gift
                                        cards,
                                        and taxes.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 mt-3 justify-content-center d-flex">
                    <div class="col-md-4">
                        <a href="{{ route('notification_setting') }}" class="text-dark" style="text-decoration: none;">
                            <div class="card pb-4 shadow" style="height: 180px;">
                                <div class="card-block" style="padding: 25px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        style="display: block; height: 32px; width: 32px; fill: currentcolor;">
                                        <path
                                            d="M30.82812,3.72656A2.00276,2.00276,0,0,0,28.1875,2.71143L11.78772,10H7a5.99987,5.99987,0,0,0-.25928,11.99414L11,21.99811V29h2V22.53833l15.18848,6.75073A2.0003,2.0003,0,0,0,31,27.46094V4.53857A2.01958,2.01958,0,0,0,30.82812,3.72656ZM6.81641,19.99609A4.00016,4.00016,0,0,1,7,12h4v8H7.02246ZM29,27.46094,13,20.35059V11.6499L29,4.53857Z">
                                        </path>
                                    </svg>
                                    <h4 class="card-title pt-4"><b>Notifications</b></h4>
                                    <p class="card-subtitle text-muted p-y-1">Choose notification preferences and how
                                        you want to be contacted.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    {{--
                        <div class="col-md-4">
                            <a href="{{ route('privacy_sharing') }}" class="text-dark" style="text-decoration: none;">
                    <div class="card shadow" style="height: 180px;">
                        <div class="card-block" style="padding: 25px;">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                role="presentation" focusable="false"
                                style="display: block; height: 32px; width: 32px; fill: currentcolor;">
                                <path
                                    d="m16 27a15.57488 15.57488 0 0 1 -14.51758-10.05811l-.10986-.29389.13281-.52051a15.00446 15.00446 0 0 1 28.98682-.01123l.13476.53272-.10937.293a15.57682 15.57682 0 0 1 -14.51758 10.05802zm-12.53174-10.46973a13.50587 13.50587 0 0 0 25.064-.001 13.00488 13.00488 0 0 0 -25.064.001zm12.53174 4.46973a5 5 0 1 1 5-5 5.00588 5.00588 0 0 1 -5 5zm0-8a3 3 0 1 0 3 3 3.00328 3.00328 0 0 0 -3-3z">
                                </path>
                            </svg>
                            <h4 class="card-title pt-4"><b>Privacy & sharing</b></h4>
                            <p class="card-subtitle text-muted p-y-1">Control connected apps, what you share,
                                and who sees it.</p>
                        </div>
                    </div>
                    </a>
                </div>
                --}}
                <div class="col-md-4">
                    <a href="{{ route('preferences') }}" class="text-dark" style="text-decoration: none;">
                        <div class="card shadow" style="height: 180px;">
                            <div class="card-block" style="padding: 25px;">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    role="presentation" focusable="false"
                                    style="display: block; height: 32px; width: 32px; fill: currentcolor;">
                                    <path
                                        d="m24 31a7 7 0 0 0 0-14h-16a7 7 0 0 0 0 14zm5-7a5 5 0 1 1 -5-5 5.00588 5.00588 0 0 1 5 5zm-26 0a5.00588 5.00588 0 0 1 5-5h11.11072a6.97751 6.97751 0 0 0 0 10h-11.11072a5.00588 5.00588 0 0 1 -5-5zm21-23h-16a7 7 0 0 0 0 14h16a7 7 0 0 0 0-14zm-21 7a5 5 0 1 1 5 5 5.00588 5.00588 0 0 1 -5-5zm21 5h-11.11035a6.97836 6.97836 0 0 0 0-10h11.11035a5 5 0 0 1 0 10z">
                                    </path>
                                </svg>
                                <h4 class="card-title pt-4"><b>Global preferences</b></h4>
                                <p class="card-subtitle text-muted p-y-1">Set your default language, currency, and
                                    timezone.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('referral_index') }}" class="text-dark" style="text-decoration: none;">
                        <div class="card shadow" style="height: 180px;">
                            <div class="card-block" style="padding: 25px;">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    role="presentation" focusable="false"
                                    style="display: block; height: 32px; width: 32px; fill: currentcolor;">
                                    <path
                                        d="m28 2c1.0543618 0 1.9181651.81587779 1.9945143 1.85073766l.0054857.14926234v24c0 1.0543618-.8158778 1.9181651-1.8507377 1.9945143l-.1492623.0054857h-24c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623v-24c0-1.0543618.81587779-1.91816512 1.85073766-1.99451426l.14926234-.00548574zm-14.415 15h-9.585v11h11v-9.586l-4.2928932 4.2931068-1.41421358-1.4142136zm14.415 0h-9.585l4.2921068 4.2928932-1.4142136 1.4142136-4.2928932-4.2931068v9.586h11zm-13-13h-11v11l3.53577067.0011092c-.34073717-.5885973-.53577067-1.272077-.53577067-2.0011092 0-2.209139 1.790861-4 4-4 1.0347079 0 1.9884302.35717147 2.8159632 1.1592818.2940352.2850022.6817727.8549374 1.1838896 1.7366117zm6 7c-.5327919 0-.9841014.1690165-1.4239808.5953825-.2060299.1997004-.6246872.8766948-1.2206134 1.985144l-.247741.466282-.4926648.9531915h3.385c1.0016437 0 1.8313084-.7363297 1.9772306-1.6972257l.0172837-.153512.0054857-.1492623c0-1.1045695-.8954305-2-2-2zm7-7h-11l.0007292 7.8948717c.5018346-.8810929.889386-1.4506978 1.1833076-1.7355899.827533-.80211033 1.7812553-1.1592818 2.8159632-1.1592818 2.209139 0 4 1.790861 4 4 0 .7290322-.1950335 1.4125119-.5357707 2.0011092l3.5357707-.0011092zm-17 7c-1.1045695 0-2 .8954305-2 2l.00548574.1492623c.07634914 1.0348599.94015246 1.8507377 1.99451426 1.8507377h3.385l-.4926648-.9531915-.3645522-.6822055c-.533991-.9806703-.9115076-1.5828334-1.1038022-1.7692205-.4398794-.426366-.8911889-.5953825-1.4239808-.5953825z">
                                    </path>
                                </svg>
                                <h4 class="card-title pt-4"><b>Referral credit & coupon</b></h4>
                                <p class="card-subtitle text-muted p-y-1">You have $0 referral credits and coupon.
                                    Learn more.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 mt-3 justify-content-center d-flex">
                {{--
                        <div class="col-md-4">
                            <div class="card pb-4 shadow" style="height: 180px;">
                                <div class="card-block" style="padding: 25px;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        style="display: block; height: 32px; width: 32px; fill: currentcolor;">
                                        <path
                                            d="M26 2a1 1 0 0 1 .922.612l.04.113 2 7a1 1 0 0 1-.847 1.269L28 11h-3v5h6v2h-2v13h-2l.001-2.536a3.976 3.976 0 0 1-1.73.527L25 29H7a3.982 3.982 0 0 1-2-.535V31H3V18H1v-2h5v-4a1 1 0 0 1 .883-.993L7 11h.238L6.086 8.406l1.828-.812L9.427 11H12a1 1 0 0 1 .993.883L13 12v4h10v-5h-3a1 1 0 0 1-.987-1.162l.025-.113 2-7a1 1 0 0 1 .842-.718L22 2h4zm1 16H5v7a2 2 0 0 0 1.697 1.977l.154.018L7 27h18a2 2 0 0 0 1.995-1.85L27 25v-7zm-16-5H8v3h3v-3zm14.245-9h-2.491l-1.429 5h5.349l-1.429-5z">
                                        </path>
                                    </svg>
                                    <h4 class="card-title pt-4"><b>Travel for work</b></h4>
                                    <p class="card-subtitle text-muted p-y-1">Add a work email for business trip benefits.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow" style="height: 180px;">
                                <div class="card-block" style="padding: 25px;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        style="display: block; height: 32px; width: 32px; fill: currentcolor;">
                                        <path
                                            d="m27 5h-4a2.00229 2.00229 0 0 0 -2 2v4h-4v-8a2.002 2.002 0 0 0 -2-2h-4a2.002 2.002 0 0 0 -2 2v8h-4a2.002 2.002 0 0 0 -2 2v16a2.00229 2.00229 0 0 0 2 2h22a2.0026 2.0026 0 0 0 2-2v-22a2.00229 2.00229 0 0 0 -2-2zm-18 24h-4l-.00146-16h4.00146zm6 0h-4v-16l-.00092-.00891-.00054-9.99109h4.00146zm6 0h-4v-16h4zm6 0h-4v-16l-.00073-.007-.00027-5.993h4.001z">
                                        </path>
                                    </svg>
                                    <h4 class="card-title pt-4"><b>Professional hosting tools</b></h4>
                                    <p class="card-subtitle text-muted p-y-1">Get professional tools if you manage several
                                        properties on EZV2 Villa.</p>
                                </div>
                            </div>
                        </div>
                    --}}
            </div>
            <div class="col-12 mt-5 justify-content-center text-center">
                <p>Need to deactivate your account?</p>
                <p><a href="{{ route('account-delete-form') }}" class="text-dark"
                        style="text-decoration: underline;"><b>Take care of that now</b></a></p>
            </div>
        </div>
    </div>
</div>
</div>


@include('new-admin.layouts.footer')

@endsection

@section('scripts')

@endsection
