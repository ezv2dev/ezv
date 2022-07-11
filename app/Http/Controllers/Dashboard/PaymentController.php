<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payments()
    {
        return view('new-admin.partner.account.payments-payouts.payments.payments');
    }

    public function payouts()
    {
        return view('new-admin.partner.account.payments-payouts.payouts.payouts');
    }

    public function taxes()
    {
        return view('new-admin.partner.account.payments-payouts.taxes.taxes');
    }

    public function guest_contributions()
    {
        return view('new-admin.partner.account.payments-payouts.guest-contributions.guest-contributions');
    }
}
