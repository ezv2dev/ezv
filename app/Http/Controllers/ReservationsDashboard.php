<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Villa;
use App\Models\VillaDetailPrice;
use App\Models\VillaBooking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DataTables;
use DB;

class ReservationsDashboard extends Controller
{
    public function datatables1(Request $request)
    {
        if ($request->ajax())
        {
            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            {
                $data = DB::table('villa_booking')
                ->select('villa_booking.*', 'villa.name as name_villa')
                ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
                ->where('villa_booking.status',0)
                ->get();
            }
            elseif (Auth::user()->role_id == 3)
            {
                $data = DB::table('villa_booking')
                ->select('villa_booking.*', 'villa.name as name_villa')
                ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
                ->where('villa_booking.created_by', Auth::user()->id)
                ->where('villa_booking.status',0)
                ->get();
                // $data = [];
            }

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('total_price', function($data){
                $no = "";
                // $no .= "<center>";
                $no .= "IDR ". number_format($data->total_price, 2);
                // $no .= "</center";

                return $no;
            })
            ->addColumn('no_inv', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->no_invoice;
                $no .= "</center";

                return $no;
            })
            ->addColumn('name_villa', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->name_villa;
                $no .= "</center";

                return $no;
            })
            ->addColumn('status', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->status == 0)
                    $co .= "<span class='text-white badge' style='background: #890F0D; padding: 8px;'>Not Complete</span>";
                elseif ($data->status == 1) {
                    $co .= "<span class='text-white badge' style='background: #125B50; padding: 8px;'>Complete</span>";
                }
                $co .= "</center";

