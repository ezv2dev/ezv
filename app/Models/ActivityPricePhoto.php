<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityPricePhoto extends Model
{
    protected $fillable = [
        'name', 'id_price', 'id_activity', 'created_by', 'updated_by', 'order'
    ];

    protected $table = 'activity_price_photo';
    protected $primaryKey = 'id_photo';
}
