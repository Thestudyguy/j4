<?php

namespace App\Http\Controllers;
use App\Mail\MailDentistAccount;
use App\Mail\MailPatientAppointmentStatus;
use App\Models\Appointment;
use App\Models\Doctors;
use App\Models\Inventory;
use App\Models\PatientHistory;
use App\Models\Patients;
use App\Models\Services;
use App\Models\sub_services;
use App\Models\SubService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Str;
use Validator;
class Controller
{
    //

    // public function SiteData(){
    //     $services = Services::all();
    //     $doctors = Doctors::all();
    //     view('pages.client-appointment-form', compact('services', 'doctors'));
    // }
        public function NewInventoryItem(Request $request) {
        try {
            $validated = $request->validate([
                'item_name' => 'required|string|max:255',
                'category'  => 'required|string|max:255',
                'stock'     => 'required|integer|min:0'
            ]);

            $item = new Inventory();
            $item->item_name = $validated['item_name'];
            $item->category  = $validated['category'];
            $item->on_hand = (int) $validated['stock'];
            $item->save();

            return response()->json([
                'message' => 'Item added successfully.',
                'item'    => $item
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error adding item.',
                'error'   => $th->getMessage()
            ], 500);
        }
    }

    public function Inventory(){
        $inventory = Inventory::where('isVisible', true)->get();
        return view('pages.inventory', compact('inventory'));
    }
    public function FrontDeskBoardingPage(){
        return view('pages.front-desk-boarding-page');
    }

    public function PatientScheduledAppointment(Request $request)
    {
        try {
            $validated = $request->validate([
                'selected_date' => 'required|date',
                'selected_time' => 'required|string',
                'selected_doctor_id' => 'required|exists:doctors,id',
                'selected_service_id' => 'required|exists:sub_services,id',
                'patient_id' => 'required',
            ]);
            Log::info(json_encode($validated, JSON_PRETTY_PRINT));
            // return;
            Appointment::create([
                'patient_id' => $validated['patient_id'],
                'doctor_id' => $validated['selected_doctor_id'],
                'service_id' => $validated['selected_service_id'],
                'date' => $validated['selected_date'],
                'time' => $validated['selected_time'],
            ]);

            return response()->json([
                'status' => 'success',
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>__($th->getMessage())],500);
            // throw $th;
        }
    }

    public function UpdatePatientAppointment(Request $request){
       $details = [
        'email' => $request->email,
        'fname' => $request->fname,
        'lname' => $request->lname,
        'refid' => $request->refid,
        'apptid' => $request->apptid,
        'service' => $request->service,
        'date' => $request->date,
        'time' => $request->time,
        'appointment_update' => $request->appointment_update,
    ];
    
    Mail::to($details['email'])->send(new MailPatientAppointmentStatus($details));
        
    }

    public function Patients(){
        $patients = DB::table('patient_info')
        ->leftJoin('appointments','appointments.patient_id', '=', 'patient_info.id')
        ->leftJoin('sub_services','sub_services.id','=', 'appointments.service_id')
        ->select(
            'patient_info.FirstName',
        'patient_info.LastName',
        'appointments.date',
        'appointments.time',
        'appointments.status',
        'sub_services.Service',
        'patient_info.id as refID'
        )
        ->get()
        ->groupBy('refID');

        // $test = DB::table('appointments')
        // ->leftJoin('patient_info','patient_info.patient_id','=', 'appointments.patient_id')
        // ->leftJoin('sub_services','sub_services.id','=', 'appointments.service_id')
        // ->select(
        //     'patient_info.FirstName',
        // 'patient_info.LastName',
        // 'appointments.date',
        // 'appointments.time',
        // 'appointments.status',
        // 'sub_services.Service',
        // 'patient_info.id as refID'
        // )
        // ->get()
        // ->groupBy('refID');
        $subServices = SubService::all();
        $doctors = Doctors::where('isRemoved', false)->get();
        // $servicesCount = count($patients);
        Log::info(json_encode($patients, JSON_PRETTY_PRINT));
        return view('pages.patients', compact('patients', 'subServices', 'doctors'));
    }

