<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Payment;
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

        return view('dashboard', compact('totalPatients', 'totalDoctors', 'appointments', 'upcomingAppointments', 'appointmentsToday'));
    }
    public function getRevenue()
    {
        $response=[];
        for($i=1; $i<13; $i++){
            $response[$i-1] = Payment::whereMonth('date', $i)->sum('payable');
        }
        Log::debug($response);
        

        return response()->json($response);
    }
}
