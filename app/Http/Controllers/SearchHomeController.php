<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Amenities;
use App\Models\DetailReview;
use App\Models\HostLanguage;
use App\Models\Location;
use App\Models\PropertyTypeVilla;
use App\Services\DeviceCheckService;
use App\Models\Villa;
use App\Models\VillaAccessibilitiyFeaturesDetail;
use App\Models\VillaAccessibilityFeatures;
use App\Models\VillaAvailability;
use App\Models\VillaBooking;
use App\Models\VillaCategory;
use App\Models\VillaFilter;
use App\Models\VillaScenicViews;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class SearchHomeController extends Controller
{
    private function setCookie($name, $value)
    {
        $minutes = 1440;
        $response = new Response($value);
        $response->withCookie(cookie($name, $value, $minutes));
        return $response;
    }

    public function index(Request $request)
    {
        $villa = Villa::with('villaHasCategory')->where('status', 1)->get();
        $amenities = Amenities::all();
        $villaCategory = VillaCategory::all();

        $sLocation = $request->sLocation;
        //* search action
        $sCheck_in = $request->sCheck_in;
        $sCheck_out = $request->sCheck_out;
        $sAdult = $request->sAdult;
        $sChild = $request->sChild;

        $this->setCookie('sCheck_in', $sCheck_in);
        $this->setCookie('sCheck_out', $sCheck_out);

        $conditionSearch = $sCheck_in || $sCheck_out || $sAdult || $sChild;
        if ($conditionSearch) {
            $villa = $this->processSearch($villa, $request);
        }

        $fMaxPrice = $request->fMaxPrice;
        $fMinPrice = $request->fMinPrice;
        $fBedroom = $request->fBedroom;
        $fBathroom = $request->fBathroom;
        $fBeds = $request->fBeds;
        $fCategory = $request->fCategory;
        $fAmenities = $request->fAmenities;
        $fSort = $request->fSort;

        $conditionFilter = $fMaxPrice || $fMinPrice || $fBedroom || $fBathroom || $fBeds || $fCategory || $fAmenities;

        if ($conditionFilter) {
            $villa = $this->processFilter($villa, $request);
        }
        //* end search action

        $ids = $villa->pluck('id_villa');

        if ($sLocation) {
            $location = $sLocation;
            if (!$fSort) {
                // ! start
                // * get latitude & longitude dari nama yang diinput user
                $latitude = Location::select('latitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();
                $longitude = Location::select('longitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();
                $get_latitude = $latitude->latitude;
                $get_longitude = $longitude->longitude;
                $get_latitude_others = Location::whereNotIn('latitude', [$get_latitude])->select('latitude', 'id_location')->get();
                $get_longitude_others = Location::whereNotIn('longitude', [$get_longitude])->select('longitude', 'id_location')->get();
                $get_lat_long_others = Location::whereNotIn('latitude', [$get_latitude])->whereNotIn('longitude', [$get_longitude])->select('latitude', 'longitude', 'id_location')->get();

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
                $sorted_data = $unsorted_data->sortBy('0');

                $tempLoc = [];
                $getLoc = Location::where('name', 'like', '%' . $location . '%')->select('id_location')->first();
                array_push($tempLoc, $getLoc->id_location);
                foreach ($sorted_data as $item) {
                    array_push($tempLoc, $item['1']);
                }

                $villaIds = $villa->modelKeys();
                $villa = Villa::where('status', 1)->whereIn('id_location', $tempLoc)->whereIn('id_villa', $villaIds)->get();

                $tempVilla = [];
                for ($i = 0; $i < collect($tempLoc)->count(); $i++) {
                    for ($j = 0; $j < $villa->count(); $j++) {
                        if ($tempLoc[$i] == $villa[$j]->id_location) {
                            array_push($tempVilla, $villa[$j]);
                        }
                    }
                }
                $villas = collect($tempVilla);
            } else {
                $villaIds = $villa->modelKeys();

                if ($fSort == 'highest') {
                    $villas = Villa::orderBy('price', 'DESC')->whereIn('id_villa', $villaIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();
                } else if ($fSort == 'lowest') {
                    $villas = Villa::orderBy('price', 'ASC')->whereIn('id_villa', $villaIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();
                } else if ($fSort == 'popularity') {
                    $countPerson = DetailReview::orderBy('count_person', 'DESC')->get();
                    $personIds = $countPerson->pluck('id_villa');
                    $villas = Villa::whereIn('id_villa', $personIds)->whereIn('id_villa', $villaIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();
                } else if ($fSort == 'best_reviewed') {
                    $countHighest = DetailReview::orderBy('average', 'DESC')->get();
                    $highestIds = $countHighest->pluck('id_villa');
                    $villas = Villa::whereIn('id_villa', $highestIds)->whereIn('id_villa', $villaIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();
                } else if ($fSort == 'ezv_top_pick') {
                    $villas = Villa::where('grade', 'AA')->whereIn('id_villa', $villaIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();
                } else if ($fSort == 'beach') {
                    // ! Find Beach
                    $k = 0;
                    $l = 0;
                    $near2 = array();

                    // ! End find Beach
                    $villas = Villa::whereIn('id_villa', $villaIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();

                    foreach ($villas as $item3) {
                        $things_loc2 = Activity::where('id_location', $item3->id_location)->join('activity_has_subcategory', 'activity.id_activity', '=', 'activity_has_subcategory.id_activity', 'left')
                            ->select('name', 'latitude', 'longitude', 'id_location', 'id_subcategory', 'activity.id_activity')
                            ->where('id_subcategory', 1)
                            ->where('status', 1)
                            ->get();

                        if (count($things_loc2) == 0) {
                            $things_loc2 = Activity::where('id_location', $item3->id_location)
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
                        $villas[$l]['km2'] = $near2[0][0];
                        $villas[$l]['beach'] = $near2[0][1];

                        $l++;
                    }
                }
            }
        } else {
            if (!$fSort) {
                $villas = Villa::whereIn('id_villa', $ids)->where('status', 1)->inRandomOrder()->get();
            }

            if ($fSort) {
                if ($fSort == 'highest') {
                    $villaIds = $villa->modelKeys();
                    $villas = Villa::orderBy('price', 'DESC')->whereIn('id_villa', $villaIds)->where('status', 1)->get();
                } else if ($fSort == 'lowest') {
                    $villaIds = $villa->modelKeys();
                    $villas = Villa::orderBy('price', 'ASC')->whereIn('id_villa', $villaIds)->where('status', 1)->get();
                } else if ($fSort == 'popularity') {
                    $villaIds = $villa->modelKeys();
                    $countPerson = DetailReview::orderBy('count_person', 'DESC')->get();
                    $personIds = $countPerson->pluck('id_villa');
                    $villas = Villa::whereIn('id_villa', $personIds)->whereIn('id_villa', $villaIds)->where('status', 1)->get();
                } else if ($fSort == 'best_reviewed') {
                    $villaIds = $villa->modelKeys();
                    $countHighest = DetailReview::orderBy('average', 'DESC')->get();
                    $highestIds = $countHighest->pluck('id_villa');
                    $villas = Villa::whereIn('id_villa', $highestIds)->whereIn('id_villa', $villaIds)->where('status', 1)->get();
                } else if ($fSort == 'ezv_top_pick') {
                    $villaIds = $villa->modelKeys();
                    $villas = Villa::where('grade', 'AA')->whereIn('id_villa', $villaIds)->where('status', 1)->get();
                } else if ($fSort == 'beach') {
                    $villaIds = $villa->modelKeys();

                    // ! Find Beach
                    $k = 0;
                    $l = 0;
                    $near2 = array();

                    // ! End find Beach
                    $villas = Villa::whereIn('id_villa', $villaIds)->where('status', 1)->get();

                    foreach ($villas as $item3) {
                        $things_loc2 = Activity::where('id_location', $item3->id_location)->join('activity_has_subcategory', 'activity.id_activity', '=', 'activity_has_subcategory.id_activity', 'left')
                            ->select('name', 'latitude', 'longitude', 'id_location', 'id_subcategory', 'activity.id_activity')
                            ->where('id_subcategory', 1)
                            ->where('status', 1)
                            ->get();

                        if (count($things_loc2) == 0) {
                            $things_loc2 = Activity::where('id_location', $item3->id_location)
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
                        $villas[$l]['km2'] = $near2[0][0];
                        $villas[$l]['beach'] = $near2[0][1];

                        $l++;
                    }
                }
            }
        }

        //! find nearby function
        $i = 0;
        $j = 0;
        foreach ($villas as $item) {
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
            $kilometers[$i] = ($miles * 1.609344 / 40) * 60;

            $item['km'] = $kilometers[$i];
            $item['airport'] = 'Ngurah Rai Airport';

            $i++;
        }
        //! end find nearby function

        $villa = $villas->paginate(env('CONTENT_PER_PAGE_LIST_VILLA'));
        return view('user.list_villa', compact('villa', 'amenities', 'villaCategory'));
    }

    public function processSearch($villas, $request)
    {
        $villa = $villas;
        $sCheck_in = $request->sCheck_in;
        $sCheck_out = $request->sCheck_out;
        $sAdult = $request->sAdult;
        $sChild = $request->sChild;

        if ($sCheck_in || $sCheck_out) {
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
        $fCategory = $request->fCategory;
        $fAmenities = $request->fAmenities;
        $fMaxPrice = $request->fMaxPrice;
        $fMinPrice = $request->fMinPrice;
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

        if ($fCategory) {
            $category = $fCategory;
            $villaIds = $villa->modelKeys();
            $villa = Villa::with('villaHasCategory')->where('status', 1)
                ->whereIn('id_villa', $villaIds)
                ->whereHas('villaHasCategory', function (Builder $query) use ($category) {
                    $query->where('id_villa_category', $category);
                })
                ->inRandomOrder()->get();
        }

        if ($fAmenities) {
            $fAmenities = explode(',', $request->fAmenities);
            $villaIds = $villa->modelKeys();
            $villa = Villa::with('villaHasAmenities')->where('villa.status', 1)
                ->whereIn('villa.id_villa', $villaIds)
                ->whereHas('villaHasAmenities', function (Builder $query) use ($fAmenities) {
                    $query->where('id_amenities', $fAmenities);
                })
                ->inRandomOrder()->get();
        }

        return $villa;
    }
}
