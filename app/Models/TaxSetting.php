<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DataTables;
use Illuminate\Support\Facades\DB;

class TaxSetting extends Model
{
    protected $fillable = [
        'total_tax', 'created_at', 'updated_at'
    ];

    protected $table = 'tax';
    protected $primaryKey = 'id_tax';

    // ! Datatable Tax Setting
    public function scopeDatatables()
    {
        $data = DB::table('tax')->select('*')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('total_tax', function ($data) {
                $total_tax = "";
                $total_tax .= "<center>";
                if ($data->total_tax != null) {
                    $total_tax .= $data->total_tax;
                }
                $total_tax .= " %";
                $total_tax .= "</center>";

                return $total_tax;
            })

            ->addColumn('created_at', function ($data) {
                $created_at = "";
                $created_at .= "<center>";
                if ($data->created_at != null) {
                    $created_at .= $data->created_at;
                }
                $created_at .= "</center>";

                return $created_at;
            })

            ->addColumn('updated_at', function ($data) {
                $updated_at = "";
                $updated_at .= "<center>";
                if ($data->updated_at != null) {
                    $updated_at .= $data->updated_at;
                }
                $updated_at .= "</center>";

                return $updated_at;
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
                                <a class='dropdown-item py-3' href='" . route('admin_tax_setting_show', $data->id_tax) . "' target='_blank'>
                                    <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                    <div>
                                        <div class='small text-gray-500'>View</div>
                                        Edit data tax setting
                                    </div>
                                </a>
                                <a class='dropdown-item py-3' href='" . route('admin_tax_setting_delete', $data->id_tax) . "'>
                                    <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                    <div>
                                        <div class='small text-gray-500'>Delete</div>
                                        Delete data tax setting
                                    </div>
                                </a>
                            </div>
                        </li>
                    ";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'total_tax', 'created_at', 'updated_at'])->make(true);
    }
}
