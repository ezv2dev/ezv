<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancellationPolicy extends Model
{
    protected $fillable = [
        'id_villa',
        'type_cancellation',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'cancellation_policy';
    protected $primaryKey = 'id_cancellation_policy';

    // * Relationship
    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
}
