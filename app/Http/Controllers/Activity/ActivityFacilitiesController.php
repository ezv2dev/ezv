<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\ActivityFacilities;
use Illuminate\Http\Request;

class ActivityFacilitiesController extends Controller
{
    public function index()
    {
        $this->authorize('activityfacilities_index');
        return view('new-admin.activity.facilities.index');
    }

    public function datatable()
    {
        $this->authorize('activityfacilities_index');
        return ActivityFacilities::datatables();
    }

    public function create()
    {
        $this->authorize('activityfacilities_create');
        return view('new-admin.activity.facilities.create');
    }

    public function store(Request $request)
    {
        $this->authorize('activityfacilities_create');

        $request->validate([
            'name' => ['required', 'max:50']
        ]);

        $createdFacilities = ActivityFacilities::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        if ($createdFacilities) {
            return redirect()->route('activity_facilities')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('activityfacilities_update');
        $find = ActivityFacilities::where('id_facilities', $id)->get();
        return view('new-admin.activity.facilities.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('activityfacilities_update');
        $find = ActivityFacilities::where('id_facilities', $id)->first();

        $updatedFacilities = $find->update([
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => auth()->user()->id,
        ]);

        if ($updatedFacilities) {
            return redirect()->route('activity_facilities')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('activityfacilities_delete');
        $find = ActivityFacilities::where('id_facilities', $id)->first();
        $deletedFacilities = $find->delete();

        if ($deletedFacilities) {
            return redirect()->route('activity_facilities')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
