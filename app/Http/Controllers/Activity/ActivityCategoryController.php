<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityCategory;

class ActivityCategoryController extends Controller
{
    public function index()
    {
        $this->authorize('activitycategory_index');
        return view('new-admin.activity.category.index');
    }

    public function datatable()
    {
        $this->authorize('activitycategory_index');
        return ActivityCategory::datatables();
    }

    public function create()
    {
        $this->authorize('activitycategory_create');
        return view('new-admin.activity.category.create');
    }

    public function store(Request $request)
    {
        $this->authorize('activitycategory_create');

        $request->validate([
            'name' => ['required', 'max:50']
        ]);

        $createdCategory = ActivityCategory::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        if ($createdCategory) {
            return redirect()->route('activity_category')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('activitycategory_update');
        $find = ActivityCategory::where('id_category', $id)->get();
        return view('new-admin.activity.category.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('activitycategory_update');
        $find = ActivityCategory::where('id_category', $id)->first();

        $updatedCategory = $find->update([
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => auth()->user()->id,
        ]);

        if ($updatedCategory) {
            return redirect()->route('activity_category')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('activitycategory_delete');
        $find = ActivityCategory::where('id_category', $id)->first();
        $deletedCategory = $find->delete();

        if ($deletedCategory) {
            return redirect()->route('activity_category')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
