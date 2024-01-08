<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            $user=$this->route('user');
            return[
            'email' => ['required','string','lowercase','email','max:255',Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable','min:8'],
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
            'slmc_no'=>['required',Rule::unique('doctors')->ignore($user->doctor->id)],
            'base_hospital'=>['required'],
        ];
        
        }
        //dd(1);
        if($this->role_id == 3){
            $user=$this->route('user');
            return[
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable','min:8'],
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

        $user=$this->route('user');
        return[
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'min:8'],
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
