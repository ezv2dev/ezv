<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;

class RewardProgram extends Model
{
    protected $fillable = [
        'name', 'value', 'created_at', 'updated_at'
    ];

    protected $table = 'reward_category';
    protected $primaryKey = 'id_reward_category';


    //DATA TABLE Reward
    public function scopeDatatables()
    {
        $data = DB::table('reward_category')->select('*')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function ($data) {
                $name = "";
                $name .= "<center>";
                if ($data->name != null) {
                    $name .= $data->name;
                }
                $name .= "</center>";

                return $name;
            })

            ->addColumn('value', function ($data) {
                $value = "";
                $value .= "<center>";
                if ($data->value != null) {
                    $value .= $data->value;
                }
                $value .= "%";
                $value .= "</center>";

                return $value;
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
                                <a class='dropdown-item py-3' href='" . route('admin_reward_category_show', $data->id_reward_category) . "' target='_blank'>
                                    <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                    <div>
                                        <div class='small text-gray-500'>View</div>
                                        Edit data reward category
                                    </div>
                                </a>
                                <a class='dropdown-item py-3' href='" . route('admin_reward_category_delete', $data->id_reward_category) . "'>
                                    <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                    <div>
                                        <div class='small text-gray-500'>Delete</div>
                                        Delete data reward category
                                    </div>
                                </a>
                            </div>
                        </li>
                    ";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'name', 'value', 'created_at', 'updated_at'])->make(true);
    }
}
