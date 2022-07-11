<?php

namespace App\Services;

use App\Models\Villa;
use App\Models\Restaurant;
use App\Models\Hotel;
use App\Models\Activity;

class DestinationNearbyVillaService
{

    private static function radius()
    {
        return env('RADIUS_NEARBY_VILLA');
    }

    public static function restaurant($id)
    {
        // * Get latitude Longitude Villa
        $get_villa = Villa::where('id_villa', $id)->first();
        $latitude1_villa = $get_villa->latitude;
        $longitude1_villa = $get_villa->longitude;

        // * Get Latitude Longitude Restaurant
        $get_lat_long_restaurant = Restaurant::with([
            'video', 'photo', 'type', 'cuisine', 'location', 'detailReview'
        ])->where('status', '1')->get();

        $point1 = array('lat' => $latitude1_villa, 'long' => $longitude1_villa, 'id_location');

        $kilometers = array();
        $i = 0;
        foreach ($get_lat_long_restaurant as $item) {
            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $restaurant_detail = $item;
            $theta = $lon1 - $lon2;

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;

            $kilometers[$i] = (object)[
                'kilometer' => number_format((float)$miles * 1.609344, 1, '.', ''),
                'detail' => $restaurant_detail
            ];
            $i++;
        }

        // filter data

        $filtered_data = collect($kilometers)->sortBy('kilometer')->toArray();
        // $radius = self::radius();
        // foreach ($kilometers as $data) {
        //     if ($data->kilometer <= $radius) {
        //         array_push($filtered_data, $data);
        //     }
        // }

        return $filtered_data;
    }

    public static function activity($id)
    {
        // * Get latitude Longitude Villa
        $get_villa = Villa::where('id_villa', $id)->first();
        $latitude1_villa = $get_villa->latitude;
        $longitude1_villa = $get_villa->longitude;

        $point1 = array('lat' => $latitude1_villa, 'long' => $longitude1_villa, 'id_location');

        // * Get Latitude Longitude To Do Things
        $get_lat_long_todo = Activity::with([
            'video', 'photo', 'facilities', 'location', 'detailReview'
        ])->where('status', '1')->get();

        $kilometers2 = array();
        $j = 0;
        foreach ($get_lat_long_todo as $item) {
            $lat3 = $point1['lat'];
            $lon3 = $point1['long'];
            $lat4 = $item->latitude;
            $lon4 = $item->longitude;
            $todo_detail = $item;
            $theta2 = $lon3 - $lon4;

            $miles2 = (sin(deg2rad($lat3)) * sin(deg2rad($lat4))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta2)));
            $miles2 = acos($miles2);
            $miles2 = rad2deg($miles2);
            $miles2 = $miles2 * 60 * 1.1515;
            $kilometers2[$j] = (object)[
                'kilometer' => number_format((float)$miles2 * 1.609344, 1, '.', ''),
                'detail' => $todo_detail
            ];
            $j++;
        }

        // filter data

        $filtered_data = collect($kilometers2)->sortBy('kilometer')->toArray();
        // $radius = self::radius();
        // foreach ($kilometers2 as $data) {
        //     if ($data->kilometer <= $radius) {
        //         array_push($filtered_data, $data);
        //     }
        //     // if (true) {
        //     //     array_push($filtered_data, $data);
        //     // }
        // }

        return $filtered_data;
    }

    public static function hotel($id)
    {
        // * Get latitude Longitude Villa
        $get_villa = Villa::where('id_villa', $id)->first();
        $latitude1_villa = $get_villa->latitude;
        $longitude1_villa = $get_villa->longitude;

        $get_lat_long_hotel = Hotel::where('status', '1')->get();
        // dd($get_lat_long_hotel);

        $point1 = array('lat' => $latitude1_villa, 'long' => $longitude1_villa, 'id_location');
        $kilometers3 = array();
        $k = 0;
        foreach ($get_lat_long_hotel as $item) {
            $lat5 = $point1['lat'];
            $lon5 = $point1['long'];
            $lat6 = $item->latitude;
            $lon6 = $item->longitude;
            $theta3 = $lon5 - $lon6;

            $miles3 = (sin(deg2rad($lat5)) * sin(deg2rad($lat6))) + (cos(deg2rad($lat5)) * cos(deg2rad($lat6)) * cos(deg2rad($theta3)));
            $miles3 = acos($miles3);
            $miles3 = rad2deg($miles3);
            $miles3 = $miles3 * 60 * 1.1515;
            $kilometers3[$k] = (object)[
                'kilometer' => number_format((float)$miles3 * 1.609344, 1, '.', ''),
                'detail' => $item
            ];
            $k++;
        }
        // filter data
        $filtered_data = array();
        $radius = self::radius();
        foreach ($kilometers3 as $data) {
            if($data->kilometer <= $radius) {
                array_push($filtered_data, $data);
            }
            // if (true) {
            //     array_push($filtered_data, $data);
            // }
        }

        return $filtered_data;
    }
}
