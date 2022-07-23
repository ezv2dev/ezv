<?php

namespace App\Http\Controllers;

use File;
use DataTables;
use Carbon\Carbon;
use App\Models\Bed;
use App\Models\Hotel;
use App\Models\Villa;
use App\Models\Review;
use App\Models\Safety;
use App\Models\BedRoom;
use App\Models\Kitchen;
use App\Models\Service;
use App\Models\Activity;
use App\Models\BathRoom;
use App\Models\Calendar;
use App\Models\Location;
use App\Models\Amenities;
use App\Models\VillaSave;
use App\Models\VillaView;
use App\Models\Government;
use App\Models\HouseRules;
use App\Models\Restaurant;
use App\Models\TaxSetting;
use App\Models\VillaPhoto;
use App\Models\VillaStory;

use App\Models\VillaVideo;

use App\Models\GuestSafety;
use App\Models\VillaFamily;
use App\Models\VillaFilter;
use App\Models\VillaSafety;
use App\Models\DetailReview;
use App\Models\HostLanguage;
use App\Models\VillaBedroom;
use App\Models\VillaKitchen;

use App\Models\VillaOutdoor;
use App\Models\VillaService;
use Illuminate\Http\Request;
use App\Models\ActivityPhoto;
use App\Models\ActivityPrice;
use App\Models\ActivityStory;

use App\Models\ActivityVideo;

use App\Models\VillaBathroom;
use App\Models\VillaCategory;
use App\Models\VillaExtraBed;
use App\Models\VillaExtraPet;
use App\Models\RestaurantMenu;
use App\Models\VillaAmenities;
use App\Models\VillaHasFilter;

use App\Models\FamilyAmenities;

use App\Models\RestaurantPhoto;
use App\Models\RestaurantStory;
use App\Models\RestaurantVideo;
use App\Models\VillaExtraGuest;
use App\Models\OutdoorAmenities;
use App\Models\VillaDetailPrice;
use App\Models\VillaHasCategory;

use App\Models\NotificationOwner;
use App\Models\PropertyTypeVilla;
use App\Models\VillaAvailability;
use App\Models\VillaQuickEnquiry;
use App\Models\CancellationPolicy;
use App\Models\VillaBedroomDetail;
use Illuminate\Support\Facades\DB;
use App\Models\VillaHasGuestSafety;
use App\Models\ActivityDetailReview;
use App\Services\DeviceCheckService;
use Illuminate\Support\Facades\Auth;
use App\Models\VillaBedroomDetailBed;
use App\Models\RestaurantDetailReview;
use Illuminate\Support\Facades\Validator;
use App\Models\VillaAccessibilityFeatures;
use App\Models\VillaAccessibilitiyFeaturesDetail;
use App\Services\GoogleMapsAPIService as GoogleMaps;
use App\Services\DestinationNearbyVillaService as Nearby;
use App\Services\FileCompressionService as FileCompression;

use App\Services\CurrencyConversionService as CurrencyConversion;

class ViewController extends Controller
{
    //============================ LOCATIO ON INDEX ===========================
    public static function get_location()
    {
        // $location = Location::inRandomOrder()->limit(5)->get();
        $location = Location::inRandomOrder()->get();
        return $location;
    }

    public static function get_location_ajax(Request $request)
    {
        $location = Location::select('name')->where('name', 'like', '%' . $request->name . '%')->get();
        echo json_encode($location);
    }

    // =========================== HOMEPAGE ========================

    public function index()
    {
        $photo = VillaPhoto::select('villa_photo.*', 'villa.name as name_villa')
            ->join('villa', 'villa_photo.id_villa', '=', 'villa.id_villa', 'left')->limit(20)->get();
        return view('user.index', compact('photo'));
    }

    // Map
    public function villa_map(Request $request)
    {
        if ($request->id) {
            $data = Villa::with([
                'photo', 'video', 'detailReview', 'propertyType', 'location'
            ])->where('id_villa', $request->id)->first();
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

    //================================ VILLA DETAIL ================================

    public function villa($id)
    {
        $villa = Villa::select('villa.*', 'location.name as location')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')->where('id_villa', $id)->with(['guestSafety', 'amenities', 'userCreate'])->where('status', 1)->get();

        // check if the editor does not have authorization
        if (auth()->check()) {
            $find = Villa::find($id);
            abort_if(!$find, 404);
            if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->id == $find->created_by) {
                $villa = Villa::select('villa.*', 'location.name as location')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')->with(['amenities'])->where('id_villa', $id)->get();
            }
        }

        // check if villa exist
        abort_if($villa->count() == 0, 404);

        // increase views
        $villaAddViews = Villa::find($id)->increment('views');
        abort_if(!$villaAddViews, 404);

        // appends additional data to hotel list
        // $villa->each(function ($item, $key) {
        //     $item->setAppends(['restaurant_nearby', 'activity_nearby', 'hotel_nearby']);
        // });

        VillaView::createViewLog($villa);

        $photo = VillaPhoto::where('id_villa', $id)->orderBy('order', 'asc')->get();
        $video = VillaVideo::where('id_villa', $id)->orderBy('order', 'asc')->get();
        $amenities = VillaAmenities::select('villa_amenities.id_villa', 'amenities.icon as icon', 'amenities.name as name')
            ->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
            ->where('villa_amenities.id_villa', $id)->limit(5)->get();
        $ratting = DetailReview::where('id_villa', $id)->get();
        $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $location = Location::get();
        $propertyType = PropertyTypeVilla::all();
        $amenities_m = Amenities::orderBy('name', 'asc')->get();
        $bathroom_m = Bathroom::orderBy('name', 'asc')->get();
        $bedroom_m = Bedroom::orderBy('name', 'asc')->get();
        $kitchen_m = Kitchen::orderBy('name', 'asc')->get();
        $safety_m = Safety::orderBy('name', 'asc')->get();
        $service_m = Service::orderBy('name', 'asc')->get();
        $villa_amenities = VillaAmenities::select('amenities.icon as icon', 'amenities.name as name')->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')->where('id_villa', $id)->get();
        $bathroom = VillaBathroom::select('bathroom.icon as icon', 'bathroom.name as name')->join('bathroom', 'villa_bathroom.id_bathroom', '=', 'bathroom.id_bathroom', 'left')->where('id_villa', $id)->get();
        $bedroom = VillaBedroom::select('bedroom.icon as icon', 'bedroom.name as name')->join('bedroom', 'villa_bedroom.id_bedroom', '=', 'bedroom.id_bed', 'left')->where('id_villa', $id)->get();
        $kitchen = VillaKitchen::select('kitchen.icon as icon', 'kitchen.name as name')->join('kitchen', 'villa_kitchen.id_kitchen', '=', 'kitchen.id_kitchen', 'left')->where('id_villa', $id)->get();
        $safety = VillaSafety::select('safety.icon as icon', 'safety.name as name')->join('safety', 'villa_safety.id_safety', '=', 'safety.id_safety', 'left')->where('id_villa', $id)->get();
        $service = VillaService::select('service.icon as icon', 'service.name as name')->join('service', 'villa_service.id_service', '=', 'service.id_service', 'left')->where('id_villa', $id)->get();
        $detail = DetailReview::where('id_villa', $id)->get();
        $bed = Bed::all();

        $createdby = Villa::select('users.first_name', 'users.last_name', 'users.id', 'owner_profile.about as about_owner')
            ->where('id_villa', $id)
            ->join('users', 'villa.created_by', '=', 'users.id')
            ->join('owner_profile', 'users.id', '=', 'owner_profile.user_id', 'left')
            ->get();

        $government = Government::where('user_id', $createdby[0]->id)->first();
        $get_villa = Villa::where('id_villa', $id)->first();
        $point = array('lat' => $get_villa->latitude, 'long' => $get_villa->longitude, 'id_location' => $get_villa->id_location);

        //? Airport Start
        $airportPoint = array('lat' => -8.7433916, 'long' => 115.1644194);

        $lat7 = $point['lat'];
        $lon7 = $point['long'];
        $lat8 = $airportPoint['lat'];
        $lon8 = $airportPoint['long'];
        $theta4 = $lon7 - $lon8;

        $miles4 = (sin(deg2rad($lat7)) * sin(deg2rad($lat8))) + (cos(deg2rad($lat7)) * cos(deg2rad($lat8)) * cos(deg2rad($theta4)));
        $miles4 = acos($miles4);
        $miles4 = rad2deg($miles4);
        $miles4 = $miles4 * 60 * 1.1515;
        $airportDistance = number_format((float)$miles4 * 1.609344, 1, '.', '');
        //? Airport End

        // $nearby_activities = Nearby::activity($id);
        // // $nearby_activities = collect($nearby_activities);
        // $nearby_activities = collect($nearby_activities)->slice(0, 10);

        // $nearby_restaurant = Nearby::restaurant($id);
        // // $nearby_restaurant = collect($nearby_restaurant);
        // $nearby_restaurant = collect($nearby_restaurant)->slice(0, 10);

        // $latitudeVilla = $villa[0]->latitude;
        // $longitudeVilla = $villa[0]->longitude;
        // // $googleApi = 'AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk';
        // $googleApi = null;

        // $k = 0;

        // foreach ($nearby_activities as $item) {
        //     $point1 = array('lat' => $latitudeVilla, 'long' => $longitudeVilla);
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
        //     $point1 = array('lat' => $latitudeVilla, 'long' => $longitudeVilla);
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

        $house_rules = HouseRules::where('id_villa', $id)->with('villa')->first();
        $cancellation_policy = CancellationPolicy::where('id_villa', $id)->select('type_cancellation')->first();
        $villaExtraGuest = VillaExtraGuest::where('id_villa', $id)->first();
        $villaExtraBed = VillaExtraBed::where('id_villa', $id)->first();
        $villaExtraPet = VillaExtraPet::where('id_villa', $id)->first();

        $villaTags = VillaHasFilter::where('id_villa', $id)->get();
        $villaFilter = VillaFilter::all();
        $villaCategory = VillaCategory::all();
        $villaHasCategory = VillaHasCategory::where('id_villa', $id)->get();

        return view('user.villa', compact(
            'cancellation_policy',
            'villaTags',
            'villaHasCategory',
            'villaCategory',
            'villaFilter',
            'villaExtraGuest',
            'villaExtraBed',
            'villaExtraPet',
            'airportDistance',
            'government',
            'video',
            'detail',
            'villa_amenities',
            'bathroom',
            'bedroom',
            'kitchen',
            'safety',
            'service',
            'villa',
            'photo',
            'amenities',
            'ratting',
            'stories',
            'location',
            'amenities_m',
            'bathroom_m',
            'bedroom_m',
            'kitchen_m',
            'safety_m',
            'service_m',
            'createdby',
            // 'nearby_restaurant',
            // 'nearby_activities',
            'propertyType',
            'house_rules',
            'bed'
        ));
    }

    public function like_favorit(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect(route('login'));
        }

        // check if there same favorit content
        $checkSameFavorit = VillaSave::where([
            ['id_villa', '=', $request->villa],
            ['id_user', '=', $request->user],
        ])->first();

        if ($checkSameFavorit != null) {
            $checkSameFavorit->delete();
            $data = 0;
            return $data;
        } else {
            // otherwise, create favorit
            $data = VillaSave::create([
                'id_villa' => $request->villa,
                'id_user' => $request->user,
                'created_by' => $request->user,
                'updated_by' => $request->user
            ]);

            $data = 1;
            return $data;
        };
    }

