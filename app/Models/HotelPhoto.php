<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelPhoto extends Model
{
    protected $fillable = [
        'name', 'id_hotel', 'caption', 'order', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_photo';
    protected $primaryKey = 'id_photo';

    public function getMediaTypeAttribute()
    {
        return 'photo';
    }
}
