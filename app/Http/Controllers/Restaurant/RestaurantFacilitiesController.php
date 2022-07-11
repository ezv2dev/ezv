<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\RestaurantFacilities;
use Illuminate\Http\Request;

class RestaurantFacilitiesController extends Controller
{
    public function index()
    {
        $this->authorize('restaurantfacilities_index');
        return view('new-admin.restaurant.facilities.index');
    }

    public function datatable()
    {
        $this->authorize('restaurantfacilities_index');
        return RestaurantFacilities::datatables();
    }

    public function create()
    {
        $this->authorize('restaurantfacilities_create');
        return view('new-admin.restaurant.facilities.create');
    }

    public function store(Request $request)
    {
        $this->authorize('restaurantfacilities_create');

        $request->validate([
            'name' => ['required', 'max:50']
        ]);

        $createdFacilities = RestaurantFacilities::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        if ($createdFacilities) {
            return redirect()->route('restaurant_facilities')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('restaurantfacilities_update');
        $find = RestaurantFacilities::where('id_facilities', $id)->get();
        return view('new-admin.restaurant.facilities.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('restaurantfacilities_update');
        $find = RestaurantFacilities::where('id_facilities', $id)->first();

        $updatedFacilities = $find->update([
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => auth()->user()->id,
        ]);

        if ($updatedFacilities) {
            return redirect()->route('restaurant_facilities')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('restaurantfacilities_delete');
        $find = RestaurantFacilities::where('id_facilities', $id)->first();
        $deletedFacilities = $find->delete();

        if ($deletedFacilities) {
            return redirect()->route('restaurant_facilities')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
