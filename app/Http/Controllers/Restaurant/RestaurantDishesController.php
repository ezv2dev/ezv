<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantDishes;

class RestaurantDishesController extends Controller
{
    public function index()
    {
        $this->authorize('restaurantdishes_index');
        return view('new-admin.restaurant.dishes.index');
    }

    public function datatable()
    {
        $this->authorize('restaurantdishes_index');
        return RestaurantDishes::datatables();
    }

    public function create()
    {
        $this->authorize('restaurantdishes_create');
        return view('new-admin.restaurant.dishes.create');
    }

    public function store(Request $request)
    {
        $this->authorize('restaurantdishes_create');

        $request->validate([
            'name' => ['required', 'max:50']
        ]);

        $createdFacilities = RestaurantDishes::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        if ($createdFacilities) {
            return redirect()->route('restaurant_dishes')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('restaurantdishes_update');
        $find = RestaurantDishes::where('id_dishes', $id)->get();
        return view('new-admin.restaurant.dishes.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('restaurantdishes_update');
        $find = RestaurantDishes::where('id_dishes', $id)->first();

        $updatedFacilities = $find->update([
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => auth()->user()->id,
        ]);

        if ($updatedFacilities) {
            return redirect()->route('restaurant_dishes')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('restaurantdishes_delete');
        $find = RestaurantDishes::where('id_dishes', $id)->first();
        $deletedFacilities = $find->delete();

        if ($deletedFacilities) {
            return redirect()->route('restaurant_dishes')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
