<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantHasGuestSafety extends Model
{
    protected $fillable = [
        'id_restaurant',
        'id_guest_safety',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];
    protected $table = 'restaurant_has_guest_safety';
}
