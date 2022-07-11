<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $this->authorize('amenities_index');
        // return view('admin.villa.service.index');
        return view('new-admin.villa.service.index');
    }

    public function datatable()
	{
        $this->authorize('amenities_index');
		return Service::datatables();
	}

    public function create()
    {
        $this->authorize('amenities_create');
        // return view('admin.villa.service.create');
        return view('new-admin.villa.service.create');
    }

    public function store(Request $request){
        $this->authorize('amenities_create');
        $request->validate([
            'name' => 'required',
        ]);

        $data = service::insert(array(
            'name' => $request->name,
            'icon' => $request->icon,
            'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_service')
            ->with('success', 'Your data has been submited');
    }

    public function show($id)
    {
        $this->authorize('amenities_update');
        $find = Service::where('id_service', $id)->get();
        // return view('admin.villa.service.edit', compact('find'));
        return view('new-admin.villa.service.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('amenities_update');
        $find = service::where('id_service', $id)->first();
        $request->validate([
            'name' => 'required',
        ]);

        $find->update(array(
            'icon' => $request->icon,
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_service')
            ->with('success', 'Your data has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('amenities_delete');
        $find = service::where('id_service', $id)->first();
        $find->delete();
        return redirect()->route('admin_service')
            ->with('success', 'Your data has been deleted');
    }
}
