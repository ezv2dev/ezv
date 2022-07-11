<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;

class Amenities extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icon', 'name',
    ];

    protected $table = 'amenities';
    protected $primaryKey = 'id_amenities';


    //DATA TABLE USER
    public function scopeDatatables()
    {
        $data = DB::table('amenities')->select('*')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('icon', function ($data) {
                $no = "";
                $no .= "<center>";
                if ($data->icon != null) {
                    $no .= "<i class='fa fa-2x fa-" . $data->icon . "'></i>";
                } else {
                    $no .= "<i class='fa fa-2x fa-question-circle'></i>";
                }
                $no .= "</center";

                return $no;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                // $aksi .= "
                //     <div class='dropdown'>
                //         <button type='button' class='button-admin btn dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //         Action
                //         </button>
                //         <div class='dropdown-menu admin-action-dropdown dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                //             <a class='dropdown-item' href='/admin/amenities/show/" . $data->id_amenities . "'>Edit</a>
                //             <a class='dropdown-item' href='/admin/amenities/delete/" . $data->id_amenities . "'>Delete</a>
                //         </div>
                //     </div>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('admin_amenities_show', $data->id_amenities) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_amenities_delete', $data->id_amenities) . "'>
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
            ->rawColumns(['aksi', 'icon'])->make(true);
    }

    public function typeAmenities()
    {
        return $this->belongsToMany(HotelTypeDetail::class, 'hotel_type_detail_amenities', 'id_amenities', 'id_hotel_type_detail', 'id_amenities', 'id_hotel_type_detail');
    }
}
