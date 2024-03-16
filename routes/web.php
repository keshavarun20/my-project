<?php

use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DoctorScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\PatientController;

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
    return view('welcome');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'],function(){
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    
    Route::group(['prefix' => 'users',], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/create',[UserController::class, 'create'])->name('user.create');
    Route::post('/store',[UserController::class, 'store'])->name('user.store');

    Route::group(['prefix' => '{user}'], function () {
    Route::get('/show',[UserController::class, 'show'])->name('user.show');
    Route::get('/edit',[UserController::class, 'edit'])->name('user.edit');
    Route::patch('/',[UserController::class, 'update'])->name('user.update');
    //Route::get('/delete',[UserController::class,'delete'])->name('user.delete');
    Route::delete('/',[UserController::class,'destroy'])->name('user.destroy');

        });
    });

    Route::group(['prefix' => 'appointments',], function () {
    Route::get('/', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('/create',[AppointmentController::class, 'create'])->name('appointment.create');
    Route::get('ajaxRequest',[AppointmentController::class, 'getUser'])->name('get.user');
    Route::post('/store',[AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('ajaxRequest1',[AppointmentController::class, 'getAvailableDoctors'])->name('get.available.doctors');


    // Route::group(['prefix' => '{user}'], function () {
    // Route::get('/show',[UserController::class, 'show'])->name('user.show');
    // Route::get('/edit',[UserController::class, 'edit'])->name('user.edit');
    // Route::patch('/',[UserController::class, 'update'])->name('user.update');
    // Route::get('/delete',[UserController::class,'delete'])->name('user.delete');
    // Route::delete('/',[UserController::class,'destroy'])->name('user.destroy');

    //     });
    });

    Route::group(['prefix' => 'doctorschedule',], function () {
    Route::get('/', [DoctorScheduleController::class, 'index'])->name('dschedule.index');
    Route::post('/store',[DoctorScheduleController::class, 'store'])->name('dschedule.store');

     Route::group(['prefix' => '{doctor}'], function () {
    // Route::get('/show',[UserController::class, 'show'])->name('user.show');
     Route::get('/edit',[DoctorScheduleController::class, 'edit'])->name('dschedule.edit');
    Route::patch('/',[DoctorScheduleController::class, 'update'])->name('dschedule.update');
    // Route::get('/delete',[UserController::class,'delete'])->name('user.delete');
    // Route::delete('/',[UserController::class,'destroy'])->name('user.destroy');

     });
    });

    Route::group(['prefix' => 'patient',], function () {
    Route::get('/', [PatientController::class, 'index'])->name('patient.index');
    //Route::post('/store',[DoctorScheduleController::class, 'store'])->name('dschedule.store');

     Route::group(['prefix' => '{patient}'], function () {
     Route::get('/profile',[PatientController::class, 'profile'])->name('patient.profile');
     Route::post('/upload-pdf', [PatientController::class,'uploadPdf'])->name('patient.uploadPdf');

    

     });
    });
    Route::group(['prefix' => 'billing',], function () {
    Route::get('/', [BillingController::class, 'billing'])->name('billing.index');
    Route::get('ajaxRequest2', [BillingController::class, 'calculateTotals'])->name('get.patient');
    Route::post('/store',[BillingController::class, 'store'])->name('billing.store');
    Route::get('/invoice',[BillingController::class, 'invoice'])->name('billing.invoice');

    //  Route::group(['prefix' => '{patient}'], function () {
    //  Route::get('/profile',[PatientController::class, 'profile'])->name('patient.profile');
    //  Route::post('/upload-pdf', [PatientController::class,'uploadPdf'])->name('patient.uploadPdf');

    

    //  });
    });




});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
