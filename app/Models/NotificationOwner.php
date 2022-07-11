<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationOwner extends Model
{
    protected $table = 'notification_owner';
    protected $primaryKey = 'id_notification';

    protected $fillable = ['id_user', 'message', 'created_at', 'updated_at'];
}
