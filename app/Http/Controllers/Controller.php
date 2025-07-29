<?php

namespace App\Http\Controllers;
use App\Mail\MailDentistAccount;
use App\Mail\MailPatientAppointmentStatus;
use App\Models\Appointment;
use App\Models\Doctors;
use App\Models\PatientHistory;
use App\Models\Patients;
use App\Models\Services;
use App\Models\sub_services;
use App\Models\SubService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

    public function Inventory(){
        return view('pages.inventory');
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
        $patients = DB::table('appointments')
    ->join('patient_info', 'patient_info.patient_id', '=', 'appointments.patient_id')
    ->join('users', 'users.id', '=', 'appointments.patient_id')
    ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
    ->select(
        'users.id as refID',
        'patient_info.FirstName',
        'patient_info.LastName',
        'appointments.date',
        'appointments.time',
        'appointments.status',
        'sub_services.Service',
    )
    ->get()
    ->groupBy('refID');

        // Log::info(json_encode($patients, JSON_PRETTY_PRINT));
        return view('pages.patients', compact('patients'));
    }

    public function AllAppointments(){
        $appointments = DB::table('appointments')
        ->join('patient_info', 'patient_info.patient_id', '=', 'appointments.patient_id')
        ->join('users', 'users.id', '=', 'appointments.patient_id')
        ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
        ->select(
            'users.id as refID',
            'patient_info.FirstName',
            'patient_info.LastName',
            'patient_info.Email',
            'appointments.date',
            'appointments.time',
            'appointments.status',
            'sub_services.Service',
            'appointments.id as apptID'
        )
        ->get();
        // Log::info($appointments);
        return view('pages.all-appointments', compact('appointments'));
    }

    public function PatientDetails($id){
        $patient = Patients::where('patient_id', $id)->first();
    $patientHistory = PatientHistory::where('patient_id', $id)->first();
    $services = DB::table('appointments')
    ->where('appointments.patient_id', $id)
    ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
    ->select('sub_services.*')
    ->get();
    Log::info(json_encode($services, JSON_PRETTY_PRINT));

    return view('pages.view-patient-profile', compact('patient', 'patientHistory', 'services'));
    }

    public function ViewPatientDetails(Request $request){
        $patientID = Auth::user()->id;
        $patient = Patients::where('patient_id', $patientID)->first();
        $patientHistory = PatientHistory::where('patient_id', $patientID)->first();
        Log::info($patientID);
        return view('pages.view-patient-profile', compact('patient', 'patientHistory'));
        
    }
    public function Dashboard()
    {
        $appointments = DB::table('appointments')
        ->join('users', 'users.id', '=', 'appointments.patient_id')
        ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
        ->select(
            //appointment 
            'appointments.status', 'appointments.date', 'appointments.time',
            'users.FirstName',
            //service
            'sub_services.Service'
        )
        ->get();
        $patientCount = Appointment::all();
            $count = count($patientCount);
        return view('pages.dashboard-dashboard', compact('appointments', 'count'));
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

}
