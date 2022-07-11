<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorHasCategory extends Model
{
    protected $fillable = [
        'id_collab', 'id_collab_category', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    protected $table = 'collaborator_has_category';

    // * Relationship
    public function collaboratorCategory()
    {
        return $this->belongsTo(CollaboratorCategory::class, 'id_collab_category', 'id_collab_category');
    }
}
