<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class PatientController extends Controller
{
    public function NewPatient(Request $request)
    {
        Log::info($request->all());

        return response()->json(['message' => 'New patient created successfully!']);

    }
}
