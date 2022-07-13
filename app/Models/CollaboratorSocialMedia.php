<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaboratorSocialMedia extends Model
{
    protected $fillable = [
        'id_collab_social',
        'id_collab',
        'instagram_name',
        'instagram_follower',
        'facebook_name',
        'facebook_follower',
        'twitter_name',
        'twitter_follower',
        'tiktok_name',
        'tiktok_follower',
    ];

    protected $table = 'collaborator_social_media';
    protected $primaryKey = 'id_collab_social';

    public function collab()
    {
        return $this->belongsTo(Collaborator::class, 'id_collab', 'id_collab');
    }
}
