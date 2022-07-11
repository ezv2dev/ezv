<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VillaType;
use Illuminate\Support\Facades\Auth;

class VillatypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('amenities_index');

        // return view('admin.villa.villatype.index');
        return view('new-admin.villa.villatype.index');
    }

    public function datatable()
	{
        $this->authorize('amenities_index');

		return VillaType::datatables();
	}

    public function create()
    {
        $this->authorize('amenities_create');


        // return view('admin.villa.villatype.create');
        return view('new-admin.villa.villatype.create');
    }

    public function store(Request $request){
        $this->authorize('amenities_create');
        $request->validate([
            'name' => 'required',
        ]);

        $data = VillaType::insert(array(
            'name' => $request->name,
            'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));



        return redirect()->route('admin_villatype')
            ->with('success', 'Your data has been submited');
    }

    public function show($id)
    {
        $this->authorize('amenities_update');
        $find = VillaType::where('id_villa_type', $id)->get();
        // return view('admin.villa.villatype.edit', compact('find'));
        return view('new-admin.villa.villatype.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('amenities_update');
        $find = VillaType::where('id_villa_type', $id)->first();

        $request->validate([
            'name' => 'required',
        ]);

        $find->update(array(
            'name' => $request->name,
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_villatype')
            ->with('success', 'Your data has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('amenities_delete');
        $find = VillaType::where('id_villa_type', $id)->first();
        $find->delete();
        return redirect()->route('admin_villatype')
            ->with('success', 'Your data has been deleted');
    }
}
