<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'symbol', 'currency'
    ];

    protected $table = 'currency';
    protected $primaryKey = 'id_currency';
}
