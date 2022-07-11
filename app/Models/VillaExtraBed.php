<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaExtraBed extends Model
{
    protected $fillable = [
        'id_villa', 'max', 'price',
    ];

    protected $table = 'villa_extra_bed';
    protected $primaryKey = 'id_extra_bed';

    // * Relationship
    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
}
