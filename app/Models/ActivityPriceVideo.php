<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityPriceVideo extends Model
{
    protected $fillable = [
        'name', 'id_price', 'id_activity', 'created_by', 'updated_by', 'order'
    ];

    protected $table = 'activity_price_video';
    protected $primaryKey = 'id_video';
}
