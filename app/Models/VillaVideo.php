<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaVideo extends Model
{
    protected $fillable = [
        'name', 'id_villa', 'thumbnail', 'created_by', 'updated_by', 'order'
    ];

    protected $table = 'villa_video';
    protected $primaryKey = 'id_video';

    public function getMediaTypeAttribute()
    {
        return 'video';
    }
    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
}
