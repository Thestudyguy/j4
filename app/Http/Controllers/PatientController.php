<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctors;
use App\Models\PatientHistory;
use App\Models\Patients;
use App\Models\SubService;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Users;
class PatientController extends Controller
{
    public function NewPatient(Request $request)
    {
        Log::info($request->all());
        return response()->json(['message' => 'New patient created successfully!']);

    }

    public function PatientProfile()
    {
        try {
            $subServices = SubService::all();//'isVisible', true put this shit back when we rollback its migration
            $doctors = Doctors::where('isRemoved', false)->get();
            return view('pages.patients.patient-profile', compact('subServices', 'doctors'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function GetVacantTimeSlots(Request $request)
{
    $date = $request->input('date');

    // Define all working hours
    $workingHours = [
    "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM",
    "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM"
];

$bookedTimes = Appointment::whereDate('date', $date)
    ->pluck('time')
    ->toArray();

if (empty($bookedTimes)) {
    $availableSlots = $workingHours; // no bookings yet
} else {
    $availableSlots = array_values(array_diff($workingHours, $bookedTimes));
}


    return response()->json([
        'availableSlots' => $availableSlots
    ]);
}

    public function AppointmentConfirmation(Request $request){
        try {
            $validated = $request->validate([
        'selected_date' => 'required|date',
        'selected_time' => 'required|string',
        'selected_doctor_id' => 'required|exists:doctors,id',
        'selected_service_id' => 'required|exists:sub_services,id',
    ]);

    Appointment::create([
        'patient_id' => auth()->id(),
        'doctor_id' => $validated['selected_doctor_id'],
        'service_id' => $validated['selected_service_id'],
        'date' => $validated['selected_date'],
        'time' => $validated['selected_time'],
    ]);

    User::where('id', Auth::user()->id)->update(['is_set_up_complete' => true]);
        // return redirect()->route('appointment-lists')->with('success', 'Appointment booked successfully!');
return response()->json([
    'status' => 'success',
    'redirect' => route('appointment-lists'),
]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function PostAppointmentLoc() {
    try {
        $prepAppointment = DB::table('appointments')
            ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
            ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
            ->join('users', 'users.id', '=', 'appointments.patient_id')
            ->select(
                'doctors.FirstName as dfName',
                'doctors.ProfessionalTitle as title',
                'doctors.LastName as dlname',
                'doctors.MiddleName as dmname',
                'sub_services.Service as service',
                'appointments.Time',
                'appointments.Date',
                'appointments.status'
            )
            ->get();

        return view('pages.patients.appointments', compact('prepAppointment'));
    } catch (\Throwable $th) {
        throw $th;
    }
}

    public function PatientSetUp(Request $request)
    {
        DB::beginTransaction();
        Log::info($request['patient_personal_info']['firstname']);
        $patient_id = Auth::user()->id;
        Log::info($request);
        try {
            // Save Patient data
            $patient = Patients::create([
                'patient_id' => $patient_id,
                'FirstName' => $request['patient_personal_info']['firstname'],
                'LastName' => $request['patient_personal_info']['lastname'],
                'MiddleName' => $request['patient_personal_info']['middlename'],
                'BirthDate' => $request['patient_personal_info']['birthdate'],
                'Gender' => $request['patient_personal_info']['sex'],
                'Age' => $request['patient_personal_info']['age'],
                'Religion' => $request['patient_personal_info']['religion'],
                'Nationality' => $request['patient_personal_info']['nationality'],
                'NickName' => $request['patient_personal_info']['nickname'],
                'Address' => $request['patient_personal_info']['address'],
                'HomeNo' => $request['patient_personal_info']['homeno'],
                'Occupation' => $request['patient_personal_info']['occupation'],
                'OfficeNo' => $request['patient_personal_info']['officeno'],
                'FaxNo' => $request['patient_personal_info']['faxno'],
                'EffectiveDate' => $request['patient_personal_info']['effectivedate'],
                'Email' => $request['patient_personal_info']['email'],
                'MobileNo' => $request['patient_personal_info']['mobileno'],
                'Guardian' => $request['patient_personal_info']['guardian'],
                'GuardianOccupation' => $request['patient_personal_info']['guardianoccupation'],
                'Referal' => $request['patient_personal_info']['referal'],
                'ReasonForVisit' => $request['patient_personal_info']['consultationreason'],
            ]);

            // Save Patient History
            $medicalRaw = $request['patient_med_history']['basic_info'];
        $medData = [];

        foreach ($medicalRaw as $item) {
            $medData[$item['name']] = $item['value'];
        }

        // Extract allergies and illnesses
        $allergies = $request['patient_med_history']['listed_allergies_illness']['Allergies']['list'] ?? [];
        $allergyOther = $request['patient_med_history']['listed_allergies_illness']['Allergies']['otherDetails'] ?? null;

        $illnesses = $request['patient_med_history']['listed_allergies_illness']['Illnesses']['list'] ?? [];
        $illnessOther = $request['patient_med_history']['listed_allergies_illness']['Illnesses']['otherDetails'] ?? null;

        // Save Patient History
        $history = PatientHistory::create([
            'patient_id' => $patient_id, // Use patient table's ID (not auth user)
            'previous_dentist' => $medData['previousdentist'] ?? null,
            'last_visit' => $medData['lastvisit'] ?? null,
            'physician_name' => $medData['physician'] ?? null,
            'physician_specialty' => $medData['specialty'] ?? null,
            'physician_office_address' => $medData['officeaddress'] ?? null,
            'physician_office_no' => $medData['officeno'] ?? null,
            'good_health' => $medData['goodhealth'] ?? null,
            'uses_drugs' => $medData['alcohol'] ?? null,
            'under_medical_care' => $medData['medicalcondition'] ?? null,
            'medical_condition_text' => $medData['medicalconditiontext'] ?? null,
            'pregnant' => $medData['isPregnant'] ?? null,
            'hospitalized' => $medData['hospital'] ?? null,
            'hospitalization_details' => $medData['hospitaltext'] ?? null,
            'taking_birth_control' => $medData['isOnBithControl'] ?? null,
            'taking_medications' => $medData['prescription'] ?? null,
            'medications_details' => $medData['prescriptiontext'] ?? null,
            'using_tobacco' => $medData['isClientASmokeWhack'] ?? null,
            'nursing' => $medData['isClientNursing'] ?? null,
            'allergy' => json_encode($allergies),
            'allergy_others' => $allergyOther,
            'known_conditions' => json_encode($illnesses),
            'blood_type' => $medData['bloodType'] ?? null,
            'blood_pressure' => $medData['bloodPressure'] ?? null,
        ]);
            User::where('id', $patient_id)->update(['is_first_login' => false]);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Patient and history saved successfully!',
                'patient' => $patient,
                'history' => $history
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }


}
