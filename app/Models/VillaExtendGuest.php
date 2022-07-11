<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaExtendGuest extends Model
{
    protected $table = 'villa';

    protected $primaryKey = 'id_villa';

    protected $fillable = [
        'price', 'id_villa'
    ];

    public function villa()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }
}
