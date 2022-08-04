<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'external_id', 'id_user', 'payment_channel', 'bank', 'va_number','name', 'email', 'price', 'status'
    ];

    protected $table = 'payment';
    protected $primaryKey = 'id_payment';
}
