@extends('new-admin.layouts.admin_layout')

@section('title', 'Notifications - EZV2')

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
                        @if (session('success'))
                        <div class="col-10 ml-n3 justify-content-center">
                            <div class="alert alert-success alert-dismissible" role="alert" style="width: 90%;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('success') }}
                            </div>
                        </div>
                        @endif
                        @if (session('danger'))
                        <div class="col-10 ml-n3 justify-content-center">
                            <div class="alert alert-danger alert-dismissible" role="alert" style="width: 90%;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('danger') }}
                            </div>
                        </div>
                        @endif

                        <nav aria-label="breadcrumb" style="margin-left: -10px;">
                            <ol class="breadcrumb" style="background: transparent;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('account_setting') }}" style="color: #FF7400">Account</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                            </ol>
                        </nav>
                    </div>
                    <h1 style="font-weight:bold; color: #383838; font-size:25pt; margin-top: -20px;">
                        Notifications
                    </h1>
                </div>

                <div class="col-12">

                    <div class="col-md-7 mt-5" style="margin-left: 20px; border-bottom: 1px solid #DFDFDE;">
                        <div class="title-bar" style="margin-right: 20px; display: inline-block;">
                            <a style="text-decoration: none;" href="{{ route('notification_setting') }}"><h6>Offers and updates</h6></a>
                        </div>
                        <div class="title-bar" style="border-bottom: 2px solid #FF7400; display: inline-block;">
                            <a style="text-decoration: none;" href="{{ route('notification_account') }}"><h6><b>Account</b></h6></a>
                        </div>
                    </div>

                </div>

                <div class="col-12">
                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="title-hosting-insight">
                            <h3><b>Account activity and policies</b></h3>
                            <p>Confirm your booking and account activity, and learn about important EZV policies.</p>
                        </div>
                    </div>

                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="section-hosting">
                            <h5>Account activity</h5>
                            @if ($notifications->account_activity == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalAccountActivity()" class="text-dark" style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                    <div class="col-md-7 mt-4" style="margin-left: 20px;">
                        <div class="section-hosting">
                            <h5>Listing activity</h5>
                            @if ($notifications->listing_activity == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalListingActivity()" class="text-dark" style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                    <div class="col-md-7 mt-4" style="margin-left: 20px;">
                        <div class="section-hosting">
                            <h5>Guest policies</h5>
                            @if ($notifications->guest_policies == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalGuest()" class="text-dark" style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                    <div class="col-md-7 mt-4" style="margin-left: 20px;">
                        <div class="section-hosting" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <h5>Host policies</h5>
                            @if ($notifications->host_policies == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalHostPolicies()" class="text-dark" style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="title-hosting-insight">
                            <h3><b>Reminders</b></h3>
                            <p>Get important reminders about your reservations, listings, and account activity.</p>
                        </div>
                    </div>

                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="section-hosting" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <h5>Reminders</h5>
                            @if ($notifications->reminders == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalReminders()" class="text-dark" style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="title-hosting-insight">
                            <h3><b>Guest and Host messages</b></h3>
                            <p>Keep in touch with your Host or guests before and during your trip.</p>
                        </div>
                    </div>

                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="section-hosting">
                            <h5>Messages</h5>
                            @if ($notifications->messages == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalMessage()" class="text-dark" style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                </div>

                <!-- Modal Account Activity Checkbox-->
                <div class="modal fade" id="accountActivityModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Account activity</b></h5>
                                <p class="text-muted">Stay on top of your reservations, account activity, and legal info, like our Terms of Service.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form12" method="POST" action="{{ route('account-activity') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['accountActivity'])){
                                            $checked = $_GET['accountActivity'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form12').submit();" name="accountActivity[]"
                                                id="account_activity" @if($notifications->account_activity== "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="account_activity"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Account Activity Checkbox-->

                <!-- Modal Listing Activity Checkbox-->
                <div class="modal fade" id="listingActivityModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Listing activity</b></h5>
                                <p class="text-muted">Stay organized with notifications about all your bookings.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form13" method="POST" action="{{ route('listing-activity') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['listingActivity'])){
                                            $checked = $_GET['listingActivity'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form13').submit();" name="listingActivity[]"
                                                id="listing_activity" @if($notifications->listing_activity== "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="listing_activity"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Listing Activity Checkbox-->

                <!-- Modal Guest Policies Checkbox-->
                <div class="modal fade" id="guestPoliciesModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Guest policies</b></h5>
                                <p class="text-muted">Keep up to date on important info about using EZV.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form14" method="POST" action="{{ route('guest-policies') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['guestPolicies'])){
                                            $checked = $_GET['guestPolicies'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form14').submit();" name="guestPolicies[]"
                                                id="guest_policies" @if($notifications->guest_policies== "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="guest_policies"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Guest Policies Checkbox-->

                <!-- Modal Host Policies Checkbox-->
                <div class="modal fade" id="hostPoliciesModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Host policies</b></h5>
                                <p class="text-muted">Get updates about changes to EZV rules and policies, plus tax and regulatory updates.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form15" method="POST" action="{{ route('host-policies') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['hostPolicies'])){
                                            $checked = $_GET['hostPolicies'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form15').submit();" name="hostPolicies[]"
                                                id="host_policies" @if($notifications->host_policies== "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="host_policies"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Host Policies Checkbox-->


                <!-- Modal Reminders Checkbox-->
                <div class="modal fade" id="remindersModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Reminders</b></h5>
                                <p class="text-muted">Never miss important reminders about your reservations and account activity.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form16" method="POST" action="{{ route('reminders') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['reminders'])){
                                            $checked = $_GET['reminders'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form16').submit();" name="reminders[]"
                                                id="reminders" @if($notifications->reminders== "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="reminders"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Reminders Checkbox-->


                <!-- Modal Message Checkbox-->
                <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Messages</b></h5>
                                <p class="text-muted">Never miss important messages from your Hosts or guests.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form17" method="POST" action="{{ route('notification_messages') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['messages'])){
                                            $checked = $_GET['messages'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form17').submit();" name="messages[]"
                                                id="messages" @if($notifications->messages== "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="messages"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Message Checkbox-->

            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection

@section('scripts')

<script>
    function showModalUnsub()
    {
        $("#unsubModal").modal({backdrop: 'static', keyboard: false});
    }

    function showModalAccountActivity()
    {
        $("#accountActivityModal").modal({backdrop: 'static', keyboard: false});
    }

    function showModalListingActivity()
    {
        $("#listingActivityModal").modal({backdrop: 'static', keyboard: false});
    }

    function showModalGuest()
    {
        $("#guestPoliciesModal").modal({backdrop: 'static', keyboard: false});
    }

    function showModalHostPolicies()
    {
        $("#hostPoliciesModal").modal({backdrop: 'static', keyboard: false});
    }

    function showModalReminders()
    {
        $("#remindersModal").modal({backdrop: 'static', keyboard: false});
    }

    function showModalMessage()
    {
        $("#messageModal").modal({backdrop: 'static', keyboard: false});
    }
</script>

@endsection
