<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaSafety extends Model
{
    protected $fillable = [
        'id_villa', 'id_safety', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_safety';
    protected $primaryKey = 'id_detail';

    // *Relationship
    public function safety()
    {
        return $this->belongsTo(Safety::class, 'id_safety', 'id_safety');
    }
}
