<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Auth;

class HotelListingController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('listvilla_create');

        $data = Hotel::insertGetId(array(
            'uid' => rand(10000, 99999).time(),
            'id_property_type' => 4,
            'name' => "Hotel Name Here",
            'short_description' => "Make your short description here",
            // 'original_name' => $request->name,
            'adult' => "1",
            'children' => "0",
            'bedroom' => "1",
            'bathroom' => "1",
            'latitude' => -8.4553718,
            'longitude' => 114.7913786,
            // 'phone' => $request->phone,
            'id_location' => 1,
            // 'email' => $request->email,
            // 'image' => $name_file,
            'status' => 0,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('hotel', $data)->with('success', 'Your data has been submited');
        // return back()->with('error', 'Please check the form below for errors');

    }

    public function status(Request $request, $id)
    {
        $this->authorize('listvilla_delete');
        $status = 500;

        $find = Hotel::where('id_hotel', $id)->first();
        if ($find->status == 0) {
            $find->update(array(
                'status' =>  1,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        } else if ($find->status == 2) {
            $find->update(array(
                'status' =>  1,
                'grade' => $request->grade,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        } else {
            $find->update(array(
                'status' =>  0,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        }

        return back()->with('success', 'Your data has been update');
    }

    public function cancel_request_update_status(Request $request)
    {
        $id = $request->id;
        abort_if(!auth()->check(), 401);
        abort_if(!$id, 500);
        $find = Hotel::where('id_hotel', $id)->first();
        abort_if(!$find, 404);
        $this->authorize('listvilla_update');
        abort_if(auth()->user()->id != $find->created_by, 403);

        $find = Hotel::where('id_hotel', $id)->first();

        $status = false;

        if ($find->status == 2) {
            $find->update(array(
                'status' =>  0, //cancel request activation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($find->status == 3) {
            $find->update(array(
                'status' =>  1, //cancel request deactivation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($status) {
            return back()
                ->with('success', 'request has been sended');
        } else {
            return back()
                ->with('error', 'request fail to sended due internal server error');
        }
    }
}
