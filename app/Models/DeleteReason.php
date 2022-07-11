<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeleteReason extends Model
{
    protected $table = 'delete_reason';
    protected $primaryKey = 'id_delete_reason';

    protected $fillable = ['reason', 'id_user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
