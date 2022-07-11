<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantReview extends Model
{
    protected $fillable = [
        'food',
        'service',
        'value',
        'atmosphere',
        'comment',
        'id_restaurant',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'restaurant_review';
    protected $primaryKey = 'id_review';
}
