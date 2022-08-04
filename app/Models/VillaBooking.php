<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VillaBooking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_payment',
        'no_invoice',
        'id_user',
        'firstname',
        'lastname',
        'email',
        'phone',
        'id_villa',
        'adult',
        'child',
        'id_extra_price',
        'number_extra',
        'check_in',
        'check_out',
        'villa_price',
        'total_price',
        'service_price',
        'cleaning_fee_price',
        'discount_price',
        'total_all_price',
        'extra_price',
        'total_price',
        'status'
    ];

    protected $table = 'villa_booking';
    protected $primaryKey = 'id_booking';

    protected $dates = ['check_in', 'check_out'];

    // * Relationship
    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }

    //DATA TABLE USER
    public function scopeDatatables()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $data = DB::table('villa_booking')->select('villa_booking.*', 'villa.name as name_villa')->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')->get();
        } elseif (Auth::user()->role_id == 3) {
            $data = DB::table('villa_booking')->select('villa_booking.*', 'villa.name as name_villa')->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')->where('villa_booking.created_by', Auth::user()->id)->get();
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('total_price', function ($data) {
                $no = "";
                // $no .= "<center>";
                $no .= "IDR " . number_format($data->total_price, 2);
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
                } elseif ($data->status == 2) {
                    $co .= "<span class='text-white badge' style='background: #F0A500; padding: 8px;'>Cancel</span>";
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
                            <a class='dropdown-item py-3' href='' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href=''>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href=''>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Active
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
