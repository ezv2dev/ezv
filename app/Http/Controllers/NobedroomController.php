<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\NoBedroom;

class NobedroomController extends Controller
{
    public function index()
    {
        $this->authorize('amenities_index');
        // return view('admin.villa.no_bedroom.index');
        return view('new-admin.villa.no_bedroom.index');
    }

    public function datatable()
	{
        $this->authorize('amenities_index');
		return NoBedroom::datatables();
	}

    public function create()
    {
        $this->authorize('amenities_create');
        // return view('admin.villa.no_bedroom.create');
        return view('new-admin.villa.no_bedroom.create');
    }

    public function store(Request $request){
        $this->authorize('amenities_create');
        $request->validate([
            'no_bedroom' => 'required',
        ]);

        $data = NoBedroom::insert(array(
            'no_bedroom' => $request->no_bedroom,
            'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));



        return redirect()->route('admin_no_bedroom')
            ->with('success', 'Your data has been submited');
    }

    public function show($id)
    {
        $this->authorize('amenities_update');
        $find = NoBedroom::where('id_bedroom', $id)->get();
        // return view('admin.villa.no_bedroom.edit', compact('find'));
        return view('new-admin.villa.no_bedroom.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('amenities_update');
        $find = NoBedroom::where('id_bedroom', $id)->first();
        $request->validate([
            'no_bedroom' => 'required',
        ]);

        $find->update(array(
            'no_bedroom' => $request->no_bedroom,
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_no_bedroom')
            ->with('success', 'Your data has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('amenities_delete');
        $find = NoBedroom::where('id_bedroom', $id)->first();
        $find->delete();
        return redirect()->route('admin_no_bedroom')
            ->with('success', 'Your data has been deleted');
    }
}
