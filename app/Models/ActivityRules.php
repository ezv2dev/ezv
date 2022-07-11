<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityRules extends Model
{
    protected $fillable = [
        'id_activity',
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

    protected $table = 'activity_rules';
    protected $primaryKey = 'id_activity_rules';

    // * Relationship
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'id_activity', 'id_activity');
    }
}
