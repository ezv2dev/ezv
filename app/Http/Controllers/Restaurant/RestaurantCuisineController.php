<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantCuisine;

class RestaurantCuisineController extends Controller
{
    public function index()
    {
        $this->authorize('restaurantcuisine_index');
        return view('new-admin.restaurant.cuisine.index');
    }

    public function datatable()
    {
        $this->authorize('restaurantcuisine_index');
        return RestaurantCuisine::datatables();
    }

    public function create()
    {
        $this->authorize('restaurantcuisine_create');
        return view('new-admin.restaurant.cuisine.create');
    }

    public function store(Request $request)
    {
        $this->authorize('restaurantcuisine_create');

        $request->validate([
            'name' => ['required', 'max:50']
        ]);

        $createdFacilities = RestaurantCuisine::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        if ($createdFacilities) {
            return redirect()->route('restaurant_cuisine')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('restaurantcuisine_update');
        $find = RestaurantCuisine::where('id_cuisine', $id)->get();
        return view('new-admin.restaurant.cuisine.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('restaurantcuisine_update');
        $find = RestaurantCuisine::where('id_cuisine', $id)->first();

        $updatedFacilities = $find->update([
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => auth()->user()->id,
        ]);

        if ($updatedFacilities) {
            return redirect()->route('restaurant_cuisine')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('restaurantcuisine_delete');
        $find = RestaurantCuisine::where('id_cuisine', $id)->first();
        $deletedFacilities = $find->delete();

        if ($deletedFacilities) {
            return redirect()->route('restaurant_cuisine')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
