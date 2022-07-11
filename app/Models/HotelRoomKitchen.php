<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomKitchen extends Model
{
    protected $fillable = [
        'id_hotel', 'id_hotel_room',
        'id_kitchen', 'created_by', 'updated_by',
    ];

    protected $table = 'hotel_room_kitchen';

    protected $primaryKey = 'id_detail';

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'id_kitchen', 'id_kitchen');
    }
}
