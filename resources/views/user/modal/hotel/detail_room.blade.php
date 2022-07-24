<style>
    .reset-padding {
        padding: 0 !important;

    }

    .reset-margin {
        margin: 0 !important;
    }

    .modal-full {
        width: 100%;
        height: 100%;
    }
</style>

{{-- MODAL AMENITIES --}}
<div class="modal fade reset-padding" id="modal-room" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-amenities" role="document" style="overflow-y: initial !important">
        <div class="modal-content modal-content-amenities reset-margin modal-full"
            style="background: white; border-radius:15px">
            <div class="modal-header modal-header-amenities">
                <h5 class="modal-title">Room Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-amenities pb-1 translate-text-group"
                style=" height: 500px; overflow-y: auto;">
                {{-- PROFILE --}}
                <div class="row page-content">
                    {{-- LEFT CONTENT --}}
                    <div class="col-lg-12 col-md-12 col-xs-12 rsv-block alert-detail">
                        <div class="row top-profile">
                            <div class="col-lg-4- col-md-4 col-xs-12 pd-0">
                                <div class="profile-image">
                                    <img id="imageProfileHotelRoom"
                                        src="{{ URL::asset('/template/villa/template_profile.jpg') }}">

                                    {{-- @auth
                                        @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;
                                            <a type="button" onclick="edit_hotel_profile()"
                                                style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                            @if ($hotel[0]->image)
                                                <a class="delete-profile" href="javascript:void(0);"
                                                    onclick="delete_profile_image({'id': '{{ $hotelRoom->id_hotel_room }}'})">
                                                    <i class="fa fa-trash" style="color:red; margin-left: 25px;"
                                                        data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Delete') }}"></i></a>
                                            @endif
                                        @endif
                                    @endauth --}}
                                    <div>
                                        <p id="property-type-content">
                                            {{-- {{ $hotel[0]->propertyType->name }} --}}
                                            @auth
                                                @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                    &nbsp;<a type="button" onclick="editPropertyTypeForm()"
                                                        style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                                @endif
                                            @endauth
                                        </p>
                                        <p>
                                            @auth
                                                @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                    <div id="property-type-form" style="display:none;">
                                                        <form action="{{ route('villa_update_property_type') }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="id_hotel"
                                                                value="{{ $hotel[0]->id_hotel }}" required>
                                                            <select name="id_property_type" id="property-type-form-input"
                                                                required>
                                                                <option value="">select property type</option>
                                                                @forelse ($propertyType as $type)
                                                                    @php
                                                                        $isSelected = '';
                                                                        if ($type->id_property_type == $hotel[0]->id_property_type) {
                                                                            $isSelected = 'selected';
                                                                        }
                                                                    @endphp
                                                                    <option value="{{ $type->id_property_type }}"
                                                                        {{ $isSelected }}>
                                                                        {{ $type->name }}</option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                            <button type="submit" class="btn btn-sm btn-primary">
                                                                <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                                            </button>
                                                            <button type="reset" class="btn btn-sm btn-secondary"
                                                                onclick="editPropertyTypeCancel()">
                                                                <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                        </p>
                                    </div>
                                    <div>
                                        <p class="location-font-size"><a onclick="" href="javascript:void(0);"><i
                                                    class="fa fa-map-marker-alt"></i>
                                                TEST</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6- col-md-6 col-xs-12 profile-info">
                                <h2 id="name-content-room">Hotel Test - <a href=""></a>
                                    @auth
                                        @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;<a type="button" onclick="editNameForm()"
                                                style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                        @endif
                                    @endauth
                                </h2>

                                {{-- @auth
                                    @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <div id="name-form" style="display:none;">

                                            <input type="hidden" id="name-hotel" value="{{ $hotel[0]->name }}">
                                            <textarea class="form-control" style="width: 100%; overflow: hidden;" name="name" id="name-form-input"
                                                cols="30" rows="3" maxlength="55" placeholder="{{ __('user_page.Hotel Room Name Here') }}"
                                                required>{{ $hotelRoom->name }}</textarea>
                                            <small id="err-name" style="display: none;"
                                                class="invalid-feedback">{{ __('auth.empty_name') }}</small><br>
                                            <button type="submit" class="btn btn-sm btn-primary" id="btnSaveName"
                                                style="background-color: #ff7400"
                                                onclick="editNameRoom({{ $hotelRoom->id_hotel_room }})">
                                                <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-secondary" onclick="editNameCancel()">
                                                <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                            </button>
                                        </div>
                                    @endif
                                @endauth --}}

                                <p><span id="detail-room-size"></span> m<sup>2</sup> | <span id="detail-room-capacity"></span>
                                    {{ __('user_page.People') }} |
                                    <span id="detail-room-bed"></span> {{ __('user_page.Beds') }} |
                                    <strong>{{ __('user_page.Total') }}</strong>
                                    <span id="detail-room-total"></span> {{ __('user_page.Rooms') }}
                                    @auth
                                        @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;<a type="button" onclick="edit_room_size()"
                                                style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                        @endif
                                    @endauth
                                </p>

                                {{-- SHORT DESCRIPTION --}}
                                <p class="short-desc" id="short-description-content">
                                    <span id="detail-room-short-desc"></span>
                                    {{-- @auth
                                        @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;<a type="button" onclick="editShortDescriptionForm()"
                                                style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                        @endif
                                    @endauth --}}
                                </p>
                                {{-- @auth
                                    @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <div id="short-description-form" style="display:none;">

                                            <input type="hidden" name="id_hotel_room"
                                                value="{{ $hotelRoom->id_hotel_room }}" required>
                                            <textarea class="form-control" style="width: 100%;" name="short_description" id="short-description-form-input"
                                                cols="30" placeholder="{{ __('user_page.Make your short description here') }}" rows="3"
                                                maxlength="255">{{ $hotelRoom->short_description }}</textarea>
                                            <small id="err-shrt-desc" style="display: none;"
                                                class="invalid-feedback">{{ __('auth.empty_name') }}</small><br>
                                            <button type="submit" class="btn btn-sm btn-primary" id="btnSaveShortDesc"
                                                onclick="editShortDesc()">
                                                <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-secondary"
                                                onclick="editShortDescriptionCancel()">
                                                <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                            </button>

                                        </div>
                                    @endif
                                @endauth --}}
                                </p>
                                {{-- @auth
                                    @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <div id="short-description-form" style="display:none;">

                                            <input type="hidden" name="id_hotel" value="{{ $hotelRoom->id_hotel_room }}"
                                                required>
                                            <textarea class="form-control" name="short_description" id="short-description-form-input" cols="30"
                                                rows="3" maxlength="255" placeholder="{{ __('user_page.Make your short description here') }}">{{ $hotelRoom->short_description }}</textarea>
                                            <small id="err-shrt-desc" style="display: none;"
                                                class="invalid-feedback">{{ __('auth.empty_name') }}</small><br>
                                            <button type="submit" class="btn btn-sm btn-primary" id="btnSaveShortDesc"
                                                onclick="editShortDesc()">
                                                <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-secondary"
                                                onclick="editShortDescriptionCancel()">
                                                <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                            </button>

                                        </div>
                                    @endif
                                @endauth --}}
                                {{-- END SHORT DESCRIPTION --}}
                                <ul class="stories inner-wrap">

                                    @if (Auth::guest() || Auth::user()->role_id == 4)
                                        @if ($stories->count() == 0 && $video->count() == 0)
                                            <li class="story">
                                                <div class="img-wrap">
                                                    <a type="button"
                                                        onclick="requestVideo({'id': '{{ $hotel[0]->created_by }}', 'name': '{{ $hotel[0]->name }}'})">
                                                        <img class="lozad" src="{{ LazyLoad::show() }}"
                                                            data-src="{{ URL::asset('assets/2.png') }}">
                                                    </a>
                                                </div>
                                            </li>
                                        @endif
                                    @endif

                                    @auth
                                        @if (Auth::user()->id == $hotel[0]->created_by ||
                                            Auth::user()->role_id == 1 ||
                                            Auth::user()->role_id == 2 ||
                                            Auth::user()->role_id == 3)
                                            @if ($stories->count() == 0)
                                                @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $hotel[0]->created_by)
                                                    <li class="story">
                                                        <div class="img-wrap">
                                                            <a type="button" onclick="edit_story()">
                                                                <img src="{{ URL::asset('assets/add_story.png') }}">
                                                            </a>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if ($video->count() < 100)
                                                    <div class="containerSlider4">
                                                        <div id="slide-left-container4">
                                                            <div class="slide-left4">
                                                            </div>
                                                        </div>
                                                        <div id="cards-container4">
                                                            <div class="cards4">
                                                                @foreach ($video as $item)
                                                                    <div class="card4 col-lg-3 radius-5">
                                                                        <div class="img-wrap">
                                                                            <div class="video-position">
                                                                                <a type="button"
                                                                                    onclick="view({{ $item->id_video }});">
                                                                                    <div class="story-video-player"><i
                                                                                            class="fa fa-play"></i>
                                                                                    </div>
                                                                                    <video preload href=""
                                                                                        class="story-video-grid"
                                                                                        style="object-fit: cover;"
                                                                                        src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
                                                                                    </video>
                                                                                    @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                                        {{-- <a class="delete-story" href="javascript:void(0);" data-id="{{ $hotel[0]->id_hotel }}"
                                                                                        data-idstory="{{ $item->id_story }}"
                                                                                        onclick="delete_story({'id': '{{$hotel[0]->id_hotel}}',
                                                                                        'id_story': '{{$item->id_story}}'})"> --}}
                                                                                        <a class="delete-story"
                                                                                            href="javascript:void(0);"
                                                                                            onclick="">
                                                                                            {{-- <a href="{{ route('villa_delete_story', ['id' => $hotel[0]->id_hotel, 'id_story' => $item->id_story]) }}"> --}}
                                                                                            <i class="fa fa-trash"
                                                                                                style="color:red; margin-left: 25px;"
                                                                                                data-bs-toggle="popover"
                                                                                                data-bs-animation="true"
                                                                                                data-bs-placement="bottom"
                                                                                                title="{{ __('user_page.Delete') }}"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <div id="slide-right-container4">
                                                            <div class="slide-right4">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                @if ($stories->count() < 100)
                                                    @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $hotel[0]->created_by)
                                                        <li class="story">
                                                            <div class="img-wrap">
                                                                <a type="button" onclick="edit_story()">
                                                                    <img src="{{ URL::asset('assets/add_story.png') }}">
                                                                </a>
                                                            </div>
                                                        </li>
                                                    @endif
                                                    <div class="containerSlider4">
                                                        <div id="slide-left-container4">
                                                            <div class="slide-left4">
                                                            </div>
                                                        </div>
                                                        <div id="cards-container4">
                                                            <div class="cards4">
                                                                @foreach ($stories as $item)
                                                                    <div class="card4 col-lg-3 radius-5">
                                                                        <div class="img-wrap">
                                                                            <div class="video-position">
                                                                                @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $hotel[0]->created_by)
                                                                                    <a type="button"
                                                                                        onclick="view_story({{ $item->id_story }});">
                                                                                    @else
                                                                                        <a type="button"
                                                                                            onclick="showPromotionMobile()">
                                                                                @endif
                                                                                <div class="story-video-player"><i
                                                                                        class="fa fa-play"></i>
                                                                                </div>
                                                                                <video preload href=""
                                                                                    class="story-video-grid"
                                                                                    style="object-fit: cover;"
                                                                                    src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
                                                                                </video>
                                                                                @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                                    {{-- <a class="delete-story" href="javascript:void(0);" data-id="{{ $hotel[0]->id_hotel }}"
                                                                                            data-idstory="{{ $item->id_story }}"
                                                                                            onclick="delete_story({'id': '{{$hotel[0]->id_hotel}}',
                                                                                            'id_story': '{{$item->id_story}}'})"> --}}
                                                                                    <a class="delete-story"
                                                                                        href="javascript:void(0);"
                                                                                        onclick="delete_story({'id': '{{ $hotel[0]->id_hotel }}', 'id_story': '{{ $item->id_story }}'})">
                                                                                        {{-- <a href="{{ route('villa_delete_story', ['id' => $hotel[0]->id_hotel, 'id_story' => $item->id_story]) }}"> --}}
                                                                                        <i class="fa fa-trash"
                                                                                            style="color:red; margin-left: 25px;"
                                                                                            data-bs-toggle="popover"
                                                                                            data-bs-animation="true"
                                                                                            data-bs-placement="bottom"
                                                                                            title="{{ __('user_page.Delete') }}"></i>
                                                                                    </a>
                                                                                @endif
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                @foreach ($video as $item)
                                                                    <div class="card4 col-lg-3 radius-5">
                                                                        <div class="img-wrap">
                                                                            <div class="video-position">
                                                                                <a type="button"
                                                                                    onclick="view({{ $item->id_video }});">
                                                                                    <div class="story-video-player"><i
                                                                                            class="fa fa-play"></i>
                                                                                    </div>
                                                                                    <video preload href=""
                                                                                        class="story-video-grid"
                                                                                        style="object-fit: cover;"
                                                                                        src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
                                                                                    </video>
                                                                                    @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                                        {{-- <a class="delete-story" href="javascript:void(0);" data-id="{{ $hotel[0]->id_hotel }}"
                                                                                            data-idstory="{{ $item->id_story }}"
                                                                                            onclick="delete_story({'id': '{{$hotel[0]->id_hotel}}',
                                                                                            'id_story': '{{$item->id_story}}'})"> --}}
                                                                                        <a class="delete-story"
                                                                                            href="javascript:void(0);"
                                                                                            onclick="">
                                                                                            {{-- <a href="{{ route('villa_delete_story', ['id' => $hotel[0]->id_hotel, 'id_story' => $item->id_story]) }}"> --}}
                                                                                            <i class="fa fa-trash"
                                                                                                style="color:red; margin-left: 25px;"
                                                                                                data-bs-toggle="popover"
                                                                                                data-bs-animation="true"
                                                                                                data-bs-placement="bottom"
                                                                                                title="{{ __('user_page.Delete') }}"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <div id="slide-right-container4">
                                                            <div class="slide-right4">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    @endauth

                                    @if (Auth::guest() || Auth::user()->role_id == 4)
                                        <div class="containerSlider3">
                                            <div id="slide-left-container3">
                                                <div class="slide-left3">
                                                </div>
                                            </div>
                                            <div id="cards-container3">
                                                <div class="cards3">
                                                    @foreach ($stories as $item)
                                                        <div class="card3 col-lg-3 radius-5">
                                                            <div class="img-wrap" style="width: 70px; height: 70px;">
                                                                <div class="video-position"
                                                                    style="width: 70px; height: 70px;">
                                                                    @auth
                                                                        @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $hotel[0]->created_by)
                                                                            <a type="button"
                                                                                onclick="view_story({{ $item->id_story }});"style="height: 70px; width: 70px;">
                                                                            @else
                                                                                <a type="button"
                                                                                    onclick="showPromotionMobile()"
                                                                                    style="height: 70px; width: 70px;">
                                                                        @endif
                                                                    @endauth
                                                                    @guest
                                                                        <a type="button" onclick="showPromotionMobile()"
                                                                            style="height: 70px; width: 70px;">
                                                                        @endguest
                                                                        <div class="story-video-player"><i
                                                                                class="fa fa-play"></i>
                                                                        </div>
                                                                        <video preload href=""
                                                                            class="story-video-grid"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
                                                                        </video>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @foreach ($video as $item)
                                                        <div class="card3 col-lg-3 radius-5">
                                                            <div class="img-wrap" style="width: 70px; height: 70px;">
                                                                <div class="video-position"
                                                                    style="width: 70px; height: 70px;">
                                                                    <a type="button"
                                                                        onclick="view({{ $item->id_video }});"
                                                                        style="height: 70px; width: 70px;">
                                                                        <div class="story-video-player"><i
                                                                                class="fa fa-play"></i>
                                                                        </div>
                                                                        <video preload href=""
                                                                            class="story-video-grid"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
                                                                        </video>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div id="slide-right-container3">
                                                <div class="slide-right3">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-12 right-0">
                            </div>
                        </div>
                        {{-- END PROFILE --}}
                        {{-- STICKY BAR --}}
                        <div class="menu-liner"></div>
                        <div id="navbar" class="sticky-div">
                            <ul class="navigationList">
                                <li class="navigationItem">
                                    <a id="gallery-sticky" class="hoover font-13 navigationItem__Button"
                                        onClick="document.getElementById('gallery').scrollIntoView();">
                                        <i aria-label="Posts" class="far fa-image navigationItem__Icon svg-icon"
                                            fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                            {{ __('user_page.GALLERY') }}</span>
                                    </a>
                                </li>
                                <li class="navigationItem ">
                                    <a id="about-sticky" class="hoover font-13 navigationItem__Button"
                                        onClick="document.getElementById('description').scrollIntoView();">
                                        <i aria-label="Posts" class="far fa-list-alt navigationItem__Icon svg-icon"
                                            fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                            {{ __('user_page.ABOUT') }}</span>
                                    </a>
                                </li>
                                <li class="navigationItem ">
                                    <a id="amenities-sticky" class="hoover font-13 navigationItem__Button"
                                        onClick="document.getElementById('amenities').scrollIntoView();">
                                        <i aria-label="Posts" class="fas fa-bell navigationItem__Icon svg-icon"
                                            fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                            {{ __('user_page.AMENITIES') }}</span>
                                    </a>
                                </li>
                                {{-- <li class="navigationItem ">
                                    <a id="location-sticky" class="hoover font-13 navigationItem__Button"
                                        onClick="document.getElementById('location-map').scrollIntoView();">
                                        <i aria-label="Posts" class="fas fa-map-marker-alt navigationItem__Icon svg-icon"
                                            fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                            LOCATION</span>
                                    </a>
                                </li> --}}
                                <li class="navigationItem">
                                    <a id="availability-sticky" class="hoover font-13 navigationItem__Button"
                                        onClick="document.getElementById('availability').scrollIntoView();">
                                        <i aria-label="Posts"
                                            class="far fa-calendar-alt navigationItem__Icon svg-icon" fill="#262626"
                                            viewBox="0 0 20 20"></i><span>&nbsp
                                            {{ __('user_page.AVAILABILITY') }}</span>
                                    </a>
                                </li>
                                <li class="navigationItem">
                                    <a id="review-sticky" class="hoover font-13 navigationItem__Button"
                                        onClick="document.getElementById('review').scrollIntoView();">
                                        <i aria-label="Posts" class="fas fa-check navigationItem__Icon svg-icon"
                                            fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                            {{ __('user_page.REVIEW') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        {{-- END STICKY BAR --}}
                        {{-- PAGE CONTENT --}}
                        <div class="js-gallery">
                            {{-- GALLERY --}}

                            <section id="gallery" class="section">
                                <div class="col-12 row gallery">
                                    {{-- @if ($photo->count() > 0)
                                        @foreach ($photo as $item)
                                            <div class="col-4 grid-phooto">
                                                <a
                                                    href="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}">
                                                    <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery"
                                                        src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}"
                                                        title="{{ $item->caption }}">
                                                </a>
                                                @auth
                                                    @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                        <span class="edit-icon">
                                                            <button data-bs-toggle="popover" data-bs-animation="true"
                                                                data-bs-placement="bottom" type="button"
                                                                title="{{ __('user_page.Add Photo Caption') }}"
                                                                onclick=""><i
                                                                    class="fa fa-pencil"></i></button>
                                                            <button data-bs-toggle="popover" data-bs-animation="true"
                                                                data-bs-placement="bottom"
                                                                title="{{ __('user_page.Swap Photo Position') }}"
                                                                type="button" onclick="position_photo()"><i
                                                                    class="fa fa-arrows"></i></button>
                                                            <button data-bs-toggle="popover" data-bs-animation="true"
                                                                data-bs-placement="bottom"
                                                                title="{{ __('user_page.Delete Photo') }}"
                                                                href="javascript:void(0);"
                                                                onclick=""><i
                                                                    class="fa fa-trash"></i></button>
                                                        </span>
                                                    @endif
                                                @endauth
                                            </div>
                                        @endforeach
                                    @endif --}}
                                    {{-- @if ($video->count() > 0)
                                        @foreach ($video as $item)
                                            <div class="col-4 grid-photo">
                                                <a class="pointer-normal" onclick="view({{ $item->id_video }});"
                                                    href="javascript:void(0);">
                                                    <video href="javascript:void(0)" class="photo-grid" loading="lazy"
                                                        src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
                                                    </video>
                                                    <span class="video-grid-button"><i class="fa fa-play"></i></span>
                                                </a>
                                                @auth
                                                    @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                        <span class="edit-video-icon">
                                                            <button href="javascript:void(0);"
                                                                onclick=""
                                                                data-bs-toggle="popover" data-bs-animation="true"
                                                                data-bs-placement="bottom"
                                                                title="{{ __('user_page.Delete Video') }}"><i
                                                                    class="fa fa-trash"></i></button>
                                                            <button type="button" onclick="position_video()"
                                                                data-bs-toggle="popover" data-bs-animation="true"
                                                                data-bs-placement="bottom"
                                                                title="{{ __('user_page.Swap Video Position') }}"><i
                                                                    class="fa fa-arrows"></i></button>
                                                        </span>
                                                    @endif
                                                @endauth
                                            </div>
                                        @endforeach
                                    @endif --}}
                                    {{-- @if ($photo->count() <= 0 && $video->count() <= 0) --}}
                                    {{ __('user_page.there is no gallery yet') }}
                                    {{-- @endif --}}
                                </div>
                            </section>

                            {{-- END GALLERY --}}
                            {{-- ADD GALLERY --}}
                            @auth
                                @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <section style="padding-right: 10px; padding-left:5px; box-sizing: border-box;">
                                        <form class="dropzone dz-image-add" id="frmTarget">
                                            @csrf
                                            <div class="dz-message" data-dz-message>
                                                <span>{{ __('user_page.Click here to upload your files') }}</span>
                                            </div>
                                            <input type="hidden" value="" id="id_hotel_room"
                                                name="id_hotel_room">
                                        </form>
                                        <small id="err-dz" style="display: none;"
                                            class="invalid-feedback">{{ __('auth.empty_file') }}</small><br>
                                        <button type="submit" id="button" class="btn btn-primary">Upload</button>
                                    </section>
                                @endif
                            @endauth
                            {{-- END ADD GALLERY --}}
                            <section id="description" class="section-2">
                                {{-- Description --}}
                                <div class="about-place">
                                    <h2>{{ __('user_page.About this room') }}
                                        @auth
                                            @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                &nbsp;
                                                <a type="button" onclick="editDescriptionForm()"
                                                    style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                            @endif
                                        @endauth
                                    </h2>
                                    <p id="description-content">
                                        {{-- {!! Str::limit(Translate::translate($hotelRoom->room_description), 600, ' ...') ??__('user_page.There is no description yet') !!} --}}
                                        <span id="detail-room-description"></span>
                                    </p>
                                    {{-- @if (Str::length($hotelRoom->room_description) > 600)
                                        <a id="btnShowMoreDescription" style="font-weight: 600;" href="javascript:void(0);"
                                            onclick="showMoreDescription();"><span
                                                style="text-decoration: underline; color: #ff7400;">{{ __('user_page.Show more') }}</span>
                                            <span style="color: #ff7400;">></span></a>
                                    @endIf
                                    @auth
                                        @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <div id="description-form" style="display:none;">
                                                <input type="hidden" name="id_hotel_room"
                                                    value="{{ $hotelRoom->id_hotel_room }}" required>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="description" id="description-form-input" class="w-100" rows="5">{{ $hotelRoom->room_description }}</textarea>
                                                    <small id="err-desc" style="display: none;"
                                                        class="invalid-feedback">{{ __('auth.empty_desc') }}</small>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-primary" id="btnSaveDesc"
                                                        onclick="editDescription()">
                                                        <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                                    </button>
                                                    <button type="reset" class="btn btn-sm btn-secondary"
                                                        onclick="editDescriptionCancel()">
                                                        <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endauth --}}
                                    <hr>
                                </div>
                            </section>
                            <section id="amenities" class="section-2">
                                <div class="row-grid-amenities">
                                    <h2>
                                        {{ __('user_page.What this room offers') }}
                                        @auth
                                            @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                &nbsp;
                                                <a type="button" onclick="edit_amenities()"
                                                    style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                            @endif
                                        @endauth
                                    </h2>
                                </div>

                                {{-- <div class="row-grid-amenities">
                                    <div class="row-grid-list-amenities translate-text-group">
                                        @if ($hotel_amenities->count() >= 6)
                                            @foreach ($hotel_amenities->take(6) as $item1)
                                                <div class="list-amenities ">
                                                    <div class="text-align-center">
                                                        <i class="f-40 fa fa-{{ $item1->amenities->icon }}"></i>
                                                        <div class="mb-0 max-line">
                                                            <span class="translate-text-group-items">
                                                                {{ $item1->amenities->name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 list-more">
                                                        <span class="translate-text-group-items">
                                                            {{ $item1->amenities->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                        @if ($hotel_amenities->count() < 6)
                                            @foreach ($hotel_amenities->take(3) as $item1)
                                                <div class="list-amenities ">
                                                    <div class="text-align-center">
                                                        <i class="f-40 fa fa-{{ $item1->amenities->icon }}"></i>
                                                        <div class="mb-0 max-line">
                                                            <span class="translate-text-group-items">
                                                                {{ $item1->amenities->name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 list-more">
                                                        <span class="translate-text-group-items">
                                                            {{ $item1->amenities->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach ($bathroom->take(3) as $item2)
                                                <div class="list-amenities ">
                                                    <div class="text-align-center">
                                                        <i class="f-40 fa fa-{{ $item2->bathroom->icon }}"></i>
                                                        <div class="mb-0 max-line">
                                                            <span class="translate-text-group-items">
                                                                {{ $item2->bathroom->name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 list-more">
                                                        <span class="translate-text-group-items">
                                                            {{ $item2->bathroom->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach ($bedroom->take(3) as $item3)
                                                <div class="list-amenities ">
                                                    <div class="text-align-center">
                                                        <i class="f-40 fa fa-{{ $item3->bedroom->icon }}"></i>
                                                        <div class="mb-0 max-line">
                                                            <span class="translate-text-group-items">
                                                                {{ $item3->bedroom->name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 list-more">
                                                        <span class="translate-text-group-items">
                                                            {{ $item3->bedroom->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach ($safety->take(3) as $item4)
                                                <div class="list-amenities ">
                                                    <div class="text-align-center">
                                                        <i class="f-40 fa fa-{{ $item4->safety->icon }}"></i>
                                                        <div class="mb-0 max-line">
                                                            <span class="translate-text-group-items">
                                                                {{ $item4->safety->name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 list-more">
                                                        <span class="translate-text-group-items">
                                                            {{ $item4->safety->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="list-amenities">
                                            <button class="amenities-button" type="button" onclick="view_amenities()">
                                                <i class="fa-solid fa-ellipsis text-orange" style="font-size: 40px;"></i>
                                                <div style="font-size: 15px; font-weight: 600;"
                                                    class="translate-text-group-items">
                                                    {{ __('user_page.More') }}
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div> --}}
                                <hr>
                            </section>

                            <section id="availability" class="section-2">
                                <div class="pd-tlr-10">
                                    <h2>
                                        {{ __('user_page.Availability') }}
                                        {{-- @auth
                                            @if (Auth::user()->id == $hotelRoom->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                &nbsp;<a type="button" onclick="edit_price()"
                                                    style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                            @endif
                                        @endauth --}}
                                    </h2>
                                    <div class="desk-e-call">
                                        <div class="flatpickr-container"
                                            style="display: flex; justify-content: center;">
                                            <div
                                                style="display: table; background-color: white; padding: 70px 80px 80px 80px; border-radius: 15px; box-shadow: 1px 1px 10px #a4a4a4; margin-bottom: 25px;">
                                                <div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
                                                    class="col-lg-12">
                                                    <p style="margin: 0px; font-size: 13px;">
                                                        {{ __('user_page.Clear Dates') }}</p>
                                                </div>
                                                <div class="flatpickr" id="inline" style="text-align: left;">
                                                    {{-- <input type="hidden" id="id_hotel_room"
                                                        value="{{ $hotelRoom->id_hotel_room }}"> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- </div>
                                    <div class="mob-e-call">
                                        <div class="flatpickr-container" style="display: flex; justify-content: center;">
                                            <div class="flatpickr" id="inline2" style="text-align: left;">
                                                {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                                            </div>
                                        </div>
                                    </div> -->
                                        <hr>
                                    </div>
                            </section>
                        </div>
                        {{-- END PAGE CONTENT --}}
                        <!--
                        <div class="spacer">&nbsp;</div>
                        -->
                    </div>
                    {{-- END LEFT CONTENT --}}
                </div>
            </div>
            <div class="modal-filter-footer" style="height: 20px;">

            </div>
        </div>
    </div>
</div>
<script>
    function view_room(id) {
        $.ajax({
            type: "GET",
            url: '/hotel/room/' + id,
            success: function(data) {
                $('#name-content-room').text(data.type_room);
                $('#detail-room-size').text(data.room_size);
                $('#detail-room-capacity').text(data.capacity);
                $('#detail-room-bed').text(data.bed_type);
                $('#detail-room-total').text(data.number_of_room);
                $('#detail-room-short-desc').text(data.short_description);
                $('#detail-room-description').text(data.room_description);
                $('#modal-room').modal('show');
            },
            error: function(jqXHR, exception) {
                if (jqXHR.responseJSON.errors) {
                    for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                        iziToast.error({
                            title: "Error",
                            message: jqXHR.responseJSON.errors[i],
                            position: "topRight",
                        });
                    }
                } else {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.message,
                        position: "topRight",
                    });
                }

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");
            },
        })
    }
</script>
