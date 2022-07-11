<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityHasSubcategory extends Model
{
    protected $table = 'activity_has_subcategory';
    protected $fillable = ['id_activity', 'id_subcategory', 'created_by', 'updated_by'];
}
