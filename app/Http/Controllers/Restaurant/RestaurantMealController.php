<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\RestaurantMeal;
use Illuminate\Http\Request;

class RestaurantMealController extends Controller
{
    public function index()
    {
        $this->authorize('restaurantmeal_index');
        return view('new-admin.restaurant.meal.index');
    }

    public function datatable()
    {
        $this->authorize('restaurantmeal_index');
        return RestaurantMeal::datatables();
    }

    public function create()
    {
        $this->authorize('restaurantmeal_create');
        return view('new-admin.restaurant.meal.create');
    }

    public function store(Request $request)
    {
        $this->authorize('restaurantmeal_create');

        $request->validate([
            'name' => ['required', 'max:50']
        ]);

        $createdFacilities = RestaurantMeal::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        if ($createdFacilities) {
            return redirect()->route('restaurant_meal')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('restaurantmeal_update');
        $find = RestaurantMeal::where('id_meal', $id)->get();
        return view('new-admin.restaurant.meal.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('restaurantmeal_update');
        $find = RestaurantMeal::where('id_meal', $id)->first();

        $updatedFacilities = $find->update([
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => auth()->user()->id,
        ]);

        if ($updatedFacilities) {
            return redirect()->route('restaurant_meal')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('restaurantmeal_delete');
        $find = RestaurantMeal::where('id_meal', $id)->first();
        $deletedFacilities = $find->delete();

        if ($deletedFacilities) {
            return redirect()->route('restaurant_meal')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
