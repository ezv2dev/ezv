<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityReview extends Model
{
    protected $fillable = [
        'experience',
        'comment',
        'id_activity',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'activity_review';
    protected $primaryKey = 'id_review';
}
