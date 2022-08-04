<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Amenities;
use App\Models\Location;
use App\Models\HostLanguage;

use App\Models\Hotel;
use App\Models\Activity;
use App\Models\HotelCategory;
use App\Models\HotelDetailReview;
use App\Models\HotelHotelDetailReview;
use App\Models\HotelFilter;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class HotelSearchController extends Controller
{
    public function index(Request $request)
    {
        $hotel = Hotel::where('status', 1)->inRandomOrder()->get();
        $hotelCategory = HotelCategory::all();
        $hotelFilter = HotelFilter::all();
        $amenities = Amenities::all();

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
        $fMinPrice = $request->fMinPrice;
        $fMaxPrice = $request->fMaxPrice;
        $fStar = $request->fStar;
        $fSort = $request->fSort;


        $conditionFilter = $fCategory || $filter || $fMinPrice || $fMaxPrice || $fStar;
        if ($conditionFilter) {
            $hotel = $this->processFilter($hotel, $request);
        }

        $hotelIds = $hotel->modelKeys();

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

                $hotelIds = $hotel->modelKeys();
                $hotel = Hotel::where('status', 1)->whereIn('id_location', $tempLoc)->whereIn('id_hotel', $hotelIds)->get();

                $tempVilla = [];
                for ($i = 0; $i < collect($tempLoc)->count(); $i++) {
                    for ($j = 0; $j < $hotel->count(); $j++) {
                        if ($tempLoc[$i] == $hotel[$j]->id_location) {
                            array_push($tempVilla, $hotel[$j]);
                        }
                    }
                }
                $hotels = collect($tempVilla);
            } else {
                $hotelIds = $hotel->modelKeys();

                if ($fSort == 'highest') {
                    $hotels = Hotel::orderBy('price', 'DESC')->whereIn('id_hotel', $hotelIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();
                } else if ($fSort == 'lowest') {
                    $hotels = Hotel::orderBy('price', 'ASC')->whereIn('id_hotel', $hotelIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();
                } else if ($fSort == 'popularity') {
                    $countPerson = HotelDetailReview::orderBy('count_person', 'DESC')->get();
                    $personIds = $countPerson->pluck('id_hotel');
                    $hotels = Hotel::whereIn('id_hotel', $personIds)->whereIn('id_hotel', $hotelIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();
                } else if ($fSort == 'best_reviewed') {
                    $countHighest = HotelDetailReview::orderBy('average', 'DESC')->get();
                    $highestIds = $countHighest->pluck('id_hotel');
                    $hotels = Hotel::whereIn('id_hotel', $highestIds)->whereIn('id_hotel', $hotelIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();
                } else if ($fSort == 'ezv_top_pick') {
                    $hotels = Hotel::where('grade', 'AA')->whereIn('id_hotel', $hotelIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();
                } else if ($fSort == 'beach') {
                    // ! Find Beach
                    $k = 0;
                    $l = 0;
                    $near2 = array();

                    // ! End find Beach
                    $hotels = Hotel::whereIn('id_hotel', $hotelIds)->whereHas('location', function (Builder $query) use ($location) {
                        $query->where('name', 'like', '%' . $location . '%');
                    })->where('status', 1)->get();

                    foreach ($hotels as $item3) {
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
                        $hotels[$l]['km2'] = $near2[0][0];
                        $hotels[$l]['beach'] = $near2[0][1];

                        $l++;
                    }
                }
            }
        } else {
            if (!$fSort) {
                $hotels = Hotel::whereIn('id_hotel', $hotelIds)->where('status', 1)->inRandomOrder()->get();
            }

            if ($fSort) {
                if ($fSort == 'highest') {
                    $hotelIds = $hotel->modelKeys();
                    $hotels = Hotel::orderBy('price', 'DESC')->whereIn('id_hotel', $hotelIds)->where('status', 1)->get();
                } else if ($fSort == 'lowest') {
                    $hotelIds = $hotel->modelKeys();
                    $hotels = Hotel::orderBy('price', 'ASC')->whereIn('id_hotel', $hotelIds)->where('status', 1)->get();
                } else if ($fSort == 'popularity') {
                    $hotelIds = $hotel->modelKeys();
                    $countPerson = HotelDetailReview::orderBy('count_person', 'DESC')->get();
                    $personIds = $countPerson->pluck('id_hotel');
                    $hotels = Hotel::whereIn('id_hotel', $personIds)->whereIn('id_hotel', $hotelIds)->where('status', 1)->get();
                } else if ($fSort == 'best_reviewed') {
                    $hotelIds = $hotel->modelKeys();
                    $countHighest = HotelDetailReview::orderBy('average', 'DESC')->get();
                    $highestIds = $countHighest->pluck('id_hotel');
                    $hotels = Hotel::whereIn('id_hotel', $highestIds)->whereIn('id_hotel', $hotelIds)->where('status', 1)->get();
                } else if ($fSort == 'ezv_top_pick') {
                    $hotelIds = $hotel->modelKeys();
                    $hotels = Hotel::where('grade', 'AA')->whereIn('id_hotel', $hotelIds)->where('status', 1)->get();
                } else if ($fSort == 'beach') {
                    $hotelIds = $hotel->modelKeys();

                    // ! Find Beach
                    $k = 0;
                    $l = 0;
                    $near2 = array();

                    // ! End find Beach
                    $hotels = Hotel::whereIn('id_hotel', $hotelIds)->where('status', 1)->get();

                    foreach ($hotels as $item3) {
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
                        $hotels[$l]['km2'] = $near2[0][0];
                        $hotels[$l]['beach'] = $near2[0][1];

                        $l++;
                    }
                }
            }
        }

        //! find nearby function
        $i = 0;
        $j = 0;
        $near = array();
        foreach ($hotels as $item) {
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

            $item['km'] = $kilometers[$i][0];
            $item['airport'] = 'Ngurah Rai Airport';

            $i++;
        }
        //! end find nearby function

        $hotel = $hotels->paginate(env('CONTENT_PER_PAGE_LIST_HOTEL'));

        return view('user.hotel.list_hotel', compact('hotel', 'amenities', 'hotelCategory', 'hotelFilter'));
    }

    public function processSearch($hotels, $request)
    {
        $hotel = $hotels;
        $sCheck_in = $request->sCheck_in;
        $sCheck_out = $request->sCheck_out;
        $sAdult = $request->sAdult;
        $sChild = $request->sChild;

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
        $fMinPrice = $request->fMinPrice;
        $fMaxPrice = $request->fMaxPrice;
        $fStar = $request->fStar;

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

        if ($fMaxPrice || $fMinPrice) {
            $hotelIds = $hotel->modelKeys();
            $hotel = Hotel::where('status', 1)
                ->whereIn('id_hotel', $hotelIds)
                ->whereBetween('price', [$fMinPrice, $fMaxPrice])
                ->inRandomOrder()->get();
        }

        if ($fStar) {
            $fStar = explode(',', $request->fStar);
            $hotelIds = $hotel->modelKeys();
            $hotel = Hotel::where('status', 1)->whereIn('id_hotel', $hotelIds)->whereIn('star', $fStar)->inRandomOrder()->get();
        }

        return $hotel;
    }
}
