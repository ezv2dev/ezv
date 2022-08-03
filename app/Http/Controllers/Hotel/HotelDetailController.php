<?php

namespace App\Http\Controllers\Hotel;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Amenities;
use App\Models\BathRoom;
use App\Models\BedRoom;
use App\Models\Hotel;
use App\Models\HotelAmenities;
use App\Models\HotelBathroom;
use App\Models\HotelBedroom;
use App\Models\HotelDetailReview;
use App\Models\HotelKitchen;
use App\Models\HotelPhoto;
use App\Models\HotelSafety;
use App\Models\HotelService;
use App\Models\HotelStory;
use App\Models\HotelTypeDetail;
use App\Models\HotelType;
use App\Models\HotelRoomBooking;
use App\Models\HotelTypeDetailAmenities;
use App\Models\HotelVideo;
use App\Models\Kitchen;
use App\Models\Location;
use App\Models\PropertyTypeVilla;
use App\Models\Restaurant;
use App\Models\Safety;
use App\Models\Service;
use App\Services\DeviceCheckService;
use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\HotelRoomPhoto;
use App\Models\HotelHasGuestSafety;
use App\Models\GuestSafety;
use App\Models\HotelRules;
use App\Models\Bed;
use App\Models\HotelCategory;
use App\Models\HotelFilter;
use App\Models\HotelHasCategory;
use App\Models\HotelHasFilter;
use App\Models\HotelRoomDetails;
use App\Models\NotificationOwner;
use Illuminate\Support\Facades\Validator;
use File;
use App\Services\FileCompressionService as FileCompression;
use App\Services\DestinationNearbyHotelService as Nearby;
use App\Services\GoogleMapsAPIService as GoogleMaps;

class HotelDetailController extends Controller
{
    public static  function amenities($id)
    {
        $amenities = HotelAmenities::select('amenities.icon as icon', 'amenities.name as name')->where('id_hotel', $id)->join('amenities', 'hotel_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')->get();

        return $amenities;
    }

    public static  function bathroom($id)
    {
        $bathroom = HotelBathroom::select('bathroom.icon as icon', 'bathroom.name as name')->where('id_hotel', $id)->join('bathroom', 'hotel_bathroom.id_bathroom', '=', 'bathroom.id_bathroom', 'left')->get();

        return $bathroom;
    }

    public static  function bedroom($id)
    {
        $bedroom = HotelBedroom::select('bedroom.icon as icon', 'bedroom.name as name')->where('id_hotel', $id)->join('bedroom', 'hotel_bedroom.id_bedroom', '=', 'bedroom.id_bed', 'left')->get();

        return $bedroom;
    }

    public static  function kitchen($id)
    {
        $kitchen = HotelKitchen::select('kitchen.icon as icon', 'kitchen.name as name')->where('id_hotel', $id)->join('kitchen', 'hotel_kitchen.id_kitchen', '=', 'kitchen.id_kitchen', 'left')->get();

        return $kitchen;
    }

    public static  function safety($id)
    {
        $safety = HotelSafety::select('safety.icon as icon', 'safety.name as name')->where('id_hotel', $id)->join('safety', 'hotel_safety.id_safety', '=', 'safety.id_safety', 'left')->get();

        return $safety;
    }

    public static  function service($id)
    {
        $service = HotelService::select('service.icon as icon', 'service.name as name')->where('id_hotel', $id)->join('service', 'hotel_service.id_service', '=', 'service.id_service', 'left')->get();

        return $service;
    }


