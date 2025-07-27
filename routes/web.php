<?php

use App\Http\Controllers\PatientController;
use App\Models\Doctors;
use App\Models\Services;
use App\Models\SubService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('default');

Auth::routes();
Route::view('/dental-medical-history', 'pages.dental-medical-history')->name('dental-medical-history');


Route::get('/client-appointment-form', [function() {
    $services = Services::where('isVisible', true)->get();
    $doctors = Doctors::where('isRemoved', false)->get();
    $subServices = SubService::all();//'isVisible', true put this shit back when we rollback its migration
    return view('pages.client-appointment-form', compact('services', 'doctors', 'subServices'));
}])->name('client-appointment-form');
Route::post('/new-user', [Controller::class, 'NewUser'])->name('new-user');
Route::middleware('authenticated')->group(function(){
    Route::get('/dashboard', [Controller::class, 'Dashboard'])->name('dashboard');
    Route::get('/client-dashboard', [Controller::class, 'ClientDashboard'])->name('client-dashboard');
    Route::get('/dentist-dashboard', [Controller::class, 'DentistDashboard'])->name('dentist-dashboard');
    Route::get('/services-dashboard', [Controller::class, 'ServicesDashboard'])->name('services-dashboard');
    Route::post('/new-patient', [App\Http\Controllers\PatientController::class, 'NewPatient'])->name('new-patient');
    Route::post('/new-service', [Controller::class, 'NewService'])->name('new-service');
    Route::post('/remove-service/{id}', [Controller::class, 'RemoveService'])->name('remove-service');
    Route::post('/new-sub-service', [Controller::class, 'NewSubService'])->name('new-sub-service');
    Route::post('get-sub-services/{id}', [Controller::class, 'GetSubServices'])->name('get-sub-services');
    Route::get('/doctors', [Controller::class, 'DoctorsPage'])->name('doctors');
    Route::post('/doctors/new', [Controller::class, 'NewDoctors']);
    Route::get('/patient-profile', [PatientController::class, 'PatientProfile'])->name('patient-profile');
});
Route::post('/patient-setup', [PatientController::class, 'PatientSetUp'])->name('patient-setup')->middleware('auth');
Route::post('/available-slots', [PatientController::class, 'GetVacantTimeSlots'])->name('available-slots')->middleware('auth');
Route::post('/appointments', [PatientController::class, 'AppointmentConfirmation'])->name('appointment-confirmation')->middleware('auth');
Route::get('/user-appointment-list', [PatientController::class, 'PostAppointmentLoc'])->name('appointment-lists')->middleware('auth');