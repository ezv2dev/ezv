<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailReview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_villa', 'average', 'count_person', 'average_clean', 'average_service', 'average_check_in', 'average_location', 'average_value'
    ];

    protected $table = 'detail_review';
    protected $primaryKey = 'id_detail';
}
