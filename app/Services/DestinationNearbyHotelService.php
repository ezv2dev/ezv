<?php

namespace App\Services;

use App\Models\Villa;
use App\Models\Restaurant;
use App\Models\Hotel;
use App\Models\Activity;

class DestinationNearbyHotelService
{

    private static function radius()
    {
        return env('RADIUS_NEARBY_HOTEL');
    }

    public static function villa($id)
    {
        // * Get latitude Longitude Hotel
        $get_hotel = Hotel::where('id_hotel', $id)->first();
        $latitude1_hotel = $get_hotel->latitude;
        $longitude1_hotel = $get_hotel->longitude;
        // dd($latitude1_hotel, $longitude1_hotel);

        // * Get Latitude Longitude Nearby Villas
        $get_lat_long_villas = Villa::with([
            'photo', 'video', 'detailReview', 'propertyType', 'location'
        ])->where('status', '1')->get();
        // dd($get_lat_long_villas);

        // * Compare distance hotel and villas
        $point1 = array('lat' => $latitude1_hotel, 'long' => $longitude1_hotel, 'id_location');
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
        // * Get latitude Longitude Hotel
        $get_hotel = Hotel::where('id_hotel', $id)->first();
        $latitude1_hotel = $get_hotel->latitude;
        $longitude1_hotel = $get_hotel->longitude;
        // dd($latitude1_hotel, $longitude1_hotel);

        // * Get Latitude Longitude To Do Things
        $get_lat_long_todo = Activity::with([
            'video', 'photo', 'facilities', 'location', 'detailReview'
        ])->where('status', '1')->get();
        // dd($get_lat_long_todo);

        $point1 = array('lat' => $latitude1_hotel, 'long' => $longitude1_hotel, 'id_location');
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

    public static function restaurant($id)
    {
        // * Get latitude Longitude Hotel
        $get_hotel = Hotel::where('id_hotel', $id)->first();
        $latitude1_hotel = $get_hotel->latitude;
        $longitude1_hotel = $get_hotel->longitude;

        // * Get Latitude Longitude Restaurant
        $get_lat_long_restaurant = Restaurant::with([
            'video', 'photo', 'type', 'cuisine', 'location', 'detailReview'
        ])->where('status', '1')->get();

        $point1 = array('lat' => $latitude1_hotel, 'long' => $longitude1_hotel, 'id_location');

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
        // $filtered_data = array();
        // $radius = self::radius();
        // foreach ($kilometers as $data) {
        //     if ($data->kilometer <= $radius) {
        //         array_push($filtered_data, $data);
        //     }
        // }

        return $filtered_data;
    }
}
