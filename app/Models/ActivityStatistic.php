<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityStatistic extends Model
{
    use HasFactory;

    protected $table = 'activity_statistic';
    protected $primaryKey = 'id_activity_statistic';

    protected $fillable = [
        'id_activity',
        'activity_views',
        'video_views',
        'photo_views',
        'month',
        'year',
        'created_at',
        'updated_at'
    ];

    // * Relationship
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'id_activity', 'id_activity');
    }
}
