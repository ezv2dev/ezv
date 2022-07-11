<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomService extends Model
{
    protected $fillable = [
        'id_hotel', 'id_hotel_room',
        'id_service', 'created_by', 'updated_by',
    ];

    protected $table = 'hotel_room_service';

    protected $primaryKey = 'id_detail';

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service', 'id_service');
    }
}
