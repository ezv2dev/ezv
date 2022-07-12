<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class RestaurantListingController extends Controller
{
    public function store(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 500);

        $this->authorize('restaurant_create');

        //insert into database
        $data = Restaurant::insertGetId(array(
            'uid' => rand(10000, 99999).time(),
            'name' => "Food Name Here",
            'id_type' => 1,
            'id_price' => 1,
            'id_location' => 1,
            'short_description' => "Make your short description here",
            'latitude' => -8.4553718,
            'longitude' => 114.7913786,
            // 'phone' => $request->phone,
            // 'email' => $request->email,
            'open_time' => '00:00',
            'closed_time' => '00:00',
            'status' => 0,
            // 'image' => $name_file,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('restaurant', $data)->with('success', 'Your data has been submited');
    }

    public function destroy($id)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 500);

        $this->authorize('restaurant_delete');
        $status = 500;

        try {
            $find = Restaurant::withTrashed()->where('id_restaurant', $id)->first();
            abort_if(!$find, 404);

            $deletedRestaurant = $find->forceDelete();

            $find = Restaurant::where('id_restaurant', $id)->first();
            // check if the editor does not have authorization
            if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->role->name != $find->created_by) {
                abort(403);
            }
            $folder = strtolower($find->name);
            $path = env("RESTAURANT_FILE_PATH"). $folder;
            File::deleteDirectory($path);
            // File::deleteDirectory(public_path('foto/restaurant/' . $find->name));
            // $find->delete();

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            // return redirect()->route('admin_restaurant')->with('success', 'Your data has been deleted');
            return response()->json([
                'message' => 'Delete Data Successfuly',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Delete Data',
                'status' => 500,
            ], 500);
        }
    }

    public function softDestroy($id)
    {
        $this->authorize('restaurant_delete');
        $status = 500;

        try {
            $find = Restaurant::where('id_restaurant', $id)->first();
            $find->update(array(
                'status' =>  0,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
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
            return redirect()->route('admin_restaurant')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function restoreDestroy($id)
    {
        $this->authorize('restaurant_delete');
        $status = 500;

        $find = Restaurant::withTrashed()->where('id_restaurant', $id)->first();
        abort_if(!$find, 404);

        $find->update(array(
            'status' =>  1,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        $restoreDeletedRestaurant = $find->restore();

        if ($restoreDeletedRestaurant) {
            return redirect()->route('admin_restaurant')
                ->with('success', 'Your data has been restore');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
