<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\PopularDestinations;
use App\Services\DeviceCheckService;
use App\Models\Location;
use App\Models\Villa;

class HomeController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('status', 1)->limit(9)->get()->shuffle()->sortBy('grade');
        $activity = Activity::where('status', 1)->limit(9)->get()->shuffle()->sortBy('grade');

        // fetch restaurant
        // $restaurant_aa = Restaurant::where('status', 1)->where('grade','AA')->inRandomOrder()->limit(9)->get();
        // $restaurant = collect();
        // $restaurant->merge($restaurant_aa);
        // if($restaurant->count() < 9){
        //     $restaurant_a = Restaurant::where('status', 1)->where('grade','A')->inRandomOrder()->limit(9 - $restaurant->count())->get();
        //     $restaurant_a->each(function ($item, $key) use($restaurant) {
        //         $restaurant->push($item);
        //     });
        //     if($restaurant->count() < 9){
        //         $restaurant_b = Restaurant::where('status', 1)->where('grade','B')->inRandomOrder()->limit(9 - $restaurant->count())->get();
        //         $restaurant_b->each(function ($item, $key) use($restaurant) {
        //             $restaurant->push($item);
        //         });
        //         if($restaurant->count() < 9){
        //             $restaurant_c = Restaurant::where('status', 1)->where('grade','C')->inRandomOrder()->limit(9 - $restaurant->count())->get();
        //             $restaurant_c->each(function ($item, $key) use($restaurant) {
        //                 $restaurant->push($item);
        //             });
        //             if($restaurant->count() < 9){
        //                 $restaurant_d = Restaurant::where('status', 1)->where('grade','D')->inRandomOrder()->limit(9 - $restaurant->count())->get();
        //                 $restaurant_d->each(function ($item, $key) use($restaurant) {
        //                     $restaurant->push($item);
        //                 });
        //                 if($restaurant->count() < 9){
        //                     $restaurant_null = Activity::where('status', 1)->where('grade', null)->inRandomOrder()->limit(9 - $restaurant->count())->get();
        //                     $restaurant_null->each(function ($item, $key) use($restaurant) {
        //                         $restaurant->push($item);
        //                     });
        //                 }
        //             }
        //         }
        //     }
        // }

        // fetch activity
        // $activity_aa = Activity::where('status', 1)->where('grade','AA')->inRandomOrder()->limit(9)->get();
        // $activity = collect();
        // $activity->merge($activity_aa);
        // if($activity->count() < 9){
        //     $activity_a = Activity::where('status', 1)->where('grade','A')->inRandomOrder()->limit(9 - $activity->count())->get();
        //     $activity_a->each(function ($item, $key) use($activity) {
        //         $activity->push($item);
        //     });
        //     if($activity->count() < 9){
        //         $activity_b = Activity::where('status', 1)->where('grade','B')->inRandomOrder()->limit(9 - $activity->count())->get();
        //         $activity_b->each(function ($item, $key) use($activity) {
        //             $activity->push($item);
        //         });
        //         if($activity->count() < 9){
        //             $activity_c = Activity::where('status', 1)->where('grade','C')->inRandomOrder()->limit(9 - $activity->count())->get();
        //             $activity_c->each(function ($item, $key) use($activity) {
        //                 $activity->push($item);
        //             });
        //             if($activity->count() < 9){
        //                 $activity_d = Activity::where('status', 1)->where('grade','D')->inRandomOrder()->limit(9 - $activity->count())->get();
        //                 $activity_d->each(function ($item, $key) use($activity) {
        //                     $activity->push($item);
        //                 });
        //                 if($activity->count() < 9){
        //                     $activity_null = Activity::where('status', 1)->where('grade', null)->inRandomOrder()->limit(9 - $activity->count())->get();
        //                     $activity_null->each(function ($item, $key) use($activity) {
        //                         $activity->push($item);
        //                     });
        //                 }
        //             }
        //         }
        //     }
        // }

        $villa = Villa::where('status', 1)->get()->shuffle()->sortBy('grade');
        // $villa_aa = Villa::where('status', 1)->where('grade','AA')->inRandomOrder()->limit(9)->get();
        // $villa = collect();
        // $villa->merge($villa_aa);
        // if($villa->count() < 9){
        //     $villa_a = Villa::where('status', 1)->where('grade','A')->inRandomOrder()->limit(9 - $villa->count())->get();
        //     $villa_a->each(function ($item, $key) use($villa) {
        //         $villa->push($item);
        //     });
        //     if($villa->count() < 9){
        //         $villa_b = Villa::where('status', 1)->where('grade','B')->inRandomOrder()->limit(9 - $villa->count())->get();
        //         $villa_b->each(function ($item, $key) use($villa) {
        //             $villa->push($item);
        //         });
        //         if($villa->count() < 9){
        //             $villa_c = Villa::where('status', 1)->where('grade','C')->inRandomOrder()->limit(9 - $villa->count())->get();
        //             $villa_c->each(function ($item, $key) use($villa) {
        //                 $villa->push($item);
        //             });
        //             if($villa->count() < 9){
        //                 $villa_d = Villa::where('status', 1)->where('grade','D')->inRandomOrder()->limit(9 - $villa->count())->get();
        //                 $villa_d->each(function ($item, $key) use($villa) {
        //                     $villa->push($item);
        //                 });
        //                 if($villa->count() < 9){
        //                     $villa_null = Villa::where('status', 1)->where('grade', null)->inRandomOrder()->limit(9 - $villa->count())->get();
        //                     $villa_null->each(function ($item, $key) use($villa) {
        //                         $villa->push($item);
        //                     });
        //                 }
        //             }
        //         }
        //     }
        // }

        return view('user.index')->with(compact('restaurant', 'activity'));
    }

    public function get_lat_long(Request $request)
    {
        // dd($request->all());
        $latitudeUser = $request->latitudeUser;
        $longitudeUser = $request->longitudeUser;
        $ip = request()->ip();

        $url = "http://ipinfo.io/" . $ip . "/geo";

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

        $location = Location::select('id_location', 'name', 'latitude', 'longitude')->get();

        $i = 0;

        $data = [];

        foreach ($location as $item) {
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
