<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Activity;

class ActivitySave extends Model
{
    protected $table = 'activity_save';
    protected $primaryKey = 'id_activitysave';

    protected $fillable = [
        'id_activity',
        'id_user',
        'created_by',
        'updated_by'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'id_activity', 'id_activity');
    }
}
