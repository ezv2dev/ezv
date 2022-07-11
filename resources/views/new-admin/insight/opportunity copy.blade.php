@extends('new-admin.layouts.admin_layout')

@section('title', 'Opportunities - EZV2')

<style>
    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
        /* height: 100px; */
    }
</style>

@section('content_admin')

<!-- Main page content-->
<div class="container mt-3 mb-5">
    <div class="bd-example bd-example-tabs">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Opportunities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Reviews</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Earnings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="false">Views</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-superhost" role="tab" aria-controls="pills-superhost" aria-selected="false">Superhost</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-cleaning" role="tab" aria-controls="pills-cleaning" aria-selected="false">Cleaning</a>
          </li>
        </ul>
        <div class="tab-content" style="color: black" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="opportunity pt-5">
                <h3>Resources for hosting now</h3>
                <div class="container">
                    <div class="row">
                      <div class="col-sm">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="card">
                                        <div class="card-horizontal">
                                            <div class="img-square-wrapper">
                                                <img width="300" height="180" class="img-thumbnail" src="http://via.placeholder.com/300x180" alt="Card image cap">
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title ml-2">Why it's smart to offer flexible cancellations right now</h4>
                                                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="card">
                                        <div class="card-horizontal">
                                            <div class="img-square-wrapper">
                                                <img width="300" height="180" class="img-thumbnail" src="http://via.placeholder.com/300x180" alt="Card image cap">
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title ml-2">Getting started with EZV’s cleaning protocol</h4>
                                                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="card">
                                        <div class="card-horizontal">
                                            <div class="img-square-wrapper">
                                                <img width="300" height="180" class="img-thumbnail" src="http://via.placeholder.com/300x180" alt="Card image cap">
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title ml-2">The do's and don’ts of providing self check-in</h4>
                                                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <div class="card">
                                            <div class="card-horizontal">
                                                <div class="img-square-wrapper">
                                                    <img width="300" height="180" class="img-thumbnail" src="http://via.placeholder.com/300x180" alt="Card image cap">
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title ml-2">What you need to know about hosting families and pets</h4>
                                                    {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <div class="card">
                                            <div class="card-horizontal">
                                                <div class="img-square-wrapper">
                                                    <img width="300" height="180" class="img-thumbnail img-responsive" src="http://via.placeholder.com/300x180" alt="Card image cap">
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title ml-2">How to make your space comfortable for remote workers</h4>
                                                    {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <div class="card">
                                            <div class="card-horizontal">
                                                <div class="img-square-wrapper">
                                                    <img width="300" height="180" class="img-thumbnail img-responsive" src="http://via.placeholder.com/300x180" alt="Card image cap">
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title ml-2">The best amenities to offer right now</h4>
                                                    {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          </div>
          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
              <div class="col-8">
                <div class="earnings pt-5">
                    <div class="select-month">
                        <label class="form-label" for="example-select">Select month</label>
                        <br>
                          <select class="form-select" id="example-select" name="example-select">
                            <option selected>Select a month</option>
                            <option value="1">April 2022</option>
                            <option value="2">Mei 2022</option>
                            <option value="3">June 2022</option>
                            <option value="4">July 2022</option>
                          </select>
                    </div>
                    <div class="value-earnings mt-5">
                        <h3 class="text-xl" style="color: rgb(54, 50, 50)"><b>$0.00</b></h3>
                        <p>Booked earnings for 2022</p>
                    </div>
                    <div class="charts-bar">
                    </div>
                    <div class="details-earning mt-5">
                        <h3 class="text-md" style="color: rgb(54, 50, 50)"><b>2022 details</b></h3>
                        <hr>
                        <p>You have no listings currently listed</p>
                        <hr>
                        <p>Cleaning fees <span style="float: right">$0</span></p>
                        <hr>
                        <p>Cancellation fees <span style="float: right">$0</span></p>
                        <p>Incurred in 2022</p>
                        <hr>
                        <a href="#">View transaction history</a>
                        <hr>
                        <a href="#">View tax information</a>
                        <p class="mt-5"><a href="#" style="text-decoration: underline; color: black;">Give feedback</a></p>
                    </div>
                </div>
              </div>
          </div>
          <div class="tab-pane fade" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
            <p>Est quis nulla laborum officia ad nisi ex nostrud culpa Lorem excepteur aliquip dolor aliqua irure ex. Nulla ut duis ipsum nisi elit fugiat commodo sunt reprehenderit laborum veniam eu veniam. Eiusmod minim exercitation fugiat irure ex labore incididunt do fugiat commodo aliquip sit id deserunt reprehenderit aliquip nostrud. Amet ex cupidatat excepteur aute veniam incididunt mollit cupidatat esse irure officia elit do ipsum ullamco Lorem. Ullamco ut ad minim do mollit labore ipsum laboris ipsum commodo sunt tempor enim incididunt. Commodo quis sunt dolore aliquip aute tempor irure magna enim minim reprehenderit. Ullamco consectetur culpa veniam sint cillum aliqua incididunt velit ullamco sunt ullamco quis quis commodo voluptate. Mollit nulla nostrud adipisicing aliqua cupidatat aliqua pariatur mollit voluptate voluptate consequat non.</p>
          </div>
        </div>
      </div>
<!-- ./Tabs -->
</div>

@include('new-admin.layouts.footer')

@endsection
