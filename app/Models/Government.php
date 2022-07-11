<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Country;
use DataTables;
use Illuminate\Support\Facades\Auth;

class Government extends Model
{
    protected $table = 'government';

    protected $primaryKey = 'id_government';

    protected $fillable = [
        'no_id',
        'front_picture',
        'back_picture',
        'type',
        'user_id',
        'id_countries',
        'approved_status',
        'approved_by'
    ];

    public function scopeDatatables()
    {
        $data = self::where('approved_status',0)
        ->join('users','users.id','=','government.user_id')
        ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function ($data) {
                $name = $data->first_name. ' ' . $data->last_name;
                return $name;
            })
            ->addColumn('type', function ($data) {
                if ($data->type == "driver_license")
                {
                    $type = "Driver License";
                }
                else if ($data->type == "identity_card")
                {
                    $type = "Identity Card";
                }
                else
                {
                    $type = "Passport";
                }
                return $type;
            })
            ->addColumn('front_picture', function ($data) {
                $url = asset('government/' . $data->front_picture);
                return '<img src="' . $url . '" border="0" width="100" class="img-rounded" align="center" />';
            })
            ->addColumn('back_picture', function ($data) {
                if (!isset($data->back_picture))
                {
                    return "";
                }
                $url = asset('government/' . $data->back_picture);
                return '<img src="' . $url . '" border="0" width="100" class="img-rounded" align="center" />';
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Update Status</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='#' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='". route('government_approve',$data->id_government) ."'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Approve
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='#'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                        </div>
                    </li>";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi','front_picture', 'back_picture', 'name','type'])->make(true);
    }

    public function scopeDatatablesApproval()
    {
        $data = self::where('approved_status',1)
        ->join('users','users.id','=','government.user_id')
        ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function ($data) {
                $name = $data->first_name. ' ' . $data->last_name;
                return $name;
            })
            ->addColumn('type', function ($data) {
                if ($data->type == "driver_license")
                {
                    $type = "Driver License";
                }
                else if ($data->type == "identity_card")
                {
                    $type = "Identity Card";
                }
                else
                {
                    $type = "Passport";
                }
                return $type;
            })
            ->addColumn('front_picture', function ($data) {
                $url = asset('government/' . $data->front_picture);
                return '<img src="' . $url . '" border="0" width="100" class="img-rounded" align="center" />';
            })
            ->addColumn('back_picture', function ($data) {
                if (!isset($data->back_picture))
                {
                    return "";
                }
                $url = asset('government/' . $data->back_picture);
                return '<img src="' . $url . '" border="0" width="100" class="img-rounded" align="center" />';
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Update Status</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='#'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                        </div>
                    </li>";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi','front_picture', 'back_picture', 'name','type'])->make(true);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function government()
    {
        return $this->belongsTo(Country::class, 'id_countries', 'id_countries');
    }
}
