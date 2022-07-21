<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\Villa;
use Illuminate\Support\Facades\Auth;

class VillaListingController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('listvilla_create');

        $data = Villa::insertGetId(array(
            'uid' => rand(10000, 99999) . time(),
            'id_property_type' => 1,
            'name' => "Home Name Here",
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

        return redirect()->route('villa', $data)->with('success', 'Your data has been submited');
        // return back()->with('error', 'Please check the form below for errors');
    }

    public function destroy($id)
    {
        $this->authorize('listvilla_delete');
        $status = 500;

        try {
            // $find = villa::where('id_villa', $id)->first();
            $find = Villa::withTrashed()->where('id_villa', $id)->first();
            abort_if(!$find, 404);

            $deletedVilla = $find->forceDelete();

            $folder = strtolower($find->name);
            $path = env("VILLA_FILE_PATH") . $folder;
            File::deleteDirectory($path);
            // File::deleteDirectory(public_path('foto/gallery/' . $find->name));
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
            // return redirect()->route('admin_villa')
            //     ->with('success', 'Your data has been deleted');
            return response()->json([
                'message' => 'Delete Data Successfuly',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Deleted Data',

            ], 500);
        }
    }

    public function status(Request $request, $id)
    {
        $find = Villa::where('id_villa', $id)->first();
        if ($find->status == 2) {
            $find->update(array(
                'status' =>  1,
                'grade' => $request->grade,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            return response()->json(['message' => 'Successfuly request for activiation', 'data' => 1, 'grade' => $request->grade]);
        } else {
            $find->update(array(
                'status' =>  0,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            return response()->json(['message' => 'Successfuly request for activiation', 'data' => 0]);
        }
    }

    public function grade(Request $request, $id)
    {
        $find = Villa::where('id_villa', $id)->first();

        $find->update(array(
            'grade' => $request->grade,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return response()->json(['success' => true, 'message' => 'Succesfully Update Grade Villa to ' . $request->grade,  'data' => $request->grade]);
    }

    public function softDestroy($id)
    {
        $this->authorize('listvilla_delete');
        $status = 500;

        try {
            $find = Villa::where('id_villa', $id)->first();
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
            return redirect()->route('admin_villa')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function restoreDestroy($id)
    {
        $this->authorize('listvilla_delete');
        $status = 500;

        $find = Villa::withTrashed()->where('id_villa', $id)->first();
        abort_if(!$find, 404);

        $find->update(array(
            'status' =>  1,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        $restoreDeletedVilla = $find->restore();

        if ($restoreDeletedVilla) {
            return redirect()->route('admin_villa')
                ->with('success', 'Your data has been restore');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
