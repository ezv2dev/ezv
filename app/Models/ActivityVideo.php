<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityVideo extends Model
{
    protected $fillable = [
        'name', 'id_activity', 'created_by', 'updated_by', 'order'
    ];

    protected $table = 'activity_video';
    protected $primaryKey = 'id_video';
}
