<?php

namespace App\Http\Controllers;

use App\Models\OutdoorAmenities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutdoorController extends Controller
{
    public function index()
    {
        $this->authorize('amenities_index');
        return view('new-admin.villa.outdoor.index');
    }

    public function datatable()
    {
        $this->authorize('amenities_index');
        return OutdoorAmenities::datatables();
    }

    public function create()
    {
        $this->authorize('amenities_create');
        return view('new-admin.villa.outdoor.create');
    }

    public function store(Request $request)
    {
        $this->authorize('amenities_create');
        $request->validate([
            'name' => 'required',
        ]);

        $data = OutdoorAmenities::insert(array(
            'name' => $request->name,
            'icon' => $request->icon,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_outdoor')
            ->with('success', 'Your data has been submited');
    }

    public function show($id)
    {
        $this->authorize('amenities_update');
        $find = OutdoorAmenities::where('id_outdoor', $id)->get();
        return view('new-admin.villa.outdoor.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('amenities_update');
        $find = OutdoorAmenities::where('id_outdoor', $id)->first();
        $request->validate([
            'name' => 'required',
        ]);

        $find->update(array(
            'icon' => $request->icon,
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_outdoor')
            ->with('success', 'Your data has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('amenities_delete');
        $find = OutdoorAmenities::where('id_outdoor', $id)->first();
        $find->delete();
        return redirect()->route('admin_outdoor')
            ->with('success', 'Your data has been deleted');
    }
}
