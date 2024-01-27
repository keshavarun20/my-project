<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Log;

class AppointmentController extends Controller
{
    public function index(){
        $appointments = Appointment::all();
        return view('appointment.index', compact('appointments'));
        
    }
    public function create(){
        $user = Auth::user();
        $doctors=Doctor::all();
        return view('appointment.create', compact('user'), compact('doctors'));
    }

    public function getUser(Request $request){
        $patient = Patient::where('nic',$request->nic)->first();
        return response()->json($patient);
    }
}
