<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantStory extends Model
{
    protected $fillable = [
        'title', 'name', 'id_restaurant', 'thumbnail', 'created_by', 'updated_by'
     ];

     protected $table = 'restaurant_story';
     protected $primaryKey = 'id_story';
}
