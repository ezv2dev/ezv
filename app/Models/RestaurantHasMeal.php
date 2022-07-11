<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantHasMeal extends Model
{
    protected $fillable = [
        'id_restaurant',
        'id_meal',
        'created_by',
        'updated_by'
    ];
    protected $table = 'restaurant_has_meal';
}
