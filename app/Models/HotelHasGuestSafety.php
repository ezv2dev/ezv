<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelHasGuestSafety extends Model
{
    protected $fillable = [
        'id_hotel',
        'id_guest_safety',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];
    protected $table = 'hotel_has_guest_safety';
}
