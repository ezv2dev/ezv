<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function help_guest()
    {
        return view('new-admin.help.help_guest');
    }

    public function help_host()
    {
        return view('new-admin.help.help_host');
    }

    public function help_experience_host()
    {
        return view('new-admin.help.help_experience_host');
    }

    public function help_travel_admin()
    {
        return view('new-admin.help.help_travel_admin');
    }
}
