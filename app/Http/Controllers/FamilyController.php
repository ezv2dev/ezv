<?php

namespace App\Http\Controllers;

use App\Models\FamilyAmenities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    public function index()
    {
        $this->authorize('amenities_index');
        return view('new-admin.villa.family.index');
    }

    public function datatable()
    {
        $this->authorize('amenities_index');
        return FamilyAmenities::datatables();
    }

    public function create()
    {
        $this->authorize('amenities_create');
        return view('new-admin.villa.family.create');
    }

    public function store(Request $request)
    {
        $this->authorize('amenities_create');
        $request->validate([
            'name' => 'required',
        ]);

        $data = FamilyAmenities::insert(array(
            'name' => $request->name,
            'icon' => $request->icon,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_family')
            ->with('success', 'Your data has been submited');
    }

    public function show($id)
    {
        $this->authorize('amenities_update');
        $find = FamilyAmenities::where('id_family', $id)->get();
        return view('new-admin.villa.family.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('amenities_update');
        $find = FamilyAmenities::where('id_family', $id)->first();
        $request->validate([
            'name' => 'required',
        ]);

        $find->update(array(
            'icon' => $request->icon,
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_family')
            ->with('success', 'Your data has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('amenities_delete');
        $find = FamilyAmenities::where('id_family', $id)->first();
        $find->delete();
        return redirect()->route('admin_family')
            ->with('success', 'Your data has been deleted');
    }
}
