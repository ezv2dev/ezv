<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaSuitable extends Model
{
    protected $table = 'villa_suitable';
    protected $primaryKey = 'id_suitable';

    protected $fillable = [
        'name'
    ];
}
