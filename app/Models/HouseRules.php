<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseRules extends Model
{
    protected $fillable = [
        'id_villa',
        'children',
        'infants',
        'pets',
        'smoking',
        'events',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'house_rules';
    protected $primaryKey = 'id_house_rules';

    // * Relationship
    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
}
