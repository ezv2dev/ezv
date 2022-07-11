<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\PopularDestinations;
use App\Services\DeviceCheckService;
use App\Models\Location;

class HomeController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('status', 1)->get()->shuffle()->sortBy('grade');
        $activity = Activity::where('status', 1)->get()->shuffle()->sortBy('grade');
        $popular_destination = PopularDestinations::with('location')->get();

        // return view('home');
        // if (DeviceCheckService::isMobile()) {
        //     return view('user.m-index')->with(compact('restaurant', 'activity', 'popular_destination'));
        // }
        // if (DeviceCheckService::isDesktop()) {
        //     return view('user.index')->with(compact('restaurant', 'activity', 'popular_destination'));
        // }
        return view('user.index')->with(compact('restaurant', 'activity', 'popular_destination'));
    }

    public function get_lat_long(Request $request)
    {
        // dd($request->all());
        $latitudeUser = $request->latitudeUser;
        $longitudeUser = $request->longitudeUser;
        $ip = request()->ip();

        $url = "http://ipinfo.io/".$ip."/geo";

        try {
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $url);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($c);
            curl_close($c);
            $json = json_decode($response, true);
            $value = $json['city'];
        } catch (\Throwable $th) {
            $value = null;
            return $value;
        }

        $loc = $json['loc'];
        $pisah = explode(",", $loc);

        $location = Location::select('id_location','name','latitude','longitude')->get();

        $i = 0;

        $data = [];

        foreach ($location as $item)
        {
            $point1 = array('lat' => $pisah[0], 'long' => $pisah[1]);

            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;

            $location_detail = $item;
            $theta = $lon1 - $lon2;

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $data[$i]['kilometer'] = number_format((float)$miles * 1.609344, 1, '.', '');
            $data[$i]['location'] = $location_detail->name;

            $i++;
        }

        $newData = collect($data);
        $filtered_data = $newData->sortBy('kilometer')->values()->all();
        $location = $filtered_data[0]['location'];

        return $location;
    }
}
