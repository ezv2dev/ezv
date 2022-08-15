<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillaEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_enquiry', 'id_villa', 'adult', 'child', 'infant', 'pet', 'check_in', 'check_out', 'id_user'
    ];

    protected $table = 'villa_enquiry';
    protected $primaryKey = 'id_enquiry';
}
