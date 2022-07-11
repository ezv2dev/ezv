<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelSafety extends Model
{
    protected $fillable = [
        'id_hotel', 'id_safety', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_safety';
    protected $primaryKey = 'id_detail';
}
