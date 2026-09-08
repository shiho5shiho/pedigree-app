<?php

use App\Http\Controllers\MedicalConditionController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonMedicalHistoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('people', PersonController::class);
    Route::resource('medical-conditions', MedicalConditionController::class);
    Route::resource('people.medical-histories', PersonMedicalHistoryController::class)
        ->except(['show'])
        ->middleware('auth');
});
