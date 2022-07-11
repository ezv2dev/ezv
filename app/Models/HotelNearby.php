<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DataTables;

class HotelNearby extends Model
{
    protected $fillable = [
        'name', 'description', 'distance', 'id_hotel', 'image', 'latitude', 'longitude'
    ];

    protected $table = 'hotel_nearby';
    protected $primaryKey = 'id_nearby';

    public function scopeTes($query, $id)
    {
        return $query->select('hotel_nearby.*', 'hotel.name as name_hotel')->where('hotel_nearby.id_hotel', $id)->join('hotel', 'hotel_nearby.id_hotel', '=', 'hotel.id_hotel', 'left')->get();
    }

    //DATA TABLE USER
    public function scopeDatatables($query, $id)
    {
        $data = $query->select('hotel_nearby.*', 'hotel.name as name_hotel')->where('hotel_nearby.id_hotel', $id)->join('hotel', 'hotel_nearby.id_hotel', '=', 'hotel.id_hotel', 'left')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('distance', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->distance . " m";
                $no .= "</center";

                return $no;
            })
            ->addColumn('foto', function ($data) {
                $co = "";
                $co .= "<center>";
                $co .= "<div class='row items-push js-gallery img-fluid-100'>";
                $co .= "<div class='animated fadeIn'>";
                $co .= "<a class='img-link img-link-zoom-in img-thumb img-lightbox' href='";
                $co .= "/foto/gallery/" . strtolower($data->name_hotel) . "/" . "near_by/" . $data->image;
                $co .= "'" . "target='_blank'>";
                $co .= "<img class='img-fluid' src='";
                $co .= "/foto/gallery/" . strtolower($data->name_hotel) . "/" . "near_by/" . $data->image;
                $co .= "' alt=''>";
                $co .= "</a>";
                $co .= "</div>";
                $co .= "</div>";
                $co .= "</center";

                return $co;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "<a type='button' class='btn btn-sm btn-danger' href='/admin/hotel/delete_nearby/" . $data->id_nearby . "'>
                            Delete
                        </a>";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'foto', 'distance'])->make(true);
    }
}
