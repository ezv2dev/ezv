<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaPhoto extends Model
{
    protected $fillable = [
        'name', 'id_villa', 'order', 'caption', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_photo';
    protected $primaryKey = 'id_photo';

    public function getMediaTypeAttribute()
    {
        return 'photo';
    }
}
