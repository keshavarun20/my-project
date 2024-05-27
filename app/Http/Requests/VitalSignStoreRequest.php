<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VitalSignStoreRequest extends FormRequest
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
            'rbs'=>['nullable'],
            'blood_pressure_systolic'=>['nullable'],
            'blood_pressure_diastolic'=>['nullable'],
            'heart_rate'=>['nullable'],
            'respiratory_rate'=>['nullable'],
            'date'=>['nullable'],
            'spo2'=>['nullable'],

        ];
    }
}
