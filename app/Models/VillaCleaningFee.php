<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaCleaningFee extends Model
{
    protected $fillable = [
        'id_villa', 'price',
    ];

    protected $table = 'villa_cleaning_fee';
    protected $primaryKey = 'id_fee';
}
