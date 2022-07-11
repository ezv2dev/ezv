<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityHasGuestSafety extends Model
{
    protected $fillable = [
        'id_activity',
        'id_guest_safety',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];
    protected $table = 'activity_has_guest_safety';
}
