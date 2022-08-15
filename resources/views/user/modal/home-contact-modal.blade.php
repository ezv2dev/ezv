    <!-- Modal -->
    <div class="modal fade modal-fullscreen" id="home-contact-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <section id="start" class="p-3 p-lg-5 h1-00 w-100 bg-black">
                        <div>
                            <div class="row">

                                <div class="col-12 col-md-6 video-text-section"> 
                                    <h1 style="color: #ff7400;">Video content is trending</h1>
                                    <p class="text-white">EZV Worlds 1<sup>st</sup> booking platform with a video search engine</p>
                                    <p class="text-white">68% of costumers prefer watching videos to learn about new</p>
                                    <p class="text-white">Show case what makes your property unique with short videos</p>
                                    <p class="text-white">EZV Collab Portal, allows host to meet & create high quality content with professional verified creators from Videographers, Photographers, Drone Pilots, Blogger and more</p> 
                                    <div class="col-12 d-flex justify-content-center pt-5">
                                        <button class="letsgo" onclick="window.location.href='#start';">Get Started</button>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="host-video-section">
                                        <div class="host-video-container">
                                            <div class="video-content">
                                                <video controls="true" autoplay="autoplay" loop="true" muted defaultmuted
                                                    playsinline>
                                                    <source src="{{ asset('assets/media/videos/hoses-sample-video.mp4') }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="p-3 p-lg-5" id="form-section">
                        <div>
                            <div class="customer-support-block p-3 p-lg-5 background-light-grey">
                                <h1>24/7 customer support team</h1>
                                <p>We are here to help you set and design your first listing with EZV</p>
                                <p>Please fill in your contact details in the form bellow and one of our team<br> members will respond
                                    to you shortly</p>
                                <form action="">
                                    <div class="d-flex flex-column flex-lg-row">
                                        <div class="col-12 col-lg-6 right-20">
                                            <input class="form-control" placeholder="First Name">
                                            <input class="form-control" placeholder="Last Name">
                                            <input class="form-control" placeholder="Email address [Example: me@localhost.com]">
                                            <input class="form-control" placeholder="Phone">
                                            <input class="form-control" placeholder="Website">
                                        </div>
                                        <div class="col-12 col-lg-6 left-20">
                                            <!-- <div class="add-link d-block" id="input-link-listing-button"
                                                onclick="open_input_link_listing()">Add Link</div> -->
                                            <input class="form-control" placeholder="Add link +">
                                            <p class="top-50">Please add a link to one of your current listings on another site to help with designing
                                                your first EZV listing even faster</p>
                                            <div class="row">
                                                <div class="col-8">
                                                    <p class="v-middle">Cutomer Support: <a href="tel:+6281667548765">+62 8166 7548
                                                            765</a></p>
                                                </div>
                                                <div class="col-4">
                                                    <button class="add-link">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!--  End Modal -->