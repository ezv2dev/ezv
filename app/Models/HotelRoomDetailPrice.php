<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomDetailPrice extends Model
{
    protected $fillable = [
        'id_hotel', 'id_hotel_room', 'start', 'end', 'price', 'disc' , 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_room_detail_price';
    protected $primaryKey = 'id_special_price';

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }

    public function hotel_room()
    {
        return $this->belongsTo(HotelTypDetail::class, 'id_hotel_room', 'id_hotel_room');
    }
}
