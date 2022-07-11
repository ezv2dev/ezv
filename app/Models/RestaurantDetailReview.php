<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantDetailReview extends Model
{
    protected $fillable = [
        'average_food',
        'average_service',
        'average_value',
        'average_atmosphere',
        'average',
        'count_person',
        'id_restaurant',
        'created_at',
        'updated_at'
    ];

    protected $table = 'restaurant_detail_review';
    protected $primaryKey = 'id_detail';
}
