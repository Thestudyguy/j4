<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }
    protected $fillable = [
        'patient_id',
        'appointment_id',
        'date',
        'time',
        'doctor_id',
        'service_id',
        'appointment_status',
        'is_walk_in',
        'created_by',
        'status',
        'amount_paid',
        'mark_by',
        
    ];
}
