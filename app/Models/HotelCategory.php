<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    protected $fillable = [
        'icon', 'name',
    ];

    protected $table = 'hotel_category';
    protected $primaryKey = 'id_hotel_category';
}
