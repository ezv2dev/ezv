<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaBedroom extends Model
{
    protected $fillable = [
        'id_villa', 'id_bedroom', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_bedroom';
    protected $primaryKey = 'id_detail';

    // * Relationship
    public function bedroom()
    {
        return $this->belongsTo(BedRoom::class, 'id_bedroom', 'id_bed');
    }
}
