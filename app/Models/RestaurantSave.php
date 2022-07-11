<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class RestaurantSave extends Model
{
    protected $table = 'restaurant_save';
    protected $primaryKey = 'id_restaurantsave';

    protected $fillable = [
        'id_restaurant',
        'id_user',
        'created_by',
        'updated_by'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant', 'id_restaurant');
    }
}
