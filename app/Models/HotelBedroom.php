<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelBedroom extends Model
{
    protected $fillable = [
        'id_hotel', 'id_hotel_room', 'id_bedroom', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_bedroom';
    protected $primaryKey = 'id_detail';

    public function bedroom()
    {
        return $this->belongsTo(BedRoom::class, 'id_bedroom', 'id_bedroom');
    }
}
