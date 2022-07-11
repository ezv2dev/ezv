<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\PropertyTypeVilla;
use App\Models\Villa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyTypeVillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $req['location'] = null;
            $req['check_in'] = null;
            $req['check_out'] = null;
            $req['adult'] = null;
            $req['children'] = null;

            $villa = Villa::where('id_property_type', $id)->inRandomOrder()->get();
        } else {
            if ($request->adult == '' || $request->children == '') {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::where('id_property_type', $id)->inRandomOrder()->get();
            } else {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;
                $villa = Villa::where('id_property_type', $id)->inRandomOrder()->get();
            }
        }

        $amenities = Amenities::all();
        $villaIds = $villa->modelKeys();
        $villa = Villa::whereIn('id_villa', $villaIds)->inRandomOrder()->paginate(5);
        $villa->appends(request()->query());

        return view('user.list_villa', compact('villa', 'req', 'amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PropertyTypeVilla  $propertyTypeVilla
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyTypeVilla $propertyTypeVilla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertyTypeVilla  $propertyTypeVilla
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyTypeVilla $propertyTypeVilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertyTypeVilla  $propertyTypeVilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyTypeVilla $propertyTypeVilla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertyTypeVilla  $propertyTypeVilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyTypeVilla $propertyTypeVilla)
    {
        //
    }
}
