<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $fillable = [
        'patient_id',
        'appointment_id',
        'date',
        'time',
        'doctor_id',
        'service_id',
        'appointment_status',
        
    ];
}
