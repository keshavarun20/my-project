<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;


class UserStoreRequest extends FormRequest
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
        if($this->role_id == 2){
            return[
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'role_id' => ['required'],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'dob'=>['required'],
            'mobile_number'=>['required'],
            'nic'=>['required'],
            'gender'=>['required'],
            'address_lane_1'=>['required'],
            'address_lane_2' => ['nullable'],
            'city'=>['required'],
            'consultation_id'=>['required'],
            'specialty' => ['nullable'],
            'slmc_no'=>['required', 'unique:doctors'],
            'base_hospital'=>['required'],
            'available_days'=>'required_if:daily_available, No',
            'time'=>'required_if:daily_available , Yes',
            'times'=>'required_if:daily_available , No',

        ];
        
        }
        //dd(1);
        if($this->role_id == 3){
            return[
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'role_id' => ['required'],
            'today_date'=>['required'],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'dob'=>['required'],
            'mobile_number'=>['required'],
            'nic'=>['required'],
            'gender'=>['required'],
            'address_lane_1'=>['required'],
            'address_lane_2' => ['nullable'],
            'city'=>['required'],
        ];
        
        }

        return[
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'role_id' => ['required'],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'dob'=>['required'],
            'mobile_number'=>['required'],
            'nic'=>['required'],
            'gender'=>['required'],
            'address_lane_1'=>['required'],
            'address_lane_2' => ['nullable'],
            'city'=>['required'],

        ];

        
    }

    
}
