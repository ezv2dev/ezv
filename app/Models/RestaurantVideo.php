<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantVideo extends Model
{
    protected $fillable = [
        'name', 'id_restaurant', 'thumbnail', 'created_by', 'updated_by', 'order'
     ];

     protected $table = 'restaurant_video';
     protected $primaryKey = 'id_video';
}
