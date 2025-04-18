<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/patients');
});

Route::resource('/patients', \App\Http\Controllers\PatientController::class);

Route::resource('/medicines', \App\Http\Controllers\MedicineController::class);

Route::post('/patients/{patient}/records/store', [\App\Http\Controllers\PatientController::class, 'storeRecord'])
    ->name('patients.records.store');

Route::post('/medicines/{medicine}/addstock', [\App\Http\Controllers\MedicineController::class, 'addStock'])
    ->name('medicines.addStock');

Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index']);

Route::get('/calendar/{id}/send-email', [App\Http\Controllers\CalendarController::class, 'sendEmail']);