<?php

namespace App\Services;

use App\Models\Villa;
use App\Models\Restaurant;
use App\Models\Hotel;
use App\Models\Activity;

class DestinationNearbyRestaurantService
{

    private static function radius()
    {
        return env('RADIUS_NEARBY_RESTAURANT');
    }

    public static function villa($id)
    {
        // * Get latitude Longitude Restaurant
        $get_restaurant = Restaurant::where('id_restaurant', $id)->first();
        $latitude1_restaurant = $get_restaurant->latitude;
        $longitude1_restaurant = $get_restaurant->longitude;
        // dd($latitude1_restaurant, $longitude1_restaurant);

        // * Get Latitude Longitude Nearby Villas
        $get_lat_long_villas = Villa::with([
            'photo', 'video', 'detailReview', 'propertyType', 'location'
        ])->where('status', '1')->get();
        // dd($get_lat_long_villas);

        // * Compare distance restaurant and villas
        $point1 = array('lat' => $latitude1_restaurant, 'long' => $longitude1_restaurant, 'id_location');
        $kilometers = [];
        $i = 0;

        foreach ($get_lat_long_villas as $item) {
            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $theta = $lon1 - $lon2;
            // dd($lat1, $lon1, $lat2, $lon2, $get_lat_long_villas, $theta);

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;

            $kilometers[$i] = (object)[
                'kilometer' => number_format((float)$miles * 1.609344, 1, '.', ''),
                'detail' => $item
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

        // return data
        return $filtered_data;
    }

    public static function activity($id)
    {
        // * Get latitude Longitude Restaurant
        $get_restaurant = Restaurant::where('id_restaurant', $id)->first();
        $latitude1_restaurant = $get_restaurant->latitude;
        $longitude1_restaurant = $get_restaurant->longitude;
        // dd($latitude1_restaurant, $longitude1_restaurant);

        // * Get Latitude Longitude To Do Things
        $get_lat_long_todo = Activity::with([
            'video', 'photo', 'facilities', 'location', 'detailReview'
        ])->where('status', '1')->get();
        // dd($get_lat_long_todo);

        $point1 = array('lat' => $latitude1_restaurant, 'long' => $longitude1_restaurant, 'id_location');
        $kilometers2 = [];
        $j = 0;
        foreach ($get_lat_long_todo as $item) {
            $lat3 = $point1['lat'];
            $lon3 = $point1['long'];
            $lat4 = $item->latitude;
            $lon4 = $item->longitude;
            // $todo_detail = $item;
            $theta2 = $lon3 - $lon4;
            // dd($lat3, $lon3, $lat4, $lon4, $get_lat_long_todo, $theta2);

            $miles2 = (sin(deg2rad($lat3)) * sin(deg2rad($lat4))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta2)));
            $miles2 = acos($miles2);
            $miles2 = rad2deg($miles2);
            $miles2 = $miles2 * 60 * 1.1515;

            $kilometers2[$j] = (object)[
                'kilometer' => number_format((float)$miles2 * 1.609344, 1, '.', ''),
                'detail' => $item
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
        // }

        return $filtered_data;
    }

    public static function hotel($id)
    {
        // * Get latitude Longitude Restaurant
        $get_restaurant = Restaurant::where('id_restaurant', $id)->first();
        $latitude1_restaurant = $get_restaurant->latitude;
        $longitude1_restaurant = $get_restaurant->longitude;
        // dd($get_restaurant, $latitude1_restaurant, $longitude1_restaurant);

        $get_lat_long_hotel = Hotel::with([
            'photo',
            'video'
        ])->where('status', '1')->get();
        // dd($get_lat_long_hotel);

        $point1 = array('lat' => $latitude1_restaurant, 'long' => $longitude1_restaurant, 'id_location');
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
            if ($data->kilometer <= $radius) {
                array_push($filtered_data, $data);
            }
            // if (true) {
            //     array_push($filtered_data, $data);
            // }
        }

        return $filtered_data;
    }
}
