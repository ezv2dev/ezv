<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\RestaurantType;
use App\Models\PropertyTypeVilla;
use App\Models\RestaurantPrice;
use App\Models\Villa;
use App\Models\Hotel;
use App\Models\Activity;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller
{
    public function add_listing()
    {
        $this->authorize('listvilla_create');
        $type = DB::table('type_listing')->get();
        $locations = Location::all();
        $restaurantTypes = RestaurantType::all();
        $restaurantPrices = RestaurantPrice::all();
        $propertyTypes = PropertyTypeVilla::all();
        return view('admin.add_listing.add', compact('type', 'locations', 'restaurantTypes', 'restaurantPrices', 'propertyTypes'));
    }

    public function becomehost()
    {
        return view('admin.add_listing.hostpage');
    }

    public static  function has_villa($id)
    {
        $has_villa = Villa::where('created_by', $id)->where('status', 0)->first();
        // dd($has_villa);

        return $has_villa;
    }

    public static  function has_hotel($id)
    {
        $has_hotel = Hotel::where('created_by', $id)->where('status', 0)->first();
        // dd($has_hotel);

        return $has_hotel;
    }

    public static  function has_restaurant($id)
    {
        $has_restaurant = Restaurant::where('created_by', $id)->where('status', 0)->first();
        // dd($has_restaurant);

        return $has_restaurant;
    }

    public static  function has_activity($id)
    {
        $has_activity = Activity::where('created_by', $id)->where('status', 0)->first();
        // dd($has_activity);

        return $has_activity;
    }
}
