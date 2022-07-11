<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantGoodfor;

class RestaurantGoodforController extends Controller
{
    public function index()
    {
        $this->authorize('restaurantgoodfor_index');
        return view('new-admin.restaurant.goodfor.index');
    }

    public function datatable()
    {
        $this->authorize('restaurantgoodfor_index');
        return RestaurantGoodfor::datatables();
    }

    public function create()
    {
        $this->authorize('restaurantgoodfor_create');
        return view('new-admin.restaurant.goodfor.create');
    }

    public function store(Request $request)
    {
        $this->authorize('restaurantgoodfor_create');

        $request->validate([
            'name' => ['required', 'max:50']
        ]);

        $createdFacilities = RestaurantGoodfor::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        if ($createdFacilities) {
            return redirect()->route('restaurant_goodfor')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('restaurantgoodfor_update');
        $find = RestaurantGoodfor::where('id_goodfor', $id)->get();
        return view('new-admin.restaurant.goodfor.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('restaurantgoodfor_update');
        $find = RestaurantGoodfor::where('id_goodfor', $id)->first();

        $updatedFacilities = $find->update([
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => auth()->user()->id,
        ]);

        if ($updatedFacilities) {
            return redirect()->route('restaurant_goodfor')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('restaurantgoodfor_delete');
        $find = RestaurantGoodfor::where('id_goodfor', $id)->first();
        $deletedFacilities = $find->delete();

        if ($deletedFacilities) {
            return redirect()->route('restaurant_goodfor')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
