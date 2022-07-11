<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelTypeDetail extends Model
{
    protected $fillable = [
        'id_hotel', 'name', 'id_hotel_type', 'short_description',
        'capacity',
        'room_description', 'room_size', 'id_bed',
        'price', 'image', 'free_cancel',
        'status', 'number_of_room',
        'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_type_detail';
    protected $primaryKey = 'id_hotel_room';

    // Relationship
    public function bed()
    {
        return $this->belongsTo(Bed::class, 'id_bed', 'id_bed');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }

    public function hotelType()
    {
        return $this->belongsTo(HotelType::class, 'id_hotel_type', 'id_hotel_type');
    }

    public function typeAmenities()
    {
        return $this->belongsToMany(Amenities::class, 'hotel_type_detail_amenities', 'id_hotel_room', 'id_amenities', 'id_hotel_room', 'id_amenities');
    }
}
