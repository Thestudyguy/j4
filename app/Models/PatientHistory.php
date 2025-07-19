<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    //
    protected $fillable = [
        'PreviousDentist',
        'LastVisit',
        'Physician',
        'AreaOfExpertise',
        'PhysicianOfficeAddress',
        'PhysicianOfficeNo',
        'IsPatientInGoodHealth',
        'IsPatientInDrugs',
        'PatientHadSurgery',
        'IsPatientInPregnant',
        'PatientHadHospitalized',
        'IsPatientInAnyPrescriptionMedicine',
        'IsPatient_A_SmokeWhack',
        'IsPatientInNursing',//dunno what that means
        'PatientBloodType',
        'PatientBloodPressure',
    ];
}
