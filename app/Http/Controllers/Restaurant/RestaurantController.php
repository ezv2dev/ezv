<?php

namespace App\Http\Controllers\Restaurant;

use App\Models\Activity;
use App\Models\HouseRules;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\NotificationOwner;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\RestaurantCuisine;
use App\Models\RestaurantDietaryFood;
use App\Models\RestaurantDishes;
use App\Models\RestaurantFacilities;
use App\Models\RestaurantGoodfor;
use App\Models\RestaurantHasGuestSafety;
use App\Models\RestaurantMeal;
use App\Models\RestaurantMenu;
use App\Models\Villa;
use App\Models\VillaAmenities;
use App\Models\RestaurantPhoto;
use App\Models\RestaurantPrice;
use App\Models\RestaurantRules;
use App\Models\RestaurantSave;
use App\Models\RestaurantType;
use App\Models\RestaurantVideo;
use App\Models\RestaurantHasSubCategory;
use App\Services\DeviceCheckService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\DestinationNearbyRestaurantService as Nearby;
use App\Services\GoogleMapsAPIService as GoogleMaps;

use App\Models\RestaurantSubCategory;

class RestaurantController extends Controller
{
    public static function get_subcategory($id_photo)
    {
        $restaurant_has_subcategory = RestaurantHasSubCategory::where('id_photo', $id_photo)->first();
        return $restaurant_has_subcategory;
    }

    public static function get_name()
    {
        $restaurant_name = Restaurant::inRandomOrder()->select('name', 'id_restaurant')->where('status', 1)->get();
        return $restaurant_name;
    }

    public static function get_cuisine()
    {
        $restaurant_cuisine = RestaurantCuisine::inRandomOrder()->select('name', 'id_cuisine')->get();
        return $restaurant_cuisine;
    }

    public static function get_menu()
    {
        $restaurant_menu = RestaurantMenu::inRandomOrder()->select('name', 'id_menu')->get();
        return $restaurant_menu;
    }

    public static function restaurant_subcategory()
    {
        $restaurant_subcategory = RestaurantSubCategory::select('id_subcategory', 'icon', 'name')->get();
        return $restaurant_subcategory;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        // dd($id);
        $restaurant = Restaurant::with([
            'favorit', 'type', 'price', 'photo', 'video', 'menu', 'story', 'detailReview', 'createdByDetails', 'facilities'
        ])
            ->where([
                ['id_restaurant', $request->id],
                ['status', 1],
            ])->first();

        // return all data
        $cuisine = RestaurantCuisine::orderby('name', 'ASC')->get();
        $dietaryfood = RestaurantDietaryFood::orderby('name', 'ASC')->get();
        $dishes = RestaurantDishes::orderby('name', 'ASC')->get();
        $goodfor = RestaurantGoodfor::all();
        $meal = RestaurantMeal::all();
        $restaurant_type = RestaurantType::all();
        $restaurant_price = RestaurantPrice::all();
        $photoTag = RestaurantSubCategory::all();
        $restaurantHasSub = RestaurantHasSubCategory::all();

        // check if the editor does not have authorization
        if (auth()->check()) {
            $find = Restaurant::find($request->id);
            abort_if(!$find, 404);
            if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->id == $find->created_by) {
                $restaurant = Restaurant::with([
                    'favorit', 'type', 'price', 'photo', 'video', 'menu', 'story', 'detailReview', 'createdByDetails', 'facilities'
                ])
                    ->where([
                        ['id_restaurant', $request->id],
                    ])->first();
            }
        }

        // check if restaurant exist
        abort_if(!$restaurant, 404);

        $restaurant->setAppends(['villa_nearby', 'activity_nearby', 'hotel_nearby']);

        // merge all restaurant tag
        $tags = new Collection();
        $tags = $tags->concat($restaurant->cuisine)
            ->concat($restaurant->dietaryfood)
            ->concat($restaurant->dishes)
            ->concat($restaurant->goodfor)
            ->concat($restaurant->meal);

        $locations = Location::orderBy('name', 'ASC')->get();

        // * Get location restaurant, villas, activities
        $restaurant_location = Restaurant::with(['location'])->select('id_location')->first();
        $villas_advertise = Villa::where('status', 1)->inRandomOrder()->first();
        $facilities = RestaurantFacilities::all();
        $cuisines = RestaurantCuisine::all();
        $villa_amenities = VillaAmenities::select('amenities.icon as icon', 'amenities.name as name')->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')->where('id_villa', '14')->get();
        $restaurant_rules = RestaurantRules::where('id_restaurant', $id)->with('restaurant')->first();

        $get_restaurant = Restaurant::where('id_restaurant', $id)->first();
        $point = array('lat' => $get_restaurant->latitude, 'long' => $get_restaurant->longitude, 'id_location' => $get_restaurant->id_location);

        // ? Start Activity Slider
        $compare_activity = Activity::all();

        $kilometers = array();
        $i = 0;
        foreach ($compare_activity as $item) {
            $lat1 = $point['lat'];
            $lon1 = $point['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $id_activity = $item->id_activity;
            $name = $item->name;
            $theta = $lon1 - $lon2;

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers[$i][] = number_format((float)$miles * 1.609344, 1, '.', '');
            $kilometers[$i][] = $id_activity;
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

        // ? Start Villa Slider
        $compare_villa = Villa::all();

        $kilometers2 = array();
        $j = 0;
        foreach ($compare_villa as $item) {
            $lat3 = $point['lat'];
            $lon3 = $point['long'];
            $lat4 = $item->latitude;
            $lon4 = $item->longitude;
            $id_villa = $item->id_villa;
            $name2 = $item->name;
            $theta2 = $lon3 - $lon4;

            $miles2 = (sin(deg2rad($lat3)) * sin(deg2rad($lat4))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta2)));
            $miles2 = acos($miles2);
            $miles2 = rad2deg($miles2);
            $miles2 = $miles2 * 60 * 1.1515;
            $kilometers2[$j][] = number_format((float)$miles2 * 1.609344, 1, '.', '');
            $kilometers2[$j][] = $id_villa;
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

        $ids_ordered = implode(',', $locArray);
        $ids_ordered2 = implode(',', $locArray2);

        // $nearby_activities = Nearby::activity($id);
        // // $nearby_activities = collect($nearby_activities);
        // $nearby_activities = collect($nearby_activities)->slice(0, 20);

        // $nearby_villas = Nearby::villa($id);
        // // $nearby_villas = collect($nearby_villas);
        // $nearby_villas = collect($nearby_villas)->slice(0, 20);

        // $latitudeRestaurant = $restaurant->latitude;
        // $longitudeRestaurant = $restaurant->longitude;
        // $googleApi = 'AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk';

        // $k = 0;

        // foreach ($nearby_villas as $item) {
        //     $point1 = array('lat' => $latitudeRestaurant, 'long' => $longitudeRestaurant);
        //     $point2 = array('lat2' => $item->detail->latitude, 'long2' => $item->detail->longitude);

        //     $urlDriving =
        //         'https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$point1['lat'].','.$point1['long'].'&destinations='.$point2['lat2'].','.$point2['long2']."&mode=driving&key=${googleApi}";
        //     $urlWalking =
        //         'https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$point1['lat'].','.$point1['long'].'&destinations='.$point2['lat2'].','.$point2['long2']."&mode=walking&key=${googleApi}";

        //     $item->kilometer = GoogleMaps::calculateDistance($urlDriving);
        //     $item->detail['eta_driving'] = GoogleMaps::calculateTime($urlDriving);
        //     $item->detail['eta_walking'] = GoogleMaps::calculateTime($urlWalking);

        //     $k++;
        // }

        // $h = 0;

        // foreach ($nearby_activities as $item) {
        //     $point1 = array('lat' => $latitudeRestaurant, 'long' => $longitudeRestaurant);
        //     $point2 = array('lat2' => $item->detail->latitude, 'long2' => $item->detail->longitude);

        //     $urlDriving =
        //         'https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$point1['lat'].','.$point1['long'].'&destinations='.$point2['lat2'].','.$point2['long2']."&mode=driving&key=${googleApi}";
        //     $urlWalking =
        //         'https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$point1['lat'].','.$point1['long'].'&destinations='.$point2['lat2'].','.$point2['long2']."&mode=walking&key=${googleApi}";

        //     $item->kilometer = GoogleMaps::calculateDistance($urlDriving);
        //     $item->detail['eta_driving'] = GoogleMaps::calculateTime($urlDriving);
        //     $item->detail['eta_walking'] = GoogleMaps::calculateTime($urlWalking);

        //     $h++;
        // }

        $villaRandom = Villa::with('amenities')
            ->where('grade', 'A')->where('status', 1)
            ->whereIn('id_villa', $locArray2)->orderByRaw("FIELD(id_villa, $ids_ordered2)")->limit(5)->get();

        // dd($villaRandom);

        return view('user.restaurant.restaurant', compact(
            'restaurant',
            'locations',
            'villas_advertise',
            'villa_amenities',
            'facilities',
            'tags',
            'cuisine',
            'dietaryfood',
            'dishes',
            'goodfor',
            'meal',
            'cuisines',
            'restaurant_type',
            'restaurant_price',
            'restaurant_rules',
            // 'nearby_villas',
            // 'nearby_activities',
            'villaRandom',
            'photoTag',
            'restaurantHasSub'
        ));
    }

    public function update_status(Request $request, $id)
    {
        abort_if(!auth()->check(), 401);
        abort_if(!$id, 500);
        abort_if(!in_array(auth()->user()->role->name, ['admin', 'superadmin']), 403);
        $find = Restaurant::where('id_restaurant', $id)->first();
        abort_if(!$find, 404);

        $status = false;

        if ($find->status == 2) {
            $find->update(array(
                'status' =>  1,
                'grade' => $request->grade,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        } else {
            $find->update(array(
                'status' =>  0,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($status) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function grade(Request $request, $id)
    {
        // dd($request->all());
        $status = 500;

        $find = Restaurant::where('id_restaurant', $id)->first();

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
        $find = Restaurant::where('id_restaurant', $id)->first();
        abort_if(!$find, 404);
        $this->authorize('restaurant_update');
        abort_if(auth()->user()->id != $find->created_by, 403);

        $find = Restaurant::where('id_restaurant', $id)->first();

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

    public function cancel_request_update_status(Request $request)
    {
        $id = $request->id;
        abort_if(!auth()->check(), 401);
        abort_if(!$id, 500);
        $find = Restaurant::where('id_restaurant', $id)->first();
        abort_if(!$find, 404);
        $this->authorize('restaurant_update');
        abort_if(auth()->user()->id != $find->created_by, 403);

        $find = Restaurant::where('id_restaurant', $id)->first();

        $status = false;

        if ($find->status == 2) {
            $find->update(array(
                'status' =>  0, //cancel request activation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($find->status == 3) {
            $find->update(array(
                'status' =>  1, //cancel request deactivation
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

    public function restaurant_update_position_photo(Request $request)
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

        $restaurant = Restaurant::find($request->id);

        if (!$restaurant) {
            return response()->json([
                'message' => 'Food Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        if (count($imageids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($imageids_arr as $id) {
                $find = RestaurantPhoto::where('id_photo', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            $data = [
                'photo' => RestaurantPhoto::where('id_restaurant', $request->id)->orderBy('order', 'asc')->get(),
                'video' => RestaurantVideo::where('id_restaurant', $request->id)->orderBy('order', 'asc')->get(),
                'uid' => Restaurant::where('id_restaurant', $request->id)->select('uid')->first(),
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

    public function restaurant_update_position_video(Request $request)
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

        $restaurant = Restaurant::find($request->id);

        if (!$restaurant) {
            return response()->json([
                'message' => 'Food Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        if (count($videoids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($videoids_arr as $id) {
                $find = RestaurantVideo::where('id_video', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            $data = [
                'photo' => RestaurantPhoto::where('id_restaurant', $request->id)->orderBy('order', 'asc')->get(),
                'video' => RestaurantVideo::where('id_restaurant', $request->id)->orderBy('order', 'asc')->get(),
                'uid' => Restaurant::where('id_restaurant', $request->id)->select('uid')->first(),
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

    public function restaurant_update_house_rules(Request $request)
    {
        // dd($request->all());
        // dd($request->id_restaurant);
        $checkID = RestaurantRules::where('id_restaurant', '=', $request->id_restaurant)->first();

        if ($checkID == null) {
            // ! ID restaurant doesn't exist
            $checkID = RestaurantRules::create(array(
                'id_restaurant' => $request->id_restaurant,
                'pets' => $request->pets,
                'smoking' => $request->smoking,
                'events' => $request->events,
            ));
            return back();
        } else {
            $checkID->update(array(
                'id_restaurant' => $request->id_restaurant,
                'pets' => $request->pets,
                'smoking' => $request->smoking,
                'events' => $request->events,
            ));
            return back();
        }
    }

    public function restaurant_update_guest_safety(Request $request)
    {
        $deleteID = RestaurantHasGuestSafety::where('id_restaurant', '=', $request->id_restaurant)->delete();

        if ($request->pool == 1) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 1,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->lake == 2) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 2,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->climb == 3) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 3,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->height == 4) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 4,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->animal == 5) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 5,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->camera == 6) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 6,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->monoxide == 7) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 7,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->alarm == 8) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 8,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->must == 9) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 9,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->potential == 10) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 10,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->come == 11) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 11,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->parking == 12) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 12,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->shared == 13) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 13,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->amenity == 14) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 14,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->weapon == 15) {
            RestaurantHasGuestSafety::create(array(
                'id_restaurant' => $request->id_restaurant,
                'id_guest_safety' => 15,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        return back();
    }

    public function like_restaurant(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect(route('login'));
        }

        // check if there same favorit content
        $checkSameFavorit = RestaurantSave::where([
            ['id_restaurant', '=', $request->restaurant],
            ['id_user', '=', $request->user],
        ])->first();

        if ($checkSameFavorit != null) {
            $checkSameFavorit->delete();
            $data = 0;
            return $data;
        } else {
            // otherwise, create favorit
            $data = RestaurantSave::create([
                'id_restaurant' => $request->restaurant,
                'id_user' => $request->user,
                'created_by' => $request->user,
                'updated_by' => $request->user
            ]);

            $data = 1;
            return $data;
        };
    }

    public function restaurant_request_video($id, $name)
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