    //================================ VILLA DETAIL ================================

    public function villa_set($id, $in, $out, $adult, $child)
    {
        $check_in = $in;
        $check_out = $out;
        $c_adult = $adult;
        $c_child = $child;

        // check if villa exist
        $villa = Villa::find($id)->increment('views');
        abort_if(!$villa, 404);

        $villa = Villa::select('villa.*', 'location.name as location')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')->where('id_villa', $id)->with('guestSafety')->where('status', 1)->get();

        // check if the editor does not have authorization
        if (auth()->check()) {
            $find = Villa::find($id);
            abort_if(!$find, 404);
            if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->id == $find->created_by) {
                $villa = Villa::select('villa.*', 'location.name as location')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')->where('id_villa', $id)->get();
            }
        }
        abort_if($villa->count() == 0, 404);

        VillaView::createViewLog($villa);

        $photo = VillaPhoto::where('id_villa', $id)->orderBy('order', 'asc')->get();
        $video = VillaVideo::where('id_villa', $id)->orderBy('order', 'asc')->get();
        $amenities = VillaAmenities::select('villa_amenities.id_villa', 'amenities.icon as icon', 'amenities.name as name')
            ->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
            ->where('villa_amenities.id_villa', $id)->limit(5)->get();
        $ratting = DetailReview::where('id_villa', $id)->get();
        $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $location = Location::get();
        $propertyType = PropertyTypeVilla::all();
        $amenities_m = Amenities::get();
        $bathroom_m = Bathroom::get();
        $bedroom_m = Bedroom::get();
        $kitchen_m = Kitchen::get();
        $safety_m = Safety::get();
        $service_m = Service::get();
        $villa_amenities = VillaAmenities::select('amenities.icon as icon', 'amenities.name as name')->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')->where('id_villa', $id)->get();
        $bathroom = VillaBathroom::select('bathroom.icon as icon', 'bathroom.name as name')->join('bathroom', 'villa_bathroom.id_bathroom', '=', 'bathroom.id_bathroom', 'left')->where('id_villa', $id)->get();
        $bedroom = VillaBedroom::select('bedroom.icon as icon', 'bedroom.name as name')->join('bedroom', 'villa_bedroom.id_bedroom', '=', 'bedroom.id_bed', 'left')->where('id_villa', $id)->get();
        $kitchen = VillaKitchen::select('kitchen.icon as icon', 'kitchen.name as name')->join('kitchen', 'villa_kitchen.id_kitchen', '=', 'kitchen.id_kitchen', 'left')->where('id_villa', $id)->get();
        $safety = VillaSafety::select('safety.icon as icon', 'safety.name as name')->join('safety', 'villa_safety.id_safety', '=', 'safety.id_safety', 'left')->where('id_villa', $id)->get();
        $service = VillaService::select('service.icon as icon', 'service.name as name')->join('service', 'villa_service.id_service', '=', 'service.id_service', 'left')->where('id_villa', $id)->get();
        $detail = DetailReview::where('id_villa', $id)->get();

        $createdby = Villa::where('id_villa', $id)
            ->join('users', 'villa.created_by', '=', 'users.id')
            ->select('users.first_name', 'users.id', 'users.avatar')
            ->get();

        $government = Government::where('user_id', $createdby[0]->id)->first();

        // dd($government);

        $villa_location = Location::join('villa', 'location.id_location', '=', 'villa.id_location')
            ->where('villa.id_villa', $id)
            ->select('location.id_location')
            ->get();

        // dd($villa_location[0]->id_location);

        // dd($villa_location[0]->id_location);
        $nearby_restaurant = Restaurant::where('id_location', $villa_location[0]->id_location)->where('status', '1')->get();
        $nearby_activities = Activity::where('id_location', $villa_location[0]->id_location)->where('status', '1')->get();

        // * Get latitude Longitude Villa
        $get_villa = Villa::where('id_villa', $id)->first();
        $latitude1_villa = $get_villa->latitude;
        $longitude1_villa = $get_villa->longitude;

        // dd($latitude1_villa, $longitude1_villa);

        // ! Start Nearby Restaurant
        $get_lat_long_restaurant = Restaurant::where('id_location', $villa_location[0]->id_location)
            ->where('status', '1')
            ->select('name', 'latitude', 'longitude', 'id_location')
            ->get();

        $point1 = array('lat' => $latitude1_villa, 'long' => $longitude1_villa, 'id_location');
        // dd($point1);

        $kilometers = array();
        $i = 0;
        foreach ($get_lat_long_restaurant as $item) {
            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $id_location_restaurant = $item->id_location;
            $name_restaurant = $item->name;
            $theta = $lon1 - $lon2;

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers[$i][] = number_format((float)$miles * 1.609344, 1, '.', '');
            $kilometers[$i][] = $id_location_restaurant;
            $kilometers[$i][] = $name_restaurant;
            $i++;
        }

        $unsorted_data = collect($kilometers);
        $sorted_data1 = $unsorted_data->sortBy('0');
        $last = $sorted_data1;
        // ! End Nearby Restaurant

        // ! Start Nearby Things To Do
        $get_lat_long_todo = Activity::where('id_location', $villa_location[0]->id_location)
            ->where('status', '1')
            ->select('name', 'latitude', 'longitude', 'id_location')
            ->get();

