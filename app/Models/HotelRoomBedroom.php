<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomBedroom extends Model
{
    protected $fillable = [
        'id_hotel', 'id_hotel_room',
        'id_bedroom', 'created_by', 'updated_by',
    ];

    protected $table = 'hotel_room_bedroom';

    protected $primaryKey = 'id_detail';

    public function bedroom()
    {
        return $this->belongsTo(Bedroom::class, 'id_bedroom', 'id_bed');
    }
}
