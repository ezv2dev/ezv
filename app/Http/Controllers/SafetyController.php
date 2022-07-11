<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Safety;

class SafetyController extends Controller
{
    public function index()
    {
        $this->authorize('amenities_index');
        // return view('admin.villa.safety.index');
        return view('new-admin.villa.safety.index');
    }

    public function datatable()
	{
        $this->authorize('amenities_index');
		return Safety::datatables();
	}

    public function create()
    {
        $this->authorize('amenities_create');
        // return view('admin.villa.safety.create');
        return view('new-admin.villa.safety.create');
    }

    public function store(Request $request){
        $this->authorize('amenities_create');
        $request->validate([
            'name' => 'required',
        ]);

        $data = Safety::insert(array(
            'name' => $request->name,
            'icon' => $request->icon,
            'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_safety')
            ->with('success', 'Your data has been submited');
    }

    public function show($id)
    {
        $this->authorize('amenities_update');
        $find = Safety::where('id_safety', $id)->get();
        // return view('admin.villa.safety.edit', compact('find'));
        return view('new-admin.villa.safety.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('amenities_update');
        $find = Safety::where('id_safety', $id)->first();
        $request->validate([
            'name' => 'required',
        ]);

        $find->update(array(
            'icon' => $request->icon,
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_safety')
            ->with('success', 'Your data has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('amenities_delete');
        $find = Safety::where('id_safety', $id)->first();
        $find->delete();
        return redirect()->route('admin_safety')
            ->with('success', 'Your data has been deleted');
    }
}
