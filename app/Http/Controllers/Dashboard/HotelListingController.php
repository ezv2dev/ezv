<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HotelListingController extends Controller
{
    public function index()
    {
        $data = Hotel::where('created_by', Auth::user()->id)->count();

        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $hotel = Hotel::with('location')->paginate(10);
        } else {
            $hotel = Hotel::with('location')->where('created_by', Auth::user()->id)->paginate(10);
        }

        return view('new-admin.hotel.dashboard_hotel_listing', compact('data', 'hotel'));
    }
}
