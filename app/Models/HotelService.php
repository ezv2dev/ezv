<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    protected $fillable = [
        'id_hotel', 'id_service', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_service';
    protected $primaryKey = 'id_detail';
}
