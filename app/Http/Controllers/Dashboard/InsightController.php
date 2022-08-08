<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityStatistic;
use App\Models\Hotel;
use App\Models\HotelStatistic;
use App\Models\Restaurant;
use App\Models\RestaurantStatistic;
use App\Models\Villa;
use App\Models\VillaStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsightController extends Controller
{
    public function homes()
    {
        $villa_created = Villa::where('created_by', Auth::user()->id)->select('id_villa')->get();
        $viewsMonth = VillaStatistic::with('villa')->whereIn('id_villa', $villa_created)->get();

        $array_month = array();
        foreach ($viewsMonth as $item) {
            $array_month[$item->villa->name][$item->month] = $item->villa_views;
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

        return view('new-admin.insight.insight_homes', compact('arrayVilla'));
    }

    public function hotel()
    {
        $hotel_created = Hotel::where('created_by', Auth::user()->id)->select('id_hotel')->get();
        $viewsMonth = HotelStatistic::with('hotel')->whereIn('id_hotel', $hotel_created)->get();

        $array_month = array();
        foreach ($viewsMonth as $item) {
            $array_month[$item->hotel->name][$item->month] = $item->hotel_views;
        }

        $arrayHotel = array();
        foreach ($array_month as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($array_month[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayHotel[$key] = $monthArray;
            unset($arrayHotel[$key][0]);
        }

        return view('new-admin.insight.insight_hotel', compact('arrayHotel'));
    }

    public function food()
    {
        $restaurant_created = Restaurant::where('created_by', Auth::user()->id)->select('id_restaurant')->get();
        $viewsMonth = RestaurantStatistic::with('restaurant')->whereIn('id_restaurant', $restaurant_created)->get();

        $array_month = array();
        foreach ($viewsMonth as $item) {
            $array_month[$item->restaurant->name][$item->month] = $item->restaurant_views;
        }

        $arrayRestaurant = array();
        foreach ($array_month as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($array_month[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayRestaurant[$key] = $monthArray;
            unset($arrayRestaurant[$key][0]);
        }
        return view('new-admin.insight.insight_food', compact('arrayRestaurant'));
    }

    public function wow()
    {
        $activity_created = Activity::where('created_by', Auth::user()->id)->select('id_activity')->get();
        $viewsMonth = ActivityStatistic::with('activity')->whereIn('id_activity', $activity_created)->get();

        $array_month = array();
        foreach ($viewsMonth as $item) {
            $array_month[$item->activity->name][$item->month] = $item->activity_views;
        }

        $arrayActivity = array();
        foreach ($array_month as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($array_month[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayActivity[$key] = $monthArray;
            unset($arrayActivity[$key][0]);
        }
        return view('new-admin.insight.insight_wow', compact('arrayActivity'));
    }
}
