<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use Illuminate\Http\Request;

class VillaSearchController extends Controller
{
    public function search(Request $request)
    {
        // dd($request->all());
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $bedroom = $request->bedroom;
        $bathroom = $request->bathroom;
        $beds = $request->beds;
        $checked = $_GET['filterAmenities'];
        $checked2 = $_GET['filterProperty'];

        $size1 = sizeof($checked);
        $size2 = sizeof($checked2);

        if ($size1 > 1 && $size2 > 1) {
            $villa = Villa::where('status', 1)
                ->join('villa_amenities', 'villa.id_villa', '=', 'villa_amenities.id_villa', 'left')
                ->whereBetween('price', [$min_price, $max_price])
                ->where('bedroom', '>=', $bedroom)
                ->where('bathroom', '>=', $bathroom)
                ->where('beds', '>=', $beds)
                ->where('villa_amenities.id_amenities', $checked)
                ->whereIn('id_property_type', $checked2)->inRandomOrder()->get();
        } else if ($size1 == 1 && $size2 > 1) {
            $villa = Villa::where('status', 1)
                ->join('villa_amenities', 'villa.id_villa', '=', 'villa_amenities.id_villa', 'left')
                ->whereBetween('price', [$min_price, $max_price])
                ->where('bedroom', '>=', $bedroom)
                ->where('bathroom', '>=', $bathroom)
                ->where('beds', '>=', $beds)
                ->where('villa_amenities.id_amenities', $checked)->inRandomOrder()->get();
        } else if ($size2 == 1 && $size1 > 1) {
            $villa = Villa::where('status', 1)
                ->whereBetween('price', [$min_price, $max_price])
                ->where('bedroom', '>=', $bedroom)
                ->where('bathroom', '>=', $bathroom)
                ->where('beds', '>=', $beds)
                ->whereIn('id_property_type', $checked2)->inRandomOrder()->get();
        } else {
            $villa = Villa::where('status', 1)
                ->whereBetween('price', [$min_price, $max_price])
                ->where('bedroom', '>=', $bedroom)
                ->where('bathroom', '>=', $bathroom)
                ->where('beds', '>=', $beds)->inRandomOrder()->get();
        }

        $villaIds = $villa->modelKeys();
        $villa = Villa::whereIn('id_villa', $villaIds)->orderByRaw("FIELD(grade, \"A\", \"B\", \"C\", \"D\")")->paginate(env('CONTENT_PER_PAGE_LIST_VILLA'));
        $villa->each(function ($item, $key) {
            $item->setAppends(['restaurant_nearby', 'activity_nearby', 'hotel_nearby']);
        });
        $villa->appends(request()->query());

        return view('user.list_villa', compact('villa'));
    }
}
