@extends('new-admin.layouts.admin_layout')

@section('title', 'Personal Information - Account Setting - EZV2')

@section('content_admin')
<style>
    * {
        margin: 0;
        padding: 0
    }

    html {
        height: 100%
    }

    p {
        color: grey
    }

    .display-none {
        display: none;
    }

    .display-block {
        display: block;
    }

    #heading {
        text-transform: uppercase;
        color: #FF7400;
        font-weight: normal
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    .form-card {
        text-align: left
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform input,
    #msform textarea {
        padding: 8px 15px 8px 15px;
        border: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        background-color: #ffffff;
        font-size: 16px;
        letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #FF7400;
        outline-width: 0
    }

    #msform .action-button {
        width: 100px;
        background: #FF7400;
        font-weight: bolder;
        color: white;
        border: 0 none;
        border-radius: 20px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 0px 10px 5px;
        float: right
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        background-color: #000
    }

    #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 20px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px 10px 0px;
        float: right
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        background-color: #000000
    }

    .card {
        z-index: 0;
        border: none;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #FF7400;
        margin-bottom: 15px;
        font-weight: bold;
        text-align: left
    }

    .purple-text {
        color: #FF7400;
        font-weight: normal
    }

    .steps {
        font-size: 18px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
    }

    .fieldlabels {
        color: gray;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .active {
        color: #FF7400
    }

    #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: "\f13e"
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "\f007"
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f030"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #FF7400
    }

    .progress {
        height: 20px
    }

    .progress-bar {
        background-color: #FF7400
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }

    [type="radio"]:checked,
    [type="radio"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }

    [type="radio"]:checked+label,
    [type="radio"]:not(:checked)+label {
        position: relative;
        padding-left: 28px;
        cursor: pointer;
        line-height: 20px;
        display: inline-block;
        color: #666;
    }

    [type="radio"]:checked+label:before,
    [type="radio"]:not(:checked)+label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 18px;
        height: 18px;
        border: 1px solid #ddd;
        border-radius: 100%;
        background: #fff;
    }

    [type="radio"]:checked+label:after,
    [type="radio"]:not(:checked)+label:after {
        content: '';
        width: 14px;
        height: 14px;
        background: #FF7400;
        position: absolute;
        top: 2px;
        left: 2px;
        border-radius: 100%;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }

    [type="radio"]:not(:checked)+label:after {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }

    [type="radio"]:checked+label:after {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1);
    }

    .checkmark {
        width: 100px;
        margin: 0 auto;
        padding-top: 20px;
    }

    .circle {
        -moz-animation-name: circle-animation;
        -webkit-animation-name: circle-animation;
        animation-name: circle-animation;
        -moz-animation-duration: 2s;
        -webkit-animation-duration: 2s;
        animation-duration: 2s;
        -moz-animation-timing-function: ease-in-out;
        -webkit-animation-timing-function: ease-in-out;
        animation-timing-function: ease-in-out;
        stroke-dasharray: 1000;
        stroke-dashoffset: 0;
    }

    .icon {
        -moz-animation-name: icon-animation;
        -webkit-animation-name: icon-animation;
        animation-name: icon-animation;
        -moz-animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -moz-animation-timing-function: ease-in-out;
        -webkit-animation-timing-function: ease-in-out;
        animation-timing-function: ease-in-out;
        opacity: 1;
    }

    @keyframes circle-animation {
        0% {
            stroke-dashoffset: 1000;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes icon-animation {
        0% {
            opacity: 0;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-7 col-xl-6 text-center p-0 mb-2">
            <div class="card px-0 pt-4 pb-0 mb-3">
                <form id="msform" action="{{ route('account-store-delete') }}" method="post">
                    @csrf
                    <!-- progressbar -->
                    <ul id="progressbar" style="margin-left: 100px;">
                        <li class="active" id="account"><strong>Select reason</strong></li>
                        <li id="personal"><strong>Confirm</strong></li>
                        <li id="confirm"><strong>Done</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">What prompted you to deactivate?</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 1 - 3</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    <p>I have safety or privacy concerns.</p>
                                </div>
                                <div class="col-1">
                                    <input type="radio" value="I have safety or privacy concerns" id="test1" name="reasonn" onclick="function1()">
                                    <label for="test1"></label>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    <p>I can’t host anymore.</p>
                                </div>
                                <div class="col-1">
                                    <input type="radio" value="I can’t host anymore" id="test2" name="reasonn" onclick="function2()">
                                    <label for="test2"></label>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    <p>I can't comply with EZV's Terms of Service / Community Commitment.</p>
                                </div>
                                <div class="col-1">
                                    <input type="radio" value="I can't comply with EZV's Terms of Service / Community Commitment" id="test3" name="reasonn" onclick="function3()">
                                    <label for="test3"></label>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    <p>Others</p>
                                </div>
                                <div class="col-1">
                                    <input type="radio" id="test4" name="reasonn" value="" onclick="function4()">
                                    <label for="test4"></label>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row display-none" id="reason">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="reason" style="color: #484848; font-weight: bolder;">Reason</label>
                                        <input type="text" class="form-control" name="reason" id="reason">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Deactivate account?</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 2 - 3</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <i class="fa-solid fa-check" style="color: #000;"></i>

                                </div>
                                <div class="col-11">
                                    <p>The profile and listings associated with this account will disappear.</p>
                                </div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <i class="fa-solid fa-check" style="color: #000;"></i>
                                </div>
                                <div class="col-11">
                                    <p>You won’t be able to access the account info or past reservations.</p>
                                </div>
                                <hr>
                            </div>
                        </div> <input type="button" name="submit" class="submit action-button" value="Deactivate" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Done</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 3 - 3</h2>
                                </div>
                            </div>

                            <div class="checkmark">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 161.2 161.2"
                                    enable-background="new 0 0 161.2 161.2" xml:space="preserve">
                                    <circle class="circle" fill="none" stroke="#33b057" stroke-width="7"
                                        stroke-miterlimit="10" cx="80.6" cy="80.6" r="62.1"></circle>
                                    <polyline class="icon" fill="none" stroke="#33b057" stroke-width="7"
                                        stroke-linecap="round" stroke-miterlimit="10"
                                        points="113,52.8 74.1,108.4 48.2,86.4"></polyline>
                                </svg>
                            </div>
                        </div> <input type="submit" class="next action-button" value="Finish" />
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


@include('new-admin.layouts.footer')

@endsection

@section('scripts')
<script>
    function function1() {
        document.getElementById("reason").classList.remove("display-block");
        document.getElementById("reason").classList.add("display-none");
    }

    function function2() {
        document.getElementById("reason").classList.remove("display-block");
        document.getElementById("reason").classList.add("display-none");
    }

    function function3() {
        document.getElementById("reason").classList.remove("display-block");
        document.getElementById("reason").classList.add("display-none");
    }

    function function4() {
        document.getElementById("reason").classList.remove("display-none");
        document.getElementById("reason").classList.add("display-block");
    }

</script>

<script>
    $(document).ready(function () {
        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function () {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(++current);
        });

        $(".previous").click(function () {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
        }

        $(".submit").click(function () {
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(++current);
        })

    });

</script>
@endsection
