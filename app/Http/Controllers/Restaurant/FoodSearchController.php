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
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Services\DeviceCheckService;
use App\Models\RestaurantSubCategory;
use App\Models\RestaurantHasSubCategory;

class FoodSearchController extends Controller
{
    public function index(Request $request)
    {
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

        $sLocation = $request->sLocation;
        $sKeyword = $request->sKeyword;
        $sCuisine = $request->sCuisine;

        if ($sLocation || $sKeyword || $sCuisine) {
            $restaurant = $this->search($restaurant, $request);
        }

        $fCuisine = $request->fCuisine;
        $fSubCategory = $request->fSubCategory;

        $condition = $fCuisine || $fSubCategory;

        if ($condition) {
            $restaurant = $this->filter($restaurant, $request);
        }

        $restaurantIds = $restaurant->modelKeys();
        $restaurant = Restaurant::with([
            'location',
            'cuisine',
            'detailReview',
            'menu'
        ])->whereIn('id_restaurant', $restaurantIds)->orderBy('grade')->paginate(env('CONTENT_PER_PAGE_LIST_RESTAURANT'));

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
            $restaurantIds = $restaurant->modelKeys();
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

        if ($request->fCuisine) {
            $cuisine = explode(',', $request->fCuisine);
            $restaurantIds = $restaurant->modelKeys();
            $restaurantIdsFilter = RestaurantHasCuisine::whereIn('id_cuisine', $cuisine)->select('id_restaurant')->get();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
                'restaurantHasCuisine'
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_restaurant', $restaurantIdsFilter)
                ->where('status', 1)
                ->whereHas('restaurantHasCuisine', function (Builder $query) use ($cuisine) {
                    $query->where('id_cuisine', $cuisine);
                })
                ->get();
        }

        if ($request->fSubCategory) {
            $subcategory = explode(',', $request->fSubCategory);
            $restaurantIds = $restaurant->modelKeys();

            $restaurantIdsFilter = RestaurantHasSubCategory::whereIn('id_subcategory', $subcategory)->select('id_restaurant')->get();
            $restaurant = Restaurant::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
                'RestaurantHasSubCategory'
            ])
                ->whereIn('id_restaurant', $restaurantIds)
                ->whereIn('id_restaurant', $restaurantIdsFilter)
                ->whereHas('RestaurantHasSubCategory', function (Builder $query) use ($subcategory) {
                    $query->where('id_subcategory', $subcategory);
                })
                ->where('status', 1)
                ->get();
        }

        return $restaurant;
    }
}
