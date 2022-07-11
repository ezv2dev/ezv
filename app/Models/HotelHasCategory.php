<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelHasCategory extends Model
{
    protected $fillable = [
        'id_hotel', 'id_hotel_category'
    ];

    protected $table = 'hotel_has_category';

    // * Relationship
    public function hotelCategory()
    {
        return $this->belongsTo(HotelCategory::class, 'id_hotel_category', 'id_hotel_category');
    }
}
