<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collaborator extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_collab', 'uid', 'grade', 'description', 'short_description', 'id_location', 'address', 'latitude', 'longitude', 'phone', 'email', 'price', 'discount', 'image', 'status', 'views', 'created_by', 'updated_by'
    ];

    protected $table = 'collaborator';
    protected $primaryKey = 'id_collab';

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function collaboratorHasCategory()
    {
        return $this->hasMany(CollaboratorHasCategory::class, 'id_collab', 'id_collab');
    }

    public function collaboratorHasFilter()
    {
        return $this->hasMany(CollaboratorHasFilter::class, 'id_collab', 'id_collab');
    }

    public function collaboratorSocial()
    {
        return $this->hasOne(CollaboratorSocialMedia::class, 'id_collab', 'id_collab');
    }
}
