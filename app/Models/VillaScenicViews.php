<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaScenicViews extends Model
{
    protected $table = 'villa_scenic_views';
    protected $primaryKey = 'id_detail';

    protected $fillable = ['id_villa', 'id_scenic_views'];
}
