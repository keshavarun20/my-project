<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AppointmentStoreRequest;
use Illuminate\Support\Carbon;
use Log;

class AppointmentController extends Controller
{
    public function index(){
        $appointments = Appointment::all();
        $appointmentBooked = Appointment::orderBy('id', 'desc')->first();
        return view('appointment.index', compact('appointments' ,'appointmentBooked'));
        
    }
    public function create(){
        $user = Auth::user();
        $doctors=Doctor::all();
        return view('appointment.create', compact('user','doctors'));
    }

    public function getUser(Request $request){
        $patient = Patient::where('nic',$request->nic)->first();
        return response()->json($patient);
    }

    public function getAvailableDoctors(Request $request)
{
    $selectedDate = $request->input('date');
    $day = Carbon::parse($selectedDate)->format('l'); 
    $availableDoctors = DoctorSchedule::where('available_days', 'LIKE', "%$day%")->pluck('doctor_id')->toArray();
    $doctors = Doctor::whereIn('id', $availableDoctors)->get();
    return response()->json($doctors);
}

public function store(AppointmentStoreRequest $request) {
    $data = $request->validated();
    $appointmentCount = Appointment::where('doctor_id', $data['doctor_id'])->count();
    $tokenNumber = $appointmentCount + 1;
    $patient =Patient::where('nic',$data['nic'])->value('id');

    $referenceNumber = uniqid('#HCC');

    Appointment::create([
        'doctor_id' => $data['doctor_id'],
        'patient_id' => $patient,
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'age' => $data['age'],
        'mobile_number' => $data['mobile_number'],
        'date' => $data['date'],
        'token_number' => $tokenNumber,
        'reference_number' => $referenceNumber,
    ]);

    return redirect()->route('appointment.index')->with('appointmentBooked', true);
}

}     
