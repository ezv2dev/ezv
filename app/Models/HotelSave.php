<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelSave extends Model
{
    protected $table = 'hotel_save';

    protected $primaryKey = 'id_hotelsave';

    protected $fillable = [
        'id_hotel',
        'id_user',
        'created_by',
        'updated_by'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }
}
