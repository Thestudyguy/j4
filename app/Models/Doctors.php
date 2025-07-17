<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    //
    protected $fillable = [
        'FirstName',
        'LastName',
        'MiddleName',
        'Suffix',
        'MDLink',
        'NameExtensions',
        'image_path'
    ];
}
