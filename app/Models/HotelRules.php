<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRules extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_hotel',
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

    protected $table = 'hotel_rules';
    protected $primaryKey = 'id_hotel_rules';

    // * Relationship
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }
}