        $kilometers2 = array();
        $j = 0;
        foreach ($get_lat_long_todo as $item) {
            $lat3 = $point1['lat'];
            $lon3 = $point1['long'];
            $lat4 = $item->latitude;
            $lon4 = $item->longitude;
            $id_location_todo = $item->id_location;
            $name_todo = $item->name;
            $theta2 = $lon3 - $lon4;

            $miles2 = (sin(deg2rad($lat3)) * sin(deg2rad($lat4))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta2)));
            $miles2 = acos($miles2);
            $miles2 = rad2deg($miles2);
            $miles2 = $miles2 * 60 * 1.1515;
            $kilometers2[$j][] = number_format((float)$miles2 * 1.609344, 1, '.', '');
            $kilometers2[$j][] = $id_location_todo;
            $kilometers2[$j][] = $name_todo;
            $j++;
        }

        $unsorted_data2 = collect($kilometers2);
        $sorted_data2 = $unsorted_data2->sortBy('0');
        $last2 = $sorted_data2;
        // ! End Things To Do Nearby

        // ! Start Hotel Nearby
        $get_lat_long_hotel = Hotel::where('id_location', $villa_location[0]->id_location)
            ->where('status', '1')
            ->select('name', 'latitude', 'longitude', 'id_location')
            ->get();

        $kilometers3 = array();
        $k = 0;
        foreach ($get_lat_long_hotel as $item) {
            $lat5 = $point1['lat'];
            $lon5 = $point1['long'];
            $lat6 = $item->latitude;
            $lon6 = $item->longitude;
            $id_location_hotel = $item->id_location;
            $name_hotel = $item->name;
            $theta3 = $lon5 - $lon6;

            $miles3 = (sin(deg2rad($lat5)) * sin(deg2rad($lat6))) + (cos(deg2rad($lat5)) * cos(deg2rad($lat6)) * cos(deg2rad($theta3)));
            $miles3 = acos($miles3);
            $miles3 = rad2deg($miles3);
            $miles3 = $miles3 * 60 * 1.1515;
            $kilometers2[$k][] = number_format((float)$miles3 * 1.609344, 1, '.', '');
            $kilometers2[$k][] = $id_location_hotel;
            $kilometers2[$k][] = $name_hotel;
            $k++;
        }
        $unsorted_data3 = collect($kilometers3);
        $sorted_data3 = $unsorted_data3->sortBy('0');
        $last3 = $sorted_data3;
        // ! End Hotel Nearby

        $house_rules = HouseRules::where('id_villa', $id)->with('villa')->first();

        // ! Start Airport Nearby
        $villaPoint = array('lat' => $latitude1_villa, 'long' => $longitude1_villa, 'id_location');
        $airportPoint = array('lat' => -8.7433916, 'long' => 115.1644194);

        $lat7 = $villaPoint['lat'];
        $lon7 = $villaPoint['long'];
        $lat8 = $airportPoint['lat'];
        $lon8 = $airportPoint['long'];
        $theta4 = $lon7 - $lon8;

        $miles4 = (sin(deg2rad($lat7)) * sin(deg2rad($lat8))) + (cos(deg2rad($lat7)) * cos(deg2rad($lat8)) * cos(deg2rad($theta4)));
        $miles4 = acos($miles4);
        $miles4 = rad2deg($miles4);
        $miles4 = $miles4 * 60 * 1.1515;
        $airportDistance = number_format((float)$miles4 * 1.609344, 1, '.', '');
        // ! End Airport Nearby

        if (DeviceCheckService::isMobile()) {
            return view('user.m-villa', compact('government', 'video', 'detail', 'villa_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'villa', 'photo', 'amenities', 'ratting', 'stories', 'location', 'amenities_m', 'bathroom_m', 'bedroom_m', 'kitchen_m', 'safety_m', 'service_m', 'createdby', 'nearby_restaurant', 'nearby_activities', 'createdby', 'nearby_restaurant', 'nearby_activities', 'last2', 'propertyType', 'house_rules', 'airportDistance', 'check_in', 'check_out', 'c_adult', 'c_child'));
        }
        if (DeviceCheckService::isDesktop()) {
            return view('user.villa', compact('government', 'video', 'detail', 'villa_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'villa', 'photo', 'amenities', 'ratting', 'stories', 'location', 'amenities_m', 'bathroom_m', 'bedroom_m', 'kitchen_m', 'safety_m', 'service_m', 'createdby', 'nearby_restaurant', 'nearby_activities', 'createdby', 'nearby_restaurant', 'nearby_activities', 'last2', 'propertyType', 'house_rules', 'airportDistance', 'check_in', 'check_out', 'c_adult', 'c_child'));
        }
        return view('user.villa', compact('government', 'video', 'detail', 'villa_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'villa', 'photo', 'amenities', 'ratting', 'stories', 'location', 'amenities_m', 'bathroom_m', 'bedroom_m', 'kitchen_m', 'safety_m', 'service_m', 'createdby', 'nearby_restaurant', 'nearby_activities', 'createdby', 'nearby_restaurant', 'nearby_activities', 'last2', 'propertyType', 'house_rules', 'airportDistance', 'check_in', 'check_out', 'c_adult', 'c_child'));
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

        $villa = Villa::find($request->id);

        if (!$villa) {
            return response()->json([
                'message' => 'Homes Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        if (count($imageids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($imageids_arr as $id) {
                $find = VillaPhoto::where('id_photo', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            $data = [
                'photo' => VillaPhoto::where('id_villa', $request->id)->orderBy('order', 'asc')->get(),
                'video' => VillaVideo::where('id_villa', $request->id)->orderBy('order', 'asc')->get(),
                'uid' => Villa::where('id_villa', $request->id)->select('uid')->first(),
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

        $villa = Villa::find($request->id);

        if (!$villa) {
            return response()->json([
                'message' => 'Homes Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        if (count($videoids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($videoids_arr as $id) {
                $find = VillaVideo::where('id_video', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            $data = [
                'photo' => VillaPhoto::where('id_villa', $request->id)->orderBy('order', 'asc')->get(),
                'video' => VillaVideo::where('id_villa', $request->id)->orderBy('order', 'asc')->get(),
                'uid' => Villa::where('id_villa', $request->id)->select('uid')->first(),
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

    public function fullcalendar($id)
    {
        // $event = VillaDetailPrice::get();
        $data = DB::table('villa_detail_price')
            ->select(
                'villa_detail_price.id_detail',
                'villa_detail_price.id_villa',
                'villa_detail_price.start',
                'villa_detail_price.end',
                'villa_detail_price.disc',
                'villa_detail_price.price as title',
                'villa.name as name',
                'villa.price as regular_price'
            )
            ->join('villa', 'villa_detail_price.id_villa', '=', 'villa.id_villa', 'left')
            ->where('villa_detail_price.id_villa', '=', $id)
            ->get();

        // dd($data);

        $event = array([
            'id_detail' => 0,
            'id_villa' => 0,
            'start' => 0,
            'end' => 0,
            'disc' => 0,
            'title' => 0,
            'name' => 0,
            'regular_price' => 0
        ]);

        $i = 0;

        foreach ($data as $item) {
            $event[$i]['id_detail'] = $item->id_detail;
            $event[$i]['id_villa'] = $item->id_villa;
            $event[$i]['start'] = $item->start;
            $event[$i]['end'] = date('Y-m-d', strtotime($item->end . " +1 days"));
            $event[$i]['disc'] = $item->disc;
            $event[$i]['title'] = CurrencyConversion::exchangeWithUnit($item->title);
            $event[$i]['name'] = $item->name;
            $event[$i]['regular_price'] = $item->regular_price;
            $i++;
        }

        return response()->json($event, 200);
    }

    public function villa_update_special_price(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            if ($request->disc == '') {
                $disc = 0;
            } else {
                $disc = $request->disc;
            }

            $data = VillaDetailPrice::create([
                'id_villa' => $request->id_villa,
                'start' => $request->start,
                'end' => $request->end,
                'price' => $request->special_price,
                'disc' => $disc,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);

            if ($data) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return response()->json([
                'message' => 'Added Special Price'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Added Special Price'
            ], 500);
        }
    }

    public function villa_update_price(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = Villa::where('id_villa', $request->id_villa)->first();

            $find->update(array(
                'price' => $request->price,
                'commission' => $request->commission,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($request->instant_book) {
                $instant_book = 'yes';
            } else {
                $instant_book = 'no';
            }

            $villaInstant = Villa::where('id_villa', $request->id_villa);
            $villaInstant->update(array('instant_book' => $instant_book));

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

    public function villa_update_bedroom(Request $request)
    {
        $bedroom = $request->bedroom;
        $beds = $request->beds;
        $bathroom = $request->bathroom;
        $adult = $request->adult;
        $children = $request->children;
        $size = $request->size;

        $bedroom1 = $request->bedroom1;
        $beds1 = $request->beds1;
        $bathroom1 = $request->bathroom1;
        $adult1 = $request->adult1;
        $children1 = $request->children1;

        $validator = Validator::make($request->all(), [
            'adult' => ['integer'],
            'children' => ['integer'],
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        $find = villa::where('id_villa', $request->id_villa)->first();

        $find->update(array(
            'bedroom' => $bedroom ?? $bedroom1,
            'beds' => $beds ?? $beds1,
            'bathroom' => $bathroom ?? $bathroom1,
            'adult' => $adult ?? $adult1,
            'children' => $children ?? $children1,
            'size' => $size,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return response()->json(['success' => true, 'message' => 'Succesfully Updated',  'data' => $request->all()]);
    }

    public function villa_update_bedroom_detail(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'authenticated',
            ], 401);
        }
        // validation
        $validator = Validator::make($request->all(), [
            'id_villa' => ['integer', 'required'],
            'data' => ['array', 'nullable'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // villa data
        $villa = Villa::find($request->id_villa);

        // check if villa does not exist, abort 404
        if (!$villa) {
            return response()->json([
                'message' => 'Home Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        try {
            // remove old bedroom detail
            $removedDetail = VillaBedroomDetail::where('id_villa', $request->id_villa)->delete();

            collect($request->data)->each(function ($item, $key) use ($request) {
                // save bedroom detail
                if ($request->id_villa) {
                    $createdDetail = VillaBedroomDetail::create([
                        'id_villa' => $request->id_villa,
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id,
                    ]);
                }

                // save bedroom detail bed
                collect($item['bed'])->each(function ($item, $key) use ($createdDetail) {
                    if ($item['qty'] != 0) {
                        VillaBedroomDetailBed::create([
                            'id_villa_bedroom_detail' => $createdDetail->id_villa_bedroom_detail,
                            'id_bed' => $item['id_bed'],
                            'qty' => $item['qty'],
                            'created_by' => auth()->user()->id,
                            'updated_by' => auth()->user()->id,
                        ]);
                    }
                });

                // save bedroom bedroom amenities
                if (isset($item['bedroom_ids'])) {
                    $createdDetail->villaBedroomDetailBedroomAmenities()->sync($item['bedroom_ids']);
                }
                // save bedroom bathroom amenities
                if (isset($item['bathroom_ids'])) {
                    $createdDetail->villaBedroomDetailBathroomAmenities()->sync($item['bathroom_ids']);
                }
            });

            // get created bedroom detail
            $createdDetail = VillaBedroomDetail::with([
                'villaBedroomDetailBed',
                'villaBedroomDetailBedroomAmenities',
                'villaBedroomDetailBathroomAmenities',
                'villaBedroomDetailBed.bed'
            ])->where('id_villa', $request->id_villa)->get();

            if ($createdDetail) {
                $bedCount = 0;
                for ($i = 0; $i < $createdDetail->count(); $i++) {
                    $bedCount = $bedCount + $createdDetail[$i]->bed_count;
                }

                $data = (object)[
                    'message' => 'done',
                    'room_count' => $createdDetail->count(),
                    'bed_count' => $bedCount,
                    'data' => $createdDetail,
                ];

                return response()->json($data, 200);
            } else {
                return response()->json([
                    'message' => 'data not found',
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $data,
            ], 500);
        }
    }

    public function villa_update_guest(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = villa::where('id_villa', $request->id_villa)->first();

            $find->update(array(
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

    public function villa_update_location(Request $request)
    {
        // check if editor not authenticated
        if(!auth()->check())
        {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_villa' => ['required', 'integer'],
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
        $villa = Villa::find($request->id_villa);

        // check if villa does not exist, abort 404
        if (!$villa) {
            return response()->json([
                'message' => 'Home Not Found',
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
        $updatedVilla = $villa->update([
            'id_villa' => $request->id_villa,
            'id_location' => $request->id_location,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'updated_by' => auth()->user()->id,
        ]);

        $homeData = Villa::where('id_villa', $request->id_villa)->select('latitude', 'longitude')->first();

        // check if update is success or not
        if ($updatedVilla) {
            return response()->json([
                'message' => 'Successfuly Updated Home Location',
                'data' => $homeData
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated Home Location',
            ], 500);
        }
    }

    public function villa_update_description(Request $request)
    {
        $find = villa::where('id_villa', $request->id_villa)->first();

        $find->update(array(
            'description' => str_replace(array("\r\n"), "<br><br>", $request->villa_description),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return response()->json(['success' => true, 'message' => 'Updated Description Villa',  'data' => $request->villa_description]);
    }

    public function villa_update_image(Request $request)
    {
        // validation
        // $validator = Validator::make($request->all(), [
        //     'id_villa' => ['required', 'integer'],
        //     'image' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960'],
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'message' => 'something error',
        //         'status' => 500,
        //     ]);
        // }

        $villa = Villa::where('id_villa', $request->id_villa)->first('uid');
        $folder = $villa->uid;
        $path = env("VILLA_FILE_PATH") . $folder;

        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->image->getClientOriginalExtension());
        // dd($ext);

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            $original_name = $request->image->getClientOriginalName();
            $find = villa::where('id_villa', $request->id_villa)->first();
            $name_file = time() . "_" . $original_name;
            $name_file = FileCompression::compressImageToCustomExt($request->image, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');
            $updatedVilla = $find->update(array(
                'image' => $name_file,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        }

        $villaData = Villa::where('id_villa', $request->id_villa)->select('image')->first();

        if ($updatedVilla) {
            return response()->json([
                'message' => 'Successfuly Updated Villa Profile',
                'status' => 200,
                'data' => $villaData
            ]);
        } else {
            return response()->json([
                'message' => 'Error Updated Updated Villa Profile',
                'status' => 500,
            ]);
        }
    }

    public function villa_delete_image(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id, 500);
        abort_if(!auth()->check(), 401);

        $villa = Villa::find($request->id);
        abort_if(!$villa, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = $villa->uid;
        $path = env("VILLA_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $villa->image)) {
            File::delete($path . '/' . $villa->image);
        }

        $deletedVillaImage = $villa->update([
            'image' => NULL,
            'updated_by' => auth()->user()->id
        ]);

        // check if delete is success or not
        if ($deletedVillaImage) {
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

    public function villa_update_name(Request $request)
    {
        $find = villa::where('id_villa', $request->id_villa)->first();

        if (Auth::user()->id == 1 || Auth::user()->id == 2) {
            $find->update(array(
                'name' => $request->villa_name,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        } else {
            $find->update(array(
                'name' => $request->villa_name,
                'original_name' => $request->villa_name,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        }

        return response()->json(['success' => true, 'message' => 'Updated Villa Name',  'data' => $request->villa_name]);
    }

    public function villa_get_name($id)
    {
        $data = Villa::where('id_villa', $id)->select('name')->first();
        return response()->json(['data' => $data->name]);
    }

    public function villa_update_short_description(Request $request)
    {
        $find = villa::where('id_villa', $request->id_villa)->first();

        $find->update(array(
            'short_description' => str_replace(array("\n", "\r"), ' ', $request->short_desc),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return response()->json(['data' => $request->short_desc, 'message' => 'Updated Villa Short Description']);
    }

    public function villa_get_short_description($id)
    {
        $data = Villa::where('id_villa', $id)->select('short_description')->first();

        return response()->json(['data' => $data->short_description]);
    }

    public function villa_update_amenities(Request $request)
    {
        VillaAmenities::where('id_villa', $request->id_villa)->delete();
        if (!empty($request->amenities)) {
            foreach ($request->amenities as $row) {
                VillaAmenities::insert(array(
                    'id_villa' => $request->id_villa,
                    'id_amenities' => $row,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            }
        }

        VillaBathroom::where('id_villa', $request->id_villa)->delete();
        if (!empty($request->bathroom)) {
            foreach ($request->bathroom as $row) {
                $data = VillaBathroom::insert(array(
                    'id_villa' => $request->id_villa,
                    'id_bathroom' => $row,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            }
        }

        // VillaBedroom::where('id_villa', $request->id_villa)->delete();
        // if (!empty($request->bedroom)) {
        //     foreach ($request->bedroom as $row) {
        //         VillaBedroom::insert(array(
        //             'id_villa' => $request->id_villa,
        //             'id_bedroom' => $row,
        //             'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
        //             'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
        //             'created_by' => Auth::user()->id,
        //             'updated_by' => Auth::user()->id,
        //         ));
        //     }
        // }

        VillaKitchen::where('id_villa', $request->id_villa)->delete();
        if (!empty($request->kitchen)) {
            foreach ($request->kitchen as $row) {
                VillaKitchen::insert(array(
                    'id_villa' => $request->id_villa,
                    'id_kitchen' => $row,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            }
        }

        VillaSafety::where('id_villa', $request->id_villa)->delete();
        if (!empty($request->safety)) {
            foreach ($request->safety as $row) {
                VillaSafety::insert(array(
                    'id_villa' => $request->id_villa,
                    'id_safety' => $row,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            }
        }

        VillaService::where('id_villa', $request->id_villa)->delete();
        if (!empty($request->service)) {
            foreach ($request->service as $row) {
                VillaService::insert(array(
                    'id_villa' => $request->id_villa,
                    'id_service' => $row,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            }
        }

        $getAmenities = VillaAmenities::with('amenities')->where('id_villa', $request->id_villa)->get();
        $getBathroom = VillaBathroom::with('bathroom')->where('id_villa', $request->id_villa)->get();
        $getKitchen = VillaKitchen::with('kitchen')->where('id_villa', $request->id_villa)->get();
        $getSafety = VillaSafety::with('safety')->where('id_villa', $request->id_villa)->get();
        $getService = VillaService::with('service')->where('id_villa', $request->id_villa)->get();

        return response()->json([
            'success' => true,
            'message' => 'Succesfully Updated',
            'getAmenities' => $getAmenities,
            'getBathroom' => $getBathroom,
            'getKitchen' => $getKitchen,
            'getSafety' => $getSafety,
            'getService' => $getService
        ]);
    }

    public function villa_update_tags(Request $request)
    {
        VillaHasFilter::where('id_villa', $request->id_villa)->delete();
        foreach ($request->villaFilter as $row) {
            VillaHasFilter::insert(array(
                'id_villa' => $request->id_villa,
                'id_villa_filter' => $row,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        $data = VillaFilter::whereIn('id_villa_filter', $request->villaFilter)->select('name')->get();

        return response()->json(['success' => true, 'message' => 'Succesfully Updated', 'data' => $data]);
    }

    public function villa_update_category(Request $request)
    {
        VillaHasCategory::where('id_villa', $request->id_villa)->delete();
        foreach ($request->villaCategory as $row) {
            VillaHasCategory::insert(array(
                'id_villa' => $request->id_villa,
                'id_villa_category' => $row,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        $data = VillaHasCategory::with('villaCategory')->where('id_villa', $request->id_villa)->get();

        return response()->json(['success' => true, 'data' => $data, 'message' => 'Updated Property Type']);
    }

    public function villa_update_property_type(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id_villa' => ['required', 'integer'],
            'id_property_type' => ['required', 'integer']
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        // villa
        $villa = Villa::find($request->id_villa);

        // check if restaurant does not exist, abort 404
        abort_if(!$villa, 404);

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by) {
            abort(403);
        }

        // update
        $updatedVilla = $villa->update([
            'id_property_type' => $request->id_property_type,
            'updated_by' => auth()->user()->id,
        ]);

        // check if update is success or not
        if ($updatedVilla) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    // original

    // public function villa_update_photo(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'id_villa' => ['required', 'integer'],
    //         'file' => ['required', 'mimes:jpeg,png,jpg,webp,mp4,mov']
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => $validator->errors()->all(),
    //         ], 500);
    //     }

    //     // restaurant data
    //     $villa = Villa::find($request->id_villa);

    //     // check if restaurant does not exist, abort 404
    //     if (!$villa) {
    //         return response()->json([
    //             'message' => 'Homes Not Found'
    //         ], 404);
    //     }

    //     // check if the editor does not have authorization
    //     $this->authorize('listvilla_update');
    //     if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by) {
    //         return response()->json([
    //             'message' => 'This action is unauthorized'
    //         ], 403);
    //     }

    //     // store process
    //     // $path = public_path() . '/foto/restaurant/' . $restaurant->name;
    //     $folder = strtolower($villa->uid);
    //     $path = env("VILLA_FILE_PATH") . $folder;

    //     if (!File::isDirectory($path)) {

    //         File::makeDirectory($path, 0777, true, true);
    //     }

    //     $ext = strtolower($request->file->getClientOriginalExtension());

    //     $photo = [];

    //     if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
    //         $validator2 = Validator::make($request->all(), [
    //             'id_villa' => ['required', 'integer'],
    //             'file' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960']
    //         ]);

    //         if ($validator2->fails()) {
    //             return response()->json([
    //                 'message' => $validator2->errors()->all(),
    //             ], 500);
    //         }

    //         $original_name = $request->file->getClientOriginalName();

    //         $name_file = time() . "_" . $original_name;

    //         $name_file = FileCompression::compressImageToCustomExt($request->file, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

    //         // check last order
    //         $lastOrder = VillaPhoto::where('id_villa', $request->id_villa)->orderBy('order', 'desc')->select('order')->first();
    //         if ($lastOrder) {
    //             $lastOrder = $lastOrder->order + 1;
    //         } else {
    //             $lastOrder = 1;
    //             $lastOrder;
    //         }

    //         //insert into database
    //         $createdVilla = VillaPhoto::create([
    //             'id_villa' => $request->id_villa,
    //             'name' => $name_file,
    //             'order' => $lastOrder,
    //             'created_by' => auth()->user()->id,
    //             'updated_by' => auth()->user()->id
    //         ]);

    //         // $photo['id_photo'] = $createdRestaurant->id_photo;
    //         array_push($photo, $createdVilla->id_photo);
    //     }

    //     $video = [];

    //     if ($ext == 'mp4' || $ext == 'mov') {
    //         $original_name = $request->file->getClientOriginalName();
    //         // dd($original_name);
    //         $name_file = time() . "_" . $original_name;
    //         // isi dengan nama folder tempat kemana file diupload
    //         $request->file->move($path, $name_file);

    //         // check last order
    //         $lastOrder = VillaVideo::where('id_villa', $request->id_villa)->orderBy('order', 'desc')->select('order')->first();
    //         if ($lastOrder) {
    //             $lastOrder = $lastOrder->order + 1;
    //         } else {
    //             $lastOrder = 1;
    //             $lastOrder;
    //         }

    //         //insert into database
    //         $createdVilla = VillaVideo::create([
    //             'id_villa' => $request->id_villa,
    //             'name' => $name_file,
    //             'order' => $lastOrder,
    //             'created_by' => auth()->user()->id,
    //             'updated_by' => auth()->user()->id
    //         ]);

    //         array_push($video, $createdVilla->id_video);
    //     }

    //     $villaReturn = [
    //         'photo' => VillaPhoto::whereIn('id_photo', $photo)->get(),
    //         'video' => VillaVideo::whereIn('id_video', $video)->get(),
    //         'uid' => Villa::where('id_villa', $request->id_villa)->select('uid')->first(),
    //     ];

    //     if ($createdVilla) {
    //         return response()->json([
    //             'message' => 'Update Gallery Homes',
    //             'data' => $villaReturn,
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'message' => 'Update Gallery Homes',
    //         ], 500);
    //     }
    // }


    // modifikasi
    public function villa_update_photo(Request $request)
    {

        // restaurant data
        $villa = Villa::find($request->id_villa);

        // check if restaurant does not exist, abort 404
        if (!$villa) {
            return response()->json([
                'message' => 'Homes Not Found'
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized'
            ], 403);
        }

        // store process
        // $path = public_path() . '/foto/restaurant/' . $restaurant->name;
        $folder = strtolower($villa->uid);
        $path = env("VILLA_FILE_PATH") . $folder;

        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->file->getClientOriginalExtension());

        $photo = [];

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            $validator2 = Validator::make($request->all(), [
                'id_villa' => ['required', 'integer'],
                'file' => ['required', 'dimensions:min_width=960']
            ]);

            if ($validator2->fails()) {
                return response()->json([
                    'message' => $validator2->errors()->all(),
                ], 500);
            }

            $original_name = $request->file->getClientOriginalName();

            $name_file = time() . "_" . $original_name;

            $name_file = FileCompression::compressImageToCustomExt($request->file, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

            // check last order
            $lastOrder = VillaPhoto::where('id_villa', $request->id_villa)->orderBy('order', 'desc')->select('order')->first();
            if ($lastOrder) {
                $lastOrder = $lastOrder->order + 1;
            } else {
                $lastOrder = 1;
                $lastOrder;
            }

            //insert into database
            $createdVilla = VillaPhoto::create([
                'id_villa' => $request->id_villa,
                'name' => $name_file,
                'order' => $lastOrder,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);

            // $photo['id_photo'] = $createdRestaurant->id_photo;
            array_push($photo, $createdVilla->id_photo);
        }

        $video = [];

        if ($ext == 'mp4' || $ext == 'mov') {
            $original_name = $request->file->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            // isi dengan nama folder tempat kemana file diupload
            $request->file->move($path, $name_file);

            // check last order
            $lastOrder = VillaVideo::where('id_villa', $request->id_villa)->orderBy('order', 'desc')->select('order')->first();
            if ($lastOrder) {
                $lastOrder = $lastOrder->order + 1;
            } else {
                $lastOrder = 1;
                $lastOrder;
            }

            //insert into database
            $createdVilla = VillaVideo::create([
                'id_villa' => $request->id_villa,
                'name' => $name_file,
                'order' => $lastOrder,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);

            array_push($video, $createdVilla->id_video);
        }

        $villaReturn = [
            'photo' => VillaPhoto::whereIn('id_photo', $photo)->get(),
            'video' => VillaVideo::whereIn('id_video', $video)->get(),
            'uid' => Villa::where('id_villa', $request->id_villa)->select('uid')->first(),
        ];


        if (isset($createdVilla) == true) {
            return response()->json([
                'message' => 'Update Gallery Homes',
                'data' => $villaReturn,
            ], 200);
        } else if (isset($createdVilla) == false) {
            $validator = Validator::make($request->all(), [
                'id_villa' => ['required', 'integer'],
                'file' => ['required', 'mimes:jpeg,png,jpg,webp,mp4,mov']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                ], 500);
            }
        }
    }

    public function villa_quick_enquiry(Request $request)
    {
        $quick = new VillaQuickEnquiry;
        $quick->check_in = $request->check_in;
        $quick->check_out = $request->check_out;
        $quick->adult = $request->adult;
        $quick->child = $request->child;
        $quick->first_name = $request->first_name;
        $quick->last_name = $request->last_name;
        $quick->email_sender = $request->email;
        $quick->email_receiver = $request->email_receiver;
        $quick->phone = $request->phone;
        $quick->additional_information = $request->additional_information;

        $details = [
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'adult' => $request->adult,
            'child' => $request->child,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email_sender' => $request->email_sender,
            'phone' => $request->phone,
            'additional_information' => $request->additional_information,
            'villa_name' => $request->villa_name,
        ];

        \Mail::to($request->email_receiver)->send(new \App\Mail\QuickEnquiryMail($details));

        // $quick->save();
        // return back();
        if ($quick->save()) {
            return response()->json([
                'message' => 'Data sent Successfuly',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed send of Data',
                'status' => 500,
            ], 500);
        }
    }

    public function villa_delete_photo_video(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_video || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $villa = Villa::find($request->id);
        $villaVideo = VillaVideo::find($request->id_video);
        abort_if(!$villa, 404);
        abort_if(!$villaVideo, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villaVideo->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = $villa->uid;
        $path = env("VILLA_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $villaVideo->name)) {
            File::delete($path . '/' . $villaVideo->name);
        }

        $deletedVillaVideo = $villaVideo->delete();
        // check if delete is success or not
        if ($deletedVillaVideo) {
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

    public function villa_delete_photo_photo(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_photo || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $villa = Villa::find($request->id);
        $villaPhoto = VillaPhoto::find($request->id_photo);
        abort_if(!$villa, 404);
        abort_if(!$villaPhoto, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villaPhoto->created_by;
        abort_if($condition, 403);

        // delete photo
        $folder = $villa->uid;
        $path = env("VILLA_FILE_PATH") . $folder;

        // remove old photo
        if (File::exists($path . '/' . $villaPhoto->name)) {
            File::delete($path . '/' . $villaPhoto->name);
        }

        $deletedVillaPhoto = $villaPhoto->delete();

        // check if delete is success or not
        if ($deletedVillaPhoto) {
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

    public function villa_update_story(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id_villa' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:100'],
            'file' => ['required', 'mimes:mp4,mov']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 500);
        }

        // restaurant data
        $villa = Villa::find($request->id_villa);

        // check if restaurant does not exist, abort 404
        if (!$villa) {
            return response()->json([
                'message' => 'Homes Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // store process
        // $path = public_path() . '/foto/restaurant/' . $restaurant->name;
        $folder = strtolower($villa->uid);
        // dd($folder);
        $path = env("VILLA_FILE_PATH") . $folder;
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
            $createdStory = VillaStory::create([
                'id_villa' => $request->id_villa,
                'name' => $name_file,
                'title' => $request->title,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }

        $getStory = VillaStory::where('id_villa', $request->id_villa)->select('name', 'id_story')->latest()->get();
        $getUID = Villa::where('id_villa', $request->id_villa)->select('uid')->first();
        $villaVideo = VillaVideo::where('id_villa', $request->id_villa)->select('id_video','name')->orderBy('order','asc')->get();

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
                'message' => 'Updated Homes Story',
                'data' => $data,
                'uid' => $getUID->uid,
                'video' => $villaVideo,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Updated Homes Story',
            ], 500);
        }
    }

    public function villa_delete_story(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_story || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $villa = Villa::find($request->id);
        $villaStory = VillaStory::find($request->id_story);
        abort_if(!$villa, 404);
        abort_if(!$villaStory, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villaStory->created_by;
        abort_if($condition, 403);

        // delete video
        $folder = $villa->uid;
        $path = env("VILLA_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $villaStory->name)) {
        }

        $deletedVillaStory = $villaStory->delete();

        // check if delete is success or not
        if ($deletedVillaStory) {
            return response()->json([
                'message' => 'Delete Data Successfuly',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Deleted Data',
                'status' => 500,
            ], 500);
        }
    }

    public function update_order($id)
    {
        if (isset($_GET["order"])) {
            $order  = explode(",", $_GET["order"]);
            for ($i = 0; $i < count($order); $i++) {
                $sql = "UPDATE reorder SET display_order='" . $i . "' WHERE id=" . $order[$i];
                mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
            }
        }
    }

    public function story($id)
    {
        // $data = VillaStory::where('id_story', $id)->get();
        $data = VillaStory::with('villa')->where('id_story', $id)->first();

        if ($data) {
            return response()->json([
                'id_story' => $data->id_story,
                'title' => $data->title,
                'name' => $data->name,
                'villa' => (object)[
                    'id_villa' => $data->villa->id_villa,
                    'uid' => $data->villa->uid
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

    public function story_next($id, $id_villa)
    {
        $data = VillaStory::where('id_story', '<', $id)->where('id_villa', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();

        if ($data->count() == 0) {
            $data = VillaStory::where('id_villa', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();
        }

        echo json_encode($data);
    }

    public function video($id)
    {
        $villa = Villa::select('villa.*', 'location.name as location')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')->where('id_villa', $id)->get();
        $amenities = VillaAmenities::select('villa_amenities.id_villa', 'amenities.icon as icon', 'amenities.name as name')
            ->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
            ->where('villa_amenities.id_villa', $id)->limit(5)->get();
        $ratting = DetailReview::where('id_villa', $id)->get();
        $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $video = VillaVideo::where('id_villa', $id)->get();
        return view('user.video', compact('video', 'villa', 'amenities', 'ratting', 'stories'));
    }

    public function description($id)
    {
        $villa = Villa::select('villa.*', 'location.name as location')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')->where('id_villa', $id)->get();
        $amenities = VillaAmenities::select('villa_amenities.id_villa', 'amenities.icon as icon', 'amenities.name as name')
            ->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
            ->where('villa_amenities.id_villa', $id)->limit(5)->get();
        $ratting = DetailReview::where('id_villa', $id)->get();
        $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $villa_amenities = VillaAmenities::select('amenities.icon as icon', 'amenities.name as name')->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')->where('id_villa', $id)->get();
        $bathroom = VillaBathroom::select('bathroom.icon as icon', 'bathroom.name as name')->join('bathroom', 'villa_bathroom.id_bathroom', '=', 'bathroom.id_bathroom', 'left')->where('id_villa', $id)->get();
        $bedroom = VillaBedroom::select('bedroom.icon as icon', 'bedroom.name as name')->join('bedroom', 'villa_bedroom.id_bedroom', '=', 'bedroom.id_bed', 'left')->where('id_villa', $id)->get();
        $kitchen = VillaKitchen::select('kitchen.icon as icon', 'kitchen.name as name')->join('kitchen', 'villa_kitchen.id_kitchen', '=', 'kitchen.id_kitchen', 'left')->where('id_villa', $id)->get();
        $safety = VillaSafety::select('safety.icon as icon', 'safety.name as name')->join('safety', 'villa_safety.id_safety', '=', 'safety.id_safety', 'left')->where('id_villa', $id)->get();
        $service = VillaService::select('service.icon as icon', 'service.name as name')->join('service', 'villa_service.id_service', '=', 'service.id_service', 'left')->where('id_villa', $id)->get();
        $detail = DetailReview::where('id_villa', $id)->get();
        return view('user.description', compact('villa', 'villa_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'detail', 'amenities', 'ratting', 'stories'));
    }

    public function availabality(Request $request, $id)
    {
        if ($request->ajax()) {

            $data = Calendar::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'summary', 'start', 'end', 'uid', 'id_villa']);

            return response()->json($data);
        }
        $villa = Villa::where('id_villa', $id)->get();
        return view('user.availabality', compact('villa'));
    }

    public function ajax(Request $request)
    {

        switch ($request->type) {
            case 'add':
                $event = Calendar::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = Calendar::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = Calendar::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                # code...
                break;
        }
    }

    public function confirm(Request $request)
    {
        dd($request->all());
        $id = $request->id_villa;
        $villa = Villa::where('id_villa', $id)->get();

        //get number of night
        $startTimeStamp = strtotime($request->check_in);
        $endTimeStamp = strtotime($request->check_out);
        $timeDiff = abs($endTimeStamp - $startTimeStamp);
        $numberDays = $timeDiff / 86400;
        $night = intval($numberDays);
        $tax_setting = TaxSetting::select('total_tax')->first();
        $tax = $tax_setting->total_tax;
        $adult = $request->adult;
        $child = $request->child;
        $infant = $request->infant;
        $pet = $request->pet;

        //total
        $total = $night * $villa[0]->price;

        $taxs = $total * $tax / 100;

        $total_all = $total + $taxs;

        $data = $request;

        return view('user.confirm', compact('data', 'villa', 'night', 'total', 'taxs', 'total_all', 'adult', 'child', 'infant', 'pet'));
    }

    public function request_update_status(Request $request)
    {
        $id = $request->id_villa;
        $find = Villa::where('id_villa', $id)->first();

        if ($find->status == 0) {
            $find->update(array(
                'status' =>  2, //request activation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            return response()->json(['message' => 'Successfuly request for activiation', 'data' => 2]);
        }

        if ($find->status == 1) {
            $find->update(array(
                'status' =>  3, //request deactivation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            return response()->json(['message' => 'Successfuly request for deactivation', 'data' => 3]);
        }
    }

    public function cancel_request_update_status(Request $request)
    {
        $id = $request->id_villa;
        $find = Villa::where('id_villa', $id)->first();

        if ($find->status == 2) {
            $find->update(array(
                'status' =>  0, //cancel request activation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            return response()->json(['message' => 'Successfuly cancel request activiation', 'data' => 0]);
        }

        if ($find->status == 3) {
            $find->update(array(
                'status' =>  1, //cancel request deactivation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            return response()->json(['message' => 'Successfuly cancel request deactiviation', 'data' => 1]);
        }
    }

    //======================= LIST VILLA ======================================
    public function villa_list()
    {
        $req = 0;
        $villa = Villa::with('location')->select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
            ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
            ->where('villa.status', 1)
            ->inRandomOrder()->get();

        dd($villa);

        //return view('user.list_villa', compact('villa', 'req'));
        return view('user.m-list_villa', compact('villa', 'req'));
    }

    public function list(Request $request)
    {
        $host_language = HostLanguage::all();

        $accessibility_features = VillaAccessibilityFeatures::all();
        $accessibility_features_detail = VillaAccessibilitiyFeaturesDetail::all();

        // $villa = Villa::where('status', 1)->paginate(env('CONTENT_PER_PAGE_LIST_VILLA') ?? 5);
        $villa = Villa::where('status', 1)->paginate(env('CONTENT_PER_PAGE_LIST_VILLA') ?? 5);
        // dd($villa->sortBy('grade')->pluck('grade', 'id_villa'));
        $villa->appends(request()->query());

        // TODO uncomment when lazy load, start
        // $villas = Villa::where('grade', '!=', 'AA')->where('status', 1)->inRandomOrder()->get()->sortBy('grade');
        // $villa_aa = Villa::where('grade', '=', 'AA')->where('status', 1)->inRandomOrder()->get();
        // if ($request->itemIds) {
        //     $villas = Villa::where('grade', '!=', 'AA')->where('status', 1)->whereNotIn('id_villa', $request->itemIds)->inRandomOrder()->get()->sortBy('grade');
        //     $villa_aa = Villa::where('grade', '=', 'AA')->where('status', 1)->whereNotIn('id_villa', $request->itemIds)->inRandomOrder()->get();
        // }

        // if ($villas->count() > 0 && $villa_aa->count() > 0) {
        //     $split_count = $villas->count() / 4;
        //     $villas_parted = $villas->split(ceil($split_count));
        //     for ($i = 0; $i < $villa_aa->count(); $i++) {
        //         if ($i == 0) {
        //             $villa = $villas_parted[0];
        //             $villa->push($villa_aa[0]);
        //         } else {
        //             if (isset($villas_parted[$i])) {
        //                 foreach ($villas_parted[$i] as $item) {
        //                     $villa->push($item);
        //                 }
        //                 $villa->push($villa_aa[$i]);
        //             } elseif ($villa_aa[$i]) {
        //                 $villa->push($villa_aa[$i]);
        //             }
        //         }
        //     }
        // }

        // if ($villas->count() > 0 && $villa_aa->count() <= 0) {
        //     $villa = $villas;
        // }

        // if ($villas->count() <= 0 && $villa_aa->count() > 0) {
        //     $villa = $villa_aa;
        // }
        // if ($villas->count() <= 0 && $villa_aa->count() <= 0) {
        //     $villa = collect([]);
        // }

        // if ($villa->count() > 0) {
        //     // dd($villa->pluck('grade', 'id_villa'));
        //     $page = 1;
        //     $perPage = 5;
        //     $villa = new \Illuminate\Pagination\LengthAwarePaginator(
        //         $villa->forPage($page, $perPage),
        //         $villa->count(),
        //         $perPage,
        //         $page
        //     );
        // }

        // if ($request->ajax()) {
        //     $view = view('user.data_list_villa', compact('villa'))->render();
        //     return response()->json(['html' => $view]);
        // }
        // TODO end

        $villa->each(function ($item, $key) {
            $item->setAppends(['restaurant_nearby', 'activity_nearby', 'hotel_nearby']);
        });

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

        $propertyType = PropertyTypeVilla::all();
        $villaCategory = VillaCategory::all();
        $villaFilter = VillaFilter::all();
        $amenities = Amenities::select('icon', 'name', 'order', 'id_amenities')->get();

        return view('user.list_villa', compact('villa', 'amenities', 'host_language', 'propertyType', 'villaCategory', 'villaFilter', 'accessibility_features', 'accessibility_features_detail'));
    }

    public static  function gallery($id)
    {
        $gallery = VillaPhoto::select('villa_photo.name as photo')->where('id_villa', $id)->orderBy('order', 'asc')->get();
        return $gallery;
    }

    public function villa_video($id)
    {
        // $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.price as price', 'location.name as location', 'villa.short_description as short', 'detail_review.count_person as count', 'villa.bedroom as bedroom', 'villa.bathroom as bathroom', 'villa.beds as beds', 'villa.id_villa as id_villas')
        //     ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')
        //     ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
        //     ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
        //     ->where('villa_video.id_villa', $id)->get();
        $data = Villa::with([
            'location',
            'video'
        ])->where('id_villa', $id)->first();
        $video = VillaVideo::where('id_villa', $id)->orderBy('order', 'desc')->first();
        if ($data && $video) {
            return response()->json([
                'id_villa' => $data->id_villa,
                'uid' => $data->uid,
                'name' => $data->name,
                'short_description' => $data->short_description,
                'bedroom' => $data->bedroom,
                'bathroom' => $data->bathroom,
                'price' => $data->price,
                'beds' => $data->beds,
                'video' => $video,
                'is_favorit' => $data->is_favorit,
                'location' => $data->location
            ]);
        }
        return response()->json([]);
        // echo json_encode($data);
    }

    public function next($id)
    {
        $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.price as price', 'location.name as location', 'villa.short_description as short', 'detail_review.count_person as count', 'villa.bedroom as bedroom', 'villa.bathroom as bathroom', 'villa.beds as beds', 'villa.id_villa as id_villas')
            ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
            ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
            ->where('villa_video.id_villa', $id)->get();


        echo json_encode($data);
    }

    public function video_open($id)
    {
        // $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.price as price')
        //     ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')
        //     ->where('villa_video.id_video', $id)->get();

        $data = VillaVideo::with('villa')->where('id_video', $id)->first();

        if ($data) {
            return response()->json([
                'video' => $data->name,
                'villa' => (object)[
                    'name' => $data->villa->name,
                    'uid' => $data->villa->uid
                ] ?? null
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        echo json_encode($data);
    }


    public static  function amenities($id)
    {
        $amenities = VillaAmenities::select('amenities.icon as icon', 'amenities.name as name')->where('id_villa', $id)->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')->get();

        return $amenities;
    }

    public static  function bathroom($id)
    {
        $bathroom = VillaBathroom::select('bathroom.icon as icon', 'bathroom.name as name')->where('id_villa', $id)->join('bathroom', 'villa_bathroom.id_bathroom', '=', 'bathroom.id_bathroom', 'left')->get();

        return $bathroom;
    }

    public static  function bedroom($id)
    {
        $bedroom = VillaBedroom::select('bedroom.icon as icon', 'bedroom.name as name')->where('id_villa', $id)->join('bedroom', 'villa_bedroom.id_bedroom', '=', 'bedroom.id_bed', 'left')->get();

        return $bedroom;
    }

    public static  function kitchen($id)
    {
        $kitchen = VillaKitchen::select('kitchen.icon as icon', 'kitchen.name as name')->where('id_villa', $id)->join('kitchen', 'villa_kitchen.id_kitchen', '=', 'kitchen.id_kitchen', 'left')->get();

        return $kitchen;
    }

    public static  function safety($id)
    {
        $safety = VillaSafety::select('safety.icon as icon', 'safety.name as name')->where('id_villa', $id)->join('safety', 'villa_safety.id_safety', '=', 'safety.id_safety', 'left')->get();

        return $safety;
    }

    public static  function service($id)
    {
        $service = VillaService::select('service.icon as icon', 'service.name as name')->where('id_villa', $id)->join('service', 'villa_service.id_service', '=', 'service.id_service', 'left')->get();

        return $service;
    }

    public function review($id)
    {
        $villa = Villa::where('id_villa', $id)->get();
        $review = Review::select('villa_review.*', 'users.name as name')
            ->join('users', 'villa_review.created_by', '=', 'users.id', 'left')
            ->where('id_villa', $id)->get();
        $detail = DetailReview::where('id_villa', $id)->get();
        return view('user.review', compact('villa', 'review', 'detail'));
    }


    //============================= RESTAURANT LIST =============================
    public function restaurant_list(Request $request)
    {

        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $restaurant = Restaurant::select('restaurant.*', DB::raw('(select name from restaurant_video where id_restaurant = restaurant.id_restaurant order by id_video asc limit 1) as video'), DB::raw('(select name from restaurant_photo where id_restaurant = restaurant.id_restaurant order by id_photo asc limit 1) as photo'), 'restaurant_detail_review.average as average', 'restaurant_detail_review.count_person as person')
                ->join('restaurant_detail_review', 'restaurant.id_restaurant', '=', 'restaurant_detail_review.id_restaurant', 'left')
                ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')
                ->inRandomOrder()->get();
        } else {
            $restaurant = Restaurant::select('restaurant.*', DB::raw('(select name from restaurant_video where id_restaurant = restaurant.id_restaurant order by id_video asc limit 1) as video'), DB::raw('(select name from restaurant_photo where id_restaurant = restaurant.id_restaurant order by id_photo asc limit 1) as photo'), 'restaurant_detail_review.average as average', 'restaurant_detail_review.count_person as person')
                ->join('restaurant_detail_review', 'restaurant.id_restaurant', '=', 'restaurant_detail_review.id_restaurant', 'left')
                ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')
                ->where('location.name', 'like', '%' . $request->location . '%')
                ->inRandomOrder()->get();
        }

        $amenities = Amenities::all();

        return view('user.list_restaurant', compact('req', 'restaurant', 'amenities'));
    }

    public static  function restaurant_gallery($id)
    {
        $gallery = RestaurantPhoto::select('restaurant_photo.name as photo')->where('id_restaurant', $id)->get();

        return $gallery;
    }

    public function restaurant_video($id)
    {
        $data = RestaurantVideo::select('restaurant_video.name as video', 'restaurant.name as name')
            ->join('restaurant', 'restaurant_video.id_restaurant', '=', 'restaurant.id_restaurant', 'left')
            ->where('restaurant_video.id_restaurant', $id)->get();

        echo json_encode($data);
    }

    public function restaurant_next()
    {
        $data = RestaurantVideo::select('restaurant_video.name as video', 'restaurant.name as name')
            ->join('restaurant', 'restaurant_video.id_restaurant', '=', 'restaurant.id_restaurant', 'left')
            ->inRandomOrder()->limit(1)->get();


        echo json_encode($data);
    }



    //================================ RESTAURANT DETAIL ================================

    public function restaurant($id)
    {
        // check if restaurant exist
        $restaurant = Restaurant::find($id);
        abort_if(!$restaurant, 404);

        $restaurant = Restaurant::select('restaurant.*', 'location.name as location')
            ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')->where('id_restaurant', $id)->get();
        $photo = RestaurantPhoto::where('id_restaurant', $id)->get();
        // $amenities = restaurantAmenities::select('restaurant_amenities.id_restaurant', 'amenities.icon as icon', 'amenities.name as name')
        //         ->join('amenities', 'restaurant_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
        //         ->where('restaurant_amenities.id_restaurant', $id)->limit(5)->get();
        $ratting = RestaurantDetailReview::where('id_restaurant', $id)->get();
        $stories = RestaurantStory::where('id_restaurant', $id)->orderBy('created_at', 'desc')->get();
        $menu = RestaurantMenu::where('id_restaurant', $id)->get();
        return view('user.restaurant.restaurant', compact('restaurant', 'photo', 'ratting', 'stories', 'menu'));
    }

    public function det_restaurant_video($id)
    {
        $restaurant = Restaurant::select('restaurant.*', 'location.name as location')
            ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')->where('id_restaurant', $id)->get();
        $ratting = RestaurantDetailReview::where('id_restaurant', $id)->get();
        $video = RestaurantVideo::where('id_restaurant', $id)->get();
        $stories = RestaurantStory::where('id_restaurant', $id)->orderBy('created_at', 'desc')->get();
        return view('user.restaurant.video', compact('video', 'restaurant', 'ratting', 'stories'));
    }

    public function restaurant_description($id)
    {
        $restaurant = Restaurant::select('restaurant.*', 'location.name as location')
            ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')->where('id_restaurant', $id)->get();
        $ratting = RestaurantDetailReview::where('id_restaurant', $id)->get();
        // $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $detail = RestaurantDetailReview::where('id_restaurant', $id)->get();
        $stories = RestaurantStory::where('id_restaurant', $id)->orderBy('created_at', 'desc')->get();
        return view('user.restaurant.description', compact('restaurant', 'detail', 'ratting', 'stories'));
    }

    public function restaurant_menu($id)
    {
        $restaurant = Restaurant::select('restaurant.*', 'location.name as location')
            ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')->where('id_restaurant', $id)->get();
        $ratting = RestaurantDetailReview::where('id_restaurant', $id)->get();
        // $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $detail = RestaurantDetailReview::where('id_restaurant', $id)->get();
        $menu = RestaurantMenu::where('id_restaurant', $id)->get();
        $stories = RestaurantStory::where('id_restaurant', $id)->orderBy('created_at', 'desc')->get();
        return view('user.restaurant.menu', compact('restaurant', 'detail', 'ratting', 'menu', 'stories'));
    }

    public function restaurant_story($id)
    {
        $data = RestaurantStory::where('id_story', $id)->get();

        echo json_encode($data);
    }

    public function restaurant_story_next($id, $id_villa)
    {
        $data = RestaurantStory::where('id_story', '<', $id)->where('id_restaurant', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();

        if ($data->count() == 0) {
            $data = RestaurantStory::where('id_restaurant', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();
        }

        echo json_encode($data);
    }




    //============================= ACTIVITY LIST =============================
    public function activity_list(Request $request)
    {

        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $activity = Activity::select('activity.*', DB::raw('(select name from activity_video where id_activity = activity.id_activity order by id_video asc limit 1) as video'), DB::raw('(select name from activity_photo where id_activity = activity.id_activity order by id_photo asc limit 1) as photo'), 'activity_detail_review.average as average', 'activity_detail_review.count_person as person')
                ->join('activity_detail_review', 'activity.id_activity', '=', 'activity_detail_review.id_activity', 'left')
                ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')
                ->inRandomOrder()->get();
        } else {
            $activity = Activity::select('activity.*', DB::raw('(select name from activity_video where id_activity = activity.id_activity order by id_video asc limit 1) as video'), DB::raw('(select name from activity_photo where id_activity = activity.id_activity order by id_photo asc limit 1) as photo'), 'activity_detail_review.average as average', 'activity_detail_review.count_person as person')
                ->join('activity_detail_review', 'activity.id_activity', '=', 'activity_detail_review.id_activity', 'left')
                ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')
                ->where('location.name', 'like', '%' . $request->location . '%')
                ->inRandomOrder()->get();
        }

        $amenities = Amenities::all();

        //return view('user.list_activity', compact('req', 'activity', 'amenities'));
        return view('user.m-list_activity', compact('req', 'activity', 'amenities'));
    }

    public static  function activity_gallery($id)
    {
        $gallery = ActivityPhoto::select('activity_photo.name as photo')->where('id_activity', $id)->get();

        return $gallery;
    }

    public function activity_video($id)
    {
        $data = ActivityVideo::select('activity_video.name as video', 'activity.name as name')
            ->join('activity', 'activity_video.id_activity', '=', 'activity.id_activity', 'left')
            ->where('activity_video.id_activity', $id)->get();

        echo json_encode($data);
    }

    public function activity_next()
    {
        $data = ActivityVideo::select('activity_video.name as video', 'activity.name as name')
            ->join('activity', 'activity_video.id_activity', '=', 'activity.id_activity', 'left')
            ->inRandomOrder()->limit(1)->get();


        echo json_encode($data);
    }

    //================================ Activity DETAIL ================================

    public function activity($id)
    {
        // check if activity exist
        $activity = Activity::find($id);
        abort_if(!$activity, 404);

        $activity = Activity::select('activity.*', 'location.name as location')
            ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')->where('id_activity', $id)->get();

        $photo = ActivityPhoto::where('id_activity', $id)->get();
        // $amenities = activityAmenities::select('activity_amenities.id_activity', 'amenities.icon as icon', 'amenities.name as name')
        //         ->join('amenities', 'activity_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
        //         ->where('activity_amenities.id_activity', $id)->limit(5)->get();
        $ratting = ActivityDetailReview::where('id_activity', $id)->get();
        $video = ActivityVideo::where('id_activity', $id)->get();
        $stories = ActivityStory::where('id_activity', $id)->orderBy('created_at', 'desc')->get();

        //return view('user.activity.activity', compact('activity', 'photo', 'video', 'ratting', 'stories'));
        return view('user.activity.m-activity', compact('activity', 'photo', 'video', 'ratting', 'stories'));
    }

    public function det_activity_video($id)
    {
        $activity = Activity::select('activity.*', 'location.name as location')
            ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')->where('id_activity', $id)->get();
        $ratting = ActivityDetailReview::where('id_activity', $id)->get();
        $video = ActivityVideo::where('id_activity', $id)->get();
        $stories = ActivityStory::where('id_activity', $id)->orderBy('created_at', 'desc')->get();
        return view('user.activity.video', compact('video', 'activity', 'ratting', 'stories'));
    }

    public function activity_description($id)
    {
        $activity = Activity::select('activity.*', 'location.name as location')
            ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')->where('id_activity', $id)->get();
        $ratting = ActivityDetailReview::where('id_activity', $id)->get();
        // $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $detail = ActivityDetailReview::where('id_activity', $id)->get();
        $stories = ActivityStory::where('id_activity', $id)->orderBy('created_at', 'desc')->get();
        return view('user.activity.description', compact('activity', 'detail', 'ratting', 'stories'));
    }

    public function activity_price($id)
    {
        $activity = Activity::select('activity.*', 'location.name as location')
            ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')->where('id_activity', $id)->get();
        $ratting = activityDetailReview::where('id_activity', $id)->get();
        // $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $detail = ActivityDetailReview::where('id_activity', $id)->get();
        $menu = ActivityPrice::where('id_activity', $id)->get();
        $stories = ActivityStory::where('id_activity', $id)->orderBy('created_at', 'desc')->get();
        return view('user.activity.price', compact('activity', 'detail', 'ratting', 'menu', 'stories'));
    }

    public function activity_story($id)
    {
        $data = ActivityStory::where('id_story', $id)->get();

        echo json_encode($data);
    }

    public function activity_story_next($id, $id_villa)
    {
        $data = ActivityStory::where('id_story', '<', $id)->where('id_activity', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();

        if ($data->count() == 0) {
            $data = ActivityStory::where('id_activity', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();
        }

        echo json_encode($data);
    }



    //Deo Section
    public function list_video()
    {
        $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.description as description')
            ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')->get();

        return view('user.all_video', compact('data'));
    }

    public function villa_list_video($id)
    {
        $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.description as description')
            ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')
            ->where('id_video', $id)->get();

        echo json_encode($data);
    }

    public function getVideoSuggestions(Request $request)
    {

        $id = $request->id;
        $keyword = $request->keyword;

        $suggestions = DB::table('villa')->select('villa.name as villa_name', 'villa.id_location', 'location.name as lokasi', 'villa_video.name as video_name', 'id_video', 'thumbnail')
            ->rightJoin('villa_video', 'villa_video.id_villa', '=', 'villa.id_villa')
            ->Join('location', 'location.id_location', '=', 'villa.id_location')
            ->where('villa.address', 'like', '%' . $keyword . '%')
            ->take(6)->get();

        $filtered = $suggestions->reject(function ($item) use ($id) {
            return $item->id_video == $id;
        });
        //dd($filtered);
        return $filtered;
    }
    public function get_table($id)
    {
        $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
            ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
            ->join('villa_amenities', 'villa.id_villa', '=', 'villa_amenities.id_villa', 'left')
            ->where('id_amenities', $id)
            ->inRandomOrder()->get();

        return view('user.filter_villa', compact('villa'));
    }

    //Deo Section End

    public function villa_update_house_rules(Request $request)
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

        $checkID = HouseRules::where('id_villa', '=', $request->id_villa)->first();

        $data = [
            'id_villa' => $request->id_villa,
            'children' => $request->children,
            'infants' => $request->infants,
            'pets' => $request->pets,
            'smoking' => $request->smoking,
            'events' => $request->events,
        ];

        if ($checkID == null) {
            // ID villa doesn't exist
            $checkID = HouseRules::create(array(
                'id_villa' => $request->id_villa,
                'children' => $request->children,
                'infants' => $request->infants,
                'pets' => $request->pets,
                'smoking' => $request->smoking,
                'events' => $request->events,
            ));

            return response()->json([
                'data' => $data,
                'message' => 'Updated House Rules Homes',
            ], 200);
        } else {
            $checkID->update(array(
                'id_villa' => $request->id_villa,
                'children' => $request->children,
                'infants' => $request->infants,
                'pets' => $request->pets,
                'smoking' => $request->smoking,
                'events' => $request->events,
            ));

            return response()->json([
                'data' => $data,
                'message' => 'Updated House Rules Homes',
            ], 200);
        }
    }

    public function villa_update_guest_safety(Request $request)
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

        $deleteID = VillaHasGuestSafety::where('id_villa', '=', $request->id_villa)->delete();

        $data = [];
        $i = 0;

        if ($request->pool == 1) {
            // dd('oke');
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 1,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->pool)
                ->select('icon', 'guest_safety', 'description')->first();
            $i++;
        }
        if ($request->lake == 2) {
            // dd('sip');
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 2,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->lake)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->climb == 3) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 3,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->climb)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->height == 4) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 4,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->height)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->animal == 5) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 5,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->animal)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->camera == 6) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 6,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->camera)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->monoxide == 7) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 7,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->monoxide)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->alarm == 8) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 8,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->alarm)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->must == 9) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 9,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->must)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->potential == 10) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 10,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->potential)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->come == 11) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 11,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->come)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->parking == 12) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 12,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->parking)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->shared == 13) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 13,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->shared)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->amenity == 14) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 14,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            $data[$i] = GuestSafety::where('id_guest_safety', $request->amenity)
                ->select('icon', 'guest_safety', 'description')->first();

            $i++;
        }
        if ($request->weapon == 15) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
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
            'id_villa' => $request->id_villa,
            'message' => 'Update Health & Safety Homes',
        ], 200);
    }

    public function villa_update_cancellation_policy(Request $request)
    {
        // dd($request);

        $request->validate([
            'type_cancellation' => 'required'
        ]);

        CancellationPolicy::updateOrCreate(
            [
                'id_villa' => $request->id_villa
            ],
            [
                'type_cancellation' => $request->type_cancellation,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]
        );

        return back();
    }

    public function villa_update_caption_photo(Request $request)
    {
        $this->authorize('listvilla_update');

        $status = 500;

        try {
            $villa = VillaPhoto::where('id_photo', $request->id_photo)->first();

            $update = $villa->update([
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

    public function villa_update_extra(Request $request)
    {
        // dd($request->all());
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = Villa::where('id_villa', $request->id_villa)->first();

            $checkVillaExtraGuest = VillaExtraGuest::where('id_villa', '=', $request->id_villa)->first();
            $checkVillaExtraBed = VillaExtraBed::where('id_villa', '=', $request->id_villa)->first();
            $checkVillaExtraPet = VillaExtraPet::where('id_villa', '=', $request->id_villa)->first();

            if ($checkVillaExtraGuest == null) {
                VillaExtraGuest::insertGetId(array(
                    'id_villa' => $request->id_villa,
                    'max' => $request->max_guest,
                    'price' => $request->price_extra_guest,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            } else {
                $checkVillaExtraGuest->update(array(
                    'id_villa' => $request->id_villa,
                    'max' => $request->max_guest,
                    'price' => $request->price_extra_guest,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            }

            if ($checkVillaExtraBed == null) {
                VillaExtraBed::insertGetId(array(
                    'id_villa' => $request->id_villa,
                    'max' => $request->max_bed,
                    'price' => $request->price_extra_bed,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            } else {
                $checkVillaExtraBed->update(array(
                    'id_villa' => $request->id_villa,
                    'max' => $request->max_bed,
                    'price' => $request->price_extra_bed,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            }

            if ($checkVillaExtraPet == null) {
                VillaExtraPet::insertGetId(array(
                    'deposit' => $request->deposit,
                    'max' => $request->max_pet,
                    'id_villa' => $request->id_villa,
                    'price_deposit' => $request->price_deposit,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            } else {
                if ($request->deposit == 0) {
                    $checkVillaExtraPet->update(array(
                        'deposit' => $request->deposit,
                        'max' => $request->max_pet,
                        'id_villa' => $request->id_villa,
                        'price_deposit' => null,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                } else if ($request->deposit == 1) {
                    $checkVillaExtraPet->update(array(
                        'deposit' => $request->deposit,
                        'max' => $request->max_pet,
                        'id_villa' => $request->id_villa,
                        'price_deposit' => $request->price_deposit,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
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
            return response()->json([
                'success' => true,
                'message' => 'Your data has been updated',
            ], 200);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json([
                'success' => false,
                'message' => 'Please check the form below for errors',
            ], 500);
        }
    }

    public function villa_request_video($id, $name)
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

    public function datatable_availability(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('villa_availability')
                ->select('id_villa_availability', 'id_villa', 'start', 'end')
                ->where("id_villa", $id)
                ->orderBy('start', 'asc')
                ->get();

            return DataTables::of($data)
                ->editColumn('start', function ($data) {
                    return Carbon::createFromFormat('Y-m-d', $data->start)->format('d F Y');
                })
                ->editColumn('end', function ($data) {
                    return Carbon::createFromFormat('Y-m-d', $data->end)->format('d F Y');
                })
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $aksi = ' <a href="javascript:void(0);" onclick="delete_date_availability(this);" data-id="' . $data->id_villa_availability . '" class="deletedata btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Delete Data"><i class="fa fa-fw fa-trash"></i> Delete</a>';
                    return $aksi;
                })
                ->rawColumns(['aksi'])->make(true);
        }
    }

    public function delete_availability($id)
    {
        $data = VillaAvailability::where('id_villa_availability', $id)->first();
        $villa = Villa::where('id_villa', $data->id_villa)->first();

        $this->authorize('listvilla_delete');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by;
        if ($condition) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        $delete = $data->delete();

        // check if delete is success or not
        if (isset($delete) == true) {
            return response()->json([
                'message' => 'Delete Data Successfuly',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Delete Data',
            ], 500);
        }
    }

    public function fullcalendarNotAvailable($id)
    {
        $event = VillaAvailability::select(
            'start',
            'end',
            'text as title',
            'color',
        )->where('id_villa', '=', $id)->get();

        $result = array(['start' => 0, 'end' => 0, 'title' => 0, 'color' => 0]);

        $i = 0;

        foreach ($event as $data) {
            $result[$i]['start'] = $data->start;
            $result[$i]['end'] = date('Y-m-d', strtotime($data->end . " +1 days"));
            $result[$i]['title'] = $data->title;
            $result[$i]['color'] = $data->color;
            $i++;
        }

        return response()->json($result, 200);
    }

    public function villa_not_available(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        $data = $request->multiEvent;

        if (!$data) {
            return response()->json([
                'message' => 'No Date Selected'
            ], 500);
        }

        // $i = 0;
        foreach ($data as $item) {
            $data2 = VillaAvailability::insert(array(
                'id_villa' => $request->id,
                'start' => $item[0],
                'end' => $item[1],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
            // VillaAvailability::insert($data);
        }
        // return $data2;

        return response()->json([
            'message' => 'Added Date Villa Availability',
            'status' => 200,
        ]);
    }

    public function datatable_special_price(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('villa_detail_price')
                ->select('id_detail', 'id_villa', 'start', 'end', 'price', 'disc')
                ->where("id_villa", $id)
                ->orderBy('start', 'asc')
                ->get();

            return DataTables::of($data)
                ->editColumn('start', function ($data) {
                    return Carbon::createFromFormat('Y-m-d', $data->start)->format('d F Y');
                })
                ->editColumn('end', function ($data) {
                    return Carbon::createFromFormat('Y-m-d', $data->end)->format('d F Y');
                })
                ->editColumn('price', function ($data) {
                    return CurrencyConversion::exchangeWithUnit($data->price);
                })
                ->editColumn('disc', function ($data) {
                    return CurrencyConversion::exchangeWithUnit($data->disc);
                })
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $aksi = ' <a href="javascript:void(0);" onclick="delete_date_special_price(this);" data-id="' . $data->id_detail . '" class="deletedata btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Delete Data"><i class="fa fa-fw fa-trash"></i> Delete</a>';
                    return $aksi;
                })
                ->rawColumns(['aksi'])->make(true);
        }
    }

    public function delete_special_price($id)
    {
        $data = VillaDetailPrice::where('id_detail', $id)->first();
        $villa = Villa::where('id_villa', $data->id_villa)->first();

        $this->authorize('listvilla_delete');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by;
        if ($condition) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        $delete = $data->delete();

        // check if delete is success or not
        if (isset($delete) == true) {
            return response()->json([
                'message' => 'Delete Data Successfuly',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Delete Data',
            ], 500);
        }
    }
}
