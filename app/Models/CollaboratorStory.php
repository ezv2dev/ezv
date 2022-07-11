<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorStory extends Model
{
    protected $fillable = [
        'title', 'name', 'id_collab'
    ];

    protected $table = 'collaborator_story';
    protected $primaryKey = 'id_story';

    public function collab()
    {
        return $this->belongsTo(Collaborator::class, 'id_collab', 'id_collab');
    }
}
