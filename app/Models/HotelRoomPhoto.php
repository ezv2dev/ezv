<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomPhoto extends Model
{
    protected $fillable = [
        'name', 'id_hotel_room', 'caption', 'id_hotel', 'order', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_room_photo';
    protected $primaryKey = 'id_photo';

    public function getMediaTypeAttribute()
    {
        return 'photo';
    }
}
