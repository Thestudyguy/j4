<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailAppointmentToPatient;
use App\Mail\MailPatientAccount;
use App\Models\Appointment;
use App\Models\Doctors;
use App\Models\PatientHistory;
use App\Models\Patients;
use App\Models\SubService;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mail;
use Users;

class PatientController extends Controller
{
    public function NewPatient(Request $request)
    {
        Log::info($request->all());

        return response()->json(['message' => 'New patient created successfully!']);

    }

    public function CreateAppointment()
    {
        $subServices = SubService::all();//'isVisible', true put this shit back when we rollback its migration
        $doctors = Doctors::where('isRemoved', false)->get();
        $doctorss = DB::table('doctors')
        ->leftJoin('dentist_off_scheds', 'dentist_off_scheds.dentist_id', '=', 'doctors.id')
        ->select(
            'doctors.id as dentistID',
            'doctors.FirstName',
            'doctors.LastName',
            'doctors.ProfessionalTitle',
            'doctors.MiddleName',
            'doctors.Suffix',
            'doctors.MDLink',
            'doctors.email',
            'doctors.AreaOfExpertise',
            'doctors.image_path',
            'dentist_off_scheds.id as off_sched_id',
            'dentist_off_scheds.date as off_date',
            'dentist_off_scheds.time as off_time',
            'dentist_off_scheds.created_at as off_created',
            'dentist_off_scheds.updated_at as off_updated'
        )
        ->where('doctors.isRemoved', false)
        ->orderBy('doctors.id')
        ->orderBy('dentist_off_scheds.date')
        ->get();
$availableDoctors = [];

foreach ($doctorss as $row) {

    $dentistID = $row->dentistID;

    if (!isset($availableDoctors[$dentistID])) {
        $availableDoctors[$dentistID] = [
            'doctor'    => [
                'dentistID'        => $row->dentistID,
                'FirstName'        => $row->FirstName,
                'LastName'         => $row->LastName,
                'ProfessionalTitle'=> $row->ProfessionalTitle,
                'MiddleName'       => $row->MiddleName,
                'Suffix'           => $row->Suffix,
                'MDLink'           => $row->MDLink,
                'email'            => $row->email,
                'AreaOfExpertise'  => $row->AreaOfExpertise,
                'image_path'       => $row->image_path,
            ],
            'off_sched' => []
        ];
    }

    // Only add off-schedule if it exists
    if ($row->off_sched_id) {
        $availableDoctors[$dentistID]['off_sched'][] = [
            'id'         => $row->off_sched_id,
            'date'       => $row->off_date,
            'time'       => $row->off_time,
            'created_at' => $row->off_created,
            'updated_at' => $row->off_updated
        ];
    }
}
$availableDoctors = array_values($availableDoctors);
        Log::info(json_encode($availableDoctors, JSON_PRETTY_PRINT));
        return view('pages.patients.new-appointment-form', compact('availableDoctors','subServices', 'doctors'));
    }

