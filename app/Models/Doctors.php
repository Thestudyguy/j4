<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    //
    protected $fillable = [
        'ProfessionalTitle',
        'FirstName',
        'LastName',
        'MiddleName',
        'Suffix',
        'MDLink',
        'AreaOfExpertise',
        'NameExtensions',
        'image_path'
    ];
}