    public function AllAppointments(){
        $appointments = DB::table('appointments')
        ->join('patient_info', 'patient_info.id', '=', 'appointments.patient_id')
        ->leftJoin('users', 'users.id', '=', 'appointments.patient_id')
        ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
        ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
        ->leftJoin('opt_notes','opt_notes.appointment','=', 'appointments.id')
        ->select(
            'doctors.ProfessionalTitle as title', 'doctors.Firstname as dfName', 'doctors.LastName as dlname',
            'users.id as refID',
            'patient_info.FirstName',
            'patient_info.LastName',
            'patient_info.Email',
            'appointments.date as Date',
            'appointments.time as Time',
            'appointments.status',
            'sub_services.Service as service',
            'appointments.id',
            'opt_notes.Date as note_date', 'opt_notes.Tooth','opt_notes.Procedure','opt_notes.AmountCharge','opt_notes.AmountPaid','opt_notes.Balance', 'PostOpNotes', 'ImportantNotes', 'opt_notes.id as note_id'
        )
        ->get();

        // Log::info($appointments);
        return view('pages.all-appointments', compact('appointments'));
    }

    public function PatientDetails($id){
        // dd($id);
        $patient = Patients::where('id', $id)->first();
    $patientHistory = PatientHistory::where('patient_id', $patient->id)->first() ?? new PatientHistory();
    $services = DB::table('appointments')
    ->where('appointments.patient_id', $id)
    ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
    ->select('sub_services.*')
    ->get();
    $prepAppointment = DB::table('appointments')
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
                // ->join('users', 'users.id', '=', 'appointments.patient_id')
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
                ->where('appointments.patient_id', $id)
                ->get();
                $servicesCount = count($prepAppointment);
                $completedAppt = DB::table('appointments')
    ->where('patient_id', $patient['id'])
    ->where('status', 'completed')
    ->count();
    Log::info(json_encode($patientHistory, JSON_PRETTY_PRINT));

    return view('pages.view-patient-profile', compact('completedAppt','servicesCount','prepAppointment','patient', 'patientHistory', 'services'));
    }

    public function ViewPatientDetails(Request $request){
        $patientID = Auth::user()->id;
        $patient = Patients::where('patient_id', $patientID)->first();
        $patientHistory = PatientHistory::where('patient_id', $patientID)->first();
    Log::info(json_encode($patientHistory, JSON_PRETTY_PRINT));
        return view('pages.view-patient-profile', compact('patient', 'patientHistory'));
        
    }
    public function Dashboard()
    {
        $inventory = Inventory::all();
        $appointments = DB::table('appointments')
        ->join('users', 'users.id', '=', 'appointments.patient_id')
        ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
        ->select(
            //appointment 
            'appointments.status', 'appointments.date', 'appointments.time',
            'users.FirstName',
            //service
            'sub_services.Service', 'sub_services.Price'
        )
        ->get();
        // $paymentDetails = DB::table('appointments')
        // ->where()
        // ->get();
        $patients = DB::table('patient_info')->get();
        $totalPatient = count($patients);
        $patientCount = Appointment::all();
            $count = count($patientCount);
        return view('pages.dashboard-dashboard', compact('inventory','appointments', 'count', 'totalPatient'));
    }

    public function ClientDashboard()
    {
        return view('pages.dashboard-dashboard');
    }

    public function DentistDashboard()
    {
        return view('pages.dentist-dashboard');
    }

    public function ServicesDashboard()
    {
        $services = Services::where('isVisible', 1)->get();
        return view('pages.dashboard-services', compact('services'));
    }


