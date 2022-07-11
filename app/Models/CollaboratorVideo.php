<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorVideo extends Model
{
    protected $fillable = [
        'name', 'id_collab', 'created_by', 'updated_by', 'order'
    ];

    protected $table = 'collaborator_video';
    protected $primaryKey = 'id_video';

    public function getMediaTypeAttribute()
    {
        return 'video';
    }
    public function collab()
    {
        return $this->belongsTo(Collaborator::class, 'id_collab', 'id_collab');
    }
}
