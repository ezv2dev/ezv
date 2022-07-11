<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomVideo extends Model
{
    protected $fillable = [
        'name', 'id_hotel_room', 'id_hotel', 'created_by', 'updated_by', 'order'
    ];

    protected $table = 'hotel_room_video';
    protected $primaryKey = 'id_video';

    public function getMediaTypeAttribute()
    {
        return 'video';
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }

    public function hotel_room()
    {
        return $this->belongsTo(HotelTypeDetail::class, 'id_hotel_room', 'id_hotel_room');
    }
}
