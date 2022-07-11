<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantPhoto extends Model
{
    protected $fillable = [
        'name', 'id_restaurant', 'caption', 'order', 'created_by', 'updated_by'
     ];

     protected $table = 'restaurant_photo';
     protected $primaryKey = 'id_photo';
}
