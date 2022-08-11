<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        "external_id",
        "payment_channel",
        "price",
        "status",
        "created_at",
        "updated_at"
    ];

    protected $table = 'payment';
    protected $primaryKey = 'id_payment';
}
