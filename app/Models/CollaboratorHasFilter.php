<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorHasFilter extends Model
{
    protected $fillable = [
        'id_collab', 'id_collab_filter', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'collaborator_has_filter';

    // * Relationship
    public function collaboratorFilter()
    {
        return $this->belongsTo(CollaboratorFilter::class, 'id_collab_filter', 'id_collab_filter');
    }
}
