<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelHasFilter extends Model
{
    protected $fillable = [
        'id_hotel', 'id_hotel_filter', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_has_filter';

    // * Relationship
    public function hotelFilter()
    {
        return $this->belongsTo(HotelFilter::class, 'id_hotel_filter', 'id_hotel_filter');
    }
}
