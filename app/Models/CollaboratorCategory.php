<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorCategory extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'collaborator_category';
    protected $primaryKey = 'id_collab_category';
}
