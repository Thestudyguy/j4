<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctors;
use App\Models\Services;
use App\Models\SubService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $doctorss = DB::table('doctors')
        ->join('dentist_off_scheds', 'dentist_off_scheds.dentist_id', '=', 'doctors.id')
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
        $appointments = DB::table('appointments')
        ->join('users', 'users.id', '=', 'appointments.patient_id')
        ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
        ->select(
            'appointments.status', 'appointments.date', 'appointments.time',
            'users.FirstName', 'appointments.created_at',
            'sub_services.Service', 'sub_services.Price'
        )
        ->get();

    $patients = DB::table('patient_info')->get();
    $totalPatient = count($patients);
    $patientCount = Appointment::all();
    $count = count($patientCount);

    // Get today's appointments
    $today = Carbon::today()->toDateString();
    $todayAppointments = Appointment::whereDate('date', $today)->count();
        $services = Services::where('isVisible', true)->get();
        $doctors = Doctors::where('isVisible', true)->where('isRemoved', false)->get();
        $subServices = SubService::all();
        return view('dental-front-face-index', compact('availableDoctors','services', 'doctors', 'subServices', 'todayAppointments'));
    }
}