                return $co;
            })
            ->addColumn('in_out', function ($data) {
                $co2 = "";
                $co2 .= "<center>";
                $co2 .= Carbon::parse($data->check_in)->format('d F Y') . " - " . Carbon::parse($data->check_out)->format('d F Y');
                $co2 .= "</center";

                return $co2;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Update Status</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('villa_booking_status_canceled', $data->id_booking) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Canceled
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('villa_booking_status_complete', $data->id_booking) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Completed
                                </div>
                            </a>
                        </div>
                    </li>";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'no_inv', 'name_villa', 'status', 'in_out'])->make(true);
        }
    }

    public function datatables2(Request $request)
    {
        if ($request->ajax())
        {
            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            {
                $data = DB::table('villa_booking')
                ->select('villa_booking.*', 'villa.name as name_villa')
                ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
                //today or tomorrow
                ->where('villa_booking.check_in','=', Carbon::now()->format('Y-m-d'))
                ->orWhere('villa_booking.check_in','=', Carbon::tomorrow()->format('Y-m-d'))
                ->where('villa_booking.status',0)
                ->get();
            }
            elseif (Auth::user()->role_id == 3)
            {
                $data = DB::table('villa_booking')
                ->select('villa_booking.*', 'villa.name as name_villa')
                ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
                // ->where('created_by', Auth::user()->id)
                ->where('villa_booking.status',0)
                ->where('villa_booking.check_in','=', Carbon::now()->format('Y-m-d'))
                ->orWhere('villa_booking.check_in','=', Carbon::tomorrow()->format('Y-m-d'))
                ->where('villa_booking.created_by', Auth::user()->id)
                ->get();
            }

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('total_price', function($data){
                $no = "";
                // $no .= "<center>";
                $no .= "IDR ". number_format($data->total_price, 2);
                // $no .= "</center";

                return $no;
            })
            ->addColumn('no_inv', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->no_invoice;
                $no .= "</center";

                return $no;
            })
            ->addColumn('name_villa', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->name_villa;
                $no .= "</center";

                return $no;
            })
            ->addColumn('status', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->status == 0)
                    $co .= "<span class='text-white badge' style='background: #890F0D; padding: 8px;'>Not Complete</span>";
                elseif ($data->status == 1) {
                    $co .= "<span class='text-white badge' style='background: #125B50; padding: 8px;'>Complete</span>";
                }
                $co .= "</center";

                return $co;
            })
            ->addColumn('in_out', function ($data) {
                $co2 = "";
                $co2 .= "<center>";
                $co2 .= Carbon::parse($data->check_in)->format('d F Y') . " - " . Carbon::parse($data->check_out)->format('d F Y');
                $co2 .= "</center";

                return $co2;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Update Status</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('villa_booking_status_canceled', $data->id_booking) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Canceled
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('villa_booking_status_complete', $data->id_booking) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Completed
                                </div>
                            </a>
                        </div>
                    </li>";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'no_inv', 'name_villa', 'status', 'in_out'])->make(true);
        }
    }

    public function datatables3(Request $request)
    {
        if ($request->ajax())
        {
            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            {
                $data = DB::table('villa_booking')
                ->select('villa_booking.*', 'villa.name as name_villa')
                ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
                //after tomorrow or upcoming
                ->where('villa_booking.check_out','=', Carbon::now()->format('Y-m-d'))
                ->orWhere('villa_booking.check_out','=', Carbon::tomorrow()->format('Y-m-d'))
                ->where('villa_booking.status',0)
                ->get();
            }
            elseif (Auth::user()->role_id == 3)
            {
                $data = DB::table('villa_booking')
                ->select('villa_booking.*', 'villa.name as name_villa')
                ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
                // ->where('created_by', Auth::user()->id)
                ->where('villa_booking.status',0)
                ->where('villa_booking.check_out','=', Carbon::now()->format('Y-m-d'))
                ->orWhere('villa_booking.check_out','=', Carbon::tomorrow()->format('Y-m-d'))
                ->where('villa_booking.created_by', Auth::user()->id)
                ->get();
            }

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('total_price', function($data){
                $no = "";
                // $no .= "<center>";
                $no .= "IDR ". number_format($data->total_price, 2);
                // $no .= "</center";

                return $no;
            })
            ->addColumn('no_inv', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->no_invoice;
                $no .= "</center";

                return $no;
            })
            ->addColumn('name_villa', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->name_villa;
                $no .= "</center";

                return $no;
            })
            ->addColumn('status', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->status == 0)
                    $co .= "<span class='text-white badge' style='background: #890F0D; padding: 8px;'>Not Complete</span>";
                elseif ($data->status == 1) {
                    $co .= "<span class='text-white badge' style='background: #125B50; padding: 8px;'>Complete</span>";
                }
                $co .= "</center";

                return $co;
            })
            ->addColumn('in_out', function ($data) {
                $co2 = "";
                $co2 .= "<center>";
                $co2 .= Carbon::parse($data->check_in)->format('d F Y') . " - " . Carbon::parse($data->check_out)->format('d F Y');
                $co2 .= "</center";

                return $co2;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Update Status</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('villa_booking_status_canceled', $data->id_booking) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Canceled
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('villa_booking_status_complete', $data->id_booking) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Completed
                                </div>
                            </a>
                        </div>
                    </li>";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'no_inv', 'name_villa', 'status', 'in_out'])->make(true);
        }
    }

    public function datatables4(Request $request)
    {
        if ($request->ajax())
        {
            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            {
                $data = DB::table('villa_booking')
                ->select('villa_booking.*', 'villa.name as name_villa')
                ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
                //after tomorrow or upcoming
                ->where('villa_booking.check_in','>', Carbon::tomorrow()->format('Y-m-d'))
                ->where('villa_booking.status',0)
                ->get();
            }
            elseif (Auth::user()->role_id == 3)
            {
                $data = DB::table('villa_booking')
                ->select('villa_booking.*', 'villa.name as name_villa')
                ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
                ->where('villa_booking.created_by', Auth::user()->id)
                ->where('villa_booking.status',0)
                ->where('villa_booking.check_in','>', Carbon::tomorrow()->format('Y-m-d'))
                ->get();
            }

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('total_price', function($data){
                $no = "";
                // $no .= "<center>";
                $no .= "IDR ". number_format($data->total_price, 2);
                // $no .= "</center";

                return $no;
            })
            ->addColumn('no_inv', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->no_invoice;
                $no .= "</center";

                return $no;
            })
            ->addColumn('name_villa', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->name_villa;
                $no .= "</center";

                return $no;
            })
            ->addColumn('status', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->status == 0)
                    $co .= "<span class='text-white badge' style='background: #890F0D; padding: 8px;'>Not Complete</span>";
                elseif ($data->status == 1) {
                    $co .= "<span class='text-white badge' style='background: #125B50; padding: 8px;'>Complete</span>";
                }
                $co .= "</center";

                return $co;
            })
            ->addColumn('in_out', function ($data) {
                $co2 = "";
                $co2 .= "<center>";
                $co2 .= Carbon::parse($data->check_in)->format('d F Y') . " - " . Carbon::parse($data->check_out)->format('d F Y');
                $co2 .= "</center";

                return $co2;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Update Status</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('villa_booking_status_canceled', $data->id_booking) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Canceled
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('villa_booking_status_complete', $data->id_booking) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Completed
                                </div>
                            </a>
                        </div>
                    </li>";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'no_inv', 'name_villa', 'status', 'in_out'])->make(true);
        }
    }

    public function updateStatusComplete($id)
    {
        $find = VillaBooking::where('id_booking', $id)->first();

        $find->update(array(
            'status' =>  1,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->back()->with('success', 'Your data has been update');
    }

    public function updateStatusCanceled($id)
    {
        $find = VillaBooking::where('id_booking', $id)->first();

        $find->update(array(
            'status' =>  2,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->back()->with('success', 'Your data has been update');
    }
}
