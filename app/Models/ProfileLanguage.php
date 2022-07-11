<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileLanguage extends Model
{
    protected $table = 'owner_profile_language';

    protected $primaryKey = "id_profile_language";

    protected $fillable = [
        'user_id', 'language'
    ];
}
