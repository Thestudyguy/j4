<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    //
    protected $fillable = [
        'user_id',
        'ProfessionalTitle',
        'FirstName',
        'LastName',
        'MiddleName',
        'Email',
        'Suffix',
        'MDLink',
        'AreaOfExpertise',
        'NameExtensions',
        'image_path'
    ];
}
