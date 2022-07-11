<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantHasGoodfor extends Model
{
    protected $fillable = [
        'id_restaurant',
        'id_goodfor',
        'created_by',
        'updated_by'
    ];
    protected $table = 'restaurant_has_goodfor';
}
