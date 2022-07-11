<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorPhoto extends Model
{
    protected $fillable = [
        'name', 'id_collab', 'order', 'created_by', 'updated_by'
    ];

    protected $table = 'collaborator_photo';
    protected $primaryKey = 'id_photo';

    public function getMediaTypeAttribute()
    {
        return 'photo';
    }
}
