<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Auth;
use DataTables;
use Carbon\Carbon;

class HotelListingController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        {
            $data = Hotel::all()->count();
        }
        elseif (Auth::user()->role_id == 3)
        {
            $data = Hotel::where('created_by', Auth::user()->id)->count();
        }

        return view('new-admin.hotel.listing_index', compact('data'));
    }

    public function datatable(Request $request)
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $data = Hotel::all();
            // $data = DB::table('villa')->select('*')->where('deleted_at',NULL)->get();
        } elseif (Auth::user()->role_id == 3) {
            $data = Hotel::where('created_by', Auth::user()->id)->get();
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('listing', function ($data) {
                $url = asset('foto/hotel/' . $data->name . '/' . $data->image);
                return '<img src="' . $url . '" border="0" width="60" class="img-rounded" align="center" /> <a href="/hotel/'.$data->id_hotel.'"><span><b>' . $data->name . '</b></span></a>';
            })

            ->addColumn('last_modified', function ($data) {
                $last_modified = Carbon::parse($data->updated_at)->diffForHumans();
                return $last_modified;
            })

            ->addColumn('price', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->price;
                $no .= "</center";

                return $no;
            })
            ->addColumn('todo', function ($data) {
                $todo = "";
                $todo .= "<center>";
                $todo .= "<button class='btn btn-outline-primary'>Finish</button>";
                $todo .= "</center>";

                return $todo;
            })
            ->addColumn('instantBook', function ($data) {
                $co = "";
                // $co .= "<center>";
                $co .= "On";
                // $co .= "</center>";

                return $co;
            })
            // ->addColumn('status_listing', function($data) {
            //     $status_listing = "";

            // })
            ->addColumn('status', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->status == 0)
                    $co .= "<span class='text-white badge badge-pill bg-danger'>Non Active</span>";
                elseif ($data->status == 1) {
                    $co .= "<span class='text-white badge badge-pill bg-success'>Active</span>";
                }
                $co .= "</center";

                return $co;
            })
            ->rawColumns(['aksi', 'status', 'price', 'todo', 'instantBook', 'listing', 'last_modified'])->make(true);
    }
}
