<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaboratorSave extends Model
{
    use HasFactory;

    protected $table = 'collaborator_save';
    protected $primaryKey = 'id_collaboratorsave';

    protected $fillable = [
        'id_collab',
        'id_user',
        'created_by',
        'updated_by'
    ];

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class, 'id_collab', 'id_collab');
    }
}
