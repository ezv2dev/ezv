<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantRules extends Model
{
    protected $fillable = [
        'id_restaurant',
        'pets',
        'smoking',
        'events',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'restaurant_rules';
    protected $primaryKey = 'id_restaurant_rules';

    // * Relationship
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant', 'id_restaurant');
    }
}
