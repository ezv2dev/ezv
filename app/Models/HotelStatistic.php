<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelStatistic extends Model
{
    use HasFactory;

    protected $table = 'hotel_statistic';
    protected $primaryKey = 'id_hotel_statistic';

    protected $fillable = [
        'id_hotel',
        'hotel_views',
        'video_views',
        'photo_views',
        'month',
        'year',
        'created_at',
        'updated_at'
    ];

    // * Relationship
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }
}
