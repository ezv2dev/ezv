<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaAccessibilitiyFeaturesDetail extends Model
{
    protected $table = 'villa_accessibility_features_detail';
    protected $primaryKey = 'id_detail_accessibility_features';

    protected $fillable = ['id_accessibility_features', 'name'];
}
