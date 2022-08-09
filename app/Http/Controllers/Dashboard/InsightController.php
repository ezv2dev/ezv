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
        $villaStatistic = VillaStatistic::with('villa')->whereIn('id_villa', $villa_created)->get();

        $tempVilla = array();
        foreach ($villaStatistic as $item) {
            $tempVilla[$item->villa->name][$item->month] = $item->villa_views;
        }

        $arrayVilla = array();
        foreach ($tempVilla as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempVilla[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayVilla[$key] = $monthArray;
            unset($arrayVilla[$key][0]);
        }

        $tempPhoto = array();
        foreach ($villaStatistic as $item) {
            $tempPhoto[$item->villa->name][$item->month] = $item->photo_views;
        }

        $arrayPhoto = array();
        foreach ($tempPhoto as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempPhoto[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayPhoto[$key] = $monthArray;
            unset($arrayPhoto[$key][0]);
        }

        $tempVideo = array();
        foreach ($villaStatistic as $item) {
            $tempVideo[$item->villa->name][$item->month] = $item->video_views;
        }

        $arrayVideo = array();
        foreach ($tempVideo as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempVideo[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayVideo[$key] = $monthArray;
            unset($arrayVideo[$key][0]);
        }

        return view('new-admin.insight.insight_homes', compact('arrayVilla', 'arrayPhoto', 'arrayVideo'));
    }

    public function hotel()
    {
        $hotelCreated = Hotel::where('created_by', Auth::user()->id)->select('id_hotel')->get();
        $hotelStatistic = HotelStatistic::with('hotel')->whereIn('id_hotel', $hotelCreated)->get();

        $tempHotel = array();
        foreach ($hotelStatistic as $item) {
            $tempHotel[$item->hotel->name][$item->month] = $item->hotel_views;
        }

        $arrayHotel = array();
        foreach ($tempHotel as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempHotel[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayHotel[$key] = $monthArray;
            unset($arrayHotel[$key][0]);
        }

        $tempPhoto = array();
        foreach ($hotelStatistic as $item) {
            $tempPhoto[$item->hotel->name][$item->month] = $item->photo_views;
        }

        $arrayPhoto = array();
        foreach ($tempPhoto as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempPhoto[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayPhoto[$key] = $monthArray;
            unset($arrayPhoto[$key][0]);
        }

        $tempVideo = array();
        foreach ($hotelStatistic as $item) {
            $tempVideo[$item->hotel->name][$item->month] = $item->video_views;
        }

        $arrayVideo = array();
        foreach ($tempVideo as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempVideo[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayVideo[$key] = $monthArray;
            unset($arrayVideo[$key][0]);
        }

        return view('new-admin.insight.insight_hotel', compact('arrayHotel', 'arrayPhoto', 'arrayVideo'));
    }

    public function food()
    {
        $restaurantCreated = Restaurant::where('created_by', Auth::user()->id)->select('id_restaurant')->get();
        $restaurantStatistic = RestaurantStatistic::with('restaurant')->whereIn('id_restaurant', $restaurantCreated)->get();

        $tempRestaurant = array();
        foreach ($restaurantStatistic as $item) {
            $tempRestaurant[$item->restaurant->name][$item->month] = $item->restaurant_views;
        }

        $arrayRestaurant = array();
        foreach ($tempRestaurant as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempRestaurant[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayRestaurant[$key] = $monthArray;
            unset($arrayRestaurant[$key][0]);
        }

        $tempPhoto = array();
        foreach ($restaurantStatistic as $item) {
            $tempPhoto[$item->restaurant->name][$item->month] = $item->photo_views;
        }

        $arrayPhoto = array();
        foreach ($tempPhoto as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempPhoto[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayPhoto[$key] = $monthArray;
            unset($arrayPhoto[$key][0]);
        }

        $tempVideo = array();
        foreach ($restaurantStatistic as $item) {
            $tempVideo[$item->restaurant->name][$item->month] = $item->video_views;
        }

        $arrayVideo = array();
        foreach ($tempVideo as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempVideo[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayVideo[$key] = $monthArray;
            unset($arrayVideo[$key][0]);
        }

        return view('new-admin.insight.insight_food', compact('arrayRestaurant', 'arrayPhoto', 'arrayVideo'));
    }

    public function wow()
    {
        $activityCreated = Activity::where('created_by', Auth::user()->id)->select('id_activity')->get();
        $activityStatistic = ActivityStatistic::with('activity')->whereIn('id_activity', $activityCreated)->get();

        $tempActivity = array();
        foreach ($activityStatistic as $item) {
            $tempActivity[$item->activity->name][$item->month] = $item->activity_views;
        }

        $arrayActivity = array();
        foreach ($tempActivity as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempActivity[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayActivity[$key] = $monthArray;
            unset($arrayActivity[$key][0]);
        }

        $tempPhoto = array();
        foreach ($activityStatistic as $item) {
            $tempPhoto[$item->activity->name][$item->month] = $item->photo_views;
        }

        $arrayPhoto = array();
        foreach ($tempPhoto as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempPhoto[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayPhoto[$key] = $monthArray;
            unset($arrayPhoto[$key][0]);
        }

        $tempVideo = array();
        foreach ($activityStatistic as $item) {
            $tempVideo[$item->activity->name][$item->month] = $item->video_views;
        }

        $arrayVideo = array();
        foreach ($tempVideo as $key => $value) {
            $monthArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

            foreach ($tempVideo[$key] as $key2 => $value2) {
                $monthArray[$key2] = $value2;
            }

            $arrayVideo[$key] = $monthArray;
            unset($arrayVideo[$key][0]);
        }

        return view('new-admin.insight.insight_wow', compact('arrayActivity', 'arrayPhoto', 'arrayVideo'));
    }
}
