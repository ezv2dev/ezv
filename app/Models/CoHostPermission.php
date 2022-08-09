<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoHostPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_co_host_permission', 'id_detail', 'listing', 'reservation', 'calendar', 'statistic', 'finance', 'inbox', 'collaboration'
     ];

     protected $table = 'co_host_permission';
     protected $primaryKey = 'id_co_host_permission';
}