  public function PatientProfile()
{
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

        $subServices = SubService::all();

        // Get all dentists and their off-schedules raw
        $dentists = DB::table('doctors')
            ->where('isRemoved', false)
            ->get();

        $offSchedules = DB::table('dentist_off_scheds')->get();

        // Combine dentists with their off-schedules
        $availableDoctors = $dentists->map(function ($dentist) use ($offSchedules) {
            // Filter off-schedules for this dentist
            $offs = $offSchedules->filter(function ($off) use ($dentist) {
                return $off->dentist_id == $dentist->id;
            })->map(function ($off) {
                return [
                    'date' => $off->date,
                    'time' => $off->time,
                ];
            })->values(); // reindex array

            return [
                'dentist' => $dentist,
                'off_sched' => $offs,
            ];
        });

        Log::info(json_encode($availableDoctors, JSON_PRETTY_PRINT));

        return view('pages.patients.patient-profile', compact('prepAppointment', 'subServices', 'availableDoctors'));

    } catch (\Throwable $th) {
        throw $th;
    }
}



    public function GetVacantTimeSlots(Request $request)
    {
        $date = $request->input('date');

        $workingHours = [
            "09:00 AM",
            "10:00 AM",
            "11:00 AM",
            "12:00 PM",
            "01:00 PM",
            "02:00 PM",
            "03:00 PM",
            "04:00 PM",
            "05:00 PM"
        ];

        $bookedTimes = Appointment::whereDate('date', $date)
            ->pluck('time')
            ->toArray();

        if (empty($bookedTimes)) {
            $availableSlots = $workingHours;
        } else {
            $availableSlots = array_values(array_diff($workingHours, $bookedTimes));
        }


        return response()->json([
            'availableSlots' => $availableSlots
        ]);
    }

    public function AppointmentConfirmation(Request $request)
{
    try {
        DB::beginTransaction();
        $user = Auth::user();
        Log::info($user->Email);
        $patientID = DB::table('patient_info')
        ->where('patient_id', Auth::user()->id)
        ->first();

        $validated = $request->validate([
            'selected_date' => 'required|date',
            'selected_time' => 'required|string',
            'selected_doctor_id' => 'required|exists:doctors,id',
            'selected_service_id' => 'required|exists:sub_services,id',
        ]);
        // Create appointment record
        $appointment = Appointment::create([
            'user_id' => Auth::user()->id,
            'patient_id' => $patientID->id,
            'doctor_id' => $validated['selected_doctor_id'],
            'service_id' => $validated['selected_service_id'],
            'date' => $validated['selected_date'],
            'time' => $validated['selected_time'],
        ]);

        // Get doctor + patient
        $doctor = DB::table('doctors')
            ->where('id', $validated['selected_doctor_id'])
            ->first();

        

        // Email details
        $details = [
            'firstname'     => $user->FirstName,
            'lastname'      => $user->LastName,
            'refID'         => $appointment->id,
            'doctorName'    => "Dr. {$doctor->FirstName} {$doctor->LastName}",
            'date'          => $validated['selected_date'],
            'time'          => $validated['selected_time'],
            'status'        => 'Pending',
            'clinicName'    => 'J4 Dental Clinic',
            'clinicContact' => '09123456789',
            'arrivalTime'   => 10,
            'portalUrl'     => url('/patient/profile'),
        ];

        // Send email
        Mail::to($patientID->Email)->send(new MailAppointmentToPatient($details));

        // User flags
        User::where('id', $user->id)->update([
            'is_set_up_complete' => true,
            'is_first_login' => false,
        ]);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'redirect' => route('patient-profile'),
        ]);

    } catch (\Throwable $th) {
        DB::rollBack();
        throw $th;
    }
}

    public function PostAppointmentLoc()
    {
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

    public function PatientAppointmentBillings()
{
    try {
        $userID = Auth::user()->id;
        $patient = Patients::where('patient_id', $userID)->first();

        // Fetch raw appointment & billing records
        $appointments = DB::table('appointments as a')
    ->leftJoin('sub_services as s', 's.id', '=', 'a.service_id')
    ->leftJoin('doctors as d', 'd.id', '=', 'a.doctor_id')
    ->leftJoin('patient_info as p', 'p.id', '=', 'a.patient_id')
    ->join('billings as b', 'b.appointmentID', '=', 'a.id')
    ->leftJoin('inventories as i', 'i.id', '=', 'b.itemID')
    ->where('a.patient_id', $patient['id'])
    ->select(
        'a.id as appointment_id',
        'a.date',
        'a.time',
        'a.status',
        'a.created_by',
        'a.amount_paid',
        'a.is_walk_in',

        // Service
        's.Service as service_name',
        's.Price as service_price',

        // Doctor
        'd.id as doctor_id',
        'd.ProfessionalTitle',
        'd.FirstName as doctor_first',
        'd.LastName as doctor_last',
        'd.Suffix as doctor_suffix',
        'd.image_path',

        // Patient
        'p.FirstName as patient_first_name',
        'p.LastName as patient_last_name',

        // Billing
        'b.item',
        'b.itemPrice',
        'b.quantity'
    )
    ->get();

        // Group & format results
        $grouped = $appointments->groupBy('appointment_id')->map(function ($items) {
    $first = $items->first();

    return [

        "appointment_id" => $first->appointment_id,
        "date" => $first->date,
        "time" => $first->time,
        "status" => $first->status,
        "created_by" => $first->created_by,
        "amount_paid" => $first->amount_paid,
        "is_walk_in" => $first->is_walk_in,
        "service_name" => $first->service_name,
        "service_price" => $first->service_price,

        // Patient info
        "patient" => [
            "first_name" => $first->patient_first_name,
            "last_name" => $first->patient_last_name
        ],

        // Doctor info
        "doctor" => [
            "doctor_id" => $first->doctor_id,
            "title" => $first->ProfessionalTitle,
            "first_name" => $first->doctor_first,
            "last_name" => $first->doctor_last,
            "suffix" => $first->doctor_suffix,
            "image" => $first->image_path
        ],

        // Billing items
        "billing_items" => $items->map(function ($i) {
            return [
                "item" => $i->item,
                "price" => $i->itemPrice,
                "quantity" => $i->quantity
            ];
        })->values(),
    ];
});

        Log::info(json_encode($grouped, JSON_PRETTY_PRINT));

        return view('pages.patients.patient-appointment-billings', [
            'appointments' => $grouped
        ]);

    } catch (\Throwable $th) {
        throw $th;
    }
}

    public function PatientMedicalHistory(){
        try {
            $patientID = Auth::user()->id;
            $prepPatient = Patients::where('patient_id', $patientID)->first();
            $patientHistory = PatientHistory::where('patient_id', $prepPatient->id)->first();
            // Log::info($prepPatient->id);
            Log::info(json_encode($patientHistory, JSON_PRETTY_PRINT));
            return view('pages.patients.patient-profile-medical-history', [
    'patientHistory' => $patientHistory,
    'patientInfo' => $prepPatient
]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function PatientAppointmentList()
    {
        try {
            $patientID = Auth::user()->id;
            $patient = Patients::where('patient_id', $patientID)->first();
            $patientHistory = PatientHistory::where('patient_id', $patient->id)->first();
            $prepAppointment = DB::table('appointments')
    ->join('patient_info', 'patient_info.id', '=', 'appointments.patient_id') // correct link
    ->join('users', 'users.id', '=', 'patient_info.patient_id') // user → patient_info
    ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
    ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
    ->leftJoin('opt_notes', 'opt_notes.appointment', '=', 'appointments.id')
    ->where('patient_info.patient_id', Auth::id()) // filter by logged-in user
    ->select(
        'doctors.FirstName as dfName',
        'doctors.ProfessionalTitle as title',
        'doctors.LastName as dlname',
        'doctors.MiddleName as dmname',
        'sub_services.Service as service',
        'sub_services.Price as price',
        'appointments.time',
        'appointments.date',
        'appointments.status',
        'appointments.id',
        'opt_notes.Date as note_date',
        'opt_notes.Tooth',
        'opt_notes.Procedure',
        'opt_notes.AmountCharge',
        'opt_notes.AmountPaid',
        'opt_notes.Balance',
        'opt_notes.PostOpNotes',
        'opt_notes.ImportantNotes',
        'opt_notes.id as note_id'
    )
    ->get();
            $appointmentcount = Appointment::where('patient_id', $patient->id)->get();
            $patientAppointmentCount = count($appointmentcount);
            Log::info(json_encode($patient, JSON_PRETTY_PRINT));
            $patientForecastPayment = $prepAppointment->sum('price');
            $patientDuePayments = $prepAppointment->where('status', 'completed')->sum('price');
            return view('pages.patients.patient-appointment-list' , compact('prepAppointment', 'patientForecastPayment', 'patient', 'patientHistory', 'patientDuePayments', 'patientAppointmentCount'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function PatientSetUp(Request $request)
    {
        DB::beginTransaction();
        Log::info($request['patient_personal_info']['firstname']);
        $patient_id = Auth::user()->id;
        $patient = User::where('id', $patient_id)->first();
        Log::info($patient_id);
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
                'patient_id' => $patient['id'], // Use patient table's ID (not auth user)
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
            Log::info($th);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function UpdateAppointment(Request $request)
    {
        Log::info($request->all());
        try {
            Log::info($request['status']);
            if ($request['status'] === 'cancel') {
                Appointment::where('id', $request['appt_id'])->update(['status' => $request['status']]);
                return response()->json(['status' => 'Appointment Cancelled'], 200);
            }
            if ($request['status'] === 're-sched') {

                Appointment::where('id', $request['appt_id'])->update([
                    'status' => $request['status'],
                    'date' => Carbon::parse($request['date'])->format('Y-m-d'),
                    'time' => $request['time'],
                ]);
                return response()->json(['status' => 'Appointment Rescheduled'], 200);
            }
            return response()->json(['data' => $request], 200);
        } catch (\Throwable $th) {
            // throw $th;
            Log::info($th);
            return response()->json(['status' => $th], 500);
        }
    }


}
