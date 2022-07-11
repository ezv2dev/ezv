<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaExtraPet extends Model
{
    protected $fillable = [
        'deposit', 'max', 'id_villa', 'price_deposit', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_extra_pet';
    protected $primaryKey = 'id_extra_pet';

    // * Relationship
    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
}
