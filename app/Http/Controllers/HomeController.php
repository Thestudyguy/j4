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
        return view('dental-front-face-index', compact('services', 'doctors', 'subServices', 'todayAppointments'));
    }
}
