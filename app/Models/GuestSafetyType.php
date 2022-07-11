<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestSafetyType extends Model
{
    protected $fillable = [
        'type',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'guest_safety_type';
    protected $primaryKey = 'id_type';
}
