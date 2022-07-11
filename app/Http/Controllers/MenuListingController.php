<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Villa;
use File;

class MenuListingController extends Controller
{
    public function index()
    {
        $this->authorize('listvilla_index');

        $data = Villa::where('created_by', Auth::user()->id)->count();

        return view('new-admin.listing.dashboard_listing', compact('data'));
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
