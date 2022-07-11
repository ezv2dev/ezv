<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaService extends Model
{
    protected $fillable = [
        'id_villa', 'id_service', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_service';
    protected $primaryKey = 'id_detail';
}
