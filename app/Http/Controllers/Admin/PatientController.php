<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;

class PatientController extends Controller
{
    public function index(){
        $patients=Patient::all();
        return view('admin.patient.index', compact('patients'));
        
    }

    public function profile(Request $request ,Patient $patient){
        $pastAppointments = Appointment::where('patient_id', $patient->id)->whereDate('date', '<', Carbon::now())->paginate(10);
        $futureAppointments = Appointment::where('patient_id', $patient->id)->whereDate('date', '>=', Carbon::now())->paginate(10);
        $pdfFiles = $patient->getMedia('pdf')->sortByDesc('created_at')->take(5);
        return view('admin.patient.profile', compact('patient','pastAppointments','futureAppointments', 'pdfFiles'));
        
    }

     public function uploadPdf(Request $request, Patient $patient)
    {
        $patient->addMedia($request->file('pdf'))->toMediaCollection('pdf');

        return redirect()->back()->with('success', 'PDF file uploaded successfully.');
    }

   
    
    

    
}
