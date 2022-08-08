<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoHost extends Model
{
    use HasFactory;

    protected $fillable = [
       'id_detail', 'id_host', 'id_co_host'
    ];

    protected $table = 'co_host';
    protected $primaryKey = 'id_detail';
}
