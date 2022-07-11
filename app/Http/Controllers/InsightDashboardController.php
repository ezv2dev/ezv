<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Villa;
use App\Models\VillaBooking;
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
        $createdBy = Review::join('users', 'villa_review.created_by', '=', 'users.id')
            ->join('villa', 'villa_review.id_villa', '=', 'villa.id_villa')
            ->select('users.first_name', 'users.last_name', 'users.avatar', 'villa.name', 'value', 'comment', 'villa_review.created_at')
            ->paginate(3);

        $avg = Review::avg('value');
        $count = Review::count();

        return view('new-admin.insight.reviews', compact('createdBy', 'avg', 'count'));
    }

    public function views()
    {
        // ? START PAGE VIEWS COUNTER

        $villa_created = Villa::where('created_by', Auth::user()->id)->select('id_villa')->get();
        $views = VillaView::whereIn('id_villa', $villa_created)->count();

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

        // ! END PAGE VIEWS COUNTER

        // ? START BOOKING COUNTER
        $booking = VillaBooking::whereIn('id_villa', $villa_created)->count();

        $bookingMonth1 = VillaBooking::whereIn('villa.id_villa', $villa_created)
            ->where('villa_booking.status', 1)
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa')
            ->selectRaw('villa.name, year(villa_booking.created_at) year, month(villa_booking.created_at) as month, count(*) data')
            ->groupBy('villa.name', 'year', 'month')
            ->orderBy('villa.name', 'desc')
            ->get();

        $arrayBooking = array();

        $array_booking_month = array();
        foreach ($bookingMonth1 as $item) {
            $array_booking_month[$item['name']][$item->month] = $item->data;
        }

        $arrayBookingVilla = array();
        foreach ($array_booking_month as $key => $value) {
            $monthArray = array(
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            );

            foreach ($array_booking_month[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayBookingVilla[$key] = $monthArray;
            unset($arrayBookingVilla[$key][0]);
        }
        // ! END BOOKING COUNTER

        // ? START BOOKING RATE
        $viewRate = VillaView::whereIn('villa_views.id_villa', $villa_created)
            ->join('villa', 'villa_views.id_villa', '=', 'villa.id_villa')
            ->selectRaw('villa_views.name, year(villa_views.created_at) year, month(villa_views.created_at) as month, count(*) data')
            ->groupBy('villa_views.name', 'year', 'month')
            ->orderBy('name', 'desc')
            ->get();

        $bookingRate = VillaBooking::whereIn('villa.id_villa', $villa_created)
            ->where('villa_booking.status', 1)
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa')
            ->selectRaw('villa.name, year(villa_booking.created_at) year, month(villa_booking.created_at) as month, count(*) data')
            ->groupBy('villa.name', 'year', 'month')
            ->orderBy('villa.name', 'desc')
            ->get();

        // $array_1 = array();
        // foreach ($viewRate as $item) {
        //     array_push($array_1, $item->data);
        // }

        // dd($array_1);

        // ! END BOOKING RATE

        $villaChart = VillaView::whereIn('id_villa', $villa_created)->select('name')->groupBy('name')->get();
        return view('new-admin.insight.views', compact('views', 'villaChart', 'viewsMonth', 'arrayVilla', 'booking', 'arrayBookingVilla'));
    }

    public function superhost()
    {
        return view('new-admin.insight.superhost');
    }

    public function cleaning()
    {
        return view('new-admin.insight.cleaning');
    }

    public function five_star()
    {
        $createdBy = Review::join('users', 'villa_review.created_by', '=', 'users.id')
            ->join('villa', 'villa_review.id_villa', '=', 'villa.id_villa')
            ->select('users.first_name', 'users.last_name', 'users.avatar', 'villa.name', 'value', 'comment', 'villa_review.created_at')
            ->get();

        $avg = Review::avg('value');
        $count = Review::count();

        return view('new-admin.insight.reviews', compact('createdBy', 'avg', 'count'));
    }

    public function four_star()
    {
        return view('new-admin.insight.reviews');
    }

    public function three_star()
    {
        return view('new-admin.insight.reviews');
    }

    public function two_star()
    {
        return view('new-admin.insight.reviews');
    }

    public function one_star()
    {
        return view('new-admin.insight.reviews');
    }
}
