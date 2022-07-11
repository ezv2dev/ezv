<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorAvailability extends Model
{
    protected $fillable = [
        'id_collab', 'date', 'created_by', 'updated_by', 'text', 'color'
    ];

    protected $table = 'collaborator_availability';
    protected $primaryKey = 'id_collab_availability';
}
