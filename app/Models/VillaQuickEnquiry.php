<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillaQuickEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in',
        'check_out',
        'adult',
        'child',
        'additional_information',
        'first_name',
        'last_name',
        'email_sender',
        'email_receiver',
        'phone',
        'created_at',
        'updated_at',
    ];

    protected $table = 'villa_quick_enquiry';
    protected $primaryKey = 'id_quick_enquiry';
}
