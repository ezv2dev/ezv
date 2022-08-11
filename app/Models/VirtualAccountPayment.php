<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualAccountPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_payment",
        "id_user",
        "bank",
        "name",
        "email",
        "va_number",
        "paid_at",
        "created_at",
        "updated_at"
    ];

    protected $table = 'virtual_account_payment';
    protected $primaryKey = 'id_va';
}
