<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientPayments extends Model
{
    //
    protected $fillable = ['amount_paid', 'patient_id'];
}
