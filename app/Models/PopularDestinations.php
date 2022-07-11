<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopularDestinations extends Model
{
    protected $table = 'popular_destinations';

    protected $primaryKey = 'id_popular_destinations';

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location');
    }
}
