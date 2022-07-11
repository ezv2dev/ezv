<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DataTables;

class RestaurantFacilities extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'restaurant_facilities';
    protected $primaryKey = 'id_facilities';

    //DATA TABLE USER
    public function scopeDatatables()
    {
        $data = self::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('createdby', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $user = User::select('first_name')->where('id', $data->created_by)->get();
                $aksi .= $user[0]->first_name;
                $aksi .= "</center>";
                return $aksi;
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
                //             <a class='dropdown-item' href='/admin/restaurant/facilities/show/" . $data->id_facilities . "'>Edit</a>
                //             <a class='dropdown-item' href='/admin/restaurant/facilities/delete/" . $data->id_facilities . "'>Delete</a>
                //         </div>
                //     </div>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('admin_restaurant_facilities_show', $data->id_facilities) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_restaurant_facilities_delete', $data->id_facilities) . "'>
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
            ->rawColumns(['aksi', 'createdby'])->make(true);
    }

    // relationship
    public function restaurant()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_has_facilities', 'id_facilities', 'id_restaurant', 'id_facilities', 'id_restaurant')->withPivot('created_by', 'updated_by')->withTimestamps();
    }
}
