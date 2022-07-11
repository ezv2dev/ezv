<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantSubCategory extends Model
{
    protected $fillable = [
        'id_cuisine',
        'name',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'restaurant_subcategory';
    protected $primaryKey = 'id_subcategory';

    public function restaurant()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_has_subcategory', 'id_subcategory', 'id_restaurant', 'id_subcategory', 'id_restaurant')->withPivot('created_by', 'updated_by')->withTimestamps();
    }
}
