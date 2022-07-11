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
                        <div class="title-bar"
                            style="margin-right: 20px; border-bottom: 2px solid #FF7400; display: inline-block;">
                            <a style="text-decoration: none;" href="{{ route('notification_setting') }}">
                                <h6><b>Offers and updates</b></h6>
                            </a>
                        </div>
                        <div class="title-bar" style="display: inline-block;">
                            <a style="text-decoration: none;" href="{{ route('notification_account') }}">
                                <h6>Account</h6>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="col-12">
                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="title-hosting-insight">
                            <h3><b>Hosting insights and rewards</b></h3>
                            <p>Learn about best hosting practices, and get access to exclusive hosting perks.</p>
                        </div>
                    </div>

                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="section-hosting">
                            <h5>Recognition and achievements</h5>
                            @if ($notifications->recognition_achievements == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalRecognition()" class="text-dark"
                                style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                    <div class="col-md-7 mt-4" style="margin-left: 20px;">
                        <div class="section-hosting">
                            <h5>Insights and tips</h5>
                            @if ($notifications->insights_tips == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalInsightsTips()" class="text-dark"
                                style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                    <div class="col-md-7 mt-4" style="margin-left: 20px;">
                        <div class="section-hosting">
                            <h5>Pricing trends and suggestions</h5>
                            @if ($notifications->pricing_trends_suggestions == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalPricingTrends()" class="text-dark"
                                style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                    <div class="col-md-7 mt-4" style="margin-left: 20px;">
                        <div class="section-hosting" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <h5>Hosting perks</h5>
                            @if ($notifications->hosting_perks == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalHostingPerks()" class="text-dark"
                                style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                </div>

                <div class="col-12">

                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="title-hosting-insight">
                            <h3><b>Hosting updates</b></h3>
                            <p>Get updates about programs, features, and regulations.</p>
                        </div>
                    </div>

                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="section-hosting">
                            <h5>News and updates</h5>
                            @if ($notifications->news_updates == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalNewsUpdate()" class="text-dark"
                                style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                    <div class="col-md-7 mt-4" style="margin-left: 20px;">
                        <div class="section-hosting" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <h5>Local laws and regulations</h5>
                            @if ($notifications->local_laws_regulations == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalLocalRegulation()" class="text-dark"
                                style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                </div>

                <div class="col-12">

                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="title-hosting-insight">
                            <h3><b>Travel tips and offers</b></h3>
                            <p>Inspire your next trip with personalized recommendations and special offers.</p>
                        </div>
                    </div>

                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="section-hosting">
                            <h5>Inspiration and offers</h5>
                            @if ($notifications->inspiration_offers == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalInspiration()" class="text-dark"
                                style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                    <div class="col-md-7 mt-4" style="margin-left: 20px;">
                        <div class="section-hosting" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <h5>Trip planning</h5>
                            @if ($notifications->trip_planning == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalTripPlanning()" class="text-dark"
                                style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                </div>

                <div class="col-12">

                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="title-hosting-insight">
                            <h3><b>EZV updates</b></h3>
                            <p>Stay up to date on the latest news from EZV, and let us know how we can improve.</p>
                        </div>
                    </div>

                    <div class="col-md-7 mt-5" style="margin-left: 20px;">
                        <div class="section-hosting">
                            <h5>News and programs</h5>
                            @if ($notifications->news_programs == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalNewsProgram()" class="text-dark"
                                style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                    <div class="col-md-7 mt-4" style="margin-left: 20px;">
                        <div class="section-hosting">
                            <h5>Feedback</h5>
                            @if ($notifications->feedback == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalFeedBack()" class="text-dark"
                                style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                    <div class="col-md-7 mt-4" style="margin-left: 20px;">
                        <div class="section-hosting" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <h5>Travel regulations</h5>
                            @if ($notifications->travel_regulations == "email")
                            <p class="text-muted">On: Email</p>
                            @else
                            <p class="text-muted">Not Connected</p>
                            @endif
                            <a href="javascript:void(0);" onclick="showModalTravel()" class="text-dark"
                                style="text-decoration: underline; font-size: 11pt;"><b>Edit</b></a>
                        </div>
                    </div>

                </div>

                <div class="col-12">
                    <div class="col-md-7 mt-4" style="margin-left: 20px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                onclick="showModalUnsub()">
                            <label class="form-check-label" for="flexCheckChecked">
                                Unsubscribe from all marketing emails
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Modal Travel Regulation Checkbox-->
                <div class="modal fade" id="travelModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Travel regulations</b></h5>
                                <p class="text-muted">Travel smart with updates about regulations.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form11" method="POST" action="{{ route('travel-regulations') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['travelRegulations'])){
                                            $checked = $_GET['travelRegulations'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form11').submit();" name="travelRegulations[]"
                                                id="travel_regulations" @if($notifications->travel_regulations== "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="travel_regulations"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Travel Regulation Checkbox-->

                <!-- Modal Feedback Checkbox-->
                <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Feedback</b></h5>
                                <p class="text-muted">Let us know how we're doing and how we can improve.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form10" method="POST" action="{{ route('feedback') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['feedback'])){
                                            $checked = $_GET['feedback'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form10').submit();" name="feedback[]"
                                                id="feedback" @if($notifications->feedback== "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="feedback"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Feedback Checkbox-->

                <!-- Modal News Program Checkbox-->
                <div class="modal fade" id="newsProgramModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>News and programs</b></h5>
                                <p class="text-muted">Stay in the know about brand new programs and announcements.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form9" method="POST" action="{{ route('news-programs') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['newsPrograms'])){
                                            $checked = $_GET['newsPrograms'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form9').submit();" name="newsPrograms[]"
                                                id="news_programs" @if($notifications->news_programs== "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="news_programs"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal News Program Checkbox-->

                <!-- Modal Trip Planning Checkbox-->
                <div class="modal fade" id="tripPlanningModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Trip planning</b></h5>
                                <p class="text-muted">Personalized recommendations for your trip.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form8" method="POST" action="{{ route('trip-planning') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['tripPlanning'])){
                                            $checked = $_GET['tripPlanning'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form8').submit();" name="tripPlanning[]"
                                                id="trip_planning" @if($notifications->trip_planning== "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="trip_planning"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Trip Planning Checkbox-->

                <!-- Modal Inspiration and Offer Checkbox-->
                <div class="modal fade" id="inspirationModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Inspiration and offers</b></h5>
                                <p class="text-muted">Inspiring stays, experiences, and deals.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form7" method="POST" action="{{ route('inspiration-offers') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['inspirationOffers'])){
                                            $checked = $_GET['inspirationOffers'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form7').submit();" name="inspirationOffers[]"
                                                id="inspiration_offers" @if($notifications->inspiration_offers== "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="inspiration_offers"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Inspiration and Offer Checkbox-->

                <!-- Modal Local Regulation Checkbox-->
                <div class="modal fade" id="localRegulationModal" tabindex="-1" role="dialog"
                    aria-labelledby="unsubModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Local laws and regulations</b></h5>
                                <p class="text-muted">Get updates on short-term rental laws in your area.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form6" method="POST" action="{{ route('local-laws-regulations') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['localLawsRegulations'])){
                                            $checked = $_GET['localLawsRegulations'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form6').submit();" name="localLawsRegulations[]"
                                                id="local_laws_regulations" @if($notifications->local_laws_regulations
                                            == "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="local_laws_regulations"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Local Regulation Checkbox-->

                <!-- Modal News and Update Checkbox-->
                <div class="modal fade" id="newsUpdateModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>News and updates</b></h5>
                                <p class="text-muted">Be first to know about new tools and changes to the app and our
                                    service.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form5" method="POST" action="{{ route('news-updates') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['newsUpdates'])){
                                            $checked = $_GET['newsUpdates'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form5').submit();" name="newsUpdates[]" id="news_updates"
                                                @if($notifications->news_updates == "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="news_updates"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal News and Update Checkbox-->

                <!-- Modal Hosting and Perks Checkbox-->
                <div class="modal fade" id="hostingModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Hosting perks</b></h5>
                                <p class="text-muted">Take advantage of EZV perks like discounts on partner products and
                                    special promotions.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form4" method="POST" action="{{ route('hosting-perks') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['hostingPerks'])){
                                            $checked = $_GET['hostingPerks'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form4').submit();" name="hostingPerks[]" id="hosting_perks"
                                                @if($notifications->hosting_perks == "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="hosting_perks"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Hosting and Perks Checkbox-->

                <!-- Modal Pricing and Trends Checkbox-->
                <div class="modal fade" id="pricingModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Pricing trends and suggestions</b></h5>
                                <p class="text-muted">Optimize your price with data-backed tips and insights.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form3" method="POST"
                                            action="{{ route('pricing-trends-suggestions') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['pricingTrendsSuggestions'])){
                                            $checked = $_GET['pricingTrendsSuggestions'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form3').submit();" name="pricingTrendsSuggestions[]"
                                                id="pricing_trends_suggestions"
                                                @if($notifications->pricing_trends_suggestions == "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="pricing_trends_suggestions"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Pricing and Trends Checkbox-->

                <!-- Modal Insight Checkbox-->
                <div class="modal fade" id="insightModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Insights and tips</b></h5>
                                <p class="text-muted">Reach your hosting goals with data-backed tips and insights.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form2" method="POST" action="{{ route('insights-tips') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['insightsTips'])){
                                            $checked = $_GET['insightsTips'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form2').submit();" name="insightsTips[]" id="insights_tips"
                                                @if($notifications->insights_tips == "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="insights_tips"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Insight Checkbox-->

                <!-- Modal Recognition and achievements Checkbox-->
                <div class="modal fade" id="recognitionModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">
                                <h5><b>Recognition and achievements</b></h5>
                                <p class="text-muted">Get recognized for reaching hosting milestones and Superhost
                                    status.</p>
                                <div class="row col-12" style="margin-top: 25px;">
                                    <div class="col-11">
                                        <h6 class="filter-modal-row-title-secondary">
                                            Email
                                        </h6>
                                    </div>
                                    <div class="col-1 modal-booking-checkbox">
                                        <form id="form1" method="POST" action="{{ route('recognition-achievements') }}">
                                            @csrf
                                            @php
                                            $checked = [];
                                            if(isset($_GET['recognitionAchievements'])){
                                            $checked = $_GET['recognitionAchievements'];
                                            }
                                            @endphp
                                            <input type="checkbox" hidden="hidden" value="email"
                                                onchange="$('#form1').submit();" name="recognitionAchievements[]"
                                                id="recognition_achievements"
                                                @if($notifications->recognition_achievements == "email")
                                            checked
                                            @endif>
                                            <label class="switch" for="recognition_achievements"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Recognition and achievements Checkbox-->

                <!-- Modal Unsubscribe Checkbox-->
                <div class="modal fade" id="unsubModal" tabindex="-1" role="dialog" aria-labelledby="unsubModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalCenterTitle"><b>Are you sure ?</b></h6>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body" style="font-size: 11pt;">You’ll be unsubscribing from all marketing
                                emails from EZV. This includes recommendations, travel inspiration and deals, things to
                                do in your home city, how EZV works, invites and referrals, surveys and research
                                studies, EZV for work updates, home hosting tips and promotions and experience hosting
                                tips and promotions.</div>
                            <div class="modal-footer"><button class="btn btn-light" type="button"
                                    data-dismiss="modal">Cancel</button><button class="btn btn-dark"
                                    type="button">Unsubscribe</button></div>
                        </div>
                    </div>
                </div>
                <!-- Modal Unsubscribe Checkbox-->

            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection

@section('scripts')

<script>
    function showModalUnsub() {
        $("#unsubModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalRecognition() {
        $("#recognitionModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalInsightsTips() {
        $("#insightModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalPricingTrends() {
        $("#pricingModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalHostingPerks() {
        $("#hostingModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalNewsUpdate() {
        $("#newsUpdateModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalLocalRegulation() {
        $("#localRegulationModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalInspiration() {
        $("#inspirationModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalTripPlanning() {
        $("#tripPlanningModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalNewsProgram() {
        $("#newsProgramModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalFeedBack() {
        $("#feedbackModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalTravel() {
        $("#travelModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

</script>

@endsection
