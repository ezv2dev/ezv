<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaStory extends Model
{
    protected $fillable = [
        'title', 'name', 'id_villa', 'thumbnail'
    ];

    protected $table = 'villa_story';
    protected $primaryKey = 'id_story';

    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
}
