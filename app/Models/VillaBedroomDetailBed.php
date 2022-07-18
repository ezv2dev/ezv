<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillaBedroomDetailBed extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_villa_bedroom_detail',
        'id_bed',
        'qty',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    protected $table = 'villa_bedroom_detail_bed';
    protected $primaryKey = 'id_villa_bedroom_detail_bed';

    // * Relationship
    public function villaBedroomDetail() {
        return $this->belongsTo(VillaBedroomDetail::class, 'id_villa_bedroom_detail', 'id_villa_bedroom_detail');
    }
    public function bed() {
        return $this->belongsTo(Bed::class, 'id_bed', 'id_bed');
    }
}
