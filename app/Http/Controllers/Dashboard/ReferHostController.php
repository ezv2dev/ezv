<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use Illuminate\Http\Request;

class ReferHostController extends Controller
{
    public function index()
    {
        return view('new-admin.refer-host.refer-host');
    }

    public function datatable()
    {
        // $this->authorize('ref_index');
        return Referral::datatables();
    }
}
