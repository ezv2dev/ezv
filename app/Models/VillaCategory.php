<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaCategory extends Model
{
    protected $fillable = [
        'icon', 'name',
    ];

    protected $table = 'villa_category';
    protected $primaryKey = 'id_villa_category';
}
