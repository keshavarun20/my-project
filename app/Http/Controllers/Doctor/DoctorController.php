<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;
class DoctorController extends Controller
{
    public function index()
    {
        $loggedInDoctorId = auth()->user()->doctor->id;
        $patients = Patient::query();

        $patients = $patients->whereHas('appointments', function ($query) use ($loggedInDoctorId) {
            $query->where('doctor_id', $loggedInDoctorId);
        })->get();

        return view('doctor.patient.index', compact('patients'));
    }

    public function profile(Request $request, Patient $patient)
    {
        $loggedInDoctorId = auth()->user()->doctor->id;

        $pastAppointments = Appointment::where('patient_id', $patient->id)
            ->where('doctor_id', $loggedInDoctorId)
            ->whereDate('date', '<', Carbon::now())
            ->paginate(10);

        $futureAppointments = Appointment::where('patient_id', $patient->id)
            ->where('doctor_id', $loggedInDoctorId)
            ->whereDate('date', '>=', Carbon::now())
            ->paginate(10);

        $pdfFiles = $patient->getMedia('pdf')->sortByDesc('created_at')->take(5);

        return view('doctor.patient.profile', compact('patient', 'pastAppointments', 'futureAppointments', 'pdfFiles'));
    }

    public function uploadPdf(Request $request, Patient $patient)
    {
        $patient->addMedia($request->file('pdf'))->toMediaCollection('pdf');

        return redirect()->back()->with('success', 'PDF file uploaded successfully.');
    }

    public function filter(Request $request)
    {
        $patients = Patient::query();
        //Log::debug($patients);
        $filterType = $request->input('filterType');
        //Log::debug($filterType);
        $filterValue = $request->input('filterValue');
        //Log::debug($filterValue);

        if ($filterType == 'name'  && $filterValue) {
            $patients->where('first_name', 'like', '%' . $filterValue . '%')->orWhere('last_name', 'like', '%' . $filterValue . '%');
        }
        if ($filterType == 'date'  && $filterValue) {
            $patients->where('today_date', $filterValue);
        }

        return response()->json($patients->get());
    }

    public function appointment(){
        $loggedInDoctorId = auth()->user()->doctor->id;

        $patients = Patient::whereHas('appointments', function ($query) use ($loggedInDoctorId) {
            $query->where('doctor_id', $loggedInDoctorId)->where('date', '>=', now());
        })->get();

        $patientsOld = Patient::whereHas('appointments', function ($query) use ($loggedInDoctorId) {
            $query->where('doctor_id', $loggedInDoctorId)->where('date', '<', now());
        })->get();

        return view('doctor.appointment', compact('patients' , 'patientsOld'));
    }

    public function filter1(Request $request)
    {
        $doctor = $request->input('userId');
        Log::debug($doctor);
        $appointments = Appointment::query()->select('id','mobile_number','token_number','date','first_name','last_name')->where('doctor_id', $doctor);
        
        $filterType = $request->input('filterType');
    
        $filterValue = $request->input('filterValue');

        if ($filterType == 'name'  && $filterValue) {
            $appointments->where('first_name', 'like', '%' . $filterValue . '%')->orWhere('last_name', 'like', '%' . $filterValue . '%');
        }
        if ($filterType == 'date'  && $filterValue) {
            $appointments->where('date', $filterValue);
        }

        return response()->json($appointments->get());
    }
}
