<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VillaBooking;
use Response;
use Auth;
use App\Models\VillaAvailability;

class EarningsController extends Controller
{
    public function earnings()
    {
        $data = VillaBooking::select
        (\DB::raw("SUM(total_price) as total"), \DB::raw("Month(check_in) as month"), \DB::raw("Year(check_in) as year"))
        ->whereYear('check_in', date('Y'))
        ->groupBy('month')
        ->groupBy('year')
        ->where('status',1)
        ->where('created_by', Auth::user()->id)
        ->get();

        $chart = array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach ($data as $item)
        {
            $chart[($item->month)-1] = $item->total;
        }

        // dd($chart)

        return view('new-admin.insight.earnings',compact('chart'));
        // return view('new-admin.insight.earnings');
    }

    public function getEarnings(Request $request, $id)
    {
        if ($request->ajax())
        {
            $total = VillaBooking::select
            (\DB::raw("SUM(total_price) as total"))
            ->whereYear('check_in', $id)
            // ->groupBy('month')
            // ->groupBy('year')
            ->where('status',1)
            ->where('created_by', Auth::user()->id)
            ->pluck('total');

    		return response()->json(['total'=>$total]);
        }
    }

    public function chart(Request $request, $id)
    {
        if ($request->ajax())
        {
            $data = VillaBooking::select
            (\DB::raw("SUM(total_price) as total"), \DB::raw("Month(check_in) as month"), \DB::raw("Year(check_in) as year"))
            ->whereYear('check_in', $id)
            ->groupBy('month')
            ->groupBy('year')
            ->where('status',1)
            ->where('created_by', Auth::user()->id)
            ->get();

            $chart = array(0,0,0,0,0,0,0,0,0,0,0,0);

            foreach ($data as $item)
            {
                $chart[($item->month)-1] = $item->total;
            }

    		// return Response::json($chart);
            return response()->json($chart)->setEncodingOptions(JSON_NUMERIC_CHECK);
        }
    }
}
