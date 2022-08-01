<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelAmenities extends Model
{
    protected $fillable = [
        'id_hotel', 'id_amenities', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_amenities';
    protected $primaryKey = 'id_detail';

    public function amenities()
    {
        return $this->belongsTo(Amenities::class, 'id_amenities', 'id_amenities');
    }
}
