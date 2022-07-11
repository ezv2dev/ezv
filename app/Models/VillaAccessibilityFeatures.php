<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaAccessibilityFeatures extends Model
{
    protected $table = 'villa_accessibility_features';
    protected $primaryKey = 'id_accessibility_features';

    protected $fillable = ['name'];
}
