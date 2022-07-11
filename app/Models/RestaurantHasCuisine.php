<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantHasCuisine extends Model
{
    protected $fillable = [
        'id_restaurant',
        'id_cuisine',
        'created_by',
        'updated_by'
    ];
    protected $table = 'restaurant_has_cuisine';
}
