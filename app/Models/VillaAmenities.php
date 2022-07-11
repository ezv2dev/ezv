<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaAmenities extends Model
{
    protected $fillable = [
        'id_villa', 'id_amenities', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_amenities';
    protected $primaryKey = 'id_detail';

    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa');
    }
}
