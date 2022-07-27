<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoomDetails extends Model
{
    use HasFactory;

    protected $fillable = ['id_hotel_room', 'price', 'capacity'];
    protected $table = 'hotel_room_details';
    protected $primaryKey = 'id_room_details';
}
