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
            
        //dd($data);
        
        Medical::create([
            'patient_id' => $patientId,
            'presenting_complaint'=>[
                'symptoms' => $data['symptoms'],
                'durations' => $data['durations']  
            ],
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
            'management_plan'=>[
                'drug_name' => $data['drug_name'],
                'dose' => $data['dose'],
                'route' => $data['route'],
                'frequency' => $data['frequency'],
            ]
            

        ]);

        return redirect()->back()->with('success', 'PDF file uploaded successfully.');

    }
}
