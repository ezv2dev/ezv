<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Villa;

class VillaSave extends Model
{
    protected $table = 'villa_save';

    protected $primaryKey = 'id_villasave';

    protected $fillable = [
        'id_villa',
        'id_user',
        'created_by',
        'updated_by'
    ];

    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
}
