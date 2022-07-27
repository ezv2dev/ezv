<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelStory extends Model
{
    protected $fillable = [
        'title', 'name', 'id_hotel', 'thumbnail', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_story';
    protected $primaryKey = 'id_story';

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }
}
