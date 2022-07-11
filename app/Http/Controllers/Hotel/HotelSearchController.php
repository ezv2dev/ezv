<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Amenities;
use App\Models\Location;
use App\Models\HotelType;
use App\Models\HostLanguage;

use App\Models\Hotel;
use App\Models\Activity;
use App\Models\HotelCategory;
use App\Models\HotelFilter;
use App\Models\HotelScenicViews;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Services\DeviceCheckService;

class HotelSearchController extends Controller
{
    public function index(Request $request)
    {
        $hotel = Hotel::where('status', 1)->inRandomOrder()->get();

        $amenities = Amenities::all();
        $host_language = HostLanguage::all();
        $property_type = HotelType::all();

        $sLocation = $request->sLocation;
        $sCheck_in = $request->sCheck_in;
        $sCheck_out = $request->sCheck_out;
        $sAdult = $request->sAdult;
        $sChild = $request->sChild;

        $conditionSearch = $sLocation || $sCheck_in || $sCheck_out || $sAdult || $sChild;
        if ($conditionSearch) {
            $hotel = $this->processSearch($hotel, $request);
        }

        $fCategory = $request->fCategory;
        $filter = $request->filter;

        $conditionFilter = $fCategory || $filter;
        if ($conditionFilter) {
            $hotel = $this->processFilter($hotel, $request);
        }

        $hotelIds = $hotel->modelKeys();
        $hotel = Hotel::whereIn('id_hotel', $hotelIds)->paginate(env('CONTENT_PER_PAGE_LIST_HOTEL'));
        $hotel->appends(request()->query());

        $i = 0;
        $j = 0;
        $near = array();
        foreach ($hotel as $item) {
            $things_loc = Activity::where('id_location', $item->id_location)->select('name', 'latitude', 'longitude', 'id_location')->get();
            $things_loc = Activity::where('id_location', $item->id_location)->select('name', 'latitude', 'longitude', 'id_location')->get();
            if (count($things_loc) == 0) {
                $things_loc = Activity::where('id_activity', 3)->select('name', 'latitude', 'longitude', 'id_location')->get();
            }

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

            $hotel[$j]['time'] = $near[0][0];
            $hotel[$j]['activity'] = $near[0][1];

            $j++;
            $near = [];
        }

        $hotelCategory = HotelCategory::all();
        $hotelFilter = HotelFilter::all();

        return view('user.hotel.list_hotel', compact('hotel', 'amenities', 'host_language', 'property_type', 'hotelCategory', 'hotelFilter'));
    }

