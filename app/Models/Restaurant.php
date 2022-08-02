<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

use App\Models\RestaurantSave;
use App\Models\RestaurantPhoto;
use App\Models\RestaurantVideo;
use App\Models\RestaurantDetailReview;
use App\Models\RestaurantReview;
use App\Models\RestaurantMenu;
use App\Models\RestaurantStory;
use App\Models\RestaurantType;
use App\Models\RestaurantMeal;
use App\Models\RestaurantPrice;
use App\Models\RestaurantCuisine;
use App\Models\RestaurantDishes;
use App\Models\RestaurantDietaryFood;
use App\Models\RestaurantGoodfor;
use App\Models\Location;
use App\Models\RestaurantFacilities;
use App\Services\DestinationNearbyRestaurantService as DestinationNearbyRestaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
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
        'open_time',
        'closed_time',
        'id_price',
        'id_type',
        'description',
        'short_description',
        'as_feature',
        'id_location',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'status',
        'step',
        'image'
    ];

    protected $table = 'restaurant';
    protected $primaryKey = 'id_restaurant';

    //DATA TABLE RESTAURANT
    public function scopeDatatables()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $data = DB::table('restaurant')->where('deleted_at', NULL)->select('*')->latest()->get();
        } elseif (Auth::user()->role_id == 3) {
            $data = DB::table('restaurant')->where('deleted_at', NULL)->select('*')->where('created_by', Auth::user()->id)->latest()->get();
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                $co = "";
                $co .= "<center>";
                // if ($data->status == 0) {
                //     $co .= "<span class='text-white badge badge-pill bg-danger'>Non Active</span>";
                // }
                // elseif ($data->status == 1) {
                //     $co .= "<span class='text-white badge badge-pill bg-sucess'>Active</span>";
                // }
                // elseif ($data->status == 2) {
                //     $co .= "<span class='text-white badge badge-pill bg-warning'>Requested Activation</span>";
                // }
                // elseif ($data->status == 3) {
                //     $co .= "<span class='text-white badge badge-pill bg-warning'>Requested Deactivation</span>";
                // }
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
                //     <div class='dropdown'>
                //     <button type='button' class='btn button-admin  dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //         Action
                //     </button>
                //      <div class='dropdown-menu admin-action-dropdown dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                //             <a class='dropdown-item' href='/admin/restaurant/show/" . $data->id_restaurant . "'>Edit</a>
                //             <a class='dropdown-item' href='/admin/restaurant/delete/" . $data->id_restaurant . "'>Delete</a>
                //             <div class='dropdown-divider'></div>
                //             <a class='dropdown-item' href='/review/create/" . $data->id_restaurant . "'>Review</a>
                //             <a class='dropdown-item' href='/admin/restaurant/index_menu/" . $data->id_restaurant . "'>Menu</a>
                //             <a class='dropdown-item' href='/admin/restaurant/create_gallery/" . $data->id_restaurant . "'>Gallery</a>
                //         </div>
                //     </div>";
                if ($data->status == 0) {
                    $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('restaurant', $data->id_restaurant) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3 delete' href='javascript:void(0);' data-id='" . $data->id_restaurant . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_food_update_status', $data->id_restaurant) . "'>
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
                            <a class='dropdown-item py-3' href='" . route('restaurant', $data->id_restaurant) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>

                            <a class='dropdown-item py-3' href='" . route('admin_restaurant_soft_delete', $data->id_restaurant) . "'>
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
            ->rawColumns(['aksi', 'status', 'price'])->make(true);
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
                // if ($data->status == 0) {
                //     $co .= "<span class='text-white badge badge-pill bg-danger'>Non Active</span>";
                // }
                // elseif ($data->status == 1) {
                //     $co .= "<span class='text-white badge badge-pill bg-sucess'>Active</span>";
                // }
                // elseif ($data->status == 2) {
                //     $co .= "<span class='text-white badge badge-pill bg-warning'>Requested Activation</span>";
                // }
                // elseif ($data->status == 3) {
                //     $co .= "<span class='text-white badge badge-pill bg-warning'>Requested Deactivation</span>";
                // }
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
                //     <div class='dropdown'>
                //     <button type='button' class='btn button-admin  dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //         Action
                //     </button>
                //      <div class='dropdown-menu admin-action-dropdown dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                //             <a class='dropdown-item' href='/admin/restaurant/show/" . $data->id_restaurant . "'>Edit</a>
                //             <a class='dropdown-item' href='/admin/restaurant/delete/" . $data->id_restaurant . "'>Delete</a>
                //             <div class='dropdown-divider'></div>
                //             <a class='dropdown-item' href='/review/create/" . $data->id_restaurant . "'>Review</a>
                //             <a class='dropdown-item' href='/admin/restaurant/index_menu/" . $data->id_restaurant . "'>Menu</a>
                //             <a class='dropdown-item' href='/admin/restaurant/create_gallery/" . $data->id_restaurant . "'>Gallery</a>
                //         </div>
                //     </div>";
                if ($data->status == 0) {
                    $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('restaurant', $data->id_restaurant) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3 delete' href='javascript:void(0);' data-id='" . $data->id_restaurant . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_restaurant_restore_delete', $data->id_restaurant) . "'>
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
                            <a class='dropdown-item py-3' href='" . route('restaurant', $data->id_restaurant) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>

                            <a class='dropdown-item py-3' href='" . route('admin_restaurant_soft_delete', $data->id_restaurant) . "'>
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
            ->rawColumns(['aksi', 'status', 'price'])->make(true);
    }

    // * Relationship
    public function guestSafety()
    {
        return $this->belongsToMany(GuestSafety::class, 'restaurant_has_guest_safety', 'id_restaurant', 'id_guest_safety', 'id_restaurant', 'id_guest_safety');
    }

    public function restaurantHasCuisine()
    {
        return $this->hasMany(RestaurantHasCuisine::class, 'id_restaurant', 'id_restaurant');
    }

    public function RestaurantHasSubCategory()
    {
        return $this->hasMany(RestaurantHasSubCategory::class, 'id_restaurant', 'id_restaurant');
    }

    public function favorit()
    {
        return $this->hasMany(RestaurantSave::class, 'id_restaurant', 'id_restaurant');
    }

    public function photo()
    {
        return $this->hasMany(RestaurantPhoto::class, 'id_restaurant', 'id_restaurant');
    }

    public function video()
    {
        return $this->hasMany(RestaurantVideo::class, 'id_restaurant', 'id_restaurant');
    }

    public function menu()
    {
        return $this->hasMany(RestaurantMenu::class, 'id_restaurant', 'id_restaurant');
    }

    public function story()
    {
        return $this->hasMany(RestaurantStory::class, 'id_restaurant', 'id_restaurant')->latest();
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location', 'id_location');
    }

    public function detailReview()
    {
        return $this->hasOne(RestaurantDetailReview::class, 'id_restaurant', 'id_restaurant');
    }

    public function userReview()
    {
        if (auth()->check()) {
            return $this->hasOne(RestaurantReview::class, 'id_restaurant', 'id_restaurant')->where('created_by', auth()->user()->id);
        }
        return false;
    }

    public function detailComment()
    {
        return $this->hasMany(RestaurantReview::class, 'id_restaurant', 'id_restaurant');
    }

    public function type()
    {
        return $this->hasOne(RestaurantType::class, 'id_type', 'id_type');
    }

    public function facilities()
    {
        return $this->belongsToMany(RestaurantFacilities::class, 'restaurant_has_facilities', 'id_restaurant', 'id_facilities', 'id_restaurant', 'id_facilities')->withPivot('created_by', 'updated_by')->withTimestamps();
    }

    public function meal()
    {
        return $this->belongsToMany(RestaurantMeal::class, 'restaurant_has_meal', 'id_restaurant', 'id_meal', 'id_restaurant', 'id_meal')->withPivot('created_by', 'updated_by')->withTimestamps();
    }

    public function price()
    {
        return $this->hasOne(RestaurantPrice::class, 'id_price', 'id_price');
    }

    public function cuisine()
    {
        return $this->belongsToMany(RestaurantCuisine::class, 'restaurant_has_cuisine', 'id_restaurant', 'id_cuisine', 'id_restaurant', 'id_cuisine')->withPivot('created_by', 'updated_by')->withTimestamps();
    }

    public function dishes()
    {
        return $this->belongsToMany(RestaurantDishes::class, 'restaurant_has_dishes', 'id_restaurant', 'id_dishes', 'id_restaurant', 'id_dishes')->withPivot('created_by', 'updated_by')->withTimestamps();
    }

    public function dietaryfood()
    {
        return $this->belongsToMany(RestaurantDietaryFood::class, 'restaurant_has_dietaryfood', 'id_restaurant', 'id_dietaryfood', 'id_restaurant', 'id_dietaryfood')->withPivot('created_by', 'updated_by')->withTimestamps();
    }

    public function goodfor()
    {
        return $this->belongsToMany(RestaurantGoodfor::class, 'restaurant_has_goodfor', 'id_restaurant', 'id_goodfor', 'id_restaurant', 'id_goodfor')->withPivot('created_by', 'updated_by')->withTimestamps();
    }

    public function ownerData()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(Profile::class, 'created_by', 'user_id');
    }

    public function subCategory()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_has_subcategory', 'id_subcategory', 'id_restaurant', 'id_subcategory', 'id_restaurant')->withPivot('created_by', 'updated_by')->withTimestamps();
    }

    // attribute
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
        return DestinationNearbyRestaurant::villa($this->id_restaurant);
    }

    public function getActivityNearbyAttribute()
    {
        return DestinationNearbyRestaurant::activity($this->id_restaurant);
    }

    public function getHotelNearbyAttribute()
    {
        return DestinationNearbyRestaurant::hotel($this->id_restaurant);
    }
}
