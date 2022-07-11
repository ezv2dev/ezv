@extends('new-admin.layouts.admin_layout')

@section('title', 'Notification Owner - EZV2')

@section('content_admin')
    <!-- Main page content-->
    <div class="container">
        <div id="reviews" class="pt-5 pb-5 text-dark">
            <div class="col-8">
                @forelse ($notificationOwners as $item)
                    <div class="card p-4 mt-4">
                        <div class="card-body">
                            <p class="mt-2" style="color: #ff7400">
                                {{ $item->created_at->format('j F, Y h:i:s A') }}</p>
                            <p class="mt-1 text-justify">{{ $item->message }}</p>
                        </div>
                    </div>

                @empty
                    <div class="rating-overview">
                        <h3><b>No message yet</b></h3>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="mt-3 d-flex justify-content-center">
            {!! $notificationOwners->appends(Request::all())->links() !!}
        </div>
    </div>

    @include('new-admin.layouts.footer')

@endsection
