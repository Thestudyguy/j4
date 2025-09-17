<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class opt_notes extends Model
{
    //
    protected $table = "opt_notes";
    protected $fillable = [
        "appointment",
        "dentist",
        "Date",
        "Tooth",
        "Procedure",
        "AmountCharge",
        "AmountPaid",
        "Balance",
        "PostOpNotes",
        "ImportantNotes",
    ];
}
