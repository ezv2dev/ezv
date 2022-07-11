<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;

class StaffRewardBalance extends Model
{
    protected $fillable = [
        'no_invoice',
        'balance',
        'commission',
        'created_at',
        'updated_at'
    ];

    protected $table = 'staff_reward_balance';
    protected $primaryKey = 'id_staff_reward_balance';

    // * Datatable
    public function scopeDatatables()
    {
        $data = DB::table('staff_reward_balance')->select('*')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('no_invoice', function ($data) {
                $no_invoice = "";
                $no_invoice .= "<center>";
                if ($data->no_invoice != null) {
                    $no_invoice .= $data->no_invoice;
                }
                $no_invoice .= "</center>";

                return $no_invoice;
            })

            ->addColumn('commission', function ($data) {
                $commission = "";
                $commission .= "<center>";
                if ($data->commission != null) {
                    $commission .= $data->commission;
                }
                $commission .= "</center>";

                return $commission;
            })

            ->addColumn('balance', function ($data) {
                $balance = "";
                $balance .= "<center>";
                if ($data->balance != null) {
                    $balance .= $data->balance;
                }
                $balance .= "</center>";

                return $balance;
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

                                <a class='dropdown-item py-3' href=''>
                                    <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                    <div>
                                        <div class='small text-gray-500'>Show</div>
                                        Show data user reward balance
                                    </div>
                                </a>
                            </div>
                        </li>
                    ";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'no_invoice', 'commission', 'balance', 'created_at', 'updated_at'])->make(true);
    }
}
