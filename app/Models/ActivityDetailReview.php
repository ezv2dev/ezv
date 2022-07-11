<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityDetailReview extends Model
{
    protected $fillable = [
        'average_experience',
        'average',
        'count_person',
        'id_activity',
        'created_at',
        'updated_at'
    ];

    protected $table = 'activity_detail_review';
    protected $primaryKey = 'id_detail';
}
