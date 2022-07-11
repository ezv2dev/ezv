<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaOutdoor extends Model
{
    protected $fillable = [
        'id_villa', 'id_outdoor', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_outdoor';
    protected $primaryKey = 'id_detail';
}
