<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billings extends Model
{
    //
    protected $fillable = [
        'appointmentID', 'item', 'itemID', 'itemPrice', 'quantity'
    ];
}
