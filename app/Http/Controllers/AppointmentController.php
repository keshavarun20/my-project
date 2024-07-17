<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AppointmentStoreRequest;
use App\Models\ActivityLog;
use Illuminate\Support\Carbon;
use Log;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointmentBooked = Appointment::orderBy('id', 'desc')->first();
        if (Auth::user()->role->name == 'Patient') {
            $patientId = Auth::user()->patient->id;
            $appointments = Appointment::where('patient_id', $patientId)->get();
            return view('appointment.index', compact('appointments', 'appointmentBooked'));
        } else {
            $appointments = Appointment::all();

            return view('appointment.index', compact('appointments', 'appointmentBooked'));
        }
    }
    public function create()
    {
        $user = Auth::user();
        $doctors = Doctor::all();
        return view('appointment.create', compact('user', 'doctors'));
    }

    public function getUser(Request $request)
    {
        $patient = Patient::where('nic', $request->nic)->first();
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

    public function store(AppointmentStoreRequest $request)
    {
        $data = $request->validated();
        $appointmentCount = Appointment::where('doctor_id', $data['doctor_id'])->where('date',$data['date'])->count();
        $tokenNumber = $appointmentCount + 1;
        $patient = Patient::where('nic', $data['nic'])->value('id');
        $patientN = Patient::find($patient);

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
        
        if(Auth::user()->role->name == 'Patient'){
            ActivityLog::create([
                'user_id' => $patient,
                'description' => 'Made an Appointment' . '' . '(' . $patientN->name . ')',
                'action_type' => 'made_appointment',
            ]);
        }

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'description' => 'Made an Appointment' . '' . '(' . $patientN->name . ')',
            'action_type' => 'made_appointment',
        ]);

        return redirect()->route('appointment.index')->with('appointmentBooked', true);
    }

    public function filter(Request $request)
    {
        $appointments = Appointment::query();
        //Log::debug($appointments);
        $filterType = $request->input('filterType');
        //Log::debug($filterType);
        $filterValue = $request->has('filterValue') ? $request->input('filterValue') : null;
        //Log::debug($filterValue);

        if ($filterType == 'name'  && $filterValue) {
            $appointments->where('first_name', 'like', '%' . $filterValue . '%')->orWhere('last_name', 'like', '%' . $filterValue . '%');
        }
        if ($filterType == 'date'  && $filterValue) {
            $appointments->where('date', $filterValue);
        }

        return response()->json($appointments->get());
    }

    public function cancel(Appointment $appointment ){
        $doctorId = $appointment->doctor_id;
        $date = $appointment->date;
        $tokenNumber = $appointment->token_number;

        // Delete the appointment
        $appointment->delete();
        
        $subsequentAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('date', $date)
            ->where('token_number', '>', $tokenNumber)
            ->orderBy('token_number')
            ->get();

        foreach ($subsequentAppointments as $subsequentAppointment) {
            $subsequentAppointment->token_number -= 1;
            $subsequentAppointment->save();
        }
        
        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'description' => 'Cancelled Appointment' . '' . '(' . $appointment->first_name . ' ' . $appointment->last_name . ')',
            'action_type' => 'cancelled_appointment',
        ]);

        return redirect()->route('appointment.index')->with('appointmentCancelled', true);
    }

    
}
