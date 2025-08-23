<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }
    protected $table = 'patient_info';
    protected $fillable = [
        'patient_id',
        'FirstName',
        'LastName',
        'MiddleName',
        'BirthDate',
        'Gender',
        'Age',
        'Religion',
        'Nationality',
        'NickName',
        'Address',
        'HomeNo',
        'Occupation',
        'OfficeNo',
        'EffectiveDate',
        'FaxNo',
        'Email',
        'MobileNo',
        'Guardian',
        'GuardianOccupation',
        'Referal',
        'ReasonForVisit',
    ];
}
