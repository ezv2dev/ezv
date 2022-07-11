<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelFilter extends Model
{
    protected $fillable = [
        'icon', 'name',
    ];

    protected $table = 'hotel_filter';
    protected $primaryKey = 'id_hotel_filter';
}
