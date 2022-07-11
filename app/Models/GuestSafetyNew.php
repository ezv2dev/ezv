<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestSafetyNew extends Model
{
    protected $fillable = [
        'id_villa',
        'pool',
        'lake',
        'climb',
        'height',
        'animal',
        'camera',
        'monoxide',
        'alarm',
        'must',
        'potential',
        'come',
        'parking',
        'shared',
        'amenity',
        'weapon',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'guest_safety_new';
    protected $primaryKey = 'id_guest_safety_new';
}
