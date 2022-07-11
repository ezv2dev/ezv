<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScenicViews extends Model
{
    protected $table = 'scenic_views';
    protected $primaryKey = 'id_scenic_views';

    protected $fillable = ['name'];
}
