<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaBathroom extends Model
{
    protected $fillable = [
        'id_villa', 'id_bathroom', 'updated_at', 'created_at', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_bathroom';
    protected $primaryKey = 'id_detail';
}
