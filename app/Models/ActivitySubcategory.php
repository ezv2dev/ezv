<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Models\ActivityCategory;
use App\Models\Activity;

class ActivitySubcategory extends Model
{
    protected $fillable = [
        'id_category',
        'name',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'activity_subcategory';
    protected $primaryKey = 'id_subcategory';

    // relationship
    public function category()
    {
        return $this->belongsTo(ActivityCategory::class, 'id_category', 'id_category');
    }

    public function activity()
    {
        return $this->belongsToMany(Activity::class, 'activity_has_subcategory', 'id_subcategory', 'id_activity', 'id_subcategory', 'id_activity')->withPivot('created_by', 'updated_by')->withTimestamps();
    }

    //DATA TABLE USER
    public function scopeDatatables()
    {
        $data = self::with(['category'])->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('categoryName', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= $data->category->name;
                $aksi .= "</center>";
                return $aksi;
            })
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
                //             <a class='dropdown-item' href='/admin/things-to-do/sub-category/show/" . $data->id_subcategory . "'>Edit</a>
                //             <a class='dropdown-item' href='/admin/things-to-do/sub-category/delete/" . $data->id_subcategory . "'>Delete</a>
                //         </div>
                //     </div>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('admin_activity_subcategory_show', $data->id_subcategory) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_activity_subcategory_delete', $data->id_subcategory) . "'>
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
            ->rawColumns(['aksi', 'createdby', 'categoryName'])->make(true);
    }
}
