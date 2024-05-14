<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd($this);
        return [
            'symptoms' => ['required'],
            'durations' => ['required'],
            'treatment' => ['required'],
            'medication' => ['required'],
            'medical_history' => ['required'],
            'surgical_history' => ['required'],
            'food' => ['required'],
            'drugs' => ['required'],
            'plaster' => ['required'],
            'family_history' => ['required'],
            'consanguineous_marriage' => ['required'],
            'occupation' => ['required'],
            'monthly_income' => ['required'],
            'nearest_hospital' => ['required'],
            'water_source' => ['required'],
            'general_sign' => ['required'],
            'abdominal' => ['required'],
            'cardiovascular_system' => ['required'],
            'respiratory_system' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'bmi' => ['required'],
            'temperature' => ['required'],
            'diagnosis' => ['required'],
            'drug_name' => ['required'],
            'dose' => ['required'],
            'route' => ['required'],
            'frequency' => ['required'],
        ];
    }
}
