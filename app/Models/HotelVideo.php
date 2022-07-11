<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelVideo extends Model
{
    protected $fillable = [
        'name', 'id_hotel', 'thumbnail', 'created_by', 'updated_by', 'order'
    ];

    protected $table = 'hotel_video';
    protected $primaryKey = 'id_video';

    public function getMediaTypeAttribute()
    {
        return 'video';
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }
}
