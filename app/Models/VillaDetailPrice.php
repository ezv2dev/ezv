<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaDetailPrice extends Model
{
    protected $fillable = [
        'id_villa', 'start', 'end', 'price', 'disc' , 'created_by', 'updated_by'
    ];

    protected $table = 'villa_detail_price';
    protected $primaryKey = 'id_detail';

}
