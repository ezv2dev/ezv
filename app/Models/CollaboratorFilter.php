<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorFilter extends Model
{
    protected $fillable = [
        'icon', 'name',
    ];

    protected $table = 'collaborator_filter';
    protected $primaryKey = 'id_collab_filter';
}
