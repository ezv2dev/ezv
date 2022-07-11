<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomSafety extends Model
{
    protected $fillable = [
        'id_hotel', 'id_hotel_room',
        'id_safety', 'created_by', 'updated_by',
    ];

    protected $table = 'hotel_room_safety';

    protected $primaryKey = 'id_detail';

    public function safety()
    {
        return $this->belongsTo(Safety::class, 'id_safety', 'id_safety');
    }
}
