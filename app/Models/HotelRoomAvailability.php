<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomAvailability extends Model
{
    protected $fillable = [
        // 'id_villa', 'start_date', 'end_date', 'created_by', 'updated_by','text','color'
        'id_hotel', 'id_hotel_room', 'date', 'created_by', 'updated_by','text','color'
    ];

    protected $table = 'hotel_room_availability';
    protected $primaryKey = 'id_room_availability';
}
