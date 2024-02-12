<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
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
            'doctor_id'=>['required'],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'mobile_number'=>['required'],
            'age'=>['required'],
            'date'=>['required'],

        ];
    }
}
