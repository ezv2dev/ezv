<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaHasFilter extends Model
{
    protected $fillable = [
        'id_villa', 'id_villa_filter', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_has_filter';

    // * Relationship
    public function villaFilter()
    {
        return $this->belongsTo(VillaFilter::class, 'id_villa_filter', 'id_villa_filter');
    }
}
