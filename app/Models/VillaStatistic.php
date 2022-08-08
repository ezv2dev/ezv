<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillaStatistic extends Model
{
    use HasFactory;

    protected $table = 'villa_statistic';
    protected $primaryKey = 'id_villa_statistic';

    protected $fillable = [
        'id_villa',
        'villa_views',
        'video_views',
        'photo_views',
        'month',
        'year',
        'created_at',
        'updated_at'
    ];

    // * Relationship
    public function villaStatistic()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
}
