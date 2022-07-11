<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityStory extends Model
{
    protected $fillable = [
        'title', 'name', 'id_activity', 'created_by', 'updated_by'
    ];

    protected $table = 'activity_story';
    protected $primaryKey = 'id_story';
}
