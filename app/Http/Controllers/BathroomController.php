<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BathRoom;

class BathroomController extends Controller
{
    public function index()
    {
        $this->authorize('amenities_index');
        // return view('admin.villa.bathroom.index');
        return view('new-admin.villa.bathroom.index');
    }

    public function datatable()
	{
        $this->authorize('amenities_index');
		return BathRoom::datatables();
	}

    public function create()
    {
        $this->authorize('amenities_create');
        // return view('admin.villa.bathroom.create');
        return view('new-admin.villa.bathroom.create');
    }

    public function store(Request $request){
        $this->authorize('amenities_create');
        $request->validate([
            'name' => 'required',
        ]);

        $data = Bathroom::insert(array(
            'name' => $request->name,
            'icon' => $request->icon,
            'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_bathroom')
            ->with('success', 'Your data has been submited');
    }

    public function show($id)
    {
        $this->authorize('amenities_update');
        $find = BathRoom::where('id_bathroom', $id)->get();
        // return view('admin.villa.bathroom.edit', compact('find'));
        return view('new-admin.villa.bathroom.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('amenities_update');
        $find = BathRoom::where('id_bathroom', $id)->first();
        $request->validate([
            'name' => 'required',
        ]);

        $find->update(array(
            'icon' => $request->icon,
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_bathroom')
            ->with('success', 'Your data has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('amenities_delete');
        $find = BathRoom::where('id_bathroom', $id)->first();
        $find->delete();
        return redirect()->route('admin_bathroom')
            ->with('success', 'Your data has been deleted');
    }
}