    public function processSearch($hotels, $request)
    {
        $hotel = $hotels;

        $sLocation = $request->sLocation;
        $sCheck_in = $request->sCheck_in;
        $sCheck_out = $request->sCheck_out;
        $sAdult = $request->sAdult;
        $sChild = $request->sChild;

        if ($sLocation) {
            if ($sLocation == 'Add Location') {
                $sLocation = null;
            }


            // ! start
            $location = $sLocation;

            // * get latitude & longitude dari nama yang diinput user
            $latitude = Location::select('latitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();
            $longitude = Location::select('longitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();
            // *if latitude & longitude is null
            if (!$latitude || !$longitude) {
                $hotel = Hotel::where('name', 'like', '%' . $location . '%')->get();
                return $hotel;
            };

            // * get latitude & longitude dari array
            $get_latitude = $latitude->latitude;
            $get_longitude = $longitude->longitude;

            // * get latitude and longitude data lainnya
            $get_latitude_others = DB::table('location')->whereNotIn('latitude', [$get_latitude])->select('latitude', 'id_location')->get();
            $get_longitude_others = DB::table('location')->whereNotIn('longitude', [$get_longitude])->select('longitude', 'id_location')->get();

            // *if latitude & longitude others is null
            if (!$get_latitude_others || !$get_longitude_others) {
                $hotel = collect([]);
                return $hotel;
            };

            $get_lat_long_others = DB::table('location')
                ->whereNotIn('latitude', [$get_latitude])
                ->whereNotIn('longitude', [$get_longitude])
                ->select('latitude', 'longitude', 'id_location')
                ->get();

            // * get id location
            $id_location = DB::table('location')->where('latitude', $get_latitude)->value('id_location');

            $point1 = array('lat' => $get_latitude, 'long' => $get_longitude, 'id_location');

            $kilometers = array();
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
            $data = $unsorted_data->sortBy('0')->first();

            $hotelIds = $hotel->modelKeys();
            $hotelAround = Hotel::where('status', 1)
                ->whereIn('id_hotel', $hotelIds)
                ->where('id_location', $data[1])->get();

            $hotelOther = Hotel::where('status', 1)
                ->whereIn('id_hotel', $hotelIds)
                ->whereHas('location', function (Builder $query) use ($location) {
                    $query->where('name', 'like', '%' . $location . '%');
                })->get();
            $hotel = new Collection();

            $hotel = $hotel->merge($hotelAround)->merge($hotelOther);
        }

        if ($sCheck_in || $sCheck_out) {
            $check_in = $sCheck_in;
            $check_out = $sCheck_out;

            $hotelIds = $hotel->modelKeys();
            $hotel = Hotel::where('hotel.status', 1)
                ->whereIn('hotel.id_hotel', $hotelIds)
                ->join('hotel_room_booking', 'hotel.id_hotel', '=', 'hotel_room_booking.id_hotel', 'left')
                ->whereNotIn('hotel.id_hotel', function ($query) use ($check_in, $check_out) {
                    $query->from('hotel_room_booking')->select('id_hotel')
                        ->where('check_in', '<=', $check_in)
                        ->where('check_out', '>=', $check_out);
                })
                ->inRandomOrder()->get();
        }

        if ($sAdult || $sChild) {
            // dd("sip");
            $adult = $sAdult;
            $child = $sChild;

            $hotelIds = $hotel->modelKeys();
            $hotel = Hotel::where('status', 1)
                ->whereIn('id_hotel', $hotelIds)
                ->where('adult', '>=', $adult)
                ->where('children', '>=', $child)
                ->inRandomOrder()->get();
        }

        return $hotel;
    }

    public function processFilter($hotels, $request)
    {
        $hotel = $hotels;
        $fCategory = $request->fCategory;
        $filter = $request->filter;

        if ($fCategory) {
            $category = $fCategory;
            $hotelIds = $hotel->modelKeys();
            $hotel = Hotel::with('hotelHasCategory')->where('status', 1)
                ->whereIn('id_hotel', $hotelIds)
                ->whereHas('hotelHasCategory', function (Builder $query) use ($category) {
                    $query->where('id_hotel_category', $category);
                })
                ->inRandomOrder()->get();
        }

        if ($filter) {
            $filter = explode(',', $request->filter);
            $hotelIds = $hotel->modelKeys();
            $hotel = Hotel::with('hotelHasFilter')->where('hotel.status', 1)
                ->whereIn('hotel.id_hotel', $hotelIds)
                ->whereHas('hotelHasFilter', function (Builder $query) use ($filter) {
                    $query->where('id_hotel_filter', $filter);
                })
                ->inRandomOrder()->get();
        }

        return $hotel;
    }

    // ! Filter Modal
    public function search(Request $request)
    {
        // dd($request->all());
        $min_price = $request->min_price;
        $max_price = $request->max_price;

        $checked = $_GET['filterAmenities'];
        $size1 = sizeof($checked);

        $property_type = [];

        if ($size1 > 1) {
            $hotel = Hotel::where('status', 1)
                ->join('hotel_amenities', 'hotel.id_hotel', '=', 'hotel_amenities.id_hotel', 'left')
                ->whereBetween('price', [$min_price, $max_price])
                ->whereIn('hotel_amenities.id_amenities', $checked)
                ->inRandomOrder()->get();
        } else {
            $hotel = Hotel::where('status', 1)
                ->whereBetween('price', [$min_price, $max_price])
                ->inRandomOrder()->get();
        }

        $hotelIds = $hotel->modelKeys();
        $hotel = Hotel::whereIn('id_hotel', $hotelIds)->inRandomOrder()->paginate(15);
        $hotel->appends(request()->query());

        return view('user.hotel.list_hotel', compact('hotel', 'property_type'));
    }
}
