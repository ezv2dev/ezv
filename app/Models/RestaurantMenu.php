<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;

class RestaurantMenu extends Model
{
    protected $fillable = [
        'id_restaurant', 'name', 'description', 'price', 'foto', 'created_by', 'updated_by'
    ];

    protected $table = 'restaurant_menu';
    protected $primaryKey = 'id_menu';

    public function scopeTes($query, $id)
    {
        return $query->select('restaurant_menu.*', 'restaurant.name as name_restaurant')->where('restaurant_menu.id_restaurant', $id)->join('restaurant', 'restaurant_menu.id_restaurant', '=', 'restaurant.id_restaurant', 'left')->get();
    }

    //DATA TABLE USER
    public function scopeDatatables($query, $id)
    {
        $data = $query->select('restaurant_menu.*', 'restaurant.name as name_restaurant')->where('restaurant_menu.id_restaurant', $id)->join('restaurant', 'restaurant_menu.id_restaurant', '=', 'restaurant.id_restaurant', 'left')->get();
        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('foto', function ($data){
                $co = "";
                $co .="<center>";
                $co .="<div class='row items-push js-gallery img-fluid-100'>";
                $co .="<div class='animated fadeIn'>";
                $co .="<a class='img-link img-link-zoom-in img-thumb img-lightbox' href='";
                $co .="/foto/restaurant/".strtolower($data->name_restaurant)."/"."menu/".$data->foto;
                $co .= "'"."target='_blank'>";
                $co .="<img class='img-fluid' src='";
                $co .="/foto/restaurant/".strtolower($data->name_restaurant)."/"."menu/".$data->foto;
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
                $aksi .="<a type='button' class='btn btn-sm btn-danger' href='/admin/restaurant/delete_menu/".$data->id_menu."'>
                            Delete
                        </a>";
                $aksi .="</center>";
                return $aksi;
                })
            ->rawColumns(['aksi', 'foto'])->make(true);
    }
}
