<?php

use App\Http\Controllers\DentistController;
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
    Route::get('/dentist', [DentistController::class, 'DentistBoard'])->name('dentist-interface');
    Route::get('/inventory', [Controller::class, 'Inventory'])->name('inventory');
    Route::get('/Patients', [Controller::class, 'Patients'])->name('patients');
    Route::get('/appointments', [Controller::class, 'AllAppointments'])->name('appointments');
    Route::get('/patient-details/{id}', [Controller::class, 'PatientDetails'])->name('patient-details-view');
    Route::post('/patient-appointment-update', [Controller::class, 'UpdatePatientAppointment'])->name('update-appointment-naboangna');
    Route::get('/front-desk-page', [Controller::class, 'FrontDeskBoardingPage'])->name('front-desk');
});
Route::get('/patient-appointments', [PatientController::class, 'PatientAppointmentList'])->name('patient-appointments-page');
Route::get('/patient-details', [Controller::class, 'ViewPatientDetails'])->name('patient-details');
Route::post('/patient-setup', [PatientController::class, 'PatientSetUp'])->name('patient-setup')->middleware('auth');
Route::post('/available-slots', [PatientController::class, 'GetVacantTimeSlots'])->name('available-slots')->middleware('auth');
Route::post('/appointments', [PatientController::class, 'AppointmentConfirmation'])->name('appointment-confirmation')->middleware('auth');
Route::get('/user-appointment-list', [PatientController::class, 'PostAppointmentLoc'])->name('appointment-lists')->middleware('auth');



Route::get('/test-mail', function () {
    try {
        Mail::raw('Test email body', function ($message) {
            $message->to('lagrosaedrian06@gmail.com') // change to your receiving email
                    ->subject('Test Email');
        });

        return 'Mail sent!';
    } catch (\Exception $e) {
        return 'Mail failed: ' . $e->getMessage();
    }
});

Route::get('/new-appointment-form', [PatientController::class, 'CreateAppointment'])->name('new-appointment-form');