<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalStoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use App\Models\Medical;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalController extends Controller
{
    public function store(MedicalStoreRequest $request) {
        $doctor=Auth::user();
        //dd(1);
        $data = $request->validated();
        $patientId = $request->route('patient');
        $patient = Patient::find($patientId);

        $presentingComplaint = [];
        foreach ($data['symptoms'] as $i => $symptom) {
            $presentingComplaint[] = [
                'symptom' => $symptom,
                'duration' => $data['durations'][$i],
            ];
        }
        $managementPlan = [];
        
        foreach ($data['drug_name'] as $j=> $drug_name) {
            $managementPlan[] = [
                'drug_name' => $drug_name,
                'dose' => $data['dose'][$j],
                'route' => $data['route'][$j],
                'frequency' => $data['frequency'][$j],
            ];
        }
        
        Medical::create([
            'patient_id' => $patientId,
            'presenting_complaint'=> $presentingComplaint,
            'medication' => $data['medication'],
            'treatment' => $data['treatment'],
            'medical_history' => $data['medical_history'],
            'surgical_history' => $data['surgical_history'],
            'food' => $data['food'],
            'drugs' => $data['drugs'],
            'plaster' => $data['plaster'],
            'family_history' => $data['family_history'],
            'consanguineous_marriage' => $data['consanguineous_marriage'],
            'occupation' => $data['occupation'],
            'monthly_income' => $data['monthly_income'],
            'nearest_hospital' => $data['nearest_hospital'],
            'water_source' => $data['water_source'],
            'general_sign' => $data['general_sign'],
            'abdominal' => $data['abdominal'],
            'cardiovascular_system' => $data['cardiovascular_system'],
            'respiratory_system' => $data['respiratory_system'],
            'height' => $data['height'],
            'weight' => $data['weight'],
            'bmi' => $data['bmi'],
            'temperature' => $data['temperature'],
            'diagnosis' => $data['diagnosis'],
            'management_plan'=> $managementPlan,

        ]);

        ActivityLog::create([
            'user_id' => $doctor->id,
            'description' => ' Created a Medical Record ' . '' . '(' . $patient->name . ')',
            'action_type' => 'medical_record',
        ]);

        return redirect()->back()->with('success', 'Medical Record Created Successfully.');

    }
}
