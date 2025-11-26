<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\FollowUpCheckupMail;
use App\Models\Appointment;
use App\Models\Doctors;
use App\Models\Inventory;
use App\Models\opt_notes;
use App\Models\PatientHistory;
use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
        $appointments = Appointment::where('appointments.doctor_id', $doctorID)
        ->join('doctors', 'doctors.user_id', '=', 'appointments.doctor_id')    
        ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
        ->join('patient_info','patient_info.id','=','appointments.patient_id')
        ->join('users','users.id','=','doctors.user_id')
            ->select(
                'appointments.id as appointment_id',
                'appointments.date',
                'appointments.time',
                'appointments.status',
                'patient_info.FirstName',
                'patient_info.LastName',
                'sub_services.Service',
            )
            ->get();

            $test = DB::table('doctors')
            ->join('users', 'users.id', '=', 'doctors.user_id')
            ->join('appointments', 'appointments.doctor_id', '=', 'doctors.id')
            ->get();
            // $doctorsAppointments = DB::table('doctors')
            // ->where('doctors.user_id', $doctorID)
            // ->join('appointments', 'appointments.doctor_id', '=', 'doctors.id')
            // ->join('patient_info', 'patient_info.patient_id', '=', 'appointments.patient_id')
            // ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
            // ->get();
            $count = count($appointments);
            $testCount = count($test);
            
            
            $dentistAppointments = DB::table('doctors')
            ->where('doctors.user_id', $doctorID)
            ->join('appointments', 'appointments.doctor_id','=','doctors.id')
            ->join('patient_info', 'patient_info.id','=','appointments.patient_id')
            ->join('sub_services', 'sub_services.id','=','appointments.service_id')
            ->leftJoin('opt_notes','opt_notes.appointment','=','appointments.id')
            ->select(
                'doctors.ProfessionalTitle as title', 'doctors.Firstname as dfName', 'doctors.LastName as dlname',
                'appointments.id',
                'appointments.date as Date',
                'appointments.time as Time',
                'appointments.status',
                'appointments.patient_id',
                'patient_info.FirstName',
                'patient_info.Email',
                'patient_info.LastName',
                'patient_info.id as refID',
                'sub_services.Service as service',
                'opt_notes.Date as note_date', 'opt_notes.Tooth','opt_notes.Procedure','opt_notes.AmountCharge','opt_notes.AmountPaid','opt_notes.Balance', 'PostOpNotes', 'ImportantNotes', 'opt_notes.id as note_id'
            )
            ->where('appointments.status', '!=', 'archive')
            ->get();
            Log::info($dentistAppointments->toArray());
            $statusCounts = DB::table('appointments')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->where('status', '!=', 'archive')
            ->where('doctor_id', function($query) use ($doctorID) {
                $query->select('id')->from('doctors')->where('user_id', $doctorID);
            })
            ->groupBy('status')
            ->pluck('total', 'status'); // returns associative array: ['completed' => 10, 'pending' => 5, ...]
            $inventoryItems = Inventory::where('isVisible', true)->get();
            Log::info(json_encode($statusCounts, JSON_PRETTY_PRINT));
            
            $dentist = Doctors::where('user_id', $doctorID)->firstOrFail();
        return view('pages.dentist.dentist-interface', compact('appointments', 'count', 'test', 'statusCounts', 'testCount', 'dentistAppointments', 'inventoryItems', 'dentist'));

    } catch (\Throwable $th) {
        throw $th;
    }
}

    public function CreateNotes(Request $request)
{
    try {
        $appointmentId = $request->input('appointment-id');
        $dentistId = $request->input('dentist-id');

        // Create the note
        $notesId = DB::table('patient_appointment_notes')->insertGetId([
            'appointment_id' => $appointmentId,
            'date'        => $request->input('date'),
            'dentist'     => $dentistId,
            'note'        => $request->input('note'),
        ]);

        // Fetch raw appointment, patient, and dentist data
        $appointmentData = DB::table('appointments as a')
            ->join('patient_info as p', 'a.patient_id', '=', 'p.id')
            ->join('doctors as d', 'a.doctor_id', '=', 'd.id')
            ->select(
                'a.id as appointment_id',
                'a.date as appointment_date',
                'a.time as appointment_time',
                'p.FirstName as patient_firstname',
                'p.LastName as patient_lastname',
                'p.Email as patient_email',
                'p.MobileNo as patient_mobile',
                'd.FirstName as doctor_firstname',
                'd.LastName as doctor_lastname',
                'd.ProfessionalTitle as doctor_title',
                'd.email as doctor_email'
            )
            ->where('a.id', $appointmentId)
            ->first();

        // Send email if patient email exists
        if ($appointmentData->patient_email) {
            Mail::to($appointmentData->patient_email)->send(new FollowUpCheckupMail([
                'appointment' => $appointmentData,
                'note_id'     => $notesId,
            ]));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Notes successfully created and email sent',
            'data' => $notesId
        ], 201);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => 'error',
            'message' => $th->getMessage()
        ], 500);
    }
}
public function PatientMedicalHistory(Request $request){
    try {
        $patientID = $request->id;
        $prepPatient = Patients::where('id', $patientID)->first();
        $patientHistory = PatientHistory::where('patient_id', $prepPatient->id)->first();
        return view('pages.patients.patient-profile-medical-history', [
    'patientHistory' => $patientHistory,
    'patientInfo' => $prepPatient
]);
    } catch (\Throwable $th) {
        throw $th;
    }
}

}
