<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelBathroom extends Model
{
    protected $fillable = [
        'id_hotel', 'id_hotel_room', 'id_bathroom', 'updated_at', 'created_at', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_bathroom';
    protected $primaryKey = 'id_detail';
}
