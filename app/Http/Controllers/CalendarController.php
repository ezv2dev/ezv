<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VillaDetailPrice;
use App\Models\Villa;
use Auth;
use DB;

class CalendarController extends Controller
{

    public function index()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        {
            $villa = Villa::select('id_villa', 'name', 'price')->where('status','=',1)->get();
            // dd($data);
        }
        elseif (Auth::user()->role_id == 3)
        {
            $villa = Villa::select('id_villa', 'name', 'price')->where('status','=',1)->where('created_by', Auth::user()->id)->get();
        }

        $data = [];
        $i = 0;
        foreach ($villa as $item)
        {
            $data[$i]['id'] = $item->id_villa;
            $data[$i]['title'] = $item->name;
            $i++;
        }

        return view('new-admin.calendar.calendar_index', compact('data'));
    }

    public function all()
    {
        // $event = VillaDetailPrice::get();
        $data = DB::table('villa_detail_price')
        ->select('villa_detail_price.id_detail',
        'villa_detail_price.id_villa',
        'villa_detail_price.start',
        'villa_detail_price.end',
        'villa_detail_price.disc',
        'villa_detail_price.price as title',
        'villa.name as name',
        'villa.price as regular_price')
        ->join('villa', 'villa_detail_price.id_villa', '=', 'villa.id_villa', 'left')
        // ->where('villa_detail_price.id_villa','=',null)
        ->get();

        $event = array([
            'id_detail' => 0,
            'id_villa' => 0,
            'start' => 0,
            'end' => 0,
            'disc' => 0,
            'title' => 0,
            'name' => 0,
            'regular_price' => 0
        ]);

        $i = 0;

        foreach ($data as $item)
        {
            $event[$i]['id_detail'] = $item->id_detail;
            $event[$i]['id_villa'] = $item->id_villa;
            $event[$i]['start'] = $item->start;
            $event[$i]['end'] = date('Y-m-d', strtotime($item->end . " +1 days"));
            $event[$i]['disc'] = $item->disc;
            $event[$i]['title'] = $item->title;
            $event[$i]['name'] = $item->name;
            $event[$i]['regular_price'] = $item->regular_price;
            $i++;
        }

        return response()->json($event, 200);
    }

    public function filterVilla($id)
    {
        // $event = DB::table('villa_detail_price')
        // ->select('villa_detail_price.id_detail',
        // 'villa_detail_price.id_villa',
        // 'villa_detail_price.start',
        // 'villa_detail_price.end',
        // 'villa_detail_price.disc',
        // 'villa_detail_price.price as title',
        // 'villa.name as name',
        // 'villa.price as regular_price')
        // // ->except(['villa_detail_price.created_at', 'villa_detail_price.updated_at', 'villa_detail_price.created_by', 'villa_detail_price.updated_by'])
        // ->join('villa', 'villa_detail_price.id_villa', '=', 'villa.id_villa', 'left')
        // ->where('villa_detail_price.id_villa','=', $id)
        // ->get();

        $data = DB::table('villa_detail_price')
            ->select(
                'villa_detail_price.id_detail',
                'villa_detail_price.id_villa',
                'villa_detail_price.start',
                'villa_detail_price.end',
                'villa_detail_price.disc',
                'villa_detail_price.price as title',
                'villa.name as name',
                'villa.price as regular_price'
            )
            ->join('villa', 'villa_detail_price.id_villa', '=', 'villa.id_villa', 'left')
            ->where('villa_detail_price.id_villa', '=', $id)
            ->get();

        // dd($data);

        $event = array([
            'id_detail' => 0,
            'id_villa' => 0,
            'start' => 0,
            'end' => 0,
            'disc' => 0,
            'title' => 0,
            'name' => 0,
            'regular_price' => 0
        ]);

        $i = 0;

        foreach ($data as $item)
        {
            $event[$i]['id_detail'] = $item->id_detail;
            $event[$i]['id_villa'] = $item->id_villa;
            $event[$i]['start'] = $item->start;
            $event[$i]['end'] = date('Y-m-d', strtotime($item->end . " +1 days"));
            $event[$i]['disc'] = $item->disc;
            $event[$i]['title'] = $item->title;
            $event[$i]['name'] = $item->name;
            $event[$i]['regular_price'] = $item->regular_price;
            $i++;
        }

        // dd($event);

        return response()->json($event, 200);
    }

    public function selectVilla($id)
    {
        $villa = Villa::where('id_villa',$id)
        ->select("id_villa","name","price")
        ->first();

        return response()->json($villa, 200);
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            // 'id_villa' => 'required',
            // 'price' => 'required',
            'start' => 'required',
            'end' => 'required',
            'disc' => 'required',
        ]);

        VillaDetailPrice::create([
            'id_villa' => $request->id_villa,
            'price' => $request->price,
            'start' => $request->start,
            'end' => $request->end,
            'disc' => $request->disc,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->back();
    }

    public function updateEvent(Request $request)
    {
        $request->validate([
            // 'id_villa' => 'required',
            'price' => 'required',
            'start' => 'required',
            'end' => 'required',
            'disc' => 'required',
        ]);

        VillaDetailPrice::where('id_detail',$request->id_detail)->update([
            'price' => $request->price,
            'start' => $request->start,
            'end' => $request->end,
            'disc' => $request->disc,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('calendar_index');
    }

    public function destroy($id)
    {
        $delete = VillaDetailPrice::where('id_detail', $id)->first();
        $delete->delete();

        return response()->json([
            'message' => 'success',
        ], 200);
    }
}