    public function video_open($id)
    {
        // $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.price as price')
        //     ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')
        //     ->where('villa_video.id_video', $id)->get();

        $data = HotelVideo::with('hotel')->where('id_video', $id)->first();

        if ($data) {
            return response()->json([
                'video' => $data->name,
                'hotel' => (object)[
                    'name' => $data->hotel->name,
                    'uid' => $data->hotel->uid,
                ] ?? null
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        echo json_encode($data);
    }


    // Map
    public function hotel_map(Request $request)
    {
        if ($request->id) {
            $data = Hotel::where('id_hotel', $request->id)->first();
            if (!$data) {
                return response()->json(
                    [
                        'message' => 'data not found'
                    ],
                    404
                );
            }
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => 'something was wrong'
            ], 500);
        }
    }


    public function hotel_details(Request $request)
    {
        $data = Hotel::with([
            'location', 'amenities', 'detailReview'
        ])->where('id_hotel', $request->id)->first();

        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function villa_nearby_hotel(Request $request)
    {
        // * Get latitude Longitude Hotel
        $get_hotel = Hotel::where('id_hotel', $request->id)->first();
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
        $filtered_data = array();
        foreach ($kilometers as $data) {
            // if($data->kilometer <= 3) {
            //     array_push($filtered_data, $data);
            // }
            if (true) {
                array_push($filtered_data, $data);
            }
        }

        // return data
        $convertJson = response()->json($filtered_data, 200);
        return $convertJson ?? null;
    }

    public function activity_nearby_hotel(Request $request)
    {
        // * Get latitude Longitude Hotel
        $get_hotel = Hotel::where('id_hotel', $request->id)->first();
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
        $filtered_data = array();
        foreach ($kilometers2 as $data) {
            // if($data->kilometer <= 3) {
            //     array_push($filtered_data, $data);
            // }
            if (true) {
                array_push($filtered_data, $data);
            }
        }

        // return data
        $convertJson = response()->json($filtered_data, 200);
        return $convertJson ?? null;
    }

    public function restaurant_nearby_hotel(Request $request)
    {
        // * Get latitude Longitude Hotel
        $get_hotel = Hotel::where('id_hotel', $request->id)->first();
        $latitude1_hotel = $get_hotel->latitude;
        $longitude1_hotel = $get_hotel->longitude;
        // dd($latitude1_hotel, $longitude1_hotel);

        // * Get Latitude Longitude Restaurant
        $get_lat_long_restaurant = Restaurant::with([
            'video', 'photo', 'type', 'cuisine', 'location', 'detailReview'
        ])->where('status', '1')->get();

        // dd($get_lat_long_restaurant);
        $point1 = array(
            'lat' => $latitude1_hotel, 'long' => $longitude1_hotel, 'id_location'
        );
        $kilometers2 = array();
        $j = 0;
        foreach ($get_lat_long_restaurant as $item) {
            $lat3 = $point1['lat'];
            $lon3 = $point1['long'];
            $lat4 = $item->latitude;
            $lon4 = $item->longitude;
            $restaurants_detail = $item;
            $theta = $lon3 - $lon4;
            // dd($lat3, $lon3, $lat4, $lon4, $id_location_restaurant, $name_restaurant, $theta);

            $miles = (sin(deg2rad($lat3)) * sin(deg2rad($lat3))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers2[$j] = (object)[
                'kilometer' => number_format((float)$miles * 1.609344, 1, '.', ''),
                'detail' => $restaurants_detail
            ];
            $j++;
        }

        // filter data
        $filtered_data = array();
        foreach ($kilometers2 as $data) {
            // if($data->kilometer <= 3) {
            //     array_push($filtered_data, $data);
            // }
            if (true) {
                array_push($filtered_data, $data);
            }
        }

        // return data
        $convertJson = response()->json($filtered_data, 200);
        return $convertJson ?? null;
    }

    public function hotel($id)
    {
        $hotel = Hotel::with('hotel_room', 'location', 'ownerHotel', 'ownerData', 'detailReview', 'detailComment')->where('id_hotel', $id)->get();

        // check if the editor does not have authorization
        if (auth()->check()) {
            $find = Hotel::find($id);
            abort_if(!$find, 404);
            if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->id == $find->created_by) {
                $hotel = Hotel::with('hotel_room', 'location', 'ownerHotel', 'ownerData', 'detailReview', 'detailComment')->where('id_hotel', $id)->get();
            }
        }

        // increase views
        $hotelAddViews = Hotel::find($id)->increment('views');

        $hotelRoomPhoto = HotelRoomPhoto::where('id_hotel', $id)->get();

        $photo = HotelPhoto::where('id_hotel', $id)->orderBy('order', 'asc')->get();
        $video = HotelVideo::where('id_hotel', $id)->orderBy('order', 'asc')->get();
        $amenities = HotelAmenities::select('hotel_amenities.id_hotel', 'amenities.icon as icon', 'amenities.name as name')
            ->join('amenities', 'hotel_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
            ->where('hotel_amenities.id_hotel', $id)->limit(5)->get();
        $ratting = HotelDetailReview::where('id_hotel', $id)->get();
        $stories = HotelStory::where('id_hotel', $id)->orderBy('created_at', 'desc')->get();
        $location = Location::get();
        $propertyType = PropertyTypeVilla::all();
        $amenities_m = Amenities::get();
        $bathroom_m = BathRoom::get();
        $bedroom_m = BedRoom::get();
        $kitchen_m = Kitchen::get();
        $safety_m = Safety::get();
        $service_m = Service::get();
        $hotel_amenities = HotelAmenities::select('amenities.icon as icon', 'amenities.name as name')
            ->join('amenities', 'hotel_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
            ->where('id_hotel', $id)->get();

        $beds = Bed::get();

        $bathroom = HotelBathroom::select('bathroom.icon as icon', 'bathroom.name as name')->join('bathroom', 'hotel_bathroom.id_bathroom', '=', 'bathroom.id_bathroom', 'left')->where('id_hotel', $id)->get();
        $bedroom = HotelBedroom::select('bedroom.icon as icon', 'bedroom.name as name')->join('bedroom', 'hotel_bedroom.id_bedroom', '=', 'bedroom.id_bed', 'left')->where('id_hotel', $id)->get();
        $kitchen = HotelKitchen::select('kitchen.icon as icon', 'kitchen.name as name')->join('kitchen', 'hotel_kitchen.id_kitchen', '=', 'kitchen.id_kitchen', 'left')->where('id_hotel', $id)->get();
        $safety = HotelSafety::select('safety.icon as icon', 'safety.name as name')->join('safety', 'hotel_safety.id_safety', '=', 'safety.id_safety', 'left')->where('id_hotel', $id)->get();
        $service = HotelService::select('service.icon as icon', 'service.name as name')->join('service', 'hotel_service.id_service', '=', 'service.id_service', 'left')->where('id_hotel', $id)->get();
        $detail = HotelDetailReview::where('id_hotel', $id)->get();

        // $get_hotel = Hotel::where('id_hotel', $id)->first();
        // $point = array('lat' => $get_hotel->latitude, 'long' => $get_hotel->longitude, 'id_location' => $get_hotel->id_location);
        // // ? Start Activity Slider
        // $compare_activity = Activity::all();

        // $kilometers = array();
        // $i = 0;
        // foreach ($compare_activity as $item) {
        //     $lat1 = $point['lat'];
        //     $lon1 = $point['long'];
        //     $lat2 = $item->latitude;
        //     $lon2 = $item->longitude;
        //     $id_activity = $item->id_activity;
        //     $name = $item->name;
        //     $theta = $lon1 - $lon2;

        //     $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        //     $miles = acos($miles);
        //     $miles = rad2deg($miles);
        //     $miles = $miles * 60 * 1.1515;
        //     $kilometers[$i][] = number_format((float)$miles * 1.609344, 1, '.', '');
        //     $kilometers[$i][] = $id_activity;
        //     $kilometers[$i][] = $name;
        //     $i++;
        // }

        // $unsorted_data = collect($kilometers);
        // $sorted_data1 = $unsorted_data->sortBy('0');
        // $last = $sorted_data1;

        // $locArray = array();
        // foreach ($last as $item1) {
        //     array_push($locArray, $item1[1]);
        // }
        // // ? End Activity Slider

        // // ? Start Restaurant Slider
        // $compare_restaurant = Restaurant::all();

        // $kilometers2 = array();
        // $j = 0;
        // foreach ($compare_restaurant as $item) {
        //     $lat3 = $point['lat'];
        //     $lon3 = $point['long'];
        //     $lat4 = $item->latitude;
        //     $lon4 = $item->longitude;
        //     $id_restaurant = $item->id_restaurant;
        //     $name2 = $item->name;
        //     $theta2 = $lon3 - $lon4;

        //     $miles2 = (sin(deg2rad($lat3)) * sin(deg2rad($lat4))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta2)));
        //     $miles2 = acos($miles2);
        //     $miles2 = rad2deg($miles2);
        //     $miles2 = $miles2 * 60 * 1.1515;
        //     $kilometers2[$j][] = number_format((float)$miles2 * 1.609344, 1, '.', '');
        //     $kilometers2[$j][] = $id_restaurant;
        //     $kilometers2[$j][] = $name2;
        //     $j++;
        // }

        // $unsorted_data2 = collect($kilometers2);
        // $sorted_data2 = $unsorted_data2->sortBy('0');
        // $last2 = $sorted_data2;

        // $locArray2 = array();
        // foreach ($last2 as $item2) {
        //     array_push($locArray2, $item2[1]);
        // }
        // // ? End Restaurant Slider

        // $ids_ordered = implode(',', $locArray);
        // $ids_ordered2 = implode(',', $locArray2);
        // $nearby_activities = Nearby::activity($id);
        // $nearby_activities = collect($nearby_activities)->slice(0, 10);
        // $nearby_restaurant = Nearby::restaurant($id);
        // $nearby_restaurant = collect($nearby_restaurant)->slice(0, 10);

        // $latitudeHotel = $hotel[0]->latitude;
        // $longitudeHotel = $hotel[0]->longitude;
        // $googleApi = 'AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk';

        // $k = 0;

        // foreach ($nearby_activities as $item) {
        //     $point1 = array('lat' => $latitudeHotel, 'long' => $longitudeHotel);
        //     $point2 = array('lat2' => $item->detail->latitude, 'long2' => $item->detail->longitude);

        //     $urlDriving =
        //         'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $point1['lat'] . ',' . $point1['long'] . '&destinations=' . $point2['lat2'] . ',' . $point2['long2'] . "&mode=driving&key=${googleApi}";
        //     $urlWalking =
        //         'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $point1['lat'] . ',' . $point1['long'] . '&destinations=' . $point2['lat2'] . ',' . $point2['long2'] . "&mode=walking&key=${googleApi}";

        //     $item->kilometer = GoogleMaps::calculateDistance($urlDriving);
        //     $item->detail['eta_driving'] = GoogleMaps::calculateTime($urlDriving);
        //     $item->detail['eta_walking'] = GoogleMaps::calculateTime($urlWalking);

        //     $k++;
        // }

        // $h = 0;

        // foreach ($nearby_restaurant as $item) {
        //     $point1 = array('lat' => $latitudeHotel, 'long' => $longitudeHotel);
        //     $point2 = array('lat2' => $item->detail->latitude, 'long2' => $item->detail->longitude);

        //     $urlDriving =
        //         'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $point1['lat'] . ',' . $point1['long'] . '&destinations=' . $point2['lat2'] . ',' . $point2['long2'] . "&mode=driving&key=${googleApi}";
        //     $urlWalking =
        //         'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $point1['lat'] . ',' . $point1['long'] . '&destinations=' . $point2['lat2'] . ',' . $point2['long2'] . "&mode=walking&key=${googleApi}";

        //     $item->kilometer = GoogleMaps::calculateDistance($urlDriving);
        //     $item->detail['eta_driving'] = GoogleMaps::calculateTime($urlDriving);
        //     $item->detail['eta_walking'] = GoogleMaps::calculateTime($urlWalking);

        //     $h++;
        // }

        $hotelType = HotelType::get();
        $hotelTypeDetail = HotelTypeDetail::with('bed', 'hotel', 'hotelType', 'typeAmenities')->where('id_hotel', $id)->get();
        $hotelRoomBooking = HotelRoomBooking::with('hotel', 'hotel_room')->where('id_hotel', $id)->get();
        $hotelTags = HotelHasFilter::where('id_hotel', $id)->get();
        $hotelFilter = HotelFilter::all();
        $hotelCategory = HotelCategory::all();
        $hotelHasCategory = HotelHasCategory::where('id_hotel', $id)->get();
        $hotelRoomDetails = HotelRoomDetails::where('id_hotel', $id)->get();
        $hotelRules = HotelRules::where('id_hotel', $id)->with('hotel')->first();

        return view('user.hotel.hotel', compact('hotelRoomPhoto', 'hotelRoomDetails', 'hotelTags', 'hotelRules', 'hotelFilter', 'hotelCategory', 'hotelHasCategory', 'hotelRoomBooking', 'hotelType', 'beds', 'video', 'detail', 'hotel_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'hotel', 'photo', 'amenities', 'ratting', 'stories', 'location', 'amenities_m', 'bathroom_m', 'bedroom_m', 'kitchen_m', 'safety_m', 'service_m', 'propertyType', 'hotelTypeDetail'));
    }

    public function hotel_update_hotel_rules(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'children' => 'required',
            'infants' => 'required',
            'pets' => 'required',
            'smoking' => 'required',
            'events' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        $checkID = HotelRules::where('id_hotel', '=', $request->id_hotel)->first();

        $data = [
            'id_hotel' => $request->id_hotel,
            'children' => $request->children,
            'infants' => $request->infants,
            'pets' => $request->pets,
            'smoking' => $request->smoking,
            'events' => $request->events,
        ];

        if ($checkID == null) {
            $checkID = HotelRules::create(array(
                'id_hotel' => $request->id_hotel,
                'children' => $request->children,
                'infants' => $request->infants,
                'pets' => $request->pets,
                'smoking' => $request->smoking,
                'events' => $request->events,
            ));

            return response()->json([
                'data' => $data,
                'message' => 'Updated Hotel Rules',
            ], 200);
        } else {
            $checkID->update(array(
                'id_hotel' => $request->id_hotel,
                'children' => $request->children,
                'infants' => $request->infants,
                'pets' => $request->pets,
                'smoking' => $request->smoking,
                'events' => $request->events,
            ));

            return response()->json([
                'data' => $data,
                'message' => 'Updated Hotel Rules',
            ], 200);
        }
    }

    public function hotel_update_guest_safety(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pool' => 'required',
            'lake' => 'required',
            'climb' => 'required',
            'height' => 'required',
            'animal' => 'required',
            'camera' => 'required',
            'monoxide' => 'required',
            'alarm' => 'required',
            'must' => 'required',
            'potential' => 'required',
            'come' => 'required',
            'shared' => 'required',
            'amenity' => 'required',
            'parking' => 'required',
            'weapon' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        $deleteID = HotelHasGuestSafety::where('id_hotel', '=', $request->id_hotel)->delete();

        $data = [];
        $i = 0;

        if ($request->pool == 1) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 1,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->pool)
                ->select('icon', 'guest_safety', 'description')->first();
            $i++;
        }
        if ($request->lake == 2) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 2,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->lake)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->climb == 3) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 3,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->climb)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->height == 4) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 4,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->height)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->animal == 5) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 5,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->animal)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->camera == 6) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 6,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->camera)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->monoxide == 7) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 7,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->monoxide)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->alarm == 8) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 8,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->alarm)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->must == 9) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 9,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->must)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->potential == 10) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 10,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->potential)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->come == 11) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 11,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->come)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->parking == 12) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 12,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->parking)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->shared == 13) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 13,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->shared)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->amenity == 14) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 14,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->amenity)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->weapon == 15) {
            HotelHasGuestSafety::create(array(
                'id_hotel' => $request->id_hotel,
                'id_guest_safety' => 15,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->weapon)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }

        return response()->json([
            'data' => $data,
            'id_hotel' => $request->id_hotel,
            'message' => 'Update Health & Safety Hotel',
        ], 200);
    }

    public function grade(Request $request, $id)
    {
        $status = 500;

        $find = Hotel::where('id_hotel', $id)->first();

        $find->update(array(
            'grade' => $request->grade,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->back()->with('success', 'Your data has been update');
    }

    public function request_update_status(Request $request)
    {
        $id = $request->id;
        abort_if(!auth()->check(), 401);
        abort_if(!$id, 500);
        $find = Hotel::where('id_hotel', $id)->first();
        abort_if(!$find, 404);
        $this->authorize('listvilla_update');
        abort_if(auth()->user()->id != $find->created_by, 403);

        $find = Hotel::where('id_hotel', $id)->first();

        $status = false;

        if ($find->status == 0) {
            $find->update(array(
                'status' =>  2, //request activation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($find->status == 1) {
            $find->update(array(
                'status' =>  3, //request deactivation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($status) {
            return back()
                ->with('success', 'request has been sended');
        } else {
            return back()
                ->with('error', 'request fail to sended due internal server error');
        }
    }

    public function hotel_update_name(Request $request)
    {
        // dd($request->all());
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = Hotel::where('id_hotel', $request->id_hotel)->first();

            if (Auth::user()->id == 1 || Auth::user()->id == 2) {
                $find->update(array(
                    'name' => $request->name,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_by' => Auth::user()->id,
                ));
            } else {
                $find->update(array(
                    'name' => $request->name,
                    'original_name' => $request->name,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_by' => Auth::user()->id,
                ));
            }

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            // return back()
            //     ->with('success', 'Your data has been updated');
            return response()->json(['success' => true, 'message' => 'Succesfully Updated Hotel Name',  'data' => $request->name]);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json(['errors' => true, 'message' => 'Fail Updated Hotel Name',  'data' => $request->name]);
        }
    }

    public function hotel_update_star(Request $request)
    {
        $find = Hotel::where('id_hotel', $request->id_hotel)->first();

        $find->update(array(
            'star' => $request->star,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return response()->json(['success' => true, 'message' => 'Succesfully Updated Hotel Star',  'data' => $request->star]);
    }

    public function hotel_update_image(Request $request)
    {
        // dd($request->all());
        // $this->authorize('listvilla_update');
        // // validation
        // request()->validate([
        //     'id_hotel' => ['required', 'integer'],
        //     'image' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960'],
        // ]);
        // $status = 500;

        // try {
        //     $hotel = Hotel::where('id_hotel', $request->id_hotel)->first();
        //     $folder = strtolower($hotel->uid);

        //     // $path = public_path() . '/foto/gallery/' . $folder;
        //     // $folder = $hotel->uid;
        //     $path = env("HOTEL_FILE_PATH") . $folder;

        //     if (!File::isDirectory($path)) {

        //         File::makeDirectory($path, 0777, true, true);
        //     }

        //     $ext = strtolower($request->image->getClientOriginalExtension());
        //     // dd($ext);

        //     if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
        //         $original_name = $request->image->getClientOriginalName();
        //         // dd($original_name);
        //         $find = Hotel::where('id_hotel', $request->id_hotel)->first();

        //         $name_file = time() . "_" . $original_name;

        //         $name_file = FileCompression::compressImageToCustomExt($request->image, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

        //         $find->update(array(
        //             'image' => $name_file,
        //             'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
        //             'updated_by' => Auth::user()->id,
        //         ));
        //     }

        //     if ($find) {
        //         $status = 200;
        //     }
        // } catch (\Illuminate\Database\QueryException $e) {
        //     $status = 500;
        // }

        // if ($status == 200) {
        //     // return back()
        //     //     ->with('success', 'Your data has been updated');
        //     return response()->json(['success' => true, 'message' => 'Succesfully Updated Hotel Profile',  'data' => $request->name]);
        // } else {
        //     // return back()
        //     //     ->with('error', 'Please check the form below for errors');
        //     return response()->json(['errors' => true, 'message' => 'Fail Updated Hotel Profile',  'data' => $request->name]);
        // }

        //test baru
        $hotel = Hotel::where('id_hotel', $request->id_hotel)->first('uid');
        $folder = $hotel->uid;
        $path = env("HOTEL_FILE_PATH") . $folder;

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->image->getClientOriginalExtension());

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            $original_name = $request->image->getClientOriginalName();
            $find = Hotel::where('id_hotel', $request->id_hotel)->first();
            $name_file = time() . "_" . $original_name;
            $name_file = FileCompression::compressImageToCustomExt($request->image, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');
            $updatedHotel = $find->update(array(
                'image' => $name_file,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        }

        $hotelData = Hotel::where('id_hotel', $request->id_hotel)->select('image')->first();

        if ($updatedHotel) {
            return response()->json([
                'message' => 'Successfuly Updated Hotel Profile',
                'status' => 200,
                'data' => $hotelData
            ]);
        } else {
            return response()->json([
                'message' => 'Error Updated Hotel Profile',
                'status' => 500,
            ]);
        }
    }

    public function hotel_delete_image(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id, 500);
        abort_if(!auth()->check(), 401);

        $hotel = Hotel::find($request->id);
        abort_if(!$hotel, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotel->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $hotel->name;
        $folder = strtolower($hotel->uid);
        $path = env("HOTEL_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $hotel->image)) {
            File::delete($path . '/' . $hotel->image);
        }

        $deleted = $hotel->update([
            'image' => NULL,
            'updated_by' => auth()->user()->id
        ]);

        // check if delete is success or not
        if ($deleted) {
            // return back()
            //     ->with('success', 'Your data has been deleted');
            return response()->json([
                'message' => 'Delete Data Successfuly',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Delete Data',
                'status' => 500,
            ], 500);
        }
    }

    public function hotel_update_bedroom(Request $request)
    {
        $this->authorize('listvilla_update');

        $validator = Validator::make($request->all(), [
            'adult' => ['required', 'integer'],
            'children' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        $status = 500;

        try {
            $find = Hotel::where('id_hotel', $request->id_hotel)->first();

            $find->update(array(
                'bedroom' => $request->bedroom,
                'bathroom' => $request->bathroom,
                'adult' => $request->adult,
                'children' => $request->children,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function hotel_update_short_description(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = Hotel::where('id_hotel', $request->id_hotel)->firstOrFail();

            $find->update(array(
                'short_description' => $request->short_description,
                // 'short_description' => str_replace(array("\n", "\r"), ' ', $request->short_description),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            // return back()
            //     ->with('success', 'Your data has been updated');
            return response()->json(['data' => $request->short_description, 'message' => 'Succesfully Updated Hotel Short Description']);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json(['data' => $request->short_description, 'errors' => 'Failed Updated Hotel Short Description']);
        }
    }

    public function hotel_update_story(Request $request)
    {
        // test
        $validator = Validator::make($request->all(), [
            'id_hotel' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:100'],
            'file' => ['required', 'mimes:mp4,mov']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 500);
        }

        // restaurant data
        $hotel = Hotel::find($request->id_hotel);

        // check if restaurant does not exist, abort 404
        if (!$hotel) {
            return response()->json([
                'message' => 'Hotel Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotel->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // store process
        // $path = public_path() . '/foto/restaurant/' . $restaurant->name;
        $folder = strtolower($hotel->uid);
        // dd($folder);
        $path = env("HOTEL_FILE_PATH") . $folder;
        // dd($path);

        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->file->getClientOriginalExtension());

        if ($ext == 'mp4' || $ext == 'mov') {
            $original_name = $request->file->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            // isi dengan nama folder tempat kemana file diupload
            $request->file->move($path, $name_file);

            // dd($name_file);

            //insert into database
            $createdStory = HotelStory::create([
                'id_hotel' => $request->id_hotel,
                'name' => $name_file,
                'title' => $request->title,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }

        $getStory = HotelStory::where('id_hotel', $request->id_hotel)->select('name', 'id_story')->latest()->get();
        $getUID = Hotel::where('id_hotel', $request->id_hotel)->select('uid')->first();
        $hotelVideo = HotelVideo::where('id_hotel', $request->id_hotel)->select('id_video', 'name')->orderBy('order', 'asc')->get();

        $data = [];

        $i = 0;

        foreach ($getStory as $item) {
            $data[$i]['id_story'] = $item->id_story;
            $data[$i]['name'] = $item->name;
            $i++;
        }

        // return $data;

        // check if update is success or not
        if ($createdStory) {
            return response()->json([
                'message' => 'Updated Hotel Story',
                'data' => $data,
                'uid' => $getUID->uid,
                'video' => $hotelVideo,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Updated Hotel Story',
            ], 500);
        }
    }

    public function story($id)
    {
        // $data = VillaStory::where('id_story', $id)->get();
        $data = HotelStory::with('hotel')->where('id_story', $id)->first();

        if ($data) {
            return response()->json([
                'id_story' => $data->id_story,
                'title' => $data->title,
                'name' => $data->name,
                'hotel' => (object)[
                    'id_hotel' => $data->hotel->id_hotel,
                    'name_hotel' => $data->hotel->name,
                    'uid' => $data->hotel->uid,
                ] ?? null,
                'thumbnail' => $data->thumbnail,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
                'created_by' => $data->created_by,
                'updated_by' => $data->updated_by
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function hotel_delete_story(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_story || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $hotel = Hotel::find($request->id);
        $hotelStory = HotelStory::find($request->id_story);
        abort_if(!$hotel, 404);
        abort_if(!$hotelStory, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotelStory->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $hotel->name;
        $folder = strtolower($hotel->uid);
        $path = env("HOTEL_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $hotelStory->name)) {
            File::delete($path . '/' . $hotelStory->name);
        }

        $deletedHotelStory = $hotelStory->delete();

        // check if delete is success or not
        if ($deletedHotelStory) {
            // return back()
            //     ->with('success', 'Your data has been deleted');
            return response()->json([
                'message' => 'Delete Data Successfuly',
                'status' => 200,
            ], 200);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json([
                'message' => 'Failed Deleted Data',
                'status' => 500,
            ], 500);
        }
    }

    public function hotel_update_description(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = hotel::where('id_hotel', $request->id_hotel)->first();

            $find->update(array(
                'description' => $request->description,
                // 'description' => str_replace(array("\n", "\r"), ' ', $request->description),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            // return back()
            //     ->with('success', 'Your data has been updated');
            return response()->json(['success' => true, 'message' => 'Succesfully Updated Description Hotel',  'data' => $request->description]);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json(['errors' => true, 'message' => 'Succesfully Updated Description Hotel',  'data' => $request->description]);
        }
    }

    public function hotel_update_amenities(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            //insert into database
            HotelAmenities::where('id_hotel', $request->id_hotel)->delete();
            if (!empty($request->amenities)) {
                foreach ($request->amenities as $row) {
                    HotelAmenities::insert(array(
                        'id_hotel' => $request->id_hotel,
                        'id_amenities' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            HotelBathroom::where('id_hotel', $request->id_hotel)->delete();
            if (!empty($request->bathroom)) {
                foreach ($request->bathroom as $row) {
                    $data = HotelBathroom::insert(array(
                        'id_hotel' => $request->id_hotel,
                        'id_bathroom' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
                // foreach ($request->bathroom as $row) {
                //     $find = VillaBathroom::where('id_villa', $request->id_villa)->where('id_bathroom', $row)->first();
                //     if ($find) {
                //         $find->update(array(
                //             'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                //             'updated_by' => Auth::user()->id,
                //         ));
                //     } else {
                //         $data = VillaBathroom::insert(array(
                //             'id_villa' => $request->id_villa,
                //             'id_bathroom' => $row,
                //             'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                //             'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                //             'created_by' => Auth::user()->id,
                //             'updated_by' => Auth::user()->id,
                //         ));
                //     }
                // }
            }

            HotelBedroom::where('id_hotel', $request->id_hotel)->delete();
            if (!empty($request->bedroom)) {
                foreach ($request->bedroom as $row) {
                    HotelBedroom::insert(array(
                        'id_hotel' => $request->id_hotel,
                        'id_bedroom' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            HotelKitchen::where('id_hotel', $request->id_hotel)->delete();
            if (!empty($request->kitchen)) {
                foreach ($request->kitchen as $row) {
                    HotelKitchen::insert(array(
                        'id_hotel' => $request->id_hotel,
                        'id_kitchen' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            HotelSafety::where('id_hotel', $request->id_hotel)->delete();
            if (!empty($request->safety)) {
                foreach ($request->safety as $row) {
                    HotelSafety::insert(array(
                        'id_hotel' => $request->id_hotel,
                        'id_safety' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            HotelService::where('id_hotel', $request->id_hotel)->delete();
            if (!empty($request->service)) {
                foreach ($request->service as $row) {
                    HotelService::insert(array(
                        'id_hotel' => $request->id_hotel,
                        'id_service' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            $status = 200;
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        $getAmenities = HotelAmenities::with('amenities')->where('id_hotel', $request->id_hotel)->get();
        $getBathroom = HotelBathroom::with('bathroom')->where('id_hotel', $request->id_hotel)->get();
        $getBedroom = HotelBedroom::with('bedroom')->where('id_hotel', $request->id_hotel)->get();
        $getKitchen = HotelKitchen::with('kitchen')->where('id_hotel', $request->id_hotel)->get();
        $getSafety = HotelSafety::with('safety')->where('id_hotel', $request->id_hotel)->get();
        $getService = HotelService::with('service')->where('id_hotel', $request->id_hotel)->get();

        if ($status == 200) {
            // return back()
            //     ->with('success', 'Your data has been updated');
            return response()->json([
                'success' => true,
                'message' => 'Succesfully Updated',
                'getAmenities' => $getAmenities,
                'getBathroom' => $getBathroom,
                'getBedroom' => $getBedroom,
                'getKitchen' => $getKitchen,
                'getSafety' => $getSafety,
                'getService' => $getService
            ]);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json([
                'success' => false,
                'message' => 'Fail Updated'
            ]);
        }
    }

    public function hotel_update_location(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_hotel' => ['required', 'integer'],
            'id_location' => ['required', 'integer'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // villa data
        $villa = Hotel::find($request->id_hotel);

        // check if villa does not exist, abort 404
        if (!$villa) {
            return response()->json([
                'message' => 'Hotel Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedHotel = $villa->update([
            'id_hotel' => $request->id_hotel,
            'id_location' => $request->id_location,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'updated_by' => auth()->user()->id,
        ]);

        $homeData = Hotel::where('id_hotel', $request->id_hotel)->select('latitude', 'longitude')->first();

        // check if update is success or not
        if ($updatedHotel) {
            return response()->json([
                'message' => 'Successfuly Updated Hotel Location',
                'data' => $homeData
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated Hotel Location',
            ], 500);
        }
    }

    public function store_room(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        $hotel = Hotel::where('id_hotel', $request->id_hotel)->first();

        $request->validate([
            'id_hotel_type' => 'required',
            'room_size' => 'required',
            'capacity' => 'required',
            'number_of_room' => 'required',
            'id_bed' => 'required',
            'name_room' => 'required',
            'price' => 'required',
        ]);

        try {

            $roomStore = HotelTypeDetail::create([
                'id_hotel' => $request->id_hotel,
                'name' => $request->name_room,
                'id_hotel_type' => $request->id_hotel_type,
                'id_bed' => $request->id_bed,
                'room_size' => $request->room_size,
                'number_of_room' => $request->number_of_room,
                'capacity' => $request->capacity,
                'status' => $hotel->status,
                'price' => $request->price,
                'updated_by' => Auth::user()->id,
                'created_by' => Auth::user()->id,
            ]);

            if ($roomStore) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }
        $data = HotelTypeDetail::where('id_hotel_room', $roomStore->id_hotel_room)->first();
        if ($status == 200) {
            // return back()
            //     ->with('success', 'Your data has been updated');
            return response()->json([
                'message' => 'Success create room',
                'status' => 200,
                'data' => route('room_hotel', ['id' => $data['id_hotel_room']])
            ], 200);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json([
                'message' => 'Fail create room',
                'status' => 500,
            ], 200);
        }
    }

    public function update_position_photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imageids' => ['required', 'array'],
            'id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 500);
        }

        $imageids_arr = $request->imageids;

        $hotel = Hotel::where('id_hotel', $request->id)->first();

        if (!$hotel) {
            return response()->json([
                'message' => 'Hotel Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotel->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        if (count($imageids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($imageids_arr as $id) {
                $find = HotelPhoto::where('id_photo', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            $data = [
                'photo' => HotelPhoto::where('id_hotel', $request->id)->orderBy('order', 'asc')->get(),
                'video' => HotelVideo::where('id_hotel', $request->id)->orderBy('order', 'asc')->get(),
                'uid' => Hotel::where('id_hotel', $request->id)->select('uid')->first(),
            ];

            return response()->json([
                'data' => $data,
                'message' => 'Updated Position Photo'
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function update_position_video(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'videoids' => ['required', 'array'],
            'id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 500);
        }

        $videoids_arr = $request->videoids;

        $hotel = Hotel::where('id_hotel', $request->id)->first();

        if (!$hotel) {
            return response()->json([
                'message' => 'Hotel Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotel->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        if (count($videoids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($videoids_arr as $id) {
                $find = HotelVideo::where('id_video', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            $data = [
                'photo' => HotelPhoto::where('id_hotel', $request->id)->orderBy('order', 'asc')->get(),
                'video' => HotelVideo::where('id_hotel', $request->id)->orderBy('order', 'asc')->get(),
                'uid' => Hotel::where('id_hotel', $request->id)->select('uid')->first(),
            ];

            return response()->json([
                'data' => $data,
                'message' => 'Updated Position Video'
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function hotel_update_caption_photo(Request $request)
    {
        $this->authorize('listvilla_update');

        $status = 500;

        try {
            $hotel = HotelPhoto::where('id_photo', $request->id_photo)->first();

            $update = $hotel->update([
                'caption' => $request->caption,
                'updated_by' => Auth::user()->id,
            ]);

            if ($update) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function hotel_request_video($id, $name)
    {
        NotificationOwner::create(array(
            'id_user' => $id,
            'message' => 'Someone request a video in ' . $name,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8)
        ));

        return response()->json([
            'message' => 'Success sent a message to Owner',
            'status' => 200,
        ], 200);
    }

    public function hotel_update_tags(Request $request)
    {
        HotelHasFilter::where('id_hotel', $request->id_hotel)->delete();
        foreach ($request->hotelFilter as $row) {
            HotelHasFilter::insert(array(
                'id_hotel' => $request->id_hotel,
                'id_hotel_filter' => $row,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        return back();
    }

    public function hotel_update_category(Request $request)
    {
        HotelHasCategory::where('id_hotel', $request->id_hotel)->delete();
        foreach ($request->hotelCategory as $row) {
            HotelHasCategory::insert(array(
                'id_hotel' => $request->id_hotel,
                'id_hotel_category' => $row,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        $data = HotelHasCategory::with('hotelCategory')->where('id_hotel', $request->id_hotel)->get();
        return response()->json(['success' => true, 'data' => $data, 'message' => 'Updated Property Type']);
    }
}
