<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InsightController extends Controller
{
    public function homes()
    {
        return view('new-admin.insight.insight_homes');
    }

    public function hotel()
    {
        return view('new-admin.insight.insight_hotel');
    }

    public function food()
    {
        return view('new-admin.insight.insight_food');
    }

    public function wow()
    {
        return view('new-admin.insight.insight_wow');
    }
}
