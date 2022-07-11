<?php

namespace App\Http\Controllers\Activity;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\ActivityFacilities;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Amenities;
use Illuminate\Database\Eloquent\Builder;

class SearchActivityController extends Controller
{
    public function search(Request $request)
    {
        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        $location = $request->location;
        // $check_in = $request->check_in;
        // $check_out = $request->check_out;
        // $adult = $request->adult;
        // $child = $request->child;
        // $infant = $request->infant;
        // $pet = $request->pet;

        if (!$location) {
            dd('location not found');
            $activity = Activity::inRandomOrder()->get();
        } else {
            // dd('location found');
            if ($location) {
                // * get latitude & longitude dari nama yang diinput user
                $latitude = Location::select('latitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();
                $longitude = Location::select('longitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();

                // * get latitude & longitude dari array
                $get_latitude = $latitude->latitude;
                $get_longitude = $longitude->longitude;

                // * get latitude and longitude data lainnya
                $get_latitude_others = DB::table('location')->whereNotIn('latitude', [$get_latitude])->select('latitude', 'id_location')->get();
                $get_longitude_others = DB::table('location')->whereNotIn('longitude', [$get_longitude])->select('longitude', 'id_location')->get();

                // dd($get_latitude_others, $get_longitude_others);
                $get_lat_long_others = DB::table('location')
                    ->whereNotIn('latitude', [$get_latitude])
                    ->whereNotIn('longitude', [$get_longitude])
                    ->select('latitude', 'longitude', 'id_location')
                    ->get();

                // * get id location
                $id_location = DB::table('location')->where('latitude', $get_latitude)->value('id_location');

                $point1 = array('lat' => $get_latitude, 'long' => $get_longitude, 'id_location');
                // $point2 = array('lat2' => $get_latitude_others, 'long2' => $get_longitude_others);
                // dd($point2);

                $kilometers[] = array();
                $i = 0;
                foreach ($get_lat_long_others as $item) {
                    $lat1 = $point1['lat'];
                    $lon1 = $point1['long'];
                    $lat2 = $item->latitude;
                    $lon2 = $item->longitude;
                    $id_location_near = $item->id_location;
                    $theta = $lon1 - $lon2;

                    $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
                    $miles = acos($miles);
                    $miles = rad2deg($miles);
                    $miles = $miles * 60 * 1.1515;
                    $kilometers[$i][] = $miles * 1.609344;
                    $kilometers[$i][] = $id_location_near;
                    $i++;
                }

                $unsorted_data = collect($kilometers);
                $sorted_data = $unsorted_data->sortByDesc('0');
                $last = end($sorted_data);

                // $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                //     ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                //     ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                //     ->where('location.name', 'like', '%' . $location . '%')
                //     ->orWhere('villa.id_location', $last['0'][1])
                //     ->inRandomOrder()->get();
                $activity = Activity::whereHas('location', function (Builder $query) use($location) {
                    $query->where('name', 'like', '%' . $location . '%');
                })->orWhere('id_location', $last['0'][1])
                ->inRandomOrder()->get();
            } else {
                if (
                    $location == null && $check_in != null && $check_out != null
                    && $adult != null && $child != null
                    && $request->isMethod('POST')
                ) {
                    // dd('3');
                    $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                        ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                        ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                        ->join('villa_booking', 'villa.id_villa', '=', 'villa_booking.id_villa', 'left')
                        ->whereNotIn('villa.id_villa', function ($query) use ($check_in, $check_out) {
                            $query->from('villa_booking')->select('id_villa')
                                ->where('check_in', '<=', $check_in)
                                ->where('check_out', '>=', $check_out);
                        })
                        ->where('villa.adult', '>=', $adult)
                        ->where('villa.children', '>=', $child)
                        ->inRandomOrder()->get();
                } else {
                    // dd('4');
                    // $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    //     ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    //     ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    //     ->where('location.name', 'like', '%' . $location . '%')
                    //     ->where('villa.adult', '>=', $adult)
                    //     ->where('villa.children', '>=', $child)
                    //     ->join('villa_booking', 'villa.id_villa', '=', 'villa_booking.id_villa', 'left')
                    //     ->whereNotIn('villa.id_villa', function ($query) use ($check_in, $check_out) {
                    //         $query->from('villa_booking')->select('id_villa')->where('check_in', '<=', $check_in)->where('check_out', '>=', $check_out);
                    //     })
                    //     ->inRandomOrder()->get();
                    // dd($villa);
                }
            }
        }


        $amenities = Amenities::all();
        $facilities = ActivityFacilities::all();
        $categories = ActivityCategory::all();

        return view('user.list_activity', compact('activity', 'req', 'amenities', 'facilities', 'categories'));
    }
}
