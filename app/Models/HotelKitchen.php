<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelKitchen extends Model
{
    protected $fillable = [
        'id_hotel', 'id_kitchen', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'hotel_kitchen';
    protected $primaryKey = 'id_detail';

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'id_kitchen', 'id_kitchen');
    }
}
