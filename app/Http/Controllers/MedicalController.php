<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalStoreRequest;
use App\Models\Medical;
use Illuminate\Http\Request;

class MedicalController extends Controller
{
    public function store(MedicalStoreRequest $request) {
        //dd(1);
        $data = $request->validated();
        $patientId = $request->route('patient');

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

        return redirect()->back()->with('success', 'PDF file uploaded successfully.');

    }
}
