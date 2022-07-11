<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\RestaurantType;

class RestaurantTypeController extends Controller
{
    public function index()
    {
        $this->authorize('restauranttype_index');
        return view('new-admin.restaurant.type.index');
    }

    public function datatable()
    {
        $this->authorize('restauranttype_index');
        return RestaurantType::datatables();
    }

    public function create()
    {
        $this->authorize('restauranttype_create');
        return view('new-admin.restaurant.type.create');
    }

    public function store(Request $request)
    {
        $this->authorize('restauranttype_create');
        $status = 500;

        try {
            $request->validate([
                'name' => 'required',
            ]);

            $data = RestaurantType::insert(array(
                'name' => $request->name,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            if ($data) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('restaurant_type')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('restauranttype_update');
        $find = RestaurantType::where('id_type', $id)->get();
        return view('new-admin.restaurant.type.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('restauranttype_update');
        $status = 500;

        try {
            $find = RestaurantType::where('id_type', $id)->first();
            $request->validate([
                'name' => 'required',
            ]);

            $find->update(array(
                'name' => $request->name,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('restaurant_type')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('restauranttype_delete');

        $status = 500;

        try {
            $find = RestaurantType::where('id_type', $id)->first();
            $find->delete();

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('restaurant_type')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
