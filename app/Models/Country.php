<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name', 'code'
    ];

    protected $table = 'countries';
    protected $primaryKey = 'id_countries';
}
