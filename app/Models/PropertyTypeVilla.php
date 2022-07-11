<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyTypeVilla extends Model
{
    protected $table = 'villa_property_type';
    protected $primaryKey = 'id_property_type';

    protected $fillable = ['name', 'icon', 'created_at', 'updated_at', 'created_by', 'updated_by'];
}
