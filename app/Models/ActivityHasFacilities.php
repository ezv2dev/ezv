<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityHasFacilities extends Model
{
    protected $table = 'activity_has_facilities';

    protected $fillable = ['id_activity', 'id_facilities', 'created_by', 'updated_by'];
}
