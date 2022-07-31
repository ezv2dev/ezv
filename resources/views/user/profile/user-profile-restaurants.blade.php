@extends('user.profile.layout-profile')

@section('title', 'User Profile - EZV2')

@section('content_admin')
    <div class="container mb-5">
        <div class="row">
            <div class="col-2">
                @if (Auth::user()->foto_profile != null)
                    <img class="img-fluid" src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                @elseIf (Auth::user()->avatar != null)
                    <img class="img-fluid" src="{{ Auth::user()->avatar }}">
                @else
                    <img class="img-fluid" src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}">
                @endif
            </div>

            <div class="col-8">
                <h1>
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </h1>

                <p>
                    <b>Address</b>
                    @if (Auth::user()->address == null)
                        -
                    @else
                        {{ Auth::user()->address }}
                    @endif
                </p>

                <p>
                    <b>Email</b>
                    {{ Auth::user()->email }}
                </p>

                <p>
                    <b>Phone</b>
                    @if (Auth::user()->phone == null)
                        -
                    @else
                        {{ Auth::user()->phone }}
                    @endif
                </p>

                <p style="color: #FF7400">
                    <b>User ID</b>
                    {{ Auth::user()->user_code }}
                </p>

                <p>
                    <b>Balance</b>
                    IDR {{ number_format($sumArray) }}
                </p>

                <div class="col-6" style="margin-left: 0; padding: 0;">
                    <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                        data-target="#exampleModal">
                        Edit Profile
                    </button>
                </div>
            </div>

            {{-- <div class="col-2 d-flex justify-content-center">
                <a href="{{ route('reward_program') }}" style="text-decoration: none !important;">
                    <img src="https://cdn-icons-png.flaticon.com/512/1426/1426708.png" class="img-fluid"
                        style="height:80px; width: 80px; cursor: pointer; margin-left: 25px;">
                    <p class="font-weight-bolder">Reward Program</p>
                </a>
            </div> --}}
        </div>

        <div class="row d-flex justify-content-center text-center my-5">
            <div class="col-2">
                <a href="{{ route('profile_index') }}" class="black" style="text-decoration: none !important;">
                    <i class="fa-solid fa-house" style="font-size:40px;"></i>
                    <p>Homes</p>
                </a>
            </div>
            <div class="col-2">
                <a href="{{ route('profile_hotels') }}" class="black" style="text-decoration: none !important;">
                    <i class="fa fa-bed" style="font-size:40px;"></i>
                    <p>Hotels</p>
                </a>
            </div>
            <div class="col-2">
                <a href="{{ route('profile_restaurants') }}" class="black" style="text-decoration: none !important;">
                    <i class="fa-solid fa-utensils" style="font-size:40px;"></i>
                    <p class="font-weight-600">Foods</p>
                </a>
            </div>
            <div class="col-2">
                <a href="{{ route('profile_activities') }}" class="black" style="text-decoration: none !important;">
                    <i class="fa-solid fa-person-hiking" style="font-size:40px;"></i>
                    <p>WoW</p>
                </a>
            </div>
        </div>

        @foreach ($location as $item)
            <div class="container-fluid">
                <h1 class="text-center mt-2">Restaurants in {{ $item->name }}</h1>
                <div class="Container">
                    <div class="list-menu-slider">
                        @foreach ($save->where('id_location', $item->id_cek) as $item2)
                            <div class="ProductBlock">
                                <div class="Content">
                                    <div class="img-fill">
                                        <img
                                            src="{{ URL::asset('/foto/restaurant/' . strtolower($item2->uid) . '/' . $item2->image) }}">
                                    </div>
                                    <h3>{{ Str::limit($item2->name, 15) }}</h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile_update', Auth::user()->id) }}" method="POST" id="basic-form"
                            class="js-validation" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-1">
                                <label class="col-4 col-form-label" for="first_name">First Name</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="Input First Name" value="{{ Auth::user()->first_name }}">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-4 col-form-label" for="last_name">Last Name</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="Input Last Name" value="{{ Auth::user()->last_name }}">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-4 col-form-label" for="address">Address</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Input Address" value="{{ Auth::user()->address }}">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-4 col-form-label" for="email">Email</label>
                                <div class="col-8">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Input Email" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-4 col-form-label" for="phone">Phone</label>
                                <div class="col-8">
                                    <input type="number" class="form-control" id="phone" name="phone"
                                        placeholder="Input Phone" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
