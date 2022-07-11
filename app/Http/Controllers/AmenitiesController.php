<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Amenities;

class AmenitiesController extends Controller
{
    public function index()
    {
        $this->authorize('amenities_index');
        // return view('admin.villa.amenities.index');
        return view('new-admin.villa.amenities.index');
    }

    public function datatable()
	{
        $this->authorize('amenities_index');
		return Amenities::datatables();
	}

    public function create()
    {
        $this->authorize('amenities_create');
        // return view('admin.villa.amenities.create');
        return view('new-admin.villa.amenities.create');
    }

    public function store(Request $request){
        $this->authorize('amenities_create');
        $status = 500;

        try {
            $request->validate([
                'name' => 'required',
            ]);

            $data = Amenities::insert(array(
                'name' => $request->name,
                'icon' => $request->icon,
                'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            if ($data){
                $status = 200;
            }
        } catch ( \Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if($status == 200){
            return redirect()->route('admin_amenities')
            ->with('success', 'Your data has been submited');
        }else{
            return back()
            ->with('error','Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('amenities_update');
        $find = Amenities::where('id_amenities', $id)->get();
        // return view('admin.villa.amenities.edit', compact('find'));
        return view('new-admin.villa.amenities.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('amenities_update');
        $status = 500;

        try {
            $find = Amenities::where('id_amenities', $id)->first();
            $request->validate([
                'name' => 'required',
            ]);

            $find->update(array(
                'icon' => $request->icon,
                'name' => $request->name,
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find){
                $status = 200;
            }
        } catch ( \Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if($status == 200){
            return redirect()->route('admin_amenities')
            ->with('success', 'Your data has been updated');
        }else{
            return back()
            ->with('error','Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('amenities_delete');

        $status = 500;

        try {
            $find = Amenities::where('id_amenities', $id)->first();
            $find->delete();

            if ($find){
                $status = 200;
            }
        } catch ( \Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if($status == 200){
            return redirect()->route('admin_amenities')
            ->with('success', 'Your data has been deleted');
        }else{
            return back()
            ->with('error','Please check the form below for errors');
        }

    }
}
