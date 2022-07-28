<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaboratorReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'experience',
        'comment',
        'id_collab',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $table = 'collaborator_review';
    protected $primaryKey = 'id_review';
}
