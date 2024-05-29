<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Medical;
use App\Models\Patient;
use App\Models\VitalSign;
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
        $rbs = VitalSign::whereNotNull('rbs')->latest()->value('rbs');
        $hr = VitalSign::whereNotNull('heart_rate')->latest()->value('heart_rate');
        $bps = VitalSign::whereNotNull('blood_pressure_systolic')->latest()->value('blood_pressure_systolic');
        $bpd = VitalSign::whereNotNull('blood_pressure_diastolic')->latest()->value('blood_pressure_diastolic');
        $rr = VitalSign::whereNotNull('respiratory_rate')->latest()->value('respiratory_rate');
        $spo2 = VitalSign::whereNotNull('spo2')->latest()->value('spo2');

        if(auth()->user()->role->name == 'Doctor'){
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
        
        $medicals = Medical::where('patient_id',$patient->id)->get();

        return view('doctor.patient.profile', compact('patient', 'pastAppointments', 'futureAppointments', 'pdfFiles','medicals', 'rbs', 'hr', 'bps', 'bpd', 'rr', 'spo2'));
        }

         if(auth()->user()->role->name == 'Patient'){
            $loggedInPatientId = auth()->user()->patient->id;

            $pastAppointments = Appointment::where('patient_id', $loggedInPatientId)
            ->whereDate('date', '<', Carbon::now())
            ->paginate(10);

            $futureAppointments = Appointment::where('patient_id', $loggedInPatientId)
            ->whereDate('date', '>=', Carbon::now())
            ->paginate(10);

            $pdfFiles = auth()->user()->patient->getMedia('pdf')->sortByDesc('created_at')->take(5);

            $medicals = Medical::where('patient_id', $loggedInPatientId)->get();

            return view('doctor.patient.profile', compact('patient', 'pastAppointments', 'futureAppointments', 'pdfFiles', 'medicals', 'rbs', 'hr', 'bps', 'bpd', 'rr', 'spo2'));
         }
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

        if ($filterType == 'name' && $filterValue) {
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

    public function getRbsData()
    {

        $rbsData = VitalSign::whereNotNull('rbs')->orderBy('created_at', 'desc')->pluck('rbs');
        return response()->json($rbsData);
    }

    public function getHrData()
    {

        $hrData = VitalSign::whereNotNull('heart_rate')->orderBy('created_at', 'desc')->pluck('heart_rate');
        return response()->json($hrData);
    }
    public function getBpsData()
    {

        $bpsData = VitalSign::whereNotNull('blood_pressure_systolic')->orderBy('created_at', 'desc')->pluck('blood_pressure_systolic');
        return response()->json($bpsData);
    }

    public function getBpdData()
    {

        $bpsData = VitalSign::whereNotNull('blood_pressure_diastolic')->orderBy('created_at', 'desc')->pluck('blood_pressure_diastolic');
        return response()->json($bpsData);
    }
    public function getRrData()
    {

        $rrData = VitalSign::whereNotNull('respiratory_rate')->orderBy('created_at', 'desc')->pluck('respiratory_rate');
        return response()->json($rrData);
    }
    public function getSpo2Data()
    {

        $sp02Data = VitalSign::whereNotNull('spo2')->orderBy('created_at', 'desc')->pluck('spo2');
        return response()->json($sp02Data);
    }
}
