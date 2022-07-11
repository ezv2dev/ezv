<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\VillaView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VillaBooking;

class InsightDashboardController extends Controller
{
    public function index()
    {
        return view('new-admin.insight.opportunity');
    }

    public function reviews()
    {
        return view('new-admin.insight.reviews');
    }

    public function earnings()
    {
        $data = VillaBooking::select
        (\DB::raw("SUM(total_price) as total"), \DB::raw("Month(check_in) as month"), \DB::raw("Year(check_in) as year"))
        ->whereYear('check_in', date('Y'))
        ->groupBy('month')
        ->groupBy('year')
        ->where('status',1)
        ->get();

        $chart = array(0,0,0,0,0,0,0,0,0,0,0,0,0);

        foreach ($data as $item)
        {
            $chart[($item->month)-1] = $item->total;
        }

        // dd($chart);

        return view('new-admin.insight.earnings',compact('chart'));
        // return view('new-admin.insight.earnings');
    }

    public function views()
    {
        $villa_created = Villa::where('created_by', Auth::user()->id)->select('id_villa')->get();
        // dd($villa_created);

        $views = VillaView::whereIn('id_villa', $villa_created)->count();

        $villaChart = VillaView::whereIn('id_villa', $villa_created)->select('name')->groupBy('name')->get();
        // dd($villaChart[0]['name']);

        $villa_array = array();
        foreach ($villaChart as $item) {
            array_push($villa_array, $item['name']);
        }

        // dd(json_encode($villa_array));

        return view('new-admin.insight.views', compact('views', 'villa_array', 'villaChart'));
    }

    public function superhost()
    {
        return view('new-admin.insight.superhost');
    }

    public function cleaning()
    {
        return view('new-admin.insight.cleaning');
    }
}
