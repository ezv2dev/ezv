<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaHasGuestSafety extends Model
{
    protected $fillable = [
        'id_villa',
        'id_guest_safety',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];
    protected $table = 'villa_has_guest_safety';
}
