<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaFamily extends Model
{
    protected $fillable = [
        'id_villa', 'id_family', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_family';
    protected $primaryKey = 'id_detail';
}
