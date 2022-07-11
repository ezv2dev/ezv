<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelScenicViews extends Model
{
    protected $table = 'hotel_scenic_views';
    protected $primaryKey = 'id_detail';

    protected $fillable = ['id_hotel', 'id_scenic_views'];
}
