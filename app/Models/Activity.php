<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivitySave;
use App\Models\ActivityPrice;
use App\Models\ActivityPhoto;
use App\Models\ActivityVideo;
use App\Models\ActivityStory;
use App\Models\ActivityFacilities;
use App\Models\ActivityDetailReview;
use App\Models\ActivityReview;
use App\Models\Location;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\DestinationNearbyActivityService as DestinationNearbyActivity;

class Activity extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'grade',
        'name',
        'short_description',
        'description',
        'as_feature',
        'adult',
        'children',
        'booking',
        'id_location',
        'address',
        'latitude',
        'longitude',
        'open_time',
        'closed_time',
        'phone',
        'email',
        'price',
        'discount',
        'cancel',
        'status',
        'step',
        'image'
    ];

    protected $table = 'activity';
    protected $primaryKey = 'id_activity';

    //DATA TABLE USER
    public function scopeDatatables()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $data = DB::table('activity')->where('deleted_at', NULL)->select('*')->latest()->get();
        } elseif (Auth::user()->role_id == 3) {
            $data = DB::table('activity')->where('deleted_at', NULL)->select('*')->where('created_by', Auth::user()->id)->latest()->get();
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->status == 0)
                    $co .= "<span class='text-white badge badge-pill bg-danger'>Non Active</span>";
                elseif ($data->status == 1) {
                    $co .= "<span class='text-white badge badge-pill bg-success'>Active</span>";
                }
                $co .= "</center";

                return $co;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                // $aksi .= "
                //      <div class='dropdown'>
                //      <button type='button' class='btn button-admin dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //      Action
                //  </button>
                //  <div class='dropdown-menu admin-action-dropdown dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                //              <a class='dropdown-item' href='/admin/activity/show/" . $data->id_activity . "'>Edit</a>
                //              <a class='dropdown-item' href='/admin/activity/delete/" . $data->id_activity . "'>Delete</a>
                //              <div class='dropdown-divider'></div>
                //              <a class='dropdown-item' href='/review/create/" . $data->id_activity . "'>Review</a>
                //              <a class='dropdown-item' href='/admin/activity/index_price/" . $data->id_activity . "'>Price</a>
                //              <a class='dropdown-item' href='/admin/activity/create_gallery/" . $data->id_activity . "'>Gallery</a>
                //          </div>
                //      </div>";
                if ($data->status == 0) {
                    $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('activity', $data->id_activity) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3 delete' href='javascript:void(0);' data-id='" . $data->id_activity . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_activity_restore_delete', $data->id_activity) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Active
                                </div>
                            </a>
                        </div>
                    </li>";
                } else {
                    $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('activity', $data->id_activity) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>

                            <a class='dropdown-item py-3' href='" . route('admin_activity_soft_delete', $data->id_activity) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Deactive
                                </div>
                            </a>

                        </div>
                    </li>";
                }
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'status'])->make(true);
    }

    public function scopeDatatablesTrash()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $data = self::onlyTrashed()->latest()->get();
        } elseif (Auth::user()->role_id == 3) {
            $data = self::onlyTrashed()->where('created_by', Auth::user()->id)->latest()->get();
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->status == 0)
                    $co .= "<span class='text-white badge badge-pill bg-danger'>Non Active</span>";
                elseif ($data->status == 1) {
                    $co .= "<span class='text-white badge badge-pill bg-success'>Active</span>";
                }
                $co .= "</center";

                return $co;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                // $aksi .= "
                //      <div class='dropdown'>
                //      <button type='button' class='btn button-admin dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //      Action
                //  </button>
                //  <div class='dropdown-menu admin-action-dropdown dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                //              <a class='dropdown-item' href='/admin/activity/show/" . $data->id_activity . "'>Edit</a>
                //              <a class='dropdown-item' href='/admin/activity/delete/" . $data->id_activity . "'>Delete</a>
                //              <div class='dropdown-divider'></div>
                //              <a class='dropdown-item' href='/review/create/" . $data->id_activity . "'>Review</a>
                //              <a class='dropdown-item' href='/admin/activity/index_price/" . $data->id_activity . "'>Price</a>
                //              <a class='dropdown-item' href='/admin/activity/create_gallery/" . $data->id_activity . "'>Gallery</a>
                //          </div>
                //      </div>";
                if ($data->status == 0) {
                    $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('activity', $data->id_activity) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3 delete' href='javascript:void(0);' data-id='" . $data->id_activity . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_activity_restore_delete', $data->id_activity) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Active
                                </div>
                            </a>
                        </div>
                    </li>";
                } else {
                    $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('activity', $data->id_activity) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3 delete' href='javascript:void(0);' data-id='" . $data->id_activity . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>

                            <a class='dropdown-item py-3' href='" . route('admin_activity_update_status', $data->id_activity) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Deactive
                                </div>
                            </a>

                        </div>
                    </li>";
                }
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'status'])->make(true);
    }

    // * Relationship
    public function guestSafety()
    {
        return $this->belongsToMany(GuestSafety::class, 'activity_has_guest_safety', 'id_activity', 'id_guest_safety', 'id_activity', 'id_guest_safety');
    }

    public function PricePhoto()
    {
        return $this->hasManyThrough(
            ActivityPricePhoto::class,
            ActivityPrice::class,
            'id_activity',
            'id_price',
        );
    }

    public function favorit()
    {
        return $this->hasMany(ActivitySave::class, 'id_activity', 'id_activity');
    }

    public function price()
    {
        return $this->hasMany(ActivityPrice::class, 'id_activity', 'id_activity');
    }

    public function photo()
    {
        return $this->hasMany(ActivityPhoto::class, 'id_activity', 'id_activity');
    }

    public function video()
    {
        return $this->hasMany(ActivityVideo::class, 'id_activity', 'id_activity');
    }

    public function story()
    {
        return $this->hasMany(ActivityStory::class, 'id_activity', 'id_activity');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location', 'id_location');
    }

    public function detailReview()
    {
        return $this->hasOne(ActivityDetailReview::class, 'id_activity', 'id_activity');
    }

    public function detailComment()
    {
        return $this->hasMany(ActivityReview::class, 'id_activity', 'id_activity');
    }

    public function userReview()
    {
        if (auth()->check()) {
            return $this->hasOne(ActivityReview::class, 'id_activity', 'id_activity')->where('created_by', auth()->user()->id);
        }
        return false;
    }

    public function facilities()
    {
        return $this->belongsToMany(ActivityFacilities::class, 'activity_has_facilities', 'id_activity', 'id_facilities', 'id_activity', 'id_facilities')->withPivot('created_by', 'updated_by')->withTimestamps();
    }

    public function subCategory()
    {
        return $this->belongsToMany(ActivitySubcategory::class, 'activity_has_subcategory', 'id_activity', 'id_subcategory', 'id_activity', 'id_subcategory')->withPivot('created_by', 'updated_by')->withTimestamps();
    }

    public function ownerData()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(Profile::class, 'created_by', 'user_id');
    }

    // favorit attribute
    public function getIsFavoritAttribute()
    {
        // if user not logged, return false
        if (!auth()->check()) {
            return false;
        };

        // check favorit
        $favorit = $this->favorit->where('id_user', auth()->user()->id)->first();
        if (empty($favorit)) {
            return false;
        }
        return true;
    }

    public function getVillaNearbyAttribute()
    {
        return DestinationNearbyActivity::villa($this->id_activity);
    }

    public function getRestaurantNearbyAttribute()
    {
        return DestinationNearbyActivity::restaurant($this->id_activity);
    }

    public function getHotelNearbyAttribute()
    {
        return DestinationNearbyActivity::hotel($this->id_activity);
    }
}
