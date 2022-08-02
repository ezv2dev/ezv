<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelReview extends Model
{
    protected $fillable = [
        'cleanliness',
        'service',
        'check_in',
        'location',
        'value',
        'comment',
        'id_hotel',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'hotel_review';
    protected $primaryKey = 'id_review';

    // * relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
