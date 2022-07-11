<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DataTables;

class HotelExtraprice extends Model
{
    protected $fillable = [
        'name', 'max_number', 'price', 'type_price', 'id_hotel'
    ];

    protected $table = 'hotel_extra_price';
    protected $primaryKey = 'id_extra_price';

    //DATA TABLE USER
    public function scopeDatatables($query, $id)
    {
        $data = $query->where('id_hotel', $id)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('type', function ($data) {
                $no = "";
                $no .= "<center>";
                if ($data->type_price == 0) {
                    $no .= "Per Night";
                } elseif ($data->type_price == 1) {
                    $no .= "One Time";
                }
                $no .= "</center";

                return $no;
            })

            ->addColumn('price', function ($data) {
                $co = "";
                $co .= "<center>";
                $co .= $data->price;
                $co .= "</center";

                return $co;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "<a type='button' class='btn btn-sm btn-danger' href='/admin/hotel/delete_extraprice/" . $data->id_extra_price . "'>
                        Delete
                    </a>";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'type', 'price'])->make(true);
    }
}
