<?php

namespace App\Services;

use App\Models\Villa;
use App\Models\Restaurant;
use App\Models\Hotel;
use App\Models\Activity;

class DestinationNearbyActivityService
{

    private static function radius()
    {
        return env('RADIUS_NEARBY_ACTIVITY');
    }

    public static function villa($id)
    {
        $get_thingstodo = Activity::where('id_activity', $id)->first();
        $latitude1_thingstodo = $get_thingstodo->latitude;
        $longitude1_thingstodo = $get_thingstodo->longitude;

        // * Get Latitude Longitude Nearby Villas
        $get_lat_long_villas = Villa::with([
            'photo', 'video', 'detailReview', 'propertyType', 'location'
        ])->where('status', '1')->get();
        // dd($get_lat_long_villas);

        // * Compare distance restaurant and villas
        $point1 = array(
            'lat' => $latitude1_thingstodo, 'long' => $longitude1_thingstodo, 'id_location'
        );
        $kilometers[] = array();
        $i = 0;

        foreach ($get_lat_long_villas as $item) {
            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $villas_detail = $item;
            $theta = $lon1 - $lon2;
            // dd($lat1, $lon1, $lat2, $lon2, $id_location_villas, $name_villas, $theta);

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers[$i] = (object)[
                'kilometer' => number_format((float)$miles * 1.609344, 1, '.', ''),
                'detail' => $villas_detail
            ];
            $i++;
        }

        //filter data
        
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

    public static function restaurant($id)
    {
        // * Get latitude Longitude Things To Do
        $get_thingstodo = Activity::where('id_activity', $id)->first();
        $latitude1_thingstodo = $get_thingstodo->latitude;
        $longitude1_thingstodo = $get_thingstodo->longitude;

        // * Get Latitude Longitude Restaurant
        $get_lat_long_restaurant = Restaurant::with([
            'video', 'photo', 'type', 'cuisine', 'location', 'detailReview'
        ])->where('status', '1')->get();
        // dd($get_lat_long_restaurant);

        $point1 = array(
            'lat' => $latitude1_thingstodo, 'long' => $longitude1_thingstodo, 'id_location'
        );
        // dd($point1);
        $kilometers = array();
        $i = 0;

        foreach ($get_lat_long_restaurant as $item) {
            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $restaurant_details = $item;
            $theta = $lon1 - $lon2;

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers[$i] = (object)[
                'kilometer' => number_format((float)$miles * 1.609344, 1, '.', ''),
                'detail' => $restaurant_details
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

    public static function hotel($id)
    {
        // * Get latitude Longitude Things To Do
        $get_thingstodo = Activity::where('id_activity', $id)->first();
        $latitude1_thingstodo = $get_thingstodo->latitude;
        $longitude1_thingstodo = $get_thingstodo->longitude;
        // dd($get_restaurant, $latitude1_restaurant, $longitude1_restaurant);

        $get_lat_long_hotel = Hotel::where('status', '1')->get();
        // dd($get_lat_long_hotel);

        $point1 = array('lat' => $latitude1_thingstodo, 'long' => $longitude1_thingstodo, 'id_location');
        $kilometers = array();
        $i = 0;
        foreach ($get_lat_long_hotel as $item) {
            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $hotel_details = $item;
            $theta = $lon1 - $lon2;

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers[$i] = (object)[
                'kilometer' => number_format((float)$miles * 1.609344, 1, '.', ''),
                'detail' => $hotel_details
            ];
            $i++;
        }

        // filter data
        $filtered_data = array();
        $radius = self::radius();
        foreach ($kilometers as $data) {
            if ($data->kilometer <= $radius) {
                array_push($filtered_data, $data);
            }
            // if(true) {
            //     array_push($filtered_data, $data);
            // }
        }

        // return data
        return $filtered_data;
    }
}
