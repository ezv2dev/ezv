<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorLanguage extends Model
{
    protected $fillable = [
        'id_collab', 'id_language'
    ];

    protected $table = 'collaborator_language';
    // protected $primaryKey = 'id_detail';

    public function language()
    {
        return $this->belongsTo(HostLanguage::class, 'id_language', 'id_host_language');
    }
}
