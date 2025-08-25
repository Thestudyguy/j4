<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    //
    protected $table = 'patient_history';

     protected $fillable = [
        'patient_id',
        'previous_dentist',
        'last_visit',

        'physician_name',
        'physician_specialty',
        'physician_office_address',
        'physician_office_no',

        'good_health',
        'uses_drugs',
        'under_medical_care',
        'medical_condition_text',

        'pregnant',
        'hospitalized',
        'hospitalization_details',
        'taking_birth_control',
        'taking_medications',
        'medications_details',
        'using_tobacco',
        'nursing',

        'allergy',
        'allergy_others',

        'known_conditions',

        'blood_type',
        'blood_pressure',
    ];

    protected $casts = [
        'known_illnesses' => 'array', // JSON field
        'good_health',
        'uses_drugs',
        'under_medical_care',
        'pregnant',
        'hospitalized',
        'had_surgery',
        'taking_birth_control',
        'taking_medications',
        'using_tobacco',
        'nursing',
        'allergy',
    ];
}
