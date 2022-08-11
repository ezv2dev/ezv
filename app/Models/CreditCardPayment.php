<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCardPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_payment",
        "id_user",
        "name",
        "email",
        "card_brand",
        "masked_card_number",
        "id_charge",
        "paid_at",
        "created_at",
        "updated_at"
    ];

    protected $table = 'credit_card_payment';
    protected $primaryKey = 'id_cc';
}
