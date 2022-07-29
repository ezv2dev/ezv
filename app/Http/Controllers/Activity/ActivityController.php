<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityPhoto;
use App\Models\ActivityPricePhoto;
use App\Models\ActivityVideo;
use App\Models\ActivityStory;
use App\Models\ActivityDetailReview;
use App\Models\ActivityFacilities;
use App\Models\ActivityHasGuestSafety;
use App\Models\ActivityHasSubcategory;
use App\Models\ActivityRules;
use App\Models\ActivitySave;
use App\Models\ActivitySubcategory;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\NotificationOwner;
use App\Models\Restaurant;
use App\Models\Villa;
use App\Models\VillaAmenities;
use App\Services\DeviceCheckService;
use Illuminate\Support\Facades\Auth;
use App\Services\DestinationNearbyActivityService as Nearby;
use App\Services\GoogleMapsAPIService as GoogleMaps;

class ActivityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public static function get_name()
    {
        $activity_name = Activity::inRandomOrder()->select('name', 'id_activity')->where('status', 1)->get();
        return $activity_name;
    }

    public static function get_subcategory()
    {
        $activity_sub_category = ActivitySubcategory::inRandomOrder()->select('name', 'id_category')->get();
        return $activity_sub_category;
    }


    public function index(Request $request, $id)
    {

        $activity = Activity::with([
            'favorit',
            'photo',
            'video',
            'story',
            'PricePhoto',
            'owner',
            'facilities',
            'price',
            'ownerData'
        ])
            ->where([
                ['id_activity', $request->id],
                ['status', 1],
            ])->first();

        $subCategory = ActivitySubcategory::orderby('name', 'ASC')->get();

        // check if the editor does not have authorization
        if (auth()->check()) {
            $find = Activity::find($request->id);
            abort_if(!$find, 404);
            if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->id == $find->created_by) {
                $activity = Activity::with([
                    'favorit',
                    'photo',
                    'video',
                    'story',
                    'owner',
                    'facilities',
                    'price'
                ])
                    ->where([
                        ['id_activity', $request->id],
                    ])->first();
            }
        }

        // check if activity exist
        abort_if(!$activity, 404);
        $activity->setAppends(['villa_nearby', 'restaurant_nearby', 'hotel_nearby']);

        $locations = Location::orderby('name', 'ASC')->get();
        $facilities = ActivityFacilities::orderby('name', 'ASC')->get();
        $villas_advertise = Villa::where('status', 1)->inRandomOrder()->first();
        $villa_amenities = VillaAmenities::select('amenities.icon as icon', 'amenities.name as name')->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')->where('id_villa', '14')->get();
        $thingstodo_location = Activity::with(['location'])->select('id_location')->first();
        $activity_rules = ActivityRules::where('id_activity', $id)->with('activity')->first();

        $villaRandom = Villa::with('amenities')
            ->where('grade', 'A')->where('status', 1)
            ->inRandomOrder()->limit(5)->get();

        $get_activity = Activity::where('id_activity', $id)->first();
        $point = array('lat' => $get_activity->latitude, 'long' => $get_activity->longitude, 'id_location' => $get_activity->id_location);
        // ? Start Villa Slider
        $compare_villa = Villa::all();

        $kilometers = array();
        $i = 0;
        foreach ($compare_villa as $item) {
            $lat1 = $point['lat'];
            $lon1 = $point['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $id_villa = $item->id_villa;
            $name = $item->name;
            $theta = $lon1 - $lon2;

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers[$i][] = number_format((float)$miles * 1.609344, 1, '.', '');
            $kilometers[$i][] = $id_villa;
            $kilometers[$i][] = $name;
            $i++;
        }

        $unsorted_data = collect($kilometers);
        $sorted_data1 = $unsorted_data->sortBy('0');
        $last = $sorted_data1;

        $locArray = array();
        foreach ($last as $item1) {
            array_push($locArray, $item1[1]);
        }
        // ? End Villa Slider

        // ? Start Restaurant Slider
        $compare_restaurant = Restaurant::all();

        $kilometers2 = array();
        $j = 0;
        foreach ($compare_restaurant as $item) {
            $lat3 = $point['lat'];
            $lon3 = $point['long'];
            $lat4 = $item->latitude;
            $lon4 = $item->longitude;
            $id_restaurant = $item->id_restaurant;
            $name2 = $item->name;
            $theta2 = $lon3 - $lon4;

            $miles2 = (sin(deg2rad($lat3)) * sin(deg2rad($lat4))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta2)));
            $miles2 = acos($miles2);
            $miles2 = rad2deg($miles2);
            $miles2 = $miles2 * 60 * 1.1515;
            $kilometers2[$j][] = number_format((float)$miles2 * 1.609344, 1, '.', '');
            $kilometers2[$j][] = $id_restaurant;
            $kilometers2[$j][] = $name2;
            $j++;
        }

        $unsorted_data2 = collect($kilometers2);
        $sorted_data2 = $unsorted_data2->sortBy('0');
        $last2 = $sorted_data2;

        $locArray2 = array();
        foreach ($last2 as $item2) {
            array_push($locArray2, $item2[1]);
        }
        // ? End Restaurant Slider

        $ids_ordered = implode(',', $locArray);
        $ids_ordered2 = implode(',', $locArray2);

        $nearby_villas = Nearby::villa($id);
        $nearby_villas = collect($nearby_villas)->slice(0, 20);
        // $nearby_villas = collect($nearby_villas);

        $nearby_restaurant = Nearby::restaurant($id);
        $nearby_restaurant = collect($nearby_restaurant)->slice(0, 20);
        // $nearby_restaurant = collect($nearby_restaurant);

        $latitudeActivity = $activity->latitude;
        $longitudeActivity = $activity->longitude;
        $googleApi = 'AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk';

        $k = 0;

        foreach ($nearby_villas as $item) {
            $point1 = array('lat' => $latitudeActivity, 'long' => $longitudeActivity);
            $point2 = array('lat2' => $item->detail->latitude, 'long2' => $item->detail->longitude);

            $urlDriving =
                'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $point1['lat'] . ',' . $point1['long'] . '&destinations=' . $point2['lat2'] . ',' . $point2['long2'] . "&mode=driving&key=${googleApi}";
            $urlWalking =
                'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $point1['lat'] . ',' . $point1['long'] . '&destinations=' . $point2['lat2'] . ',' . $point2['long2'] . "&mode=walking&key=${googleApi}";

            $item->kilometer = GoogleMaps::calculateDistance($urlDriving);
            $item->detail['eta_driving'] = GoogleMaps::calculateTime($urlDriving);
            $item->detail['eta_walking'] = GoogleMaps::calculateTime($urlWalking);

            $k++;
        }

        $h = 0;

        foreach ($nearby_restaurant as $item) {
            $point1 = array('lat' => $latitudeActivity, 'long' => $longitudeActivity);
            $point2 = array('lat2' => $item->detail->latitude, 'long2' => $item->detail->longitude);

            $urlDriving =
                'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $point1['lat'] . ',' . $point1['long'] . '&destinations=' . $point2['lat2'] . ',' . $point2['long2'] . "&mode=driving&key=${googleApi}";
            $urlWalking =
                'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $point1['lat'] . ',' . $point1['long'] . '&destinations=' . $point2['lat2'] . ',' . $point2['long2'] . "&mode=walking&key=${googleApi}";

            $item->kilometer = GoogleMaps::calculateDistance($urlDriving);
            $item->detail['eta_driving'] = GoogleMaps::calculateTime($urlDriving);
            $item->detail['eta_walking'] = GoogleMaps::calculateTime($urlWalking);

            $h++;
        }

        $wowHasSubCategory = ActivityHasSubcategory::where('id_activity', $id)->get();
        $wowSubCategory = ActivitySubcategory::all();

        // dd($activity->price);

        return view('user.activity.activity', compact('villaRandom', 'wowSubCategory', 'wowHasSubCategory', 'activity', 'locations', 'facilities', 'nearby_villas', 'nearby_restaurant', 'subCategory', 'villas_advertise', 'villa_amenities', 'activity_rules'));
    }

    public function grade(Request $request, $id)
    {
        $find = Activity::where('id_activity', $id)->first();

        $find->update(array(
            'grade' => $request->grade,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return response()->json(['success' => true, 'message' => 'Succesfully Update Grade WOW to ' . $request->grade,  'data' => $request->grade]);
    }

    public function update_status(Request $request, $id)
    {
        $find = Activity::where('id_activity', $id)->first();
        if ($find->status == 2) {
            $find->update(array(
                'status' =>  1,
                'grade' => $request->grade,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            return response()->json(['message' => 'Successfuly request for activiation', 'data' => 1, 'grade' => $request->grade]);
        } else {
            $find->update(array(
                'status' =>  0,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            return response()->json(['message' => 'Successfuly request for activiation', 'data' => 0]);
        }
    }

    public function request_update_status(Request $request)
    {
        $id = $request->id_wow;
        $find = Activity::where('id_activity', $id)->first();

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
        $id = $request->id_wow;
        $find = Activity::where('id_activity', $id)->first();

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

    public function activity_update_activity_rules(Request $request)
    {
        // dd($request->orderby('name', 'ASC')->get());
        // dd($request->id_restaurant);
        $checkID = ActivityRules::where('id_activity', '=', $request->id_activity)->first();

        if ($checkID == null) {
            // ! ID activity doesn't exist
            $checkID = ActivityRules::create(array(
                'id_activity' => $request->id_activity,
                'children' => $request->children,
                'infants' => $request->infants,
                'pets' => $request->pets,
                'smoking' => $request->smoking,
                'events' => $request->events,
            ));
            return back();
        } else {
            $checkID->update(array(
                'id_activity' => $request->id_activity,
                'children' => $request->children,
                'infants' => $request->infants,
                'pets' => $request->pets,
                'smoking' => $request->smoking,
                'events' => $request->events,
            ));
            return back();
        }
    }

    public function activity_update_guest_safety(Request $request)
    {
        $deleteID = ActivityHasGuestSafety::where('id_activity', '=', $request->id_activity)->delete();

        if ($request->pool == 1) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 1,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->lake == 2) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 2,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->climb == 3) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 3,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->height == 4) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 4,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->animal == 5) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 5,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->camera == 6) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 6,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->monoxide == 7) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 7,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->alarm == 8) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 8,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->must == 9) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 9,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->potential == 10) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 10,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->come == 11) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 11,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->parking == 12) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 12,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->shared == 13) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 13,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->amenity == 14) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 14,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->weapon == 15) {
            ActivityHasGuestSafety::create(array(
                'id_activity' => $request->id_activity,
                'id_guest_safety' => 15,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        return back();
    }

    public function things_to_do_request_video($id, $name)
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
}
