<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantPrice;

class RestaurantPriceController extends Controller
{
    public function index()
    {
        $this->authorize('restaurantprice_index');
        return view('new-admin.restaurant.price.index');
    }

    public function datatable()
    {
        $this->authorize('restaurantprice_index');
        return RestaurantPrice::datatables();
    }

    public function create()
    {
        $this->authorize('restaurantprice_create');
        return view('new-admin.restaurant.price.create');
    }

    public function store(Request $request)
    {
        $this->authorize('restaurantprice_create');

        $request->validate([
            'name' => ['required', 'max:50']
        ]);

        $createdFacilities = RestaurantPrice::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        if ($createdFacilities) {
            return redirect()->route('restaurant_price')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('restaurantprice_update');
        $find = RestaurantPrice::where('id_price', $id)->get();
        return view('new-admin.restaurant.price.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('restaurantprice_update');
        $find = RestaurantPrice::where('id_price', $id)->first();

        $updatedFacilities = $find->update([
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => auth()->user()->id,
        ]);

        if ($updatedFacilities) {
            return redirect()->route('restaurant_price')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('restaurantprice_delete');
        $find = RestaurantPrice::where('id_price', $id)->first();
        $deletedFacilities = $find->delete();

        if ($deletedFacilities) {
            return redirect()->route('restaurant_price')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
