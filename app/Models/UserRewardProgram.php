<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;

class UserRewardProgram extends Model
{
    protected $fillable = [
        'id_user', 'reference_code', 'start_program', 'end_program', 'status'
    ];

    protected $table = 'user_reward';
    protected $primaryKey = 'id_user_reward';

    // * Relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // * DATA TABLE USER REWARD
    public function scopeDatatables()
    {
        $data = DB::table('user_reward')->select('*')->join('users', 'user_reward.id_user', '=', 'users.id')->get();
        // dd($data);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('id_user', function ($data) {
                $id_user = "";
                $id_user .= "<center>";
                if ($data->id_user != null) {
                    $id_user .= $data->first_name;
                    $id_user .= " ";
                    $id_user .= $data->last_name;
                }
                $id_user .= "</center>";

                return $id_user;
            })

            ->addColumn('reference_code', function ($data) {
                $reference_code = "";
                $reference_code .= "<center>";

                if ($data->reference_code != null) {
                    $reference_code .= $data->reference_code;
                }

                $reference_code .= "</center>";

                return $reference_code;
            })

            ->addColumn('start_program', function ($data) {
                $start_program = "";
                $start_program .= "<center>";

                if ($data->start_program != null) {
                    $start_program .= $data->start_program;
                }
                $start_program .= "</center>";

                return $start_program;
            })

            ->addColumn('end_program', function ($data) {
                $end_program = "";
                $end_program .= "<center>";

                if ($data->end_program != null) {
                    $end_program .= $data->end_program;
                }
                $end_program .= "</center>";

                return $end_program;
            })

            ->addColumn('status', function ($data) {
                $status = "";
                $status .= "<center>";

                if ($data->status == 0)
                    $status .= "<span class='text-white badge badge-pill bg-danger'>Non Active</span>";
                elseif ($data->status == 1) {
                    $status .= "<span class='text-white badge badge-pill bg-success'>Active</span>";
                }

                $status .= "</center>";

                return $status;
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
                                <a class='dropdown-item py-3' href='" . route('admin_user_reward_update_status', $data->id_user_reward) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                <div class='small text-gray-500'>Update Status</div>
                                Change the status of User
                                </div>
                            </a>
                            </div>
                        </li>
                    ";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'id_user', 'reference_code', 'start_program', 'end_program', 'status'])->make(true);
    }
}
