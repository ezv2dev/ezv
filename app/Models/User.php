<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'google_id', 'facebook_id',
        'email_google', 'email_facebook',
        'email_verified_at', 'first_name',
        'last_name', 'address', 'username', 'phone',
        'email', 'password', 'role_id', 'avatar',
        'user_code', 'gender', 'birthday', 'active', 'foto_profile',
        'id_language', 'id_currency', 'id_timezone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'birthday'
    ];

    // relationship
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function roles()
    {
        return $this->belongsTo(UserHasRoles::class, 'role_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo(HostLanguage::class, 'id_language', 'id_host_language');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'id_currency', 'id_currency');
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class, 'id_timezone', 'id_timezone');
    }

    public function getPartnerResponseRateAttribute()
    {
        if (auth()->check()) {
            if (auth()->user()->role->name == 'partner') {
                $totalMessages = $this->hasMany(VillaContactHost::class, 'id_owner', 'id')->where('approve_by', '!=', null)->where('disapprove_by', '=', null);
                $replyMessages = $this->hasMany(VillaContactHost::class, 'id_owner', 'id')->where('approve_by', '!=', null)->where('disapprove_by', '=', null)
                    ->whereHas('conversationReply', function (Builder $query) {
                        $query->where('approve_by', '!=', null)->where('disapprove_by', '=', null);
                    })->get();
                $responseRate = ($replyMessages->count() * 100) / $totalMessages->count();
                return round($responseRate, 2);
            }
        }

        return false;
    }

    public function hasPermission($permission)
    {
        return $this->role->permissions()->where('name', $permission)->first() ?: false;
    }

    public function scopeDatatablesTrash()
    {
        $data = self::onlyTrashed()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('role', function ($data) {
                $active = "";
                $active .= "<center>";
                if ($data->role_id == 1) {
                    $active .= "Superadmin";
                } else if ($data->role_id == 2) {
                    $active .= "Admin";
                } else if ($data->role_id == 3) {
                    $active .= "Partner";
                } else if ($data->role_id == 4) {
                    $active .= "User";
                }
                $active .= "</center>";
                return $active;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                // $aksi .= "
                //     <div class='dropdown'>
                //     <button type='button' class='btn button-admin  dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //     Action
                // </button>
                // <div class='dropdown-menu dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                //             <a class='dropdown-item admin-action-dropdown' href='/admin/user/show/" . $data->id . "'>Edit</a>
                //             <a class='dropdown-item admin-action-dropdown' href='/admin/user/delete/" . $data->id . "'>Delete</a>
                //             <div class='dropdown-divider'></div>
                //             <a class='dropdown-item admin-action-dropdown' href='javascript:void(0)'>Something else here</a>
                //         </div>
                //     </div>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('admin_user_show', $data->id) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i class='fa-solid fa-pen-to-square'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                ";
                if ($data->is_deleted) {
                    $aksi .= "
                            <a class='dropdown-item py-3' href='" . route('admin_user_restore_delete', $data->id) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i class='fa-solid fa-trash-can-undo'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Activated</div>
                                    Activated this user
                                </div>
                            </a>
                    ";
                } else {
                    $aksi .= "
                            <a class='dropdown-item py-3' href='" . route('admin_user_soft_delete', $data->id) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i class='fa-solid fa-trash-can'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Deactivated</div>
                                    Deactivated this user
                                </div>
                            </a>
                    ";
                }

                $aksi .= "
                            <a class='delete dropdown-item py-3' href='javascript:void(0);' data-id='" . $data->id . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i class='fa-solid fa-trash-can'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Permanently delete the user
                                </div>
                            </a>
                ";
                $aksi .= "
                        </div>
                    </li>
                ";
                $aksi .= "</center>";
                return $aksi;
            })
            ->addColumn('isActive', function ($data) {
                return $data->is_active;
            })
            ->rawColumns(['aksi', 'role'])->make(true);
    }

    //DATA TABLE USER
    public function scopeDatatables()
    {
        $data = self::where('deleted_at', NULL)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('role', function ($data) {
                $active = "";
                $active .= "<center>";
                if ($data->role_id == 1) {
                    $active .= "Superadmin";
                } else if ($data->role_id == 2) {
                    $active .= "Admin";
                } else if ($data->role_id == 3) {
                    $active .= "Partner";
                } else if ($data->role_id == 4) {
                    $active .= "User";
                }
                $active .= "</center>";
                return $active;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                // $aksi .= "
                //     <div class='dropdown'>
                //     <button type='button' class='btn button-admin  dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //     Action
                // </button>
                // <div class='dropdown-menu dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                //             <a class='dropdown-item admin-action-dropdown' href='/admin/user/show/" . $data->id . "'>Edit</a>
                //             <a class='dropdown-item admin-action-dropdown' href='/admin/user/delete/" . $data->id . "'>Delete</a>
                //             <div class='dropdown-divider'></div>
                //             <a class='dropdown-item admin-action-dropdown' href='javascript:void(0)'>Something else here</a>
                //         </div>
                //     </div>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('admin_user_show', $data->id) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i class='fa-solid fa-pen-to-square'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                ";
                $aksi .= "
                            <a class='dropdown-item py-3' href='" . route('admin_user_soft_delete', $data->id) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i class='fa-solid fa-trash-can'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Deactivated</div>
                                    Deactivated this user
                                </div>
                            </a>
                ";
                $aksi .= "
                        </div>
                    </li>
                ";
                $aksi .= "</center>";
                return $aksi;
            })
            ->addColumn('isActive', function ($data) {
                return $data->is_active;
            })
            ->rawColumns(['aksi', 'role'])->make(true);
    }

    public function scopeFind($query, $id)
    {
        $query->where('id', $id);
    }

    // custom attribute
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getisDeletedAttribute()
    {
        if ($this->deleted_at) {
            return true;
        }
        return false;
    }

    public function getisActiveAttribute()
    {
        if ($this->deleted_at) {
            return 'Deactive';
        }
        return 'Active';
    }
}
