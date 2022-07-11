<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaAvailability extends Model
{
    protected $fillable = [
        'id_villa', 'date', 'created_by', 'updated_by', 'text', 'color'
    ];

    protected $table = 'villa_availability';
    protected $primaryKey = 'id_villa_availability';
}
