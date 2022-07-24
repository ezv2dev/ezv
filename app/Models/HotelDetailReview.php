<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelDetailReview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_hotel', 'average', 'count_person', 'average_clean', 'average_service', 'average_check_in', 'average_location', 'average_value'
    ];

    protected $table = 'hotel_detail_review';
    protected $primaryKey = 'id_detail';

    // * Relationship

    public function hotelReview()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }
}
