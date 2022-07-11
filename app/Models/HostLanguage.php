<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostLanguage extends Model
{
    protected $table = 'host_language';
    protected $primaryKey = 'id_host_language';

    protected $fillable = ['locale','name'];
}
