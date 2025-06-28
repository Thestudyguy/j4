<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.j4-body');
})->name('default');

Auth::routes();
Route::view('/dental-medical-history', 'pages.dental-medical-history')->name('dental-medical-history');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/client-appointment-form', function() {
    return view('pages.client-appointment-form');
})->name('client-appointment-form');