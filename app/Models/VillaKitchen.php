<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaKitchen extends Model
{
    protected $fillable = [
        'id_villa', 'id_kitchen', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_kitchen';
    protected $primaryKey = 'id_detail';

    // * Relationship
    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'id_kitchen', 'id_kitchen');
    }
}
