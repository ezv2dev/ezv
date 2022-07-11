<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;

class VillaNearby extends Model
{
    protected $fillable = [
        'name', 'description', 'distance', 'id_villa', 'image', 'latitude', 'longitude'
    ];

    protected $table = 'villa_nearby';
    protected $primaryKey = 'id_nearby';

    public function scopeTes($query, $id)
    {
        return $query->select('villa_nearby.*', 'villa.name as name_villa')->where('villa_nearby.id_villa', $id)->join('villa', 'villa_nearby.id_villa', '=', 'villa.id_villa', 'left')->get();
    }

    //DATA TABLE USER
    public function scopeDatatables($query, $id)
    {
        $data = $query->select('villa_nearby.*', 'villa.name as name_villa')->where('villa_nearby.id_villa', $id)->join('villa', 'villa_nearby.id_villa', '=', 'villa.id_villa', 'left')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('distance', function ($data){
                $no = "";
                $no .="<center>";
                $no .= $data->distance." m";
                $no .="</center";

                return $no;
            })
            ->addColumn('foto', function ($data){
                $co = "";
                $co .="<center>";
                $co .="<div class='row items-push js-gallery img-fluid-100'>";
                $co .="<div class='animated fadeIn'>";
                $co .="<a class='img-link img-link-zoom-in img-thumb img-lightbox' href='";
                $co .="/foto/gallery/".strtolower($data->name_villa)."/"."near_by/".$data->image;
                $co .= "'"."target='_blank'>";
                $co .="<img class='img-fluid' src='";
                $co .="/foto/gallery/".strtolower($data->name_villa)."/"."near_by/".$data->image;
                $co .="' alt=''>";
                $co .="</a>";
                $co .="</div>";
                $co .="</div>";
                $co .="</center";

                return $co;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .="<center>";
                $aksi .="<a type='button' class='btn btn-sm btn-danger' href='/admin/villa/delete_nearby/".$data->id_nearby."'>
                            Delete
                        </a>";
                $aksi .="</center>";
                return $aksi;
                })
            ->rawColumns(['aksi', 'foto', 'distance'])->make(true);
    }
}
