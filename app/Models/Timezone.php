<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    protected $table = 'timezone';
    protected $primaryKey = 'id_timezone';

    protected $fillable = ['name', 'offset', 'diff_from_gtm'];
}
