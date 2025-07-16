<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sub_services extends Model
{
    protected $fillable =[
        'Service',
        'Price',
        'Description',
        'image_path',
        'parent_service'
    ];
}
