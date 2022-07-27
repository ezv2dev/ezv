<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaboratorDetailReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'average_experience',
        'average',
        'count_person',
        'id_collab',
        'created_at',
        'updated_at'
    ];

    protected $table = 'collaborator_detail_review';
    protected $primaryKey = 'id_detail';
}
