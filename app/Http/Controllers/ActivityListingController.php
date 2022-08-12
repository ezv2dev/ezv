<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityListingController extends Controller
{
    public function store(Request $request)
    {
        abort_if(!auth()->check(), 401);
        $this->authorize('activity_create');

        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'id_location' => ['required', 'integer'],
        //     'short_description' => ['required', 'string', 'max:255'],
        //     'latitude' => ['required'],
        //     'longitude' => ['required'],
        //     'phone' => ['required', 'string', 'max:50'],
        //     'email' => ['required', 'string', 'email', 'max:100'],
        //     'image' => ['required', 'mimes:jpeg,jpg,png']
        // ]);

        // $folder = strtolower($request->name);
        // $path = env("ACTIVITY_FILE_PATH"). $folder;
        // if (!File::isDirectory($path)) {

        //     File::makeDirectory($path, 0777, true, true);
        // }

        // $ext = strtolower($request->image->getClientOriginalExtension());

        // if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {
        //     $original_name = $request->image->getClientOriginalName();
        //     // dd($original_name);
        //     $name_file = time() . "_" . $original_name;
        //     // isi dengan nama folder tempat kemana file diupload
        //     $request->image->move($path, $name_file);

        //insert into database
        $data = Activity::insertGetId(array(
            'uid' => rand(10000, 99999) . time(),
            'name' => 'Wow Name Here',
            'id_location' => 1,
            'short_description' => "Make your short description here",
            'status' => 0,
            'latitude' => -8.4553718,
            'longitude' => 114.7913786,
            'open_time' => '00:00',
            'closed_time' => '00:00',
            // 'phone' => $request->phone,
            // 'email' => $request->email,
            // 'image' => $name_file,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));
        return redirect()->route('activity', $data)->with('success', 'Your data has been submited');
        // return back()->with('error', 'Please check the form below for errors');
    }

    public function destroy($id)
    {
        abort_if(!auth()->check(), 401);
        $this->authorize('activity_delete');
        $status = 500;

        try {
            $find = Activity::withTrashed()->where('id_activity', $id)->first();
            abort_if(!$find, 404);

            $deletedVilla = $find->forceDelete();
            // $find = Activity::where('id_activity', $id)->first();
            $folder = strtolower($find->name);
            $path = env("ACTIVITY_FILE_PATH") . $folder;
            File::deleteDirectory($path);
            // File::deleteDirectory(public_path('foto/activity/' . $find->name));
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
            // return redirect()->route('admin_activity')->with('success', 'Your data has been deleted');
            return response()->json([
                'message' => 'Delete Data Successfully',
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
        $this->authorize('activity_delete');
        $status = 500;

        try {
            $find = Activity::where('id_activity', $id)->first();
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
            return redirect()->route('admin_activity')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function restoreDestroy($id)
    {
        $this->authorize('activity_delete');
        $status = 500;

        $find = Activity::withTrashed()->where('id_activity', $id)->first();
        abort_if(!$find, 404);

        $find->update(array(
            'status' =>  1,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        $restoreDeletedActivity = $find->restore();

        if ($restoreDeletedActivity) {
            return redirect()->route('admin_activity')
                ->with('success', 'Your data has been restore');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
