<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Amenities;
use App\Models\Villa;
use App\Models\VillaAmenities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterBoxController extends Controller
{
    public function filter(Request $request)
    {
        // dd($request->all());
        // if (!empty($request)) {
        //     abort(404);
        // }
        $checked = $_GET['filterProperty'];
        // dd($checked);

        // dd($checked);
        $amenities = Amenities::all();

        if ($request->location == '') {
            $checked = $_GET['filterProperty'];
            $req['location'] = null;
            $req['check_in'] = null;
            $req['check_out'] = null;
            $req['adult'] = null;
            $req['children'] = null;

            $villa = Villa::whereIn('id_property_type', $checked)->inRandomOrder()->get();
        } else {
            if ($request->adult == '' || $request->children == '') {
                $checked = $_GET['filterProperty'];
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::whereIn('id_property_type', $checked)->inRandomOrder()->get();
            } else {
                $checked = $_GET['filterProperty'];
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::whereIn('id_property_type', $checked)->inRandomOrder()->get();
            }
        }
        $villaIds = $villa->modelKeys();
        $villa = Villa::whereIn('id_villa', $villaIds)->inRandomOrder()->paginate(5);
        $villa->appends(request()->query());

        $i = 0;
        $j = 0;
        $near = array();
        foreach ($villa as $item) {
            $things_loc = Activity::where(
                'id_location',
                $item->id_location
            )->select('name', 'latitude', 'longitude', 'id_location')->get();
            $point1 = array('lat' => $item->latitude, 'long' => $item->longitude, 'name' => $item->name);

            foreach ($things_loc as $item2) {
                $lat1 = $point1['lat'];
                $lon1 = $point1['long'];
                $lat2 = $item2->latitude;
                $lon2 = $item2->longitude;
                $name = $item2->name;
                $theta = $lon1 - $lon2;

                $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
                $miles = acos($miles);
                $miles = rad2deg($miles);
                $miles = $miles * 60 * 1.1515;
                $kilometers[$i][] = ($miles * 1.609344 / 40) * 60;
                $kilometers[$i][] = $name;

                if ($near == null) {
                    $near[0] = $kilometers[$i];
                } else {
                    if (
                        $kilometers[$i][0] <= $near[0][0]
                    ) {
                        $near[0] = $kilometers[$i];
                    }
                }
                $i++;
            }

            $villa[$j]['time'] = $near[0][0];
            $villa[$j]['activity'] = $near[0][1];

            $j++;
            $near = [];
        }

        return view('user.list_villa', compact('villa', 'req', 'amenities'));
    }

    public function amenities(Request $request)
    {
        if (!$request->all()) {

            $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                ->join('villa_amenities', 'villa.id_villa', '=', 'villa_amenities.id_villa', 'left')
                ->inRandomOrder()
                ->get();

            $villaIds = $villa->modelKeys();
            $villa = Villa::whereIn('id_villa', $villaIds)->inRandomOrder()->paginate(5);
            $villa->appends(request()->query());

            return view('user.list_villa', compact('villa'));
        }
        $checked = $request->filterAmenities;
        $checked2 = $request->filterSuitable;
        $amenities = Amenities::all();

        if ($checked == null) {
            $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                ->join('villa_amenities', 'villa.id_villa', '=', 'villa_amenities.id_villa', 'left')
                ->whereIn('id_suitable', $checked2)
                ->inRandomOrder()
                ->get();
        } else if ($checked2 == null) {
            $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                ->join('villa_amenities', 'villa.id_villa', '=', 'villa_amenities.id_villa', 'left')
                ->WhereIn('villa_amenities.id_amenities', $checked)
                ->inRandomOrder()
                ->get();
        } else {
            $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                ->join('villa_amenities', 'villa.id_villa', '=', 'villa_amenities.id_villa', 'left')
                ->WhereIn('villa_amenities.id_amenities', $checked)
                ->whereIn('id_suitable', $checked2)
                ->inRandomOrder()
                ->get();
        }

        $villaIds = $villa->modelKeys();
        $villa = Villa::whereIn('id_villa', $villaIds)->inRandomOrder()->paginate(5);
        $villa->appends(request()->query());

        $i = 0;
        $j = 0;
        $near = array();
        foreach ($villa as $item) {
            $things_loc = Activity::where('id_location', $item->id_location)->select('name', 'latitude', 'longitude', 'id_location')->get();
            $point1 = array('lat' => $item->latitude, 'long' => $item->longitude, 'name' => $item->name);

            foreach ($things_loc as $item2) {
                $lat1 = $point1['lat'];
                $lon1 = $point1['long'];
                $lat2 = $item2->latitude;
                $lon2 = $item2->longitude;
                $name = $item2->name;
                $theta = $lon1 - $lon2;

                $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
                $miles = acos($miles);
                $miles = rad2deg($miles);
                $miles = $miles * 60 * 1.1515;
                $kilometers[$i][] = ($miles * 1.609344 / 40) * 60;
                $kilometers[$i][] = $name;

                if ($near == null) {
                    $near[0] = $kilometers[$i];
                } else {
                    if ($kilometers[$i][0] <= $near[0][0]) {
                        $near[0] = $kilometers[$i];
                    }
                }
                $i++;
            }

            $villa[$j]['time'] = $near[0][0];
            $villa[$j]['activity'] = $near[0][1];

            $j++;
            $near = [];
        }

        // dd($villa);

        return view('user.list_villa', compact('villa', 'amenities'));
    }
}
