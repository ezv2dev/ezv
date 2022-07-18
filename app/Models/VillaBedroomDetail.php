<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillaBedroomDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_villa',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    protected $table = 'villa_bedroom_detail';
    protected $primaryKey = 'id_villa_bedroom_detail';

    // * Relationship
    public function villa() {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
    public function villaBedroomDetailBed() {
        return $this->hasMany(VillaBedroomDetailBed::class, 'id_villa_bedroom_detail', 'id_villa_bedroom_detail');
    }
    public function villaBedroomDetailBedroomAmenities() {
        return $this->belongsToMany(BedRoom::class, 'villa_bedroom_detail_has_bedroom_amenities', 'id_villa_bedroom_detail', 'id_bedroom', 'id_villa_bedroom_detail', 'id_bed');
    }
    public function villaBedroomDetailBathroomAmenities() {
        return $this->belongsToMany(BathRoom::class, 'villa_bedroom_detail_has_bathroom_amenities', 'id_villa_bedroom_detail', 'id_bathroom', 'id_villa_bedroom_detail', 'id_bathroom');
    }

    // *attribute
    public function getBedCountAttribute() {
        $count = 0;
        if($this->villaBedroomDetailBed){
            for ($i=0; $i < $this->villaBedroomDetailBed->count(); $i++) {
                $count = $count + $this->villaBedroomDetailBed[$i]->qty;
            }
        }
        return $count;
    }
}
