<?php

namespace App\Http\Controllers\Activity;

use App\Models\ActivityCategory;
use App\Models\ActivitySubcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivitySubcategoryController extends Controller
{
    public function index()
    {
        $this->authorize('activitysubcategory_index');
        return view('new-admin.activity.subcategory.index');
    }

    public function datatable()
    {
        $this->authorize('activitysubcategory_index');
        return ActivitySubcategory::datatables();
    }

    public function create()
    {
        $this->authorize('activitysubcategory_create');
        $categories = ActivityCategory::all();
        return view('new-admin.activity.subcategory.create')->with(compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('activitysubcategory_create');

        $request->validate([
            'id_category' => ['required', 'integer'],
            'name' => ['required', 'max:50']
        ]);

        $createdSubcategory = ActivitySubcategory::create([
            'id_category' => $request->id_category,
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        if ($createdSubcategory) {
            return redirect()->route('activity_subcategory')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('activitysubcategory_update');
        $find = ActivitySubcategory::where('id_subcategory', $id)->get();
        $categories = ActivityCategory::all();
        return view('new-admin.activity.subcategory.edit', compact('find', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('activitysubcategory_update');
        $find = ActivitySubcategory::where('id_subcategory', $id)->first();

        $request->validate([
            'id_category' => ['required', 'integer'],
            'name' => ['required', 'max:50']
        ]);

        $updatedSubcategory = $find->update([
            'id_category' => $request->id_category,
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => auth()->user()->id,
        ]);

        if ($updatedSubcategory) {
            return redirect()->route('activity_subcategory')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('activitysubcategory_delete');
        $find = ActivitySubcategory::where('id_subcategory', $id)->first();
        $deletedSubcategory = $find->delete();

        if ($deletedSubcategory) {
            return redirect()->route('activity_subcategory')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
