<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cleanliness', 'service', 'check_in', 'location', 'value', 'comment', 'id_villa'
    ];

    protected $table = 'villa_review';
    protected $primaryKey = 'id_review';
}
