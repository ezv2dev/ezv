<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantHasDishes extends Model
{
    protected $fillable = [
        'id_restaurant',
        'id_dishes',
        'created_by',
        'updated_by'
    ];
    protected $table = 'restaurant_has_dishes';
}
