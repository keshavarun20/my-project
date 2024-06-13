<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Medical;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\VitalSign;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::count();
        $appointments = Appointment::orderBy('created_at', 'desc')->take(3)->get();
        $upcomingAppointments = Appointment::where('date', '>', Carbon::now())->count();
        $appointmentsToday = Appointment::whereDate('date',  Carbon::today())->count();
        if (url()->previous() == env('APP_URL') . '/login') {
            session()->flash('success', 'Welcome to your account, Dear');
        }
        if (auth()->user()->patient) {
            $patientId = auth()->user()->patient->id;
            $patientAppointments = Appointment::where('patient_id', $patientId)->where('date', '>', now())->orderBy('date', 'asc')->get();
            $medicals = Medical::where('patient_id', $patientId)->latest()->first();
            return view('dashboard', compact('totalPatients', 'totalDoctors', 'appointments', 'upcomingAppointments', 'appointmentsToday', 'patientAppointments', 'medicals'));
        }

        return view('dashboard', compact('totalPatients', 'totalDoctors', 'appointments', 'upcomingAppointments', 'appointmentsToday'));
    }
    public function getRevenue()
    {
            $response = [];
            for ($i = 1; $i < 13; $i++) {
                $response[$i - 1] = Payment::whereMonth('date', $i)->sum('payable');
            }

        if (auth()->user()->patient) {
            $patientId = auth()->user()->patient->id;
            $response = [];
            for ($i = 1; $i < 13; $i++) {
                $response[$i - 1] = Payment::where('patient_id', $patientId)->whereMonth('date', $i)->sum('payable');
            }
        }


        return response()->json($response);
    }

    public function getVital()
    {
        $patientId = auth()->user()->patient->id;
        $response = VitalSign::where('patient_id', $patientId)->orderBy('created_at', 'desc')->first();
        Log::debug($response);

        return response()->json($response);
    }
}
