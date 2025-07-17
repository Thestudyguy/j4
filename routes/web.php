<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
Route::get('/', function () {
    return view('dental-front-face-index');
})->name('default');

Auth::routes();
Route::view('/dental-medical-history', 'pages.dental-medical-history')->name('dental-medical-history');
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/client-appointment-form', function() {
    return view('pages.client-appointment-form');
})->name('client-appointment-form');
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
});