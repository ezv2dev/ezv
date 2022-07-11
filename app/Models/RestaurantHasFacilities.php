<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantHasFacilities extends Model
{
    protected $fillable = [
        'id_restaurant',
        'id_facilities',
        'created_by',
        'updated_by'
    ];
    protected $table = 'restaurant_has_facilities';
}
