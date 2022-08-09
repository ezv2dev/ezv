<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Villa;
use Carbon\Carbon;
use File;

class MenuListingController extends Controller
{
    public function index()
    {
        $this->authorize('listvilla_index');

        $data = Villa::where('created_by', Auth::user()->id)->count();

        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $villa = Villa::with('location')->paginate(10);
        } else {
            $villa = Villa::with('location')->where('created_by', Auth::user()->id)->paginate(10);
        }

        return view('new-admin.listing.dashboard_listing', compact('data', 'villa'));
    }

    public function datatable()
    {
        $this->authorize('listvilla_index');
        return villa::datatablesListing();
    }

    public function editListing()
    {
        return view('new-admin.listing.edit_listing_dashboard');
    }
}
