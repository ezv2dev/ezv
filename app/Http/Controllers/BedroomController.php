<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BedRoom;

class BedroomController extends Controller
{
    public function index()
    {
        $this->authorize('amenities_index');
        // return view('admin.villa.bedroom.index');
        return view('new-admin.villa.bedroom.index');
    }

    public function datatable()
	{
        $this->authorize('amenities_index');
		return BedRoom::datatables();
	}

    public function create()
    {
        $this->authorize('amenities_create');
        // return view('admin.villa.bedroom.create');
        return view('new-admin.villa.bedroom.create');
    }

    public function store(Request $request){
        $this->authorize('amenities_create');
        $request->validate([
            'name' => 'required',
        ]);

        $data = BedRoom::insert(array(
            'name' => $request->name,
            'icon' => $request->icon,
            'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_bedroom')
            ->with('success', 'Your data has been submited');
    }

    public function show($id)
    {
        $this->authorize('amenities_update');
        $find = Bedroom::where('id_bed', $id)->get();
        // return view('admin.villa.bedroom.edit', compact('find'));
        return view('new-admin.villa.bedroom.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('amenities_update');
        $find = BedRoom::where('id_bed', $id)->first();
        $request->validate([
            'name' => 'required',
        ]);

        $find->update(array(
            'icon' => $request->icon,
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_bedroom')
            ->with('success', 'Your data has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('amenities_delete');
        $find = BedRoom::where('id_bed', $id)->first();
        $find->delete();
        return redirect()->route('admin_bedroom')
            ->with('success', 'Your data has been deleted');
    }
}
