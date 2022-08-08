@extends('new-admin.layouts.admin_layout')

@section('title', 'EZV2 Coupon Codes: Invite Your Friends - EZV2')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content_admin')

<style>
    .accordion-button:not(.collapsed) {
        color: #FF7400 !important;
        background-color: #e7f1ff;
        box-shadow: inset 0 -1px 0 rgb(0 0 0 / 13%);
    }
    @media only screen and (max-width: 767px) {
        .ml-max-md-20p {
            margin-left: 20px !important;
        }
    }
</style>


<div class="page-header">
    <div class="container text-dark">
        <div class="page-header-content pt-4">
            <div class=" mt-4 ml-max-md-20p" style="margin-left: 30px;">
                <h1 style="font-weight:bold; color: #383838; font-size:25pt; margin-top: -20px;">
                    Guest referral
                </h1>
            </div>

            <div id="content" class="col-12">
                <div class="col-12 mt-5 justify-content-center align-item-center" style="display: flex;">

                        <div class="card" style="width: 400px; padding: 20px; box-shadow: 0px 3px 15px -8px rgb(100,100,100);">
                            <div class="card-body">
                                <h4 class="card-title pt-2" style="margin-left: -10px;"><b>Track your referrals</b></h4>
                                <div class="row mb-2">
                                    <table>
                                        <tr>
                                            <td>Completed referral</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Sign up</td>
                                            <td>0</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <button class="btn text-center" style="color: #2C3333; background: transparant; border: 1px solid #2C3333;"><b>Show more details</b></button>
                        </div>
                    </div>
                </div>

                <hr style="margin-top: 80px;">

                <div class="col-12 mt-5 d-block d-md-flex b">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <h2 class="text-dark"><b>Common questions</b></h2>
                        <p>Check out these answers to common questions and review other program information in the
                            <a class="text-dark" style="text-decoration: underline; color:black;" href="#"><b>Help
                                    Center</b></a>.</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                        <b>Is the referral program still open?</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>The referrals program is no longer open and no new invites can be sent.
                                        </p>

                                        <p>If you were sent a coupon prior to the shutdown of the program, you will
                                            be able to use the coupon on any booking made prior to the expiration of
                                            the coupon.</p>

                                        <p>Sender credits will be honored till they expire. For prior referrals, you
                                            will receive credit upon completion of successful stay if the coupon is
                                            used prior to expiry (credit amount based on offer at the time).</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                        aria-expanded="false" aria-controls="flush-collapseTwo">
                                        <b>I referred a friend but didn't get travel credit</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">For referrals made after Oct 1, 2020, EZV2 doesn't
                                        offer travel credit for referrals.</div>
                                </div>
                            </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

@endsection
