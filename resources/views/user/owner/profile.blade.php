@extends('new-admin.layouts.admin_layout')

@section('title', 'Owner Profile - EZV2')

<style>
    .section-photo {
        height: auto;
        border: 1px solid #DFDFDE;
        border-radius: 10px;
        color: #3A3845;
        padding-bottom: 20px;
    }

    .photo {
        text-align: center;
    }

    .section-profile {
        padding: 15px;
        /* border: 1px solid #78938A; */
        border-radius: 5px;
    }

    .section-form-profile {
        padding: 15px;
    }

    .photo-profile {
        height: 125px;
        border-radius: 50%;
        margin-top: 30px;
        margin-bottom: 10px;
        asset-ratio: 1/1;
    }

    .name-user {
        font-size: 20pt;
        font-weight: bold;
    }

    .confirmed {
        margin: 30px;
        border-top: 1px solid #DFDFDE;
        padding-top: 20px;
    }

    .identity-verification {
        margin: 30px;
    }
</style>

@section('content_admin')

    <div class="page-header">
        <div class="container text-dark">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-12 d-flex">
                        <div class="col-4">
                            <div class="section-photo">
                                <div class="photo">
                                    @if ($user->foto_profile != null)
                                        <img class="photo-profile"
                                            src="{{ asset('foto_profile/' . $user->foto_profile) }} ">
                                    @elseIf ($user->avatar != null)
                                        <img class="photo-profile" src="{{ $user->avatar }}">
                                    @else
                                        <img class="photo-profile"
                                            src="https://ui-avatars.com/api/?name={{ $user->first_name }}">
                                    @endif
                                    {{-- <img class="photo-profile" src="{{ Auth::user()->foto_profile == NULL || Auth::user()->avatar == NULL ? 'https://a0.muscache.com/defaults/user_pic-225x225.png' : asset('/foto_profile/'.Auth::user()->foto_profile) }}" alt=""> --}}
                                </div>
                                <div class="identity-verification">
                                    <div style="margin-bottom: 10px;">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                            style="height:24px; width:24px; fill:currentColor; margin-right: 10px;"
                                            aria-hidden="true" role="presentation" focusable="false">
                                            <path
                                                d="M14.998 1.032a2 2 0 0 0-.815.89l-3.606 7.766L1.951 10.8a2 2 0 0 0-1.728 2.24l.031.175A2 2 0 0 0 .87 14.27l6.36 5.726-1.716 8.608a2 2 0 0 0 1.57 2.352l.18.028a2 2 0 0 0 1.215-.259l7.519-4.358 7.52 4.358a2 2 0 0 0 2.734-.727l.084-.162a2 2 0 0 0 .147-1.232l-1.717-8.608 6.361-5.726a2 2 0 0 0 .148-2.825l-.125-.127a2 2 0 0 0-1.105-.518l-8.627-1.113-3.606-7.765a2 2 0 0 0-2.656-.971zm-3.07 10.499l4.07-8.766 4.07 8.766 9.72 1.252-7.206 6.489 1.938 9.723-8.523-4.94-8.522 4.94 1.939-9.723-7.207-6.489z">
                                            </path>
                                        </svg>
                                        <span style="font-weight: 600;">780 reviews</span>
                                    </div>
                                    <div style="margin-bottom: 10px;">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            role="presentation" focusable="false"
                                            style="height: 24px; width: 24px; fill: currentcolor; margin-right: 10px;">
                                            <path
                                                d="M16 .798l.555.37C20.398 3.73 24.208 5 28 5h1v12.5C29 25.574 23.21 31 16 31S3 25.574 3 17.5V5h1c3.792 0 7.602-1.27 11.445-3.832L16 .798zm0 2.394l-.337.213C12.245 5.52 8.805 6.706 5.352 6.952L5 6.972V17.5c0 6.831 4.716 11.357 10.713 11.497L16 29c6.133 0 11-4.56 11-11.5V6.972l-.352-.02c-3.453-.246-6.893-1.432-10.311-3.547L16 3.192zm7 7.394L24.414 12 13.5 22.914 7.586 17 9 15.586l4.5 4.499 9.5-9.5z">
                                            </path>
                                        </svg>
                                        <span style="font-weight: 600;">Identity verified</span>
                                    </div>

                                </div>
                                <div class="confirmed">
                                    <h3 class="mb-4"><b>{{ $user->first_name }} confirmed</b></h3>
                                    <p><svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            role="presentation" focusable="false"
                                            style="height: 16px; width: 16px; fill: currentcolor; margin-right: 10px;">
                                            <path
                                                d="M13.102 2.537L15.365 4.8l-9.443 9.443L.057 8.378 2.32 6.115l3.602 3.602z">
                                            </path>
                                        </svg>
                                        Email address</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="section-profile">
                                <h3 class="name-user" style="margin-bottom: 10px;">Hi, I'm {{ $user->first_name }}
                                    {{ $user->last_name }}</h3>
                                <span style="color: #78938A;">Joined in {{ $user->created_at->format('M Y') }}</span>
                            </div>
                            <hr>
                            <div class="section-profile">
                                <h4>About</h4>
                                <p>{{ $infoOwner->about ?? '-' }}</p>
                                <p>{{ $infoOwner->location ?? '-' }}</p>
                            </div>
                            <hr>
                            <div class="container-fluid" style="padding: 15px;">
                                <h1 class="mt-2">{{ $user->first_name }}'s listings</h1>
                                <div class="Container">
                                    <div class="list-menu-slider">
                                        @foreach ($villaOwner as $item)
                                            <div class="ProductBlock">
                                                <div class="Content">
                                                    <div class="img-fill">
                                                        <img
                                                            src="{{ URL::asset('/foto/gallery/' . strtolower($item->uid) . '/' . $item->image) }}">
                                                    </div>
                                                    <h3>{{ Str::limit($item->name, 15) }}</h3>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col-8 -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('new-admin.layouts.footer')

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".list-menu-slider").slick({
                rtl: false, // If RTL Make it true & .slick-slide{float:right;}
                autoplay: false,
                autoplaySpeed: 5000, //  Slide Delay
                speed: 500, // Transition Speed
                slidesToShow: 2, // Number Of Carousel
                slidesToScroll: 1, // Slide To Move
                pauseOnHover: false,
                // appendArrows:$(".Arrows"), // Class For Arrows Buttons
                prevArrow: '<span class="Slick-Prev"></span>',
                nextArrow: '<span class="Slick-Next"></span>',
                easing: "linear",
                responsive: [{
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 1280,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 1536,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                ],
            })
        })
    </script>
@endsection
