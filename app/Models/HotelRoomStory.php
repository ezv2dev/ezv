<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomStory extends Model
{
    protected $fillable = [
        'title', 'name', 'id_hotel', 'id_hotel_room', 'thumbnail'
    ];

    protected $table = 'hotel_room_story';
    protected $primaryKey = 'id_story';

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }

    public function hotel_room()
    {
        return $this->belongsTo(HotelTypeDetail::class, 'id_hotel_room', 'id_hotel_room');
    }
}
