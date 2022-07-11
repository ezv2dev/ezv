<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = "owner_profile";

    protected $primaryKey = "id_profile";

    protected $fillable = [
        'user_id' , 'about' , 'location', 'work',
    ];
}
