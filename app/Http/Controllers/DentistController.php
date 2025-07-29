<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class DentistController extends Controller
{
    //
    public function DentistBoard()
{
    if (Auth::user()->Role !== 'Dentist') {
        abort(403, 'Unauthorized');
    }

    try {
        $doctorID = Auth::user()->id;
        Log::info($doctorID);
        $appointments = Appointment::where('appointments.doctor_id', $doctorID)
            ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
            ->join('users', 'users.id', '=', 'appointments.patient_id')
            ->join('doctors', 'doctors.user_id', '=', 'users.id')
            ->select(
                'appointments.id as appointment_id',
                'appointments.date',
                'appointments.time',
                'appointments.status',
                'users.FirstName',
                'users.LastName',
                'sub_services.Service'
            )
            ->get();
            $test = DB::table('doctors')
            ->join('users', 'users.id', '=', 'doctors.user_id')
            ->join('appointments', 'appointments.doctor_id', '=', 'doctors.id')
            // ->join('patient_info', 'patient_info.id', '=', 'appointments.patient_id')
            // ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
            ->get();
            $doctorsAppointments = DB::table('doctors')
            ->where('doctors.user_id', $doctorID)
            ->join('appointments', 'appointments.doctor_id', '=', 'doctors.id')
            ->join('patient_info', 'patient_info.patient_id', '=', 'appointments.patient_id')
            ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
            ->get();
            $count = count($appointments);
            $testCount = count($test);
            Log::info(json_encode($doctorsAppointments, JSON_PRETTY_PRINT));

        return view('pages.dentist.dentist-interface', compact('appointments', 'count', 'test', 'testCount', 'doctorsAppointments'));

    } catch (\Throwable $th) {
        throw $th;
    }
}

}
