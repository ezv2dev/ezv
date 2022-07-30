<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\Activity;

class ActivityPrice extends Model
{
    protected $fillable = [
        'id_activity', 'name', 'short_description', 'description', 'adult', 'children', 'price', 'foto', 'start_date', 'end_date', 'created_by', 'updated_by'
    ];

    protected $table = 'activity_price';
    protected $primaryKey = 'id_price';

    public function scopeTes($query, $id)
    {
        return $query->select('activity_price.*', 'activity.name as name_activity')->where('activity_price.id_activity', $id)->join('activity', 'activity_price.id_activity', '=', 'activity.id_activity', 'left')->get();
    }

    //DATA TABLE USER
    public function scopeDatatables($query, $id)
    {
        $data = $query->select('activity_price.*', 'activity.name as name_activity')->where('activity_price.id_activity', $id)->join('activity', 'activity_price.id_activity', '=', 'activity.id_activity', 'left')->get();
        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('foto', function ($data) {
                $co = "";
                $co .= "<center>";
                $co .= "<div class='row items-push js-gallery img-fluid-100'>";
                $co .= "<div class='animated fadeIn'>";
                $co .= "<a class='img-link img-link-zoom-in img-thumb img-lightbox' href='";
                $co .= "/foto/activity/" . strtolower($data->name_activity) . "/" . "price/" . $data->foto;
                $co .= "'" . "target='_blank'>";
                $co .= "<img class='img-fluid' src='";
                $co .= "/foto/activity/" . strtolower($data->name_activity) . "/" . "price/" . $data->foto;
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
                $aksi .= "<a type='button' class='btn btn-sm btn-danger' href='/admin/activity/delete_price/" . $data->id_price . "'>
                            Delete
                        </a>";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'foto'])->make(true);
    }

    // relationship
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'id_activity', 'id_activity');
    }

    public function photo()
    {
        return $this->hasMany(ActivityPricePhoto::class, 'id_price', 'id_price');
    }
}
