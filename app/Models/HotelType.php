<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;

class HotelType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    protected $primaryKey = 'id_hotel_type';
    protected $table = 'hotel_type';

    //DATA TABLE USER
    public function scopeDatatables()
    {
        $data = DB::table('hotel_type')->select('*')->get();
        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                    <div class='dropdown'>
                    <button type='button' class='btn btn-primary dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Action
                </button>
                <div class='dropdown-menu dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                            <a class='dropdown-item' href='/admin/hoteltype/show/" . $data->id_hotel_type . "'>Edit</a>
                            <a class='dropdown-item' href='/admin/hoteltype/delete/" . $data->id_hotel_type . "'>Delete</a>
                        </div>
                    </div>";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi'])->make(true);
    }
}
