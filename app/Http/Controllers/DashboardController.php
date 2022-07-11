<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
        // return view('new-admin.partner.dashboard_partner');
        // return view('new-admin.dashboard');
    }
}
