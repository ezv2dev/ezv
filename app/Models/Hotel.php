<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\DestinationNearbyHotelService as DestinationNearbyHotel;
use PDO;

class Hotel extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_hotel';

    protected $fillable = [
        'id_property_type', 'id_suitable', 'uid', 'star', 'grade', 'name', 'original_name', 'description', 'short_description', 'as_feature', 'adult', 'children', 'size', 'bedroom', 'bathroom', 'beds', 'parking', 'min_stay', 'booking', 'id_location', 'address', 'latitude', 'longitude', 'phone', 'email', 'price', 'discount', 'cancel', 'status', 'step', 'image', 'views', 'created_by', 'updated_at'
    ];

    protected $table = 'hotel';

    // Datatable User
    public function scopeDatatables()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $data = DB::table('hotel')->select('*')->where('deleted_at', NULL)->get();
        } elseif (Auth::user()->role_id == 3) {
            $data = DB::table('hotel')->select('*')->where('deleted_at', NULL)->where('created_by', Auth::user()->id)->get();
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('price', function ($data) {
                $no = "";
                $no .= "<center>";
                $no .= $data->price;
                $no .= "</center";

                return $no;
            })
            ->addColumn('status', function ($data) {
                $co = "";
                $co .= "<center>";
                if ($data->status == 0)
                    $co .= "<span class='badge badge-pill badge-danger'>Non Active</span>";
                elseif ($data->status == 1) {
                    $co .= "<span class='badge badge-pill badge-success'>Active</span>";
                }
                $co .= "</center";

                return $co;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                    <div class='dropdown'>
                    <button type='button' class='btn btn-primary dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Action
                </button>
                <div class='dropdown-menu dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                            <a class='dropdown-item' href='/admin/hotel/show/" . $data->id_hotel . "'>Edit</a>
                            <a class='dropdown-item' href='/admin/hotel/delete/" . $data->id_hotel . "'>Delete</a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item' href='/review/create/" . $data->id_hotel . "'>Review</a>
                            <a class='dropdown-item' href='/admin/hotel/create_gallery/" . $data->id_hotel . "'>Gallery</a>
                            <a class='dropdown-item' href='/admin/hotel/index_nearby/" . $data->id_hotel . "'>Near By</a>
                            <a class='dropdown-item' href='/admin/hotel/index_extraprice/" . $data->id_hotel . "'>Ekstra Price</a>
                        </div>
                    </div>";
                $aksi .= "</center>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'status', 'price'])->make(true);
    }

    // relationship
    public function userReview()
    {
        if (auth()->check()) {
            return $this->hasOne(HotelReview::class, 'id_hotel', 'id_hotel')->where('created_by', auth()->user()->id);
        }
        return false;
    }

    public function ownerHotel()
    {
        return $this->belongsTo(Profile::class, 'created_by', 'user_id');
    }

    public function guestSafety()
    {
        return $this->belongsToMany(GuestSafety::class, 'hotel_has_guest_safety', 'id_hotel', 'id_guest_safety', 'id_hotel', 'id_guest_safety');
    }

    public function ownerData()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function favorit()
    {
        return $this->hasMany(HotelSave::class, 'id_hotel', 'id_hotel');
    }

    public function hotelAmenities()
    {
        return $this->hasMany(HotelAmenities::class, 'id_hotel', 'id_hotel');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenities::class, 'hotel_amenities', 'id_hotel', 'id_amenities', 'id_hotel', 'id_amenities');
    }

    public function hotelHasCategory()
    {
        return $this->hasMany(HotelHasCategory::class, 'id_hotel', 'id_hotel');
    }

    public function hotelHasFilter()
    {
        return $this->hasMany(HotelHasFilter::class, 'id_hotel', 'id_hotel');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location', 'id_location');
    }

    public function hotel_room()
    {
        return $this->hasMany(HotelTypeDetail::class, 'id_hotel', 'id_hotel');
    }

    public function video()
    {
        return $this->hasMany(HotelVideo::class, 'id_hotel', 'id_hotel');
    }

    public function photo()
    {
        return $this->hasMany(HotelPhoto::class, 'id_hotel', 'id_hotel');
    }

    public function detailReview()
    {
        return $this->hasOne(HotelDetailReview::class, 'id_hotel', 'id_hotel');
    }

    public function detailComment()
    {
        return $this->hasMany(HotelReview::class, 'id_hotel', 'id_hotel');
    }

    public function extendGuest()
    {
        return $this->hasOne(HotelExtendGuest::class, 'id_hotel', 'id_hotel');
    }

    public function hotelView()
    {
        return $this->hasMany(HotelView::class, 'id_hotel', 'id_hotel');
    }

    public function showHotel()
    {
        if (auth()->id() == null) {
            return $this->hotelView()
                ->where('ip', '=',  request()->ip())->exists();
        }

        return $this->hotelView()
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
        return DestinationNearbyHotel::restaurant($this->id_hotel);
    }

    public function getActivityNearbyAttribute()
    {
        return DestinationNearbyHotel::activity($this->id_hotel);
    }

    public function getVillaNearbyAttribute()
    {
        return DestinationNearbyHotel::villa($this->id_hotel);
    }
}
