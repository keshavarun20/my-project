<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Log;
class PatientController extends Controller
{
    public function index(){
        $patients = Patient::all();

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

    public function filter(Request $request)
    {
    $patients = Patient::query();
    //Log::debug($patients);
    $filterType = $request->input('filterType');
    //Log::debug($filterType);
    $filterValue = $request->input('filterValue');
    //Log::debug($filterValue);

    if ($filterType == 'name'  && $filterValue) {
        $patients->where('first_name', 'like', '%'.$filterValue.'%')->orWhere('last_name', 'like', '%'.$filterValue.'%');
    } if ($filterType == 'date'  && $filterValue) {
        $patients->where('today_date', $filterValue);
    }

    return response()->json($patients->get());
    }


    
    

    
}
