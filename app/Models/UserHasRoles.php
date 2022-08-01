<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasRoles extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'is_super_admin',
        'is_admin',
        'is_owner',
        'is_user',
        'is_collaborator'
    ];

    protected $table = 'user_has_roles';
}
