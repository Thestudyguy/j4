<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctors;
use App\Models\Inventory;
use App\Models\opt_notes;
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
        
        Log::info($request['appointment-id']);
        $notes = opt_notes::create([
            'appointment'            => $request->input('appointment-id'),
            'Date'            => $request->input('date'),
            'dentist'      => $request->input('dentist-id'),
            'Tooth'           => $request->input('tooth'),
            'Procedure'       => $request->input('procedure'),
            'AmountCharge' => str_replace(',', '', $request->input('amount_charge') ?? 0),
            'AmountPaid'     =>  str_replace(',', '', $request->input('amount_paid') ?? 0),
            'Balance'         =>  str_replace(',', '', $request->input('balance') ?? 0),
            'PostOpNotes'   => $request->input('post_op_notes'),
            'ImportantNotes' => $request->input('important_notes'),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Notes successfully created',
            'data'    => $notes
        ], 201);

    } catch (\Throwable $th) {
        return response()->json([
            'status'  => 'error',
            'message' => $th->getMessage()
        ], 500);
    }
}


}
