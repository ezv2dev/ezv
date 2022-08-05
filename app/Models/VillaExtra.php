<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillaExtra extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_villa', 'type_extra', 'max_extra', 'price', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_extra';
    protected $primaryKey = 'id_extra_price';

    // * Relationship
    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
}
