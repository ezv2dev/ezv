<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityPriceStory extends Model
{
    protected $fillable = [
        'title', 'name', 'id_price', 'id_activity', 'created_by', 'updated_by'
    ];

    protected $table = 'activity_price_story';
    protected $primaryKey = 'id_story';

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'id_activity');
    }
}
