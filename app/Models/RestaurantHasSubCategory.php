<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantHasSubCategory extends Model
{
    protected $table = 'restaurant_has_subcategory';
    protected $fillable = ['id_restaurant', 'id_subcategory', 'id_photo', 'created_by', 'updated_by'];
}
