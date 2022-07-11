<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityPhoto extends Model
{
    protected $fillable = [
        'name', 'id_activity', 'caption', 'created_by', 'updated_by', 'order'
    ];

    protected $table = 'activity_photo';
    protected $primaryKey = 'id_photo';
}
