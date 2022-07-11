<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaTypeDetail extends Model
{
    protected $fillable = [
        'id_villa', 'id_villa_type'
    ];

    protected $table = 'villa_type_detail';
    protected $primaryKey = 'id_detail';
}
