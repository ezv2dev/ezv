<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaExtraGuest extends Model
{
    protected $fillable = [
        'id_villa', 'max', 'price',
    ];

    protected $table = 'villa_extra_guest';
    protected $primaryKey = 'id_extra_guest';

    // * Relationship
    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
}
