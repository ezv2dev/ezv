@extends('layouts.user.user')

@section('content')
<style>
input {
  background: rgba(255,255,255,0.4);
  border: none;
  position: relative;
  display: block;
  outline: none;
  margin: 0 auto;
  color: #333;
  -webkit-box-shadow: 0 2px 10px 1px rgba(0,0,0,0.5);
  box-shadow: 0 2px 10px 1px rgba(0,0,0,0.5);
}
.topbar {
  background: rgba(255,255,255,0.4);
  border: none;
  position: relative;
  display: block;
  outline: none;
  margin: 0 auto;
  color: #333;
  -webkit-box-shadow: 0 2px 10px 1px rgba(0,0,0,0.5);
  box-shadow: 0 2px 10px 1px rgba(0,0,0,0.5);
}
::-webkit-input-placeholder { color: #000;} 
:-moz-placeholder { color: #000; }
::-moz-placeholder { color: #000; }
:-ms-input-placeholder { color: #000; }
</style>
<section class="hero-area bg_img" data-background="{{ asset('assets/user/assets/images/banner/02.jpg') }}">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12">
                <form action="{{ route('list') }}" method="POST" id="basic-form">
                    @csrf
                <div class="mb-2">
                    <input id="location" type="text" name="location" style="width: 400px; height:50px;" placeholder="Let's find location..."/>
                </div>
                <div id="textfield" style="width: 400px; margin: 0 auto;" >
                    <div class="row mb-2">
                        <div class="col-lg-6">
                        <input type="number" min="0" style="width: 190px; height:50px; display: none;" name="adult" id="adult" placeholder="Number of adults"/>
                        </div>
                        <div class="col-lg-6">
                        <input type="number" min="0" style="width: 189px; height:50px; display: none;" name="children" id="children" placeholder="Number of children"/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                        <input type="text" min="0" style="width: 190px; height:50px; display: none;" name="check_in" id="check_in" placeholder="Check In"/>
                        </div>
                        <div class="col-lg-6">
                        <input type="text" min="0" style="width: 189px; height:50px; display: none;" name="check_out" id="check_out" placeholder="Check Out"/>
                        </div>
                    </div>
                    <div style="text-align:center;">
                        <button type="submit" id="button" class="site-btn" style="display: none;">Search</button>
                    </div>
                </div>
                </form>
            </div>
            
            <div class="col-lg-6">
                <div class="hero-content">
                    {{-- <h1 class="title" style="color: #fff">EZV2<br>
                    </h1>
                    <p style="color: #fff">Stylish Modern Villa in Bali</p> --}}
                    {{-- <div class="hero-buttons">
                        <a href="service-details.html" class="site-btn">Our Departments</a>
                        <a href="about.html" class="site-btn red">Learn More</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="hero-ilustration-shape">
        <img src="assets/images/ilustration/ilustration-1.png" alt="">
    </div>
</section>
<!-- Hero area end -->
<!-- hero slide area end -->

<!-- about area start -->
{{-- <section class="about-area about-area-2 bg_img pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="about-content about-content-2">
                    <div class="section-heading mb-25">
                        <h4 class="sub-title">About Us</h4>
                        <h2 class="section-title">Have A Fun At <br>
                        The Doctor’s Office<span>.</span></h2>
                    </div>
                    <div class="row about-left">
                        <div class="col-lg-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisici ng elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                            aute irure dolor in reprehenderit in voluptate.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 pl-0 pr-10">
                <div class="opening-hour-box opening-hour-box-2 bg_img" data-overlay="94" data-background="{{ asset('assets/user/assets/images/bg/open-hour-bg.jpg') }}">
                    <div class="opening-hour-top">
                        <div class="icon">
                            <img src="assets/images/icons/clock-icon-white.png" alt="">
                        </div>
                        <div class="content">
                            <h5 class="title">Opening Hours</h5>
                            <p>It’s a fake timing. Actually we
                                are available 24/7.</p>
                        </div>
                    </div>
                    <div class="opening-hour-list">
                        <ul>
                            <li>Monday - Friday<span>8:00 - 16:00</span></li>
                            <li>Saturday<span>8:00 - 12:00</span></li>
                            <li>Sunday<span><strong>Closed</strong></span></li>
                            <li>Lunch Break<span>9:15 - 22:45</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- about area end -->

<!-- appointment area start -->
{{-- <section class="appointment-area appointment-area-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="appointment-box appointment-box-2">
                    <div class="row">
                        <div class="col-xl-7 col-lg-10">
                            <div class="section-heading">
                                <h4 class="sub-title">Get A Quote</h4>
                                <h2 class="section-title">Make An Appointment <br> Right Now<span>.</span></h2>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 my-auto text-right">
                            <a href="contact.html" class="site-btn">Make Appointment</a>
                        </div>
                    </div>
                    <div class="appointment-ilustration">
                        <img src="assets/images/ilustration/ilustration-2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- appointment area end -->

<!-- service area start -->
{{-- <section class="service-area pt-120 pb-120 bg_img" data-overlay="94" data-background="assets/images/bg/service-bg.jpeg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="section-heading mb-70">
                    <h4 class="sub-title">Services</h4>
                    <h2 class="section-title">Our Departments<span>.</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav service-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab-1" role="tab" data-toggle="tab">
                            <span class="icon">
                                <img class="default" src="assets/images/service/service-icon-01.png" alt="">
                                <img class="hover" src="assets/images/service/service-icon-hover-01.png" alt="">
                            </span>
                            <span class="title">Instant Medicine</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-2" role="tab" data-toggle="tab">
                            <span class="icon">
                                <img class="default" src="{{ asset('assets/user/assets/images/service/service-icon-02.png') }}" alt="">
                                <img class="hover" src="{{ asset('assets/user/assets/images/service/service-icon-hover-02.png') }}" alt="">
                            </span>
                            <span class="title">Medical Checkup</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-3" role="tab" data-toggle="tab">
                            <span class="icon">
                                <img class="default" src="assets/images/service/service-icon-03.png" alt="">
                                <img class="hover" src="assets/images/service/service-icon-hover-03.png" alt="">
                            </span>
                            <span class="title">Corona Checkup</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-4" role="tab" data-toggle="tab">
                            <span class="icon">
                                <img class="default" src="assets/images/service/service-icon-04.png" alt="">
                                <img class="hover" src="assets/images/service/service-icon-hover-04.png" alt="">
                            </span>
                            <span class="title">Pro Dental</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-5" role="tab" data-toggle="tab">
                            <span class="icon">
                                <img class="default" src="assets/images/service/service-icon-05.png" alt="">
                                <img class="hover" src="assets/images/service/service-icon-hover-05.png" alt="">
                            </span>
                            <span class="title">Kidney Solution</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-6" role="tab" data-toggle="tab">
                            <span class="icon">
                                <img class="default" src="assets/images/service/service-icon-06.png" alt="">
                                <img class="hover" src="assets/images/service/service-icon-hover-06.png" alt="">
                            </span>
                            <span class="title">Blood Test</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="tab-content service-tab-content mt-60">
                    <div role="tabpanel" class="tab-pane fade in active show" id="tab-1">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="service-box-thumb">
                                    <div class="service-big">
                                        <img src="assets/images/service/service-01.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-big.png" alt="">
                                        </span>
                                    </div>
                                    <div class="service-small">
                                        <img src="assets/images/service/service-02.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-small.png" alt="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-2">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="service-box-thumb">
                                    <div class="service-big">
                                        <img src="assets/images/service/service-01.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-big.png" alt="">
                                        </span>
                                    </div>
                                    <div class="service-small">
                                        <img src="assets/images/service/service-02.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-small.png" alt="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 my-auto">
                                <div class="service-box-content">
                                    <div class="section-heading mb-50">
                                        <h4 class="sub-title">Medical checkup</h4>
                                        <h2 class="section-title">Dr. Stephanie Wosniack is
                                            is dedicated to providing<span>.</span></h2>
                                    </div>
                                    <p>Dr. Stephanie Wosniack is is dedicated to providing her patients with the best possible care. We at
                                        MediCare are focused
                                        on helping you. After receiving successful care for various aches and pains over the years, Dr. Woshiack
                                        found her
                                        calling to help others get well.</p>
                                    <a href="contact.html" class="site-btn transparent">Get Appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-3">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="service-box-thumb">
                                    <div class="service-big">
                                        <img src="assets/images/service/service-01.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-big.png" alt="">
                                        </span>
                                    </div>
                                    <div class="service-small">
                                        <img src="assets/images/service/service-02.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-small.png" alt="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 my-auto">
                                <div class="service-box-content">
                                    <div class="section-heading mb-50">
                                        <h4 class="sub-title">Corona Checkup</h4>
                                        <h2 class="section-title">Dr. Stephanie Wosniack is
                                            is dedicated to providing<span>.</span></h2>
                                    </div>
                                    <p>Dr. Stephanie Wosniack is is dedicated to providing her patients with the best possible care. We at
                                        MediCare are focused
                                        on helping you. After receiving successful care for various aches and pains over the years, Dr. Woshiack
                                        found her
                                        calling to help others get well.</p>
                                    <a href="contact.html" class="site-btn transparent">Get Appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-4">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="service-box-thumb">
                                    <div class="service-big">
                                        <img src="assets/images/service/service-01.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-big.png" alt="">
                                        </span>
                                    </div>
                                    <div class="service-small">
                                        <img src="assets/images/service/service-02.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-small.png" alt="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 my-auto">
                                <div class="service-box-content">
                                    <div class="section-heading mb-50">
                                        <h4 class="sub-title">Pro Dental</h4>
                                        <h2 class="section-title">Dr. Stephanie Wosniack is
                                            is dedicated to providing<span>.</span></h2>
                                    </div>
                                    <p>Dr. Stephanie Wosniack is is dedicated to providing her patients with the best possible care. We at
                                        MediCare are focused
                                        on helping you. After receiving successful care for various aches and pains over the years, Dr. Woshiack
                                        found her
                                        calling to help others get well.</p>
                                    <a href="contact.html" class="site-btn transparent">Get Appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-5">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="service-box-thumb">
                                    <div class="service-big">
                                        <img src="assets/images/service/service-01.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-big.png" alt="">
                                        </span>
                                    </div>
                                    <div class="service-small">
                                        <img src="assets/images/service/service-02.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-small.png" alt="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 my-auto">
                                <div class="service-box-content">
                                    <div class="section-heading mb-50">
                                        <h4 class="sub-title">Kidney Solution</h4>
                                        <h2 class="section-title">Dr. Stephanie Wosniack is
                                            is dedicated to providing<span>.</span></h2>
                                    </div>
                                    <p>Dr. Stephanie Wosniack is is dedicated to providing her patients with the best possible care. We at
                                        MediCare are focused
                                        on helping you. After receiving successful care for various aches and pains over the years, Dr. Woshiack
                                        found her
                                        calling to help others get well.</p>
                                    <a href="contact.html" class="site-btn transparent">Get Appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-6">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="service-box-thumb">
                                    <div class="service-big">
                                        <img src="assets/images/service/service-01.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-big.png" alt="">
                                        </span>
                                    </div>
                                    <div class="service-small">
                                        <img src="assets/images/service/service-02.jpeg" alt="">
                                        <span class="shape">
                                            <img src="assets/images/ilustration/service-shape-small.png" alt="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 my-auto">
                                <div class="service-box-content">
                                    <div class="section-heading mb-50">
                                        <h4 class="sub-title">Blood Test</h4>
                                        <h2 class="section-title">Dr. Stephanie Wosniack is
                                            is dedicated to providing<span>.</span></h2>
                                    </div>
                                    <p>Dr. Stephanie Wosniack is is dedicated to providing her patients with the best possible care. We at
                                        MediCare are focused
                                        on helping you. After receiving successful care for various aches and pains over the years, Dr. Woshiack
                                        found her
                                        calling to help others get well.</p>
                                    <a href="contact.html" class="site-btn transparent">Get Appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- service area end -->

<!-- Doctor carousel start -->
{{-- <div class="doctor-carousel owl-carousel">
    <div class="single-carousel-item">
        <div class="thumb">
            <img src="{{ asset('assets/user/assets/images/team/doctor-01.jpeg') }}" alt="">
            <span class="icon">
                <img src="{{ asset('assets/user/assets/images/icons/heart-icon.png') }}" alt="">
            </span>
        </div>
        <div class="content">
            <h4 class="title">Rosalina D. William</h4>
            <span class="sub-title">FOunder</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
        </div>
        <div class="social-links">
            <a href="#0"><i class="fab fa-facebook-f"></i></a>
            <a href="#0"><i class="fab fa-twitter"></i></a>
            <a href="#0"><i class="fab fa-behance"></i></a>
            <a href="#0"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
    <div class="single-carousel-item">
        <div class="thumb">
            <img src="{{ asset('assets/user/assets/images/team/doctor-02.jpeg') }}" alt="">
            <span class="icon">
                <img src="{{ asset('assets/user/assets/images/icons/heart-icon.png') }}" alt="">
            </span>
        </div>
        <div class="content">
            <h4 class="title">Romada B. Browni</h4>
            <span class="sub-title">dentist</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
        </div>
        <div class="social-links">
            <a href="#0"><i class="fab fa-facebook-f"></i></a>
            <a href="#0"><i class="fab fa-twitter"></i></a>
            <a href="#0"><i class="fab fa-behance"></i></a>
            <a href="#0"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
    <div class="single-carousel-item">
        <div class="thumb">
            <img src="{{ asset('assets/user/assets/images/team/doctor-03.jpeg') }}" alt="">
            <span class="icon">
                <img src="{{ asset('assets/user/assets/images/icons/heart-icon.png') }}" alt="">
            </span>
        </div>
        <div class="content">
            <h4 class="title">Pokoloko K. Kinder</h4>
            <span class="sub-title">consultant</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
        </div>
        <div class="social-links">
            <a href="#0"><i class="fab fa-facebook-f"></i></a>
            <a href="#0"><i class="fab fa-twitter"></i></a>
            <a href="#0"><i class="fab fa-behance"></i></a>
            <a href="#0"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
    <div class="single-carousel-item">
        <div class="thumb">
            <img src="{{ asset('assets/user/assets/images/team/doctor-04.jpeg') }}" alt="">
            <span class="icon">
                <img src="{{ asset('assets/user/assets/images/icons/heart-icon.png') }}" alt="">
            </span>
        </div>
        <div class="content">
            <h4 class="title">Yellow P. Pakura</h4>
            <span class="sub-title">dentist</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
        </div>
        <div class="social-links">
            <a href="#0"><i class="fab fa-facebook-f"></i></a>
            <a href="#0"><i class="fab fa-twitter"></i></a>
            <a href="#0"><i class="fab fa-behance"></i></a>
            <a href="#0"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
    <div class="single-carousel-item">
        <div class="thumb">
            <img src="{{ asset('assets/user/assets/images/team/doctor-01.jpeg') }}" alt="">
            <span class="icon">
                <img src="{{ asset('assets/user/assets/images/icons/heart-icon.png') }}" alt="">
            </span>
        </div>
        <div class="content">
            <h4 class="title">Dumble D. Dockers</h4>
            <span class="sub-title">consultant</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
        </div>
        <div class="social-links">
            <a href="#0"><i class="fab fa-facebook-f"></i></a>
            <a href="#0"><i class="fab fa-twitter"></i></a>
            <a href="#0"><i class="fab fa-behance"></i></a>
            <a href="#0"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div> --}}
<!-- Doctor carousel end -->

<!-- pricing area start -->
{{-- <section class="pricing-area pt-120 pb-120 bg-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="section-heading mb-70">
                    <h4 class="sub-title">pricing</h4>
                    <h2 class="section-title">Price & Plans<span>.</span></h2>
                </div>
            </div>
        </div>
        <div class="row mt-none-30 align-items-center no-gutters">
            <div class="col-xl-4 col-lg-6 col-md-6 mt-30">
                <div class="single-pricing-box">
                    <div class="pricing-head">
                        <h4 class="title">Basic</h4>
                        <h2 class="price"><span>$</span>99</h2>
                        <h6 class="duration">Monthly</h6>
                    </div>
                    <div class="pricing-list">
                        <ul>
                            <li>Routine checkup<i class="fal fa-check"></i></li>
                            <li>24h Assisance<i class="fal fa-check"></i></li>
                            <li>100 Tests & Treatments<i class="fal fa-check"></i></li>
                            <li>Regular Health Checkups<i class="fal fa-check"></i></li>
                            <li>Blood Test<i class="fal fa-check"></i></li>
                        </ul>
                    </div>
                    <a href="#0" class="site-btn transparent">Make Payment</a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 mt-30">
                <div class="single-pricing-box active bg_img" data-overlay="94" data-background="assets/images/bg/pricing-bg-01.jpeg">
                    <div class="pricing-head">
                        <h4 class="title">Basic</h4>
                        <h2 class="price"><span>$</span>199</h2>
                        <h6 class="duration">Monthly</h6>
                    </div>
                    <div class="pricing-list">
                        <ul>
                            <li>Routine checkup<i class="fal fa-check"></i></li>
                            <li>24h Assisance<i class="fal fa-check"></i></li>
                            <li>100 Tests & Treatments<i class="fal fa-check"></i></li>
                            <li>Regular Health Checkups<i class="fal fa-check"></i></li>
                            <li>Blood Test<i class="fal fa-check"></i></li>
                            <li>Kidney Test<i class="fal fa-check"></i></li>
                        </ul>
                    </div>
                    <a href="#0" class="site-btn transparent">Make Payment</a>
                    <div class="shape">
                        <img src="assets/images/icons/pricing-icon.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 mt-30">
                <div class="single-pricing-box">
                    <div class="pricing-head">
                        <h4 class="title">Basic</h4>
                        <h2 class="price"><span>$</span>59</h2>
                        <h6 class="duration">Monthly</h6>
                    </div>
                    <div class="pricing-list">
                        <ul>
                            <li>Routine checkup<i class="fal fa-check"></i></li>
                            <li>24h Assisance<i class="fal fa-check"></i></li>
                            <li>100 Tests & Treatments<i class="fal fa-check"></i></li>
                            <li>Regular Health Checkups<i class="fal fa-check"></i></li>
                            <li>Blood Test<i class="fal fa-check"></i></li>
                        </ul>
                    </div>
                    <a href="#0" class="site-btn transparent">Make Payment</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- pricing area end -->

<!-- blog area start -->
{{-- <section class="blog-area">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="video-box">
                    <div class="video-thumb">
                        <img src="{{ asset('assets/user/assets/images/bg/blog-bg-1.jpeg') }}" alt="">
                    </div>
                    <a href="//www.youtube.com/embed/4xe72U7mXNg?rel=0&amp;controls=0&amp;showinfo=0" class="video-btn"
                            data-rel="lightcase:myCollection"><i class="fa fa-play"></i></a>
                </div>
            </div>
            <div class="col-lg-6 my-auto">
                <div class="blog-content-wrap">
                    <div class="section-heading mb-80">
                        <h4 class="sub-title">our blog</h4>
                        <h2 class="section-title">Get Every Single <br> News Feeds<span>.</span></h2>
                    </div>
                    <div class="blog-list">
                        <div class="single-blog-item">
                            <div class="thumb">
                                <img src="assets/images/blog/04.jpeg" alt="">
                            </div>
                            <div class="content">
                                <div class="blog-meta">
                                    <ul>
                                        <li><a href="#0"><i class="fal fa-calendar-alt"></i> 12th May 2020</a></li>
                                        <li><a href="#0"><i class="fal fa-user"></i> By Admin</a></li>
                                    </ul>
                                </div>
                                <h4 class="title"><a href="blog-details.html">I am deeply grateful to Dr. Chase for his
                                    expertise and care.</a></h4>
                            </div>
                        </div>
                        <div class="single-blog-item">
                            <div class="thumb">
                                <img src="assets/images/blog/05.jpeg" alt="">
                            </div>
                            <div class="content">
                                <div class="blog-meta">
                                    <ul>
                                        <li><a href="#0"><i class="fal fa-calendar-alt"></i> 12th May 2020</a></li>
                                        <li><a href="#0"><i class="fal fa-user"></i> By Admin</a></li>
                                    </ul>
                                </div>
                                <h4 class="title"><a href="blog-details.html">I am deeply grateful to Dr. Chase for his
                                    expertise and care.</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- blog area end -->

<!-- newslater area start -->
{{-- <section class="newslater-area">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-lg-6 my-auto">
                <div class="newslater-content-wrap">
                    <div class="section-heading mb-60">
                        <h4 class="sub-title">our blog</h4>
                        <h2 class="section-title">Get Every Single <br> News Feeds<span>.</span></h2>
                    </div>
                    <div class="newslater-form">
                        <form action="index.html">
                            <label for="mail">Email Address <span>**</span></label>
                            <input type="email" id="mail" placeholder="Your Email Address">
                            <button class="site-btn" type="submit">Subscribe Now</button>
                        </form>
                    </div>
                    <div class="newslater-lists">
                        <ul>
                            <li><span>01.</span> Trust us we are not gonna spam</li>
                            <li><span>02.</span> GDPR Supported</li>
                            <li><span>03.</span> Secure information</li>
                            <li><span>04.</span> Get Daily Updates</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="newslater-bg">
                    <img src="{{ asset('assets/user/assets/images/bg/newslater-bg.jpeg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- newslater area end -->

<!-- sponser area start -->
{{-- <div class="sponser-area pt-100 pb-100">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-lg-12">
                <div class="brand-carousel owl-carousel">
                    <div class="singel-brand-item">
                        <img src="{{ asset('assets/user/assets/images/sponsor/01.png') }}" alt="">
                    </div>
                    <div class="singel-brand-item">
                        <img src="{{ asset('assets/user/assets/images/sponsor/02.png') }}" alt="">
                    </div>
                    <div class="singel-brand-item">
                        <img src="{{ asset('assets/user/assets/images/sponsor/03.png') }}" alt="">
                    </div>
                    <div class="singel-brand-item">
                        <img src="{{ asset('assets/user/assets/images/sponsor/04.png') }}" alt="">
                    </div>
                    <div class="singel-brand-item">
                        <img src="{{ asset('assets/user/assets/images/sponsor/05.png') }}" alt="">
                    </div>
                    <div class="singel-brand-item">
                        <img src="{{ asset('assets/user/assets/images/sponsor/01.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- sponser area end -->
@endsection

@section('scripts')
<script>
$("#location").keyup(function() {
  var id = $(this).val();
  if ((id).length >= 1) {
    $("#adult").fadeIn("slow");
    $("#children").fadeIn("slow");
    $("#check_in").fadeIn("slow");
    $("#check_out").fadeIn("slow");
    $("#button").fadeIn("slow");
  }
  else
    {
        $("#adult").fadeOut("slow");
        $("#children").fadeOut("slow");
        $("#check_in").fadeOut("slow");
        $("#check_out").fadeOut("slow");
        $("#button").fadeOut("slow");
    }
})
</script>
@endsection