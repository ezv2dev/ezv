<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Amenities;
use App\Models\Location;
use App\Models\PropertyTypeVilla;
use App\Models\RestaurantType;
use App\Models\RestaurantPrice;
use App\Models\RestaurantFacilities;
use App\Models\RestaurantMeal;
use App\Models\RestaurantCuisine;
use App\Models\RestaurantDishes;
use App\Models\RestaurantDietaryFood;
use App\Models\RestaurantGoodfor;
use App\Models\RestaurantHasCuisine;
use App\Models\RestaurantHasDishes;
use App\Models\RestaurantHasFacilities;
use App\Models\RestaurantHasDietaryfood;
use App\Models\RestaurantHasGoodfor;
use App\Models\RestaurantHasMeal;
use App\Models\RestaurantMenu;
use App\Models\Villa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Services\DeviceCheckService;
use App\Models\RestaurantSubCategory;
use App\Models\RestaurantHasSubCategory;

class RestaurantSearchController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $restaurant = Restaurant::with([
            'photo',
            'video',
            'detailReview',
            'facilities',
            'menu'
        ])->where('status', 1)->get();
        $amenities = Amenities::all();
        $locations = Location::all();
        $types = RestaurantType::all();
        $facilities = RestaurantFacilities::all();
        $meals = RestaurantMeal::all();
        $prices = RestaurantPrice::all();
        $cuisines = RestaurantCuisine::all();
        $dishes = RestaurantDishes::all();
        $dietaryfoods = RestaurantDietaryFood::all();
        $goodfors = RestaurantGoodfor::all();
        $property_type = PropertyTypeVilla::all();
        $categories = RestaurantCuisine::all();
        $subcategories = RestaurantSubCategory::all();

        // search request
        $sLocation = $request->sLocation;
        $sKeyword = $request->sKeyword;
        $sCuisine = $request->sCuisine;
        // dd($sLocation, $sKeyword, $sCuisine);

        // search restaurant
        if ($sLocation || $sKeyword || $sCuisine) {
            $restaurant = $this->search($restaurant, $request);
            // dd($restaurant);
        }

        $fLocation = $request->fLocation;
        $fType = $request->fType;
        $fPrice = $request->fPrice;
        $fFacilities = $request->fFacilities;
        $fMeal = $request->fMeal;
        $fCuisine = $request->fCuisine;
        $fCategory = $request->fCategory;
        $fSubCategory = $request->fSubCategory;
        $fDishes = $request->fDishes;
        $fDietaryfood = $request->fDietaryfood;
        $fGoodfor = $request->fGoodfor;

        $condition =
            $fLocation
            || $fType
            || $fPrice
            || $fFacilities
            || $fMeal
            || $fCuisine
            || $fDishes
            || $fDietaryfood
            || $fGoodfor;

        if ($fCuisine || $fCategory || $fSubCategory) {
            $restaurant = $this->filter($restaurant, $request);
            // dd($restaurant);
        }

        $restaurantIds = $restaurant->modelKeys();
        $restaurant = Restaurant::with([
            'location',
            'cuisine',
            'detailReview',
            'menu'
        ])->whereIn('id_restaurant', $restaurantIds)->orderBy('grade')->paginate(env('CONTENT_PER_PAGE_LIST_RESTAURANT'));
        $restaurant->each(function ($item, $key) {
            $item->setAppends(['villa_nearby', 'activity_nearby', 'hotel_nearby']);
        });
        $restaurant->appends(request()->query());

        return view('user.list_restaurant', compact(
            'restaurant',
            'amenities',
            'locations',
            'types',
            'facilities',
            'meals',
            'prices',
            'cuisines',
            'dishes',
            'dietaryfoods',
            'goodfors',
            'property_type',
            'categories',
            'subcategories'
        ));
    }

    private function search($restaurants, $request)
    {
        $restaurant = $restaurants;

        $sLocation = $request->sLocation;
        $sKeyword = $request->sKeyword;
        $sCuisine = $request->sCuisine;

        if ($sLocation) {
            $location = $sLocation;

            // * get latitude & longitude dari nama yang diinput user
            $latitude = Location::select('latitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();
            $longitude = Location::select('longitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();

            // *if latitude & longitude is null
            if (!$latitude || !$longitude) {
                $restaurant = collect([]);
                return $restaurant;
            };

            // * get latitude & longitude dari array
            $get_latitude = $latitude->latitude;
            $get_longitude = $longitude->longitude;

            // * get latitude and longitude data lainnya
            $get_latitude_others = DB::table('location')->whereNotIn('latitude', [$get_latitude])->select('latitude', 'id_location')->get();
            $get_longitude_others = DB::table('location')->whereNotIn('longitude', [$get_longitude])->select('longitude', 'id_location')->get();

            // *if latitude & longitude others is null
            if (!$get_latitude_others || !$get_longitude_others) {
                $restaurant = collect([]);
                return $restaurant;
            };

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
            $data = $unsorted_data->sortBy('0')->first();
            // dd($location, $latitude, $longitude, $get_latitude, $get_longitude, $get_latitude_others, $get_longitude_others, $get_lat_long_others);

            $restaurantIds = $restaurant->modelKeys();
            $restaurantAround = Restaurant::where('status', 1)
                ->whereIn('id_restaurant', $restaurantIds)
                ->where('id_location', $data[1])->get();

            $restaurantOther = Restaurant::where('status', 1)
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereHas('location', function (Builder $query) use ($location) {
                    $query->where('name', 'like', '%' . $location . '%');
                })->get();
            $restaurant = new Collection();
            $restaurant = $restaurant->merge($restaurantOther);
        }
        if ($sKeyword) {
            $restaurantIds = $restaurant->modelKeys();

            $restaurant = Restaurant::select('restaurant.*', 'restaurant_cuisine.name as cuisine_name')
                ->join('restaurant_has_cuisine', 'restaurant.id_restaurant', '=', 'restaurant_has_cuisine.id_restaurant', 'left')
                ->join('restaurant_cuisine', 'restaurant_has_cuisine.id_cuisine', '=', 'restaurant_cuisine.id_cuisine', 'left')
                ->where('status', 1)
                ->whereIn('restaurant.id_restaurant', $restaurantIds)
                ->where('restaurant_cuisine.name', 'like', '%' . $sKeyword . '%')
                ->orWhereHas('menu', function (Builder $query) use ($sKeyword) {
                    $query->where('name', 'like', '%' . $sKeyword . '%');
                })
                ->get();
        }
        if ($sCuisine) {
            $cuisine = explode(',', $sCuisine);
            $restaurantIds = $restaurant->modelKeys();
            $restaurantIdsFilter = RestaurantHasCuisine::whereIn('id_cuisine', $cuisine)->select('id_restaurant')->get();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_restaurant', $restaurantIdsFilter)
                ->where('status', 1)
                ->get();
        }
        return $restaurant;
    }

    private function filter($restaurants, $request)
    {
        $restaurant = $restaurants;
        // dd($request->all());
        // dd($restaurant);
        if ($request->fLocation) {
            $location = explode(',', $request->fLocation);
            // dd($location);
            $restaurantIds = $restaurant->modelKeys();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_location', $location)
                ->where('status', 1)
                ->get();
            // dd($restaurant);
        }
        if ($request->fType) {
            $type = explode(',', $request->fType);
            // dd($type);
            $restaurantIds = $restaurant->modelKeys();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_type', $type)
                ->where('status', 1)
                ->get();
            // dd($restaurant);
        }
        if ($request->fPrice) {
            $price = explode(',', $request->fPrice);
            // dd($price);
            $restaurantIds = $restaurant->modelKeys();

            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_price', $price)
                ->where('status', 1)
                ->get();
            // dd($restaurant);
        }
        if ($request->fFacilities) {
            $facilities = explode(',', $request->fFacilities);
            $restaurantIds = $restaurant->modelKeys();
            // dd($facilities);

            $restaurantIdsFilter = RestaurantHasFacilities::whereIn('id_facilities', $facilities)->select('id_restaurant')->get();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_restaurant', $restaurantIdsFilter)
                ->where('status', 1)
                ->get();
            // dd($activity);
        }
        if ($request->fMeal) {
            $meal = explode(',', $request->fMeal);
            $restaurantIds = $restaurant->modelKeys();

            $restaurantIdsFilter = RestaurantHasMeal::whereIn('id_meal', $meal)->select('id_restaurant')->get();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_restaurant', $restaurantIdsFilter)
                ->where('status', 1)
                ->get();
            // dd($activity);
        }
        if ($request->fCuisine) {
            $cuisine = explode(',', $request->fCuisine);
            // dd($cuisine);
            $restaurantIds = $restaurant->modelKeys();

            $restaurantIdsFilter = RestaurantHasCuisine::whereIn('id_cuisine', $cuisine)->select('id_restaurant')->get();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_restaurant', $restaurantIdsFilter)
                ->where('status', 1)
                ->get();
            // dd($activity);
        }
        if ($request->fDishes) {
            $dishes = explode(',', $request->fDishes);
            $restaurantIds = $restaurant->modelKeys();

            $restaurantIdsFilter = RestaurantHasDishes::whereIn('id_dishes', $dishes)->select('id_restaurant')->get();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_restaurant', $restaurantIdsFilter)
                ->where('status', 1)
                ->get();
            // dd($activity);
        }
        if ($request->fDietaryfood) {
            $dietaryfood = explode(',', $request->fDietaryfood);
            $restaurantIds = $restaurant->modelKeys();

            $restaurantIdsFilter = RestaurantHasDietaryfood::whereIn('id_dietaryfood', $dietaryfood)->select('id_restaurant')->get();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_restaurant', $restaurantIdsFilter)
                ->where('status', 1)
                ->get();
            // dd($activity);
        }
        if ($request->fGoodfor) {
            $goodfor = explode(',', $request->fGoodfor);
            $restaurantIds = $restaurant->modelKeys();

            $restaurantIdsFilter = RestaurantHasGoodfor::whereIn('id_goodfor', $goodfor)->select('id_restaurant')->get();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_restaurant', $restaurantIdsFilter)
                ->where('status', 1)
                ->get();
            // dd($activity);
        }

        if ($request->fCategory) {
            $category = explode(',', $request->fCategory);
            // dd($cuisine);
            $restaurantIds = $restaurant->modelKeys();

            $restaurantIdsFilter = RestaurantHasCuisine::whereIn('id_cuisine', $category)->select('id_restaurant')->get();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_restaurant', $restaurantIdsFilter)
                ->where('status', 1)
                ->get();
            // dd($activity);
        }

        if ($request->fSubCategory) {
            $subcategory = explode(',', $request->fSubCategory);
            // dd($cuisine);
            $restaurantIds = $restaurant->modelKeys();

            $restaurantIdsFilter = RestaurantHasSubCategory::whereIn('id_subcategory', $subcategory)->select('id_restaurant')->get();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_restaurant', $restaurantIdsFilter)
                ->where('status', 1)
                ->get();
            // dd($activity);
        }

        return $restaurant;
    }
}
