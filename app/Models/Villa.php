<?php

namespace App\Models;

use App\Services\CurrencyConversionService as CurrencyConversion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\VillaSave;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\DestinationNearbyVillaService as DestinationNearbyVilla;

class Villa extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_property_type',
        'uid',
        'grade',
        'name',
        'original_name',
        'description',
        'short_description',
        'as_feature',
        'adult',
        'children',
        'size',
        'bedroom',
        'bathroom',
        'beds',
        'parking',
        'min_stay',
        'booking',
        'id_location',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'price',
        'commission',
        'discount',
        'instant_book',
        'self_check_in',
        'free_cancelation',
        'status',
        'step',
        'image',
        'views'
    ];

    protected $table = 'villa';
    protected $primaryKey = 'id_villa';

    //DATA TABLE VILLA
    public function scopeDatatables()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $data = DB::table('villa')->select('*')->where('deleted_at', NULL)->get();
        } elseif (Auth::user()->role_id == 3) {
            $data = DB::table('villa')->select('*')->where('deleted_at', NULL)->where('created_by', Auth::user()->id)->get();
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('listing', function ($data) {
                $url = asset('foto/gallery/' . $data->uid . '/' . $data->image);
                return '<img src="' . $url . '" border="0" width="60" class="img-rounded" align="center" /> <a href="/homes/' . $data->id_villa . '"><span><b>' . $data->name . '</b></span></a>';
            })

            ->addColumn('last_modified', function ($data) {
                $last_modified = Carbon::parse($data->updated_at)->diffForHumans();
                return $last_modified;
            })

            ->addColumn('price', function ($data) {
                $no = "";
                $no .= "IDR " . number_format($data->price, 0);

                return $no;
            })

            ->addColumn('grade', function ($data) {
                $grade = "";
                $grade .= $data->grade;

                return $grade;
            })
            ->addColumn('todo', function ($data) {
                $todo = "";
                $todo .= "<center>";
                $todo .= "<button class='btn btn-outline-primary'>Finish</button>";
                $todo .= "</center>";

                return $todo;
            })
            ->addColumn('instantBook', function ($data) {
                $co = "";
                // $co .= "<center>";
                $co .= "On";
                // $co .= "</center>";

                return $co;
            })
            // ->addColumn('status_listing', function($data) {
            //     $status_listing = "";

            // })
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
                //     <div class='dropdown'>
                //     <button type='button' class='btn button-admin dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //     Action
                // </button>
                // <div class='dropdown-menu dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>";
                // if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
                //     if($data->status == 0){
                //         $aksi .= "<a class='dropdown-item admin-action-dropdown' href='/villa/status/" . $data->id_villa . "'>Active</a>";
                //     }else{
                //         $aksi .= "<a class='dropdown-item admin-action-dropdown' href='/villa/status/" . $data->id_villa . "'>Non Active</a>";
                //     }
                // }
                // $aksi .=     "<a class='dropdown-item admin-action-dropdown' href='/villa/" . $data->id_villa . "'>View</a>
                //             <a class='dropdown-item admin-action-dropdown' href='/admin/villa/delete/" . $data->id_villa . "'>Delete</a>
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
                            <a class='dropdown-item py-3' href='" . route('villa', $data->id_villa) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3 delete' href='javascript:void(0);' data-id='" . $data->id_villa . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_villa_restore_delete', $data->id_villa) . "'>
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
                            <a class='dropdown-item py-3' href='" . route('villa', $data->id_villa) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_villa_soft_delete', $data->id_villa) . "'>
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
            ->rawColumns(['aksi', 'status', 'price', 'todo', 'instantBook', 'listing', 'last_modified'])->make(true);
    }

    public function scopeDatatablesTrash()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $data = self::onlyTrashed()->get();
        } elseif (Auth::user()->role_id == 3) {
            $data = self::onlyTrashed()->where('created_by', Auth::user()->id)->get();
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('listing', function ($data) {
                $url = asset('foto/gallery/' . $data->name . '/' . $data->image);
                return '<img src="' . $url . '" border="0" width="60" class="img-rounded" align="center" /> <span><b>' . $data->name . '</b></span>';
            })

            ->addColumn('last_modified', function ($data) {
                $last_modified = Carbon::parse($data->updated_at)->diffForHumans();
                return $last_modified;
            })

            ->addColumn('price', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->price;
                $no .= "</center>";

                return $no;
            })
            ->addColumn('todo', function ($data) {
                $todo = "";
                $todo .= "<center>";
                $todo .= "<button class='btn btn-outline-primary'>Finish</button>";
                $todo .= "</center>";

                return $todo;
            })
            ->addColumn('instantBook', function ($data) {
                $co = "";
                // $co .= "<center>";
                $co .= "On";
                // $co .= "</center>";

                return $co;
            })
            // ->addColumn('status_listing', function($data) {
            //     $status_listing = "";

            // })
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
                //     <div class='dropdown'>
                //     <button type='button' class='btn button-admin dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //     Action
                // </button>
                // <div class='dropdown-menu dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>";
                // if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
                //     if($data->status == 0){
                //         $aksi .= "<a class='dropdown-item admin-action-dropdown' href='/villa/status/" . $data->id_villa . "'>Active</a>";
                //     }else{
                //         $aksi .= "<a class='dropdown-item admin-action-dropdown' href='/villa/status/" . $data->id_villa . "'>Non Active</a>";
                //     }
                // }
                // $aksi .=     "<a class='dropdown-item admin-action-dropdown' href='/villa/" . $data->id_villa . "'>View</a>
                //             <a class='dropdown-item admin-action-dropdown' href='/admin/villa/delete/" . $data->id_villa . "'>Delete</a>
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
                            <a class='dropdown-item py-3' href='" . route('villa', $data->id_villa) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3 delete' href='javascript:void(0);' data-id='" . $data->id_villa . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_villa_restore_delete', $data->id_villa) . "'>
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
                            <a class='dropdown-item py-3' href='" . route('villa', $data->id_villa) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                            <a class='dropdown-item py-3 delete' href='javascript:void(0);' data-id='" . $data->id_villa . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='" . route('admin_villa_soft_delete', $data->id_villa) . "'>
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
            ->rawColumns(['aksi', 'status', 'grade', 'price', 'todo', 'instantBook', 'listing', 'last_modified'])->make(true);
    }

    public function scopeDatatablesListing()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $data = DB::table('villa')->select('*')->where('deleted_at', NULL)->get();
        } elseif (Auth::user()->role_id == 3) {
            $data = DB::table('villa')->select('*')->where('deleted_at', NULL)->where('created_by', Auth::user()->id)->get();
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('listing', function ($data) {
                $url = asset('foto/gallery/' . $data->uid . '/' . $data->image);
                return '<img src="' . $url . '" border="0" width="60" class="img-rounded" align="center" /> <a href="/homes/' . $data->id_villa . '" target="_blank"><span><b>' . $data->name . '</b></span></a>';
            })

            ->addColumn('last_modified', function ($data) {
                $last_modified = Carbon::parse($data->updated_at)->diffForHumans();
                return $last_modified;
            })

            ->addColumn('price', function ($data) {
                $no = "";
                $no .= "IDR " . number_format($data->price, 0);

                return $no;
            })

            ->addColumn('grade', function ($data) {
                $grade = "";
                $grade .= $data->grade;

                return $grade;
            })
            // ->addColumn('todo', function ($data) {
            //     $todo = "";
            //     $todo .= "<center>";
            //     $todo .= "<button class='btn btn-outline-primary'>Finish</button>";
            //     $todo .= "</center>";

            //     return $todo;
            // })
            ->addColumn('instantBook', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->instant_book == 'yes') {
                    $co .= "<span class='text-white badge badge-pill' style='background-color:#28A745;'>Yes</span>";
                } else {
                    $co .= "<span class='text-white badge badge-pill bg-danger'>No</span>";
                }
                $co .= "</center>";

                return $co;
            })
            // ->addColumn('status_listing', function($data) {
            //     $status_listing = "";

            // })
            ->addColumn('status', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->status == 0)
                    $co .= "<span class='text-white badge badge-pill bg-danger'>Non Active</span>";
                elseif ($data->status == 1) {
                    $co .= "<span class='text-white badge badge-pill' style='background-color:#28A745;'>Active</span>";
                }
                $co .= "</center";

                return $co;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                // $aksi .= "
                //     <div class='dropdown'>
                //     <button type='button' class='btn button-admin dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //     Action
                // </button>
                // <div class='dropdown-menu dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>";
                // if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
                //     if($data->status == 0){
                //         $aksi .= "<a class='dropdown-item admin-action-dropdown' href='/villa/status/" . $data->id_villa . "'>Active</a>";
                //     }else{
                //         $aksi .= "<a class='dropdown-item admin-action-dropdown' href='/villa/status/" . $data->id_villa . "'>Non Active</a>";
                //     }
                // }
                // $aksi .=     "<a class='dropdown-item admin-action-dropdown' href='/villa/" . $data->id_villa . "'>View</a>
                //             <a class='dropdown-item admin-action-dropdown' href='/admin/villa/delete/" . $data->id_villa . "'>Delete</a>
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
                            <a class='dropdown-item py-3' href='" . route('villa', $data->id_villa) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
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
                            <a class='dropdown-item py-3' href='" . route('villa', $data->id_villa) . "' target='_blank'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                                <div>
                                    <div class='small text-gray-500'>View</div>
                                    View data details
                                </div>
                            </a>
                        </div>
                    </li>";
                }
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'status', 'price', 'todo', 'instantBook', 'listing', 'last_modified'])->make(true);
    }

    // * Relationship
    public function booking()
    {
        return $this->hasMany(VillaBooking::class, 'id_villa', 'id_villa');
    }

    public function userReview()
    {
        if (auth()->check()) {
            return $this->hasOne(VillaReview::class, 'id_villa', 'id_villa')->where('created_by', auth()->user()->id);
        }
        return false;
    }

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function guestSafety()
    {
        return $this->belongsToMany(GuestSafety::class, 'villa_has_guest_safety', 'id_villa', 'id_guest_safety', 'id_villa', 'id_guest_safety');
    }

    public function villaCategory()
    {
        return $this->belongsToMany(VillaCategory::class, 'villa_has_category', 'id_villa', 'id_villa_category');
    }

    public function villaHasCategory()
    {
        return $this->hasMany(VillaHasCategory::class, 'id_villa', 'id_villa');
    }

    public function villaHasFilter()
    {
        return $this->hasMany(VillaHasFilter::class, 'id_villa', 'id_villa');
    }

    public function villaHasAmenities()
    {
        return $this->hasMany(VillaAmenities::class, 'id_villa', 'id_villa');
    }

    public function villaFilter()
    {
        return $this->belongsToMany(VillaFilter::class, 'villa_has_filter', 'id_villa', 'id_villa_filter', 'id_villa', 'id_villa_filter');
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyTypeVilla::class, 'id_property_type', 'id_property_type');
    }

    public function favorit()
    {
        return $this->hasMany(VillaSave::class, 'id_villa', 'id_villa');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location', 'id_location');
    }
    public function photo()
    {
        return $this->hasMany(VillaPhoto::class, 'id_villa', 'id_villa');
    }
    public function video()
    {
        return $this->hasMany(VillaVideo::class, 'id_villa', 'id_villa');
    }
    public function amenities()
    {
        return $this->belongsToMany(Amenities::class, 'villa_amenities', 'id_villa', 'id_amenities', 'id_villa', 'id_amenities');
    }
    public function detailReview()
    {
        return $this->hasOne(DetailReview::class, 'id_villa', 'id_villa');
    }

    public function extendGuest()
    {
        return $this->hasOne(VillaExtendGuest::class, 'id_villa', 'id_villa');
    }

    public function villaView()
    {
        return $this->hasMany(VillaView::class, 'id_villa', 'id_villa');
    }

    public function villaBedroomDetail()
    {
        return $this->hasMany(VillaBedroomDetail::class, 'id_villa', 'id_villa');
    }

    public function showVilla()
    {
        if (auth()->id() == null) {
            return $this->villaView()
                ->where('ip', '=',  request()->ip())->exists();
        }

        return $this->villaView()
            ->where(function ($villaViewsQuery) {
                $villaViewsQuery
                    ->where('session_id', '=', request()->getSession()->getId())
                    ->orWhere('user_id', '=', (auth()->check()));
            })->exists();
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

    // location
    public function getLocationNameAttribute()
    {
        return $this->location->name;
    }

    public function getisDeletedAttribute()
    {
        if ($this->deleted_at) {
            return true;
        }
        return false;
    }

    public function getRestaurantNearbyAttribute()
    {
        return DestinationNearbyVilla::restaurant($this->id_villa);
    }

    public function getActivityNearbyAttribute()
    {
        return DestinationNearbyVilla::activity($this->id_villa);
    }

    public function getHotelNearbyAttribute()
    {
        return DestinationNearbyVilla::hotel($this->id_villa);
    }
    public function getPriceWithExchangeUnitAttribute()
    {
        if ($this->price) {
            return CurrencyConversion::exchangeWithUnit($this->price);
        } else {
            return null;
        }
    }

    // public function getAddressGoogleApiAttribute()
    // {
    //     $latitude = $this->latitude;
    //     $longitude = $this->longitude;
    //     $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&sensor=false';
    //     $json = file_get_contents($url);
    //     $data=json_decode($json);
    //     $status = $data->status;

    //     if($status=="OK") {
    //         return $data->results[0]->formatted_address;
    //     }
    //     else {
    //         return false;
    //     }
    // }
}
