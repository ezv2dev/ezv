<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestSafety extends Model
{
    protected $fillable = [
        'id_type',
        'guest_safety',
        'description',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'guest_safety';
    protected $primaryKey = 'id_guest_safety';

    // * Relationship
    public function guestSafetyType()
    {
        return $this->belongsTo(GuestSafetyType::class, 'id_type', 'id_type');
    }

    public function villa()
    {
        return $this->belongsToMany(GuestSafety::class, 'villa_has_guest_safety', 'id_guest_safety', 'id_villa', 'id_guest_safety', 'id_villa');
    }

    public function restaurant()
    {
        return $this->belongsToMany(GuestSafety::class, 'restaurant_has_guest_safety', 'id_guest_safety', 'id_restaurant', 'id_guest_safety', 'id_restaurant');
    }

    public function activity()
    {
        return $this->belongsToMany(GuestSafety::class, 'activity_has_guest_safety', 'id_guest_safety', 'id_activity', 'id_guest_safety', 'id_activity');
    }
}
