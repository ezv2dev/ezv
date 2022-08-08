<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantStatistic extends Model
{
    use HasFactory;

    protected $table = 'restaurant_statistic';
    protected $primaryKey = 'id_restaurant_statistic';

    protected $fillable = [
        'id_restaurant',
        'restaurant_views',
        'video_views',
        'photo_views',
        'month',
        'year',
        'created_at',
        'updated_at'
    ];

    // * Relationship
    public function restaurantStatistic()
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant', 'id_restaurant');
    }
}
