<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $fillable = [
        'icon', 'name',
    ];

    protected $table = 'bed';
    protected $primaryKey = 'id_bed';
}
