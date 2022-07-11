<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantDietaryFood;

class RestaurantDietaryFoodController extends Controller
{
    public function index()
    {
        $this->authorize('restaurantdietaryfood_index');
        return view('new-admin.restaurant.dietaryfood.index');
    }

    public function datatable()
    {
        $this->authorize('restaurantdietaryfood_index');
        return RestaurantDietaryFood::datatables();
    }

    public function create()
    {
        $this->authorize('restaurantdietaryfood_create');
        return view('new-admin.restaurant.dietaryfood.create');
    }

    public function store(Request $request)
    {
        $this->authorize('restaurantdietaryfood_create');

        $request->validate([
            'name' => ['required', 'max:50']
        ]);

        $createdFacilities = RestaurantDietaryFood::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        if ($createdFacilities) {
            return redirect()->route('restaurant_dietary_food')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('restaurantdietaryfood_update');
        $find = RestaurantDietaryFood::where('id_dietaryfood', $id)->get();
        return view('new-admin.restaurant.dietaryfood.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('restaurantdietaryfood_update');
        $find = RestaurantDietaryFood::where('id_dietaryfood', $id)->first();

        $updatedFacilities = $find->update([
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => auth()->user()->id,
        ]);

        if ($updatedFacilities) {
            return redirect()->route('restaurant_dietary_food')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('restaurantdietaryfood_delete');
        $find = RestaurantDietaryFood::where('id_dietaryfood', $id)->first();
        $deletedFacilities = $find->delete();

        if ($deletedFacilities) {
            return redirect()->route('restaurant_dietary_food')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
