<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;

class NoBedroom extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_bedroom',
    ];

    protected $table = 'no_bedroom';
    protected $primaryKey = 'id_bedroom';


    //DATA TABLE USER
     public function scopeDatatables()
     {
         $data = DB::table('no_bedroom')->select('*')->get();
         return Datatables::of($data)
             ->addIndexColumn()
             ->addColumn('no_beds', function ($data){
                $no = "";
                $no .="<center>";
                if($data->no_bedroom > 1){
                    $no .= $data->no_bedroom." Bedrooms";
                }else{
                    $no .= $data->no_bedroom." Bedroom";
                }
                $no .="</center";

                return $no;
             })
             ->addColumn('aksi', function ($data) {
                 $aksi = "";
                 $aksi .="<center>";
                //  $aksi .="
                //      <div class='dropdown'>
                //      <button type='button' class='btn admin-adddata-button dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //      Action
                //  </button>
                //  <div class='dropdown-menu admin-action-dropdown dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                //              <a class='dropdown-item' href='/admin/bedroom/show/".$data->id_bedroom."'>Edit</a>
                //              <a class='dropdown-item' href='/admin/bedroom/delete/".$data->id_bedroom."'>Delete</a>
                //          </div>
                //      </div>";
                //  $aksi .="</center>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('admin_no_bedroom_show', $data->id_bedroom) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_no_bedroom_delete', $data->id_bedroom) . "'>
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
                return $aksi;
                })
             ->rawColumns(['aksi', 'no_beds'])->make(true);
     }
}
