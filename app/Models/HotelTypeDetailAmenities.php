<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelTypeDetailAmenities extends Model
{
    protected $fillable = [
        'id_hotel', 'id_hotel_room', 'id_amenities', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_type_detail_amenities';
    protected $primaryKey = 'id_hotel_type_amenities';

    // relationship
    public function amenities()
    {
        return $this->belongsTo(Amenities::class, 'id_amenities', 'id_amenities');
    }
}
