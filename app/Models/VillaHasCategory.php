<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaHasCategory extends Model
{
    protected $fillable = [
        'id_villa', 'id_villa_category', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'villa_has_category';

    // * Relationship
    public function villaCategory()
    {
        return $this->belongsTo(VillaCategory::class, 'id_villa_category', 'id_villa_category');
    }
}
