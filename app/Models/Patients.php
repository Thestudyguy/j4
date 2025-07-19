<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    //
    protected $fillable = [
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
