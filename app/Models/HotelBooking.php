<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HotelBooking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'id_hotel', 'adult', 'child', 'id_extra_price', 'number_extra', 'check_in', 'check_out', 'hotel_price', 'extra price', 'total_price', 'method', 'status'
    ];

    protected $table = 'hotel_booking';
    protected $primaryKey = 'id_booking';

    //DATA TABLE USER
    public function scopeDatatables()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $data = DB::table('hotel_booking')->select('hotel_booking.*', 'hotel.name as name_hotel')->join('hotel', 'hotel_booking.id_hotel', '=', 'hotel.id_hotel', 'left')->get();
        } elseif (Auth::user()->role_id == 3) {
            $data = DB::table('hotel_booking')->select('hotel_booking.*', 'hotel.name as name_hotel')->join('hotel', 'hotel_booking.id_hotel', '=', 'hotel.id_hotel', 'left')->where('created_by', Auth::user()->id)->get();
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('no_inv', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->no_invoice;
                $no .= "</center";

                return $no;
            })
            ->addColumn('name_hotel', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->name_hotel;
                $no .= "</center";

                return $no;
            })
            ->addColumn('status', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->status == 0)
                    $co .= "<span class='badge bg-danger'>Not Complete</span>";
                elseif ($data->status == 1) {
                    $co .= "<span class='badge bg-success'>Complete</span>";
                }
                $co .= "</center";

                return $co;
            })
            ->addColumn('in_out', function ($data) {
                $co2 = "";
                $co2 .= "<center>";
                $co2 .= $data->check_in . " - " . $data->check_out;
                $co2 .= "</center";

                return $co2;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                if ($data->status == 0) {
                    $aksi .= "
                    <div class='dropdown'>
                    <button type='button' class='btn btn-primary dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Action
                </button>
                <div class='dropdown-menu dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                            <form id='update' action='/admin/hotel/booking/update/" . $data->id_booking . "' method='POST'>
                                <button class='dropdown-item' type='submit' >Complete</button>
                            </form>
                            <a class='dropdown-item' href='/admin/hotel/booking/delete/" . $data->id_booking . "'>Delete</a>
                        </div>
                    </div>";
                }
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'no_inv', 'name_hotel', 'status', 'in_out'])->make(true);
    }
}
