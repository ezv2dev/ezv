<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelExtendGuest extends Model
{
    protected $table = 'hotel';

    protected $primaryKey = 'id_hotel';

    protected $fillable = [
        'price', 'id_hotel'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }
}