    public function NewUser(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'user_name' => 'required|string|max:255|unique:users,UserName',
                'email' => 'required|email|unique:users,Email',
                'password' => 'required|string|confirmed', // expects password_confirmation field
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = [
                'FirstName' => $request->first_name,
                'LastName' => $request->last_name,
                'UserName' => $request->user_name,
                'Email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            if ($request->has('role')) {
                $data['Role'] = $request->role;
            }

            $user = User::create($data);
            Auth::login($user);
            // return redirect()->route('dashboard')->with('success', 'Account created successfully.');

            return response()->json([
                'status' => 'success',
                'redirect' => route('patient-profile'),
            ]);



        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function NewService(Request $request)
    {

        $validateEntry = $request->validate([
            'servicename' => 'required|string|max:255|unique:services,Service',
        ]);
        try {
            DB::beginTransaction();
            $newService = new Services();
            $newService->Service = $request->input('servicename');
            $newService->save();
            DB::commit();
            return response()->json(['message' => 'New Service Created']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['message' => 'Validation failed', 'error' => $ex->getMessage()], 422);
        }
    }


    public function RemoveService($id)
    {
        try {
            DB::beginTransaction();
            Services::where('id', $id)->update(['isVisible' => false]);
            DB::commit();
            return response()->json(['message' => 'Service removed', 'id' => $id]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to remove service', 'details' => $ex->getMessage()], 500);
        }
    }

    public function NewSubService(Request $request)
    {

        Log::info($request->all());

        $validated = $request->validate([
            'servicename' => 'required|string|max:255|unique:sub_services,Service',
            'serviceprice' => 'required|numeric',
            'servicedescription' => 'required|string|max:1000',
            'parent-service-id' => 'nullable|exists:services,id',
            'serviceimage' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        try {
            $image = $request->file('serviceimage');
            $fileName = 'sub_service_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('services', $fileName, 'public');

            $subService = SubService::create([
                'parent_service' => $validated['parent-service-id'],
                'Service' => $validated['servicename'],
                'Price' => $validated['serviceprice'],
                'Description' => $validated['servicedescription'],
                'image_path' => $imagePath,
            ]);
            Log::info('Sub-service added successfully.', ['id' => $subService->id]);

            return response()->json([
                'success' => true,
                'message' => 'Sub-service created successfully.',
                'data' => $subService,
            ], 201);


        } catch (\Exception $e) {
            Log::error('Error creating sub-service: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating sub-service.',
            ], 500);
        }
    }

    public function GetSubServices($id)
    {
        try {
            $trimmedId = explode('_', $id);
            Log::info($trimmedId[2]);
            $subServices = SubService::where('parent_service', $trimmedId[2])->get();
            return response()->json(['sub_services' => $subServices], 200);
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function DoctorsPage()
    {
        try {
            $doctors = Doctors::all();
            return view('pages.dashboard-doctors', compact('doctors'));
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function NewDoctors(Request $request)
{
    try {
        DB::beginTransaction();
        $validator = Validator::make($request->all(), [
            'ProfessionalTitle' => 'nullable|string|max:40',
            'FirstName' => 'required|string|max:100',
            'LastName' => 'required|string|max:100',
            'MiddleName' => 'nullable|string|max:100',
            'Email' => 'string|max:100|unique:doctors,Email|unique:users,Email|required',
            'Suffix' => 'nullable|string|max:10',
            'MDLink' => 'required',
            'AreaOfExpertise' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ])->after(function ($validator) use ($request) {
            $exists = Doctors::where('FirstName', $request->FirstName)
                ->where('LastName', $request->LastName)
                ->where(function ($query) use ($request) {
                    $requestMiddle = $request->MiddleName ?? '';
                    $query->where('MiddleName', $requestMiddle)
                        ->orWhere(function ($q) use ($requestMiddle) {
                            $q->whereNull('MiddleName')->whereRaw('? = ""', [$requestMiddle]);
                        });
                })
                ->exists();

            if ($exists) {
                $validator->errors()->add('FirstName', 'A doctor with the same full name already exists.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $doctor = new Doctors($request->except('image_path'));
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('doctors', $filename, 'public');
            $doctor->image_path = 'storage/' . $path;
        }

        $doctor->isVisible = $request->has('isVisible');

        $usernameBase = $doctor->LastName;
        $username = $usernameBase;
        $counter = 1;
        while (User::where('UserName', $username)->exists()) {
            $username = $usernameBase . $counter++;
        }

        $rawPassword = Str::random(10);
        $hashedPassword = bcrypt($doctor->LastName . "_" . $rawPassword); // You can change this if needed
        $finalPassword = Hash::make($rawPassword);
        $user = User::create([
            'FirstName' => $doctor->FirstName,
            'LastName' => $doctor->LastName,
            'UserName' => $doctor->LastName,
            'Email' => $doctor->Email,
            'Role' => 'Dentist',
            'password' => $finalPassword,
            'is_first_login' => false,
            'is_set_up_complete' => true
        ]);
        $doctor->user_id = $user->id;
        Log::info($user->id);
        $doctor->save();
        Log::info($doctor->Email);
        Mail::to($doctor->Email)->send(new MailDentistAccount($doctor, $username, $rawPassword));
        DB::commit();
        return response()->json(['message' => 'Doctor created successfully and account credentials sent via email.']);
    } catch (\Throwable $th) {
        DB::rollBack();
        Log::info($th);
        return response()->json(['error' => 'Server error occurred.'], 500);
    
    }
}

    public function UpdatePatientBasicInformation(Request $request)
{
    try {
        $patient = Patients::find($request['patient-id'])->get();
        
        $rules = [
        'patient-id'           => 'required|exists:patient_info,id',
        'patient-lastname'     => 'required|string|max:255',
        'patient-firstname'    => 'required|string|max:255',
        'birthdate'            => 'required|date',
        'sex'                  => 'required|in:Male,Female',
        'age'                  => 'required|integer|min:0',
        'nationality'          => 'required|string|max:255',
        'nickname'             => 'required|string|max:255',
        'address'              => 'required|string|max:500',
        'occupation'           => 'required|string|max:255',
        'mobileno'             => 'required|string|max:20',

        'patient-middlename'   => 'nullable|string|max:255',
        'religion'             => 'nullable|string|max:255',
        'effectivedate'        => 'nullable|date',
        'homeno'               => 'nullable|string|max:20',
        'officeno'             => 'nullable|string|max:20',
        'faxno'                => 'nullable|string|max:20',
        'email'                => 'nullable|email|max:255',
        'guardian'             => 'nullable|string|max:255',
        'guardianoccupation'   => 'nullable|string|max:255',
        'referal'              => 'nullable|string|max:255',
        'consultationreason'   => 'nullable|string|max:1000',
    ];

    $validated = $request->validate($rules);
    Log::info('Validated patient ID: ' . $validated['patient-id']);

    // $patient = DB::table('patient_info')->where('id', $validated['patient-id'])->first();

    // $patient = Patients::find($validated['patient-id']);

    if (!$patient) {
        return response()->json(['message' => 'Patient not found'], 404);
    }

    DB::table('patient_info')
    ->where('id', $validated['patient-id'])
    ->update([
        'LastName'            => $validated['patient-lastname'],
        'FirstName'           => $validated['patient-firstname'],
        'MiddleName'          => $validated['patient-middlename'] ?? null,
        'BirthDate'           => $validated['birthdate'],
        'Gender'                 => $validated['sex'],
        'Age'                 => $validated['age'],
        'Nationality'         => $validated['nationality'],
        'NickName'            => $validated['nickname'],
        'Address'             => $validated['address'],
        'Occupation'          => $validated['occupation'],
        'MobileNo'            => $validated['mobileno'],
        'HomeNo'              => $validated['homeno'] ?? null,
        'OfficeNo'            => $validated['officeno'] ?? null,
        'FaxNo'               => $validated['faxno'] ?? null,
        'Email'               => $validated['email'] ?? null,
        'Religion'            => $validated['religion'] ?? null,
        'Guardian'            => $validated['guardian'] ?? null,
        'GuardianOccupation' => $validated['guardianoccupation'] ?? null,
        'Referal'             => $validated['referal'] ?? null,
        'ReasonForVisit' => $validated['consultationreason'] ?? null,
        'EffectiveDate'       => $validated['effectivedate'] ?? null,
    ]);

    return response()->json(['message' => 'Patient updated successfully']);
    } catch (\Throwable $th) {
        Log::error($th);
        return response()->json(['message' => 'Update failed', 'error' => $th->getMessage()], 500);
    }
}


public function AddWalkInPatient(Request $request)
{
    try {
        $rules = [
            'firstname'    => 'required|string|max:255',
            'lastname'     => 'required|string|max:255',
            'middlename'   => 'nullable|string|max:255',
            'birthdate'            => 'required|date',
            'sex'                  => 'required|in:male,female,Male,Female',
            'age'                  => 'required|integer|min:0',
            'religion'             => 'nullable|string|max:255',
            'nationality'          => 'required|string|max:255',
            'nickname'             => 'required|string|max:255',
            'address'              => 'required|string|max:500',
            'homeno'               => 'nullable|string|max:20',
            'occupation'           => 'required|string|max:255',
            'officeno'             => 'nullable|string|max:20',
            'effectivedate'        => 'nullable|date',
            'faxno'                => 'nullable|string|max:20',
            'email'                => 'nullable|email|max:255',
            'mobileno'             => 'required|string|max:20',
            'guardian'             => 'nullable|string|max:255',
            'guardianoccupation'   => 'nullable|string|max:255',
            'referal'              => 'nullable|string|max:255',
            'consultationreason'   => 'nullable|string|max:1000',
        ];

        $validated = $request->validate($rules);

        $data = [
            'FirstName'          => $validated['firstname'],
            'LastName'           => $validated['lastname'],
            'MiddleName'         => $validated['middlename'] ?? null,
            'BirthDate'          => $validated['birthdate'],
            'Gender'             => $validated['sex'],
            'Age'                => $validated['age'],
            'Religion'           => $validated['religion'] ?? null,
            'Nationality'        => $validated['nationality'],
            'NickName'           => $validated['nickname'],
            'Address'            => $validated['address'],
            'HomeNo'             => $validated['homeno'] ?? null,
            'Occupation'         => $validated['occupation'],
            'OfficeNo'           => $validated['officeno'] ?? null,
            'EffectiveDate'      => $validated['effectivedate'] ?? null,
            'FaxNo'              => $validated['faxno'] ?? null,
            'Email'              => $validated['email'] ?? null,
            'MobileNo'           => $validated['mobileno'],
            'Guardian'           => $validated['guardian'] ?? null,
            'GuardianOccupation' => $validated['guardianoccupation'] ?? null,
            'Referal'            => $validated['referal'] ?? null,
            'ReasonForVisit'     => $validated['consultationreason'] ?? null,
        ];

        // Step 3: Insert to DB
        DB::table('patient_info')->insert($data);

        return response()->json(['message' => 'Walk-in patient added successfully'], 201);
    } catch (\Throwable $th) {
        Log::error('Error adding walk-in patient: ' . $th->getMessage());
        return response()->json([
            'message' => 'Failed to add patient',
            'error' => $th->getMessage(),
        ], 500);
    }
}


public function UpdateOrCreatePatientHistory(Request $request)
{
    try {
        Log::info($request->all());
        $history = PatientHistory::updateOrCreate(
            ['patient_id' => $request->input('patient_id')],
            [
                'previous_dentist'        => $request->input('updateorcreate_previous_dentist'),
                'last_visit'              => $request->input('updateorcreate_last_visit'),
                'physician_name'          => $request->input('updateorcreate_physician_name'),
                'physician_specialty'     => $request->input('updateorcreate_physician_specialty'),
                'physician_office_address'=> $request->input('updateorcreate_physician_office_address'),
                'physician_office_no'     => $request->input('updateorcreate_physician_office_no'),
                'good_health'             => $request->input('good_health'),
                'uses_drugs'              => $request->input('uses_drugs'),
                'under_medical_care'      => $request->input('update_under_medical_care'),
                'medical_condition_text' => $request->input('updateorcreate_under_medical_care_text'),
                'allergy'               => json_encode($request->input('isAllergicTo')), // array → JSON
                'allergy_others'          => $request->input('isAllergicToTextInput'),
                'surgery'                 => $request->input('update_surgery'),
                'surgery_text'            => $request->input('updateorcreate_surgery_text'),
                'pregnant'                => $request->input('pregnant'),
                'hospitalized'            => $request->input('update_hospitalized'),
                'hospitalization_details' => $request->input('updateorcreate_hospitalization_details'),
                'taking_birth_control'    => $request->input('taking_birth_control'),
                'taking_medications'      => $request->input('update_taking_medications'),
                'medications_details'     => $request->input('updateorcreate_medications_details'),
                'using_tobacco'           => $request->input('using_tobacco'),
                'nursing'                 => $request->input('nursing'),
                'blood_type'              => $request->input('createorupdate_bloodType'),
                'blood_pressure'          => $request->input('createorupdate_bloodPressure'),
                'known_conditions'               => json_encode($request->input('illnesses')), // array → JSON
                'other_illness_details'   => $request->input('otherIllnessDetails'),
            ]
        );

        return response()->json([
            'message' => 'Patient history updated or created successfully.',
            'data' => $history
        ], 200);

    } catch (\Throwable $th) {
        return response()->json(['message'=> $th->getMessage()], 500);
    }
}

    public function UpdateService(Request $request)
{
    try {
        $request->validate([
            'service' => 'required|string|max:255|unique:services,Service,' . $request->service_id,
        ]);

        Services::where('id', $request->service_id)
                ->update(['Service' => $request->service]);

        return response()->json(['message' => 'Service updated successfully'], 200);
    } catch (\Throwable $th) {
        Log::info($th);
        return response()->json(['message' => $th->getMessage()], 500);
    }
}
public function UpdateSubServices(Request $request)
{
    try {
        $validated = $request->validate([
        'id'          => 'required|exists:sub_services,id',
        'service' => 'required|string|max:255|unique:sub_services,service,' . $request->id,
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,tiff,svg|max:2048'
    ]);

    $subService = SubService::findOrFail($validated['id']);

    $subService->Service     = $validated['service'];
    $subService->Description = $validated['description'] ?? '';
    $subService->Price       = $validated['price'];
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        // Optional: delete old image if it exists
        if ($subService->image_path && Storage::disk('public')->exists($subService->image_path)) {
            Storage::disk('public')->delete($subService->image_path);
        }

        $fileName  = 'sub_service_' . time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('services', $fileName, 'public');

        $subService->image_path = $imagePath;
    }

    $subService->save();

    return response()->json([
        'success' => true,
        'message' => 'Sub-service updated successfully',
        'data'    => $subService
    ]);
    } catch (\Throwable $th) {
        return response()->json(['message' => $th->getMessage()]);
        //throw $th;
    }
}


    public function RemoveSubService(Request $request){
        try {
            Log::info($request->all());
            SubService::where('id', $request->id)->update(['isVisible' => false]);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage()]);
            //throw $th;
        }
    }

    public function GetDoctorsAppointments($id){
        try {
           $doc = Doctors::where('id', $id)->get();
           $appts = Appointment::where('doctor_id', $id)->get();
           $appt = DB::table('appointments')->where('appointments.doctor_id', $id)
           ->join('patient_info','patient_info.id','=','appointments.patient_id')
           ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
           ->select(
            'appointments.id as ApptID', 'appointments.*',
            'patient_info.id as ptID', 'patient_info.*',
            'sub_services.id as serviceID', 'sub_services.*'
           )
           ->get();
            
           return response()->json(['appointments'=> $appt]);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage()]);
            //throw $th;
        }
    }
}
