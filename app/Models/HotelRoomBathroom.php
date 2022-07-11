<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomBathroom extends Model
{
    protected $fillable = [
        'id_hotel', 'id_hotel_room',
        'id_bathroom', 'created_by', 'updated_by',
    ];

    protected $table = 'hotel_room_bathroom';

    protected $primaryKey = 'id_detail';

    public function bathroom()
    {
        return $this->belongsTo(Bathroom::class, 'id_bathroom', 'id_bathroom');
    }
}
