<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivacySharingController extends Controller
{
    public function privacy_sharing()
    {
        return view('new-admin.partner.account.privacy-sharing.index');
    }
}
