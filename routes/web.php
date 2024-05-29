<?php

use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DoctorScheduleController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\VitalSignController;
use App\Models\VitalSign;

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

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    Route::group(['prefix' => 'users',], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/search', [UserController::class, 'search'])->name('search');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');

        Route::group(['prefix' => '{user}'], function () {
            Route::get('/show', [UserController::class, 'show'])->name('user.show');
            Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
            Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/profile_picture', [UserController::class, 'profilePicture'])->name('user.profile_picture');
            Route::patch('/', [UserController::class, 'update'])->name('user.update');
            //Route::get('/delete',[UserController::class,'delete'])->name('user.delete');
            Route::delete('/', [UserController::class, 'destroy'])->name('user.destroy');
        });
    });

    Route::group(['prefix' => 'appointments',], function () {
        Route::get('/', [AppointmentController::class, 'index'])->name('appointment.index');
        Route::get('/filter', [AppointmentController::class, 'filter'])->name('appointment.filter');
        Route::get('/create', [AppointmentController::class, 'create'])->name('appointment.create');
        Route::get('ajaxRequest', [AppointmentController::class, 'getUser'])->name('get.user');
        Route::post('/store', [AppointmentController::class, 'store'])->name('appointment.store');
        Route::get('ajaxRequest1', [AppointmentController::class, 'getAvailableDoctors'])->name('get.available.doctors');


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
        Route::post('/store', [DoctorScheduleController::class, 'store'])->name('dschedule.store');

        Route::group(['prefix' => '{doctor}'], function () {
            // Route::get('/show',[UserController::class, 'show'])->name('user.show');
            Route::get('/edit', [DoctorScheduleController::class, 'edit'])->name('dschedule.edit');
            Route::patch('/', [DoctorScheduleController::class, 'update'])->name('dschedule.update');
            // Route::get('/delete',[UserController::class,'delete'])->name('user.delete');
            // Route::delete('/',[UserController::class,'destroy'])->name('user.destroy');

        });
    });

    Route::group(['prefix' => 'patient',], function () {
        Route::get('/', [PatientController::class, 'index'])->name('patient.info');
        Route::get('/filter', [PatientController::class, 'filter'])->name('patient.filter');
        //Route::post('/store',[DoctorScheduleController::class, 'store'])->name('dschedule.store');

        Route::group(['prefix' => '{patient}'], function () {
            Route::get('/', [PatientController::class, 'profile'])->name('patient.profileinfo');
            Route::get('/profile', [DoctorController::class, 'profile'])->name('patient.profile');
            Route::post('/store', [MedicalController::class, 'store'])->name('medical.store');
            Route::post('/upload-pdf', [DoctorController::class, 'uploadPdf'])->name('patient.uploadPdf');
            Route::get('/get-rbs-data', [DoctorController::class, 'getRbsData'])->name('vital.rbs');
            Route::get('/get-hr-data', [DoctorController::class, 'getHrData'])->name('vital.hr');
            Route::get('/get-bps-data', [DoctorController::class, 'getBpsData'])->name('vital.bps');
            Route::get('/get-bpd-data', [DoctorController::class, 'getBpdData'])->name('vital.bpd');
            Route::get('/get-rr-data', [DoctorController::class, 'getRrData'])->name('vital.rr');
            Route::get('/get-spo2-data', [DoctorController::class, 'getSpo2Data'])->name('vital.spo2');
            //Route::post('/upload-pdf', [PatientController::class,'uploadPdf'])->name('patient.uploadPdf');



        });
    });
    Route::group(['prefix' => 'doctor',], function () {
        Route::get('/', [DoctorController::class, 'index'])->name('patient.index');
        Route::get('/filter', [DoctorController::class, 'filter'])->name('patient.filter');
        Route::get('/filter1', [DoctorController::class, 'filter1'])->name('patient.filter1');
        Route::get('/appointment', [DoctorController::class, 'appointment'])->name('patient.appointment');

        Route::group(['prefix' => '{patient}'], function () {
            // Route::get('/profile', [DoctorController::class, 'profile'])->name('patient.profile');
        });
    });
    Route::group(['prefix' => 'billing',], function () {
        Route::get('/', [BillingController::class, 'billing'])->name('billing.index');
        Route::get('ajaxRequest2', [BillingController::class, 'calculateTotals'])->name('get.patient');
        Route::post('/store', [BillingController::class, 'store'])->name('billing.store');
        Route::get('/invoice', [BillingController::class, 'invoice'])->name('billing.invoice');


        Route::group(['prefix' => '{payment}'], function () {
            Route::get('generate-pdf', [BillingController::class, 'generatePdf'])->name('generate.pdf');
        });
    });
    Route::group(['prefix' => 'vital',], function () {
        Route::get('/', [VitalSignController::class, 'index'])->name('vital.index');
        Route::post('/store', [VitalSignController::class, 'store'])->name('vital.store');
        Route::get('/get-rbs-data', [VitalSignController::class, 'getRbsData'])->name('vital.rbs');
        Route::get('/get-hr-data', [VitalSignController::class, 'getHrData'])->name('vital.hr');
        Route::get('/get-bps-data', [VitalSignController::class, 'getBpsData'])->name('vital.bps');
        Route::get('/get-bpd-data', [VitalSignController::class, 'getBpdData'])->name('vital.bpd');
        Route::get('/get-rr-data', [VitalSignController::class, 'getRrData'])->name('vital.rr');
        Route::get('/get-spo2-data', [VitalSignController::class, 'getSpo2Data'])->name('vital.spo2');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
