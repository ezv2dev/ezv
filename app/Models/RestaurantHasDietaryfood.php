<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantHasDietaryfood extends Model
{
    protected $fillable = [
        'id_restaurant',
        'id_dietaryfood',
        'created_by',
        'updated_by'
    ];
    protected $table = 'restaurant_has_dietaryfood';
}
