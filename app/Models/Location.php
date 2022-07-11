<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\Restaurant;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'latitude', 'longitude', 'image', 'created_by', 'updated_by'
    ];

    protected $table = 'location';
    protected $primaryKey = 'id_location';

    //DATA TABLE USER
    public function scopeDatatables()
    {
        $data = DB::table('location')->select('*')->get();
        // $data = [];
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('coordinate', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->latitude == null || $data->longitude == null) {
                    $co .= "-";
                } else {
                    $co .= $data->latitude . "," . $data->longitude;
                }
                $co .= "</center";

                return $co;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('admin_location_show', $data->id_location) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_location_delete', $data->id_location) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                            {{-- <div class='dropdown-divider m-0'></div> --}}
                        </div>
                    </li>
                ";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'coordinate'])->make(true);
    }

    // relationship
    public function restaurant()
    {
        return $this->hasMany(Restaurant::class, 'id_location', 'id_location');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'id_district');
    }
}
