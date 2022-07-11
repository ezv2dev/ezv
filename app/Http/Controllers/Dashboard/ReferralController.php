<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function referral_index()
    {
        return view('new-admin.partner.account.referral.index');
    }
}
