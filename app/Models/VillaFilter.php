<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaFilter extends Model
{
    protected $fillable = [
        'icon', 'name',
    ];

    protected $table = 'villa_filter';
    protected $primaryKey = 'id_villa_filter';
}
