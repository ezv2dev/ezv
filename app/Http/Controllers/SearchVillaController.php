<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Amenities;
use App\Models\HostLanguage;
use App\Models\Location;
use App\Models\PropertyTypeVilla;
use App\Services\DeviceCheckService;
use App\Models\Villa;
use App\Models\VillaAccessibilitiyFeaturesDetail;
use App\Models\VillaAccessibilityFeatures;
use App\Models\VillaAvailability;
use App\Models\VillaBooking;
use App\Models\VillaScenicViews;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SearchVillaController extends Controller
{
    public function search(Request $request)
    {
        $location = $request->location;
        $check_in = $request->check_in;
        $check_out = $request->check_out;
        $adult = $request->adult;
        $child = $request->child;
        $infant = $request->infant;
        $pet = $request->pet;

        if ($location == null && $check_in == null && $check_out == null && $adult != null && $child != null) {
            $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                ->where('villa.adult', '>=', $adult)
                ->where('villa.children', '>=', $child)
                ->whereBetween('price', [$request->min_price, $request->max_price])
                ->inRandomOrder()->get();
        } else {
            if (
                $location != null && $check_in == null && $check_out == null
                && $adult != null && $child != null

            ) {
                // * get latitude & longitude dari nama yang diinput user
                $latitude = Location::select('latitude', 'id_location')->where('name', 'like', '%' . $location . '%')->get();
                $longitude = Location::select('longitude', 'id_location')->where('name', 'like', '%' . $location . '%')->get();

                // * get latitude & longitude dari array
                $get_latitude = $latitude[0]->latitude;
                $get_longitude = $longitude[0]->longitude;

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

                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $location . '%')
                    ->orWhere('villa.id_location', $last['0'][1])
                    ->inRandomOrder()->get();
            } else {
                if (
                    $location == null && $check_in != null && $check_out != null
                    && $adult != null && $child != null

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
                    $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                        ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                        ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                        ->where('location.name', 'like', '%' . $location . '%')
                        ->where('villa.adult', '>=', $adult)
                        ->where('villa.children', '>=', $child)
                        ->join('villa_booking', 'villa.id_villa', '=', 'villa_booking.id_villa', 'left')
                        ->whereNotIn('villa.id_villa', function ($query) use ($check_in, $check_out) {
                            $query->from('villa_booking')->select('id_villa')
                                ->where('check_in', '<=', $check_in)->where('check_out', '>=', $check_out);
                        })
                        ->inRandomOrder()->get();
                }
            }
        }

        $amenities = Amenities::all();
        $villaIds = $villa->modelKeys();
        $villa = Villa::whereIn('id_villa', $villaIds)->orderByRaw("FIELD(grade, \"A\", \"B\", \"C\", \"D\")")->paginate(5);
        $villa->appends(request()->query());

        return view('user.list_villa_search', compact('villa', 'amenities'));
    }

    public function search_combine(Request $request)
    {
        $villa = Villa::where('status', 1)->inRandomOrder()->get();
        $amenities = Amenities::all();
        $host_language = HostLanguage::all();
        $accessibility_features = VillaAccessibilityFeatures::all();
        $accessibility_features_detail = VillaAccessibilitiyFeaturesDetail::all();
        $property_type = PropertyTypeVilla::all();

        $sLocation = $request->sLocation;
        $sCheck_in = $request->sCheck_in;
        $sCheck_out = $request->sCheck_out;
        $sAdult = $request->sAdult;
        $sChild = $request->sChild;

        $conditionSearch = $sLocation || $sCheck_in || $sCheck_out || $sAdult || $sChild;
        if ($conditionSearch) {
            $villa = $this->processSearch($villa, $request);
        }

        $fMaxPrice = $request->fMaxPrice;
        $fMinPrice = $request->fMinPrice;
        $fProperty = $request->fProperty;
        $fBedroom = $request->fBedroom;
        $fBathroom = $request->fBathroom;
        $fBeds = $request->fBeds;
        $fFacilities = $request->fFacilities;
        $fSuitable = $request->fSuitable;
        $fViews = $request->fViews;
        $fAmenities = $request->fAmenities;

        $conditionFilter =
            $fMaxPrice ||
            $fMinPrice ||
            $fProperty ||
            $fBedroom ||
            $fBathroom ||
            $fBeds ||
            $fFacilities ||
            $fSuitable ||
            $fViews ||
            $fAmenities;

        if ($conditionFilter) {
            $villa = $this->processFilter($villa, $request);
        }

        $villaIds = $villa->modelKeys();
        $villa = Villa::whereIn('id_villa', $villaIds)->orderByRaw("FIELD(grade, \"A\", \"B\", \"C\", \"D\")")->paginate(5);
        $villa->each(function ($item, $key) {
            $item->setAppends(['restaurant_nearby', 'activity_nearby', 'hotel_nearby']);
        });
        $villa->appends(request()->query());
        $i = 0;
        $j = 0;
        $near = array();
        foreach ($villa as $item) {
            $point1 = array('lat' => $item->latitude, 'long' => $item->longitude, 'name' => $item->name);
            $airportPoint = array('lat2' => -8.7433916, 'long2' => 115.1644194);

            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $airportPoint['lat2'];
            $lon2 = $airportPoint['long2'];
            $name = 'Ngurah Rai Airport';
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
            $villa[$i]['km'] = $near[0][0];
            $villa[$i]['airport'] = $near[0][1];

            $i++;
        }

        $k = 0;
        $l = 0;
        $near2 = array();
        foreach ($villa as $item3) {
            $things_loc2 = Activity::where('id_location', $item3->id_location)
                ->join('activity_has_subcategory', 'activity.id_activity', '=', 'activity_has_subcategory.id_activity', 'left')
                ->select('name', 'latitude', 'longitude', 'id_location', 'id_subcategory', 'activity.id_activity')
                ->where('id_subcategory', 1)
                ->where('status', 1)
                ->get();


            if (count($things_loc2) == 0) {
                $things_loc2 = Activity::where('id_location', $item->id_location)
                    ->select('name', 'latitude', 'longitude', 'id_location')
                    ->where('status', 1)
                    ->get();

                if (count($things_loc2) == 0) {
                    $things_loc2 = Activity::where('id_activity', 3)
                        ->select('name', 'latitude', 'longitude', 'id_location')
                        ->get();
                }
            }

            $point2 = array('lat' => $item3->latitude, 'long' => $item3->longitude, 'name' => $item3->name);

            foreach ($things_loc2 as $item4) {
                $lat3 = $point2['lat'];
                $lon3 = $point2['long'];
                $lat4 = $item4->latitude;
                $lon4 = $item4->longitude;
                $name2 = $item4->name;
                $theta = $lon3 - $lon4;

                $miles2 = (sin(deg2rad($lat3)) * sin(deg2rad($lat4))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta)));
                $miles2 = acos($miles2);
                $miles2 = rad2deg($miles2);
                $miles2 = $miles2 * 60 * 1.1515;
                $kilometers2[$k][] = ($miles2 * 1.609344 / 40) * 60;
                $kilometers2[$k][] = $name2;

                if ($near2 == null) {
                    $near2[0] = $kilometers2[$k];
                } else {
                    if ($kilometers2[$k][0] <= $near2[0][0]) {
                        $near2[0] = $kilometers2[$k];
                    }
                }
                $k++;
            }
            $villa[$l]['km2'] = $near2[0][0];
            $villa[$l]['beach'] = $near2[0][1];

            $l++;
        }

        if (DeviceCheckService::isMobile()) {
            return view('user.m-list_villa', compact('villa', 'amenities', 'host_language', 'accessibility_features', 'accessibility_features_detail', 'property_type'));
        }
        if (DeviceCheckService::isDesktop()) {
            return view('user.list_villa_search', compact('villa', 'amenities', 'host_language', 'accessibility_features', 'accessibility_features_detail', 'property_type'));
        }
        return view('user.list_villa_search', compact('villa', 'amenities', 'host_language', 'accessibility_features', 'accessibility_features_detail', 'property_type'));
    }

    public function processSearch($villas, $request)
    {
        $villa = $villas;

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
                $villa = collect([]);
                return $villa;
            };

            // * get latitude & longitude dari array
            $get_latitude = $latitude->latitude;
            $get_longitude = $longitude->longitude;

            // * get latitude and longitude data lainnya
            $get_latitude_others = DB::table('location')->whereNotIn('latitude', [$get_latitude])->select('latitude', 'id_location')->get();
            $get_longitude_others = DB::table('location')->whereNotIn('longitude', [$get_longitude])->select('longitude', 'id_location')->get();

            // *if latitude & longitude others is null
            if (!$get_latitude_others || !$get_longitude_others) {
                $villa = collect([]);
                return $villa;
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

            $villaIds = $villa->modelKeys();
            $villaAround = Villa::where('status', 1)
                ->whereIn('id_villa', $villaIds)
                ->where('id_location', $data[1])->get();

            $villaOther = Villa::where('status', 1)
                ->whereIn('id_villa', $villaIds)
                ->whereHas('location', function (Builder $query) use ($location) {
                    $query->where('name', 'like', '%' . $location . '%');
                })->get();

            $villa = new Collection();
            $villa = $villa->merge($villaOther);
        }


        if ($sCheck_in || $sCheck_out) {
            $check_in = $sCheck_in;
            $check_out = $sCheck_out;

            $villaIds = $villa->modelKeys();
            $villa_all = Villa::where('villa.status', 1)
                ->whereIn('villa.id_villa', $villaIds)
                ->orderBy('id_villa', 'asc')->get()->toArray();
            $villa_availability = VillaAvailability::select('id_villa')
                ->where(function ($query) use ($sCheck_in, $sCheck_out) {
                    $query->where([
                        ['start', '<=', $sCheck_in],
                        ['end', '>=', $sCheck_out]
                    ]);
                })
                ->groupBy('id_villa')
                ->get();

            $count = count($villa_all);
            foreach ($villa_availability as $item) {
                for ($i = 0; $i < $count; $i++) {
                    if (array_search($item->id_villa, $villa_all[$i]) == "id_villa") {
                        unset($villa_all[$i]);
                    }
                }
            }

            $villa = collect($villa_all);
        }

        if ($sAdult || $sChild) {
            $adult = $sAdult;
            $child = $sChild;
            $villaIds = array();
            foreach ($villa as $item) {
                array_push($villaIds, $item["id_villa"]);
            }

            $villa = Villa::where('status', 1)
                ->whereIn('id_villa', $villaIds)
                ->where('adult', '>=', $adult)
                ->where('children', '>=', $child)
                ->inRandomOrder()->get();
        }

        return $villa;
    }

    public function processFilter($villas, $request)
    {
        $villa = $villas;

        $fMaxPrice = $request->fMaxPrice;
        $fMinPrice = $request->fMinPrice;
        $fProperty = $request->fProperty;
        $fBedroom = $request->fBedroom;
        $fBathroom = $request->fBathroom;
        $fBeds = $request->fBeds;
        $fFacilities = $request->fFacilities;
        $fSuitable = $request->fSuitable;
        $fViews = $request->fViews;
        $fAmenities = $request->fAmenities;

        if ($fMaxPrice || $fMinPrice) {
            $max_price = $fMaxPrice;
            $min_price = $fMinPrice;

            $villaIds = $villa->modelKeys();
            $villa = Villa::where('status', 1)
                ->whereIn('id_villa', $villaIds)
                ->whereBetween('price', [$min_price, $max_price])
                ->inRandomOrder()->get();
        }

        if ($fProperty) {
            $property = $fProperty;

            $villaIds = $villa->modelKeys();
            $villa = Villa::where('status', 1)
                ->whereIn('id_villa', $villaIds)
                ->where('id_property_type', $property)
                ->inRandomOrder()->get();
        }

        if ($fBedroom) {
            $bedroom = $fBedroom;

            $villaIds = $villa->modelKeys();
            $villa = Villa::where('status', 1)
                ->whereIn('id_villa', $villaIds)
                ->where('bedroom', '>=', $bedroom)
                ->inRandomOrder()->get();
        }

        if ($fBathroom) {
            $bathroom = $fBathroom;

            $villaIds = $villa->modelKeys();
            $villa = Villa::where('status', 1)
                ->whereIn('id_villa', $villaIds)
                ->where('bathroom', '>=', $bathroom)
                ->inRandomOrder()->get();
        }

        if ($fBeds) {
            $beds = $fBeds;

            $villaIds = $villa->modelKeys();
            $villa = Villa::where('status', 1)
                ->whereIn('id_villa', $villaIds)
                ->where('beds', '>=', $beds)
                ->inRandomOrder()->get();
        }

        if ($fAmenities) {
            $amenities = $fAmenities;

            $villaIds = $villa->modelKeys();
            $villa = Villa::where('villa.status', 1)
                ->whereIn('villa.id_villa', $villaIds)
                ->join('villa_amenities', 'villa.id_villa', '=', 'villa_amenities.id_villa', 'left')
                ->Where('villa_amenities.id_amenities', $amenities)
                ->inRandomOrder()->get();
        }

        if ($fFacilities) {
            $facilities = $fFacilities;

            $villaIds = $villa->modelKeys();
            $villa = Villa::where('villa.status', 1)
                ->whereIn('villa.id_villa', $villaIds)
                ->join('villa_amenities', 'villa.id_villa', '=', 'villa_amenities.id_villa', 'left')
                ->WhereIn('villa_amenities.id_amenities', $facilities)
                ->inRandomOrder()->get();
        }

        if ($fSuitable) {
            $suitable = explode(',', $request->fSuitable);

            $villaIds = $villa->modelKeys();
            $villa = Villa::where('status', 1)
                ->whereIn('id_villa', $villaIds)
                ->whereIn('id_suitable', $suitable)
                ->inRandomOrder()->get();
        }

        if ($fViews) {
            $views = explode(',', $request->fViews);

            $villa_scenic = VillaScenicViews::where('id_scenic_views', $views)->get();

            $temp_villa = array();
            $i = 0;
            foreach ($villa_scenic as $item) {
                array_push($temp_villa, $villa_scenic[$i]->id_villa);
                $i++;
            }

            $villa = Villa::where('status', 1)
                ->whereIn('id_villa', $temp_villa)
                ->inRandomOrder()->get();
        }

        return $villa;
    }

    public function modalSearch(Request $request)
    {
        $villa = Villa::where('status', 1)->inRandomOrder()->get();
        $amenities = Amenities::all();
        $host_language = HostLanguage::all();
        $accessibility_features = VillaAccessibilityFeatures::all();
        $accessibility_features_detail = VillaAccessibilitiyFeaturesDetail::all();
        $property_type = PropertyTypeVilla::all();

        $fMaxPrice = $request->fMaxPrice;
        $fMinPrice = $request->fMinPrice;
        $fBedroom = $request->fBedroom;
        $fBeds = $request->fBeds;
        $fBathroom = $request->fBathroom;
        $fProperty = $request->fProperty;
        $fAmenities = $request->fAmenities;

        $conditionFilter = $fMaxPrice || $fMinPrice || $fBedroom || $fBeds || $fBathroom || $fProperty || $fAmenities;
        if ($conditionFilter) {
            $villa = $this->processModal($villa, $request);
        }

        $villaIds = $villa->modelKeys();
        $villa = Villa::whereIn('id_villa', $villaIds)->orderByRaw("FIELD(grade, \"A\", \"B\", \"C\", \"D\")")->paginate(5);
        $villa->each(function ($item, $key) {
            $item->setAppends(['restaurant_nearby', 'activity_nearby', 'hotel_nearby']);
        });
        $villa->appends(request()->query());

        if (DeviceCheckService::isMobile()) {
            return view('user.m-list_villa', compact('villa', 'amenities', 'host_language', 'accessibility_features', 'accessibility_features_detail', 'property_type'));
        }
        if (DeviceCheckService::isDesktop()) {
            return view('user.list_villa_search', compact('villa', 'amenities', 'host_language', 'accessibility_features', 'accessibility_features_detail', 'property_type'));
        }
        return view('user.list_villa_search', compact('villa', 'amenities', 'host_language', 'accessibility_features', 'accessibility_features_detail', 'property_type'));
    }
}
