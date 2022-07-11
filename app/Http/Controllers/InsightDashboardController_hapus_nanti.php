<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\VillaView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('new-admin.insight.earnings');
    }

    public function views()
    {
        $villa_created = Villa::where('created_by', Auth::user()->id)->select('id_villa')->get();
        // dd($villa_created);

        $views = VillaView::whereIn('id_villa', $villa_created)->count();

        // dd($views);

        $viewsMonth = VillaView::whereIn('id_villa', $villa_created)
            ->selectRaw('name, year(created_at) year, month(created_at) as month, count(*) data')
            ->groupBy('name', 'year', 'month')
            ->orderBy('name', 'desc')
            ->get();

        $array_month = array();
        foreach ($viewsMonth as $item) {
            $array_month[$item['name']][$item->month] = $item->data;
        }

        $arrayVilla = array();

        foreach ($array_month as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($array_month[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayVilla[$key] = $monthArray;
            unset($arrayVilla[$key][0]);
        }
        // dd($arrayVilla);

        // dd(json_encode(array_values($arrayVilla["Villa Test Again"])));

        $villaChart = VillaView::whereIn('id_villa', $villa_created)->select('name')->groupBy('name')->get();
        return view('new-admin.insight.views', compact('views', 'villaChart', 'viewsMonth', 'arrayVilla'));
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
