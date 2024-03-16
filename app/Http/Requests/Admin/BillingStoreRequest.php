<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BillingStoreRequest extends FormRequest
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
            'nic' => ['required'],
            'date' => ['required'],
            'name' => ['required'],
            'mobile_number' => ['required'],
            'description' => ['required'],
            'rate' => ['required'],
            'qty' => ['required'],
            'subtotal' => ['required'],
            'payment_method' => ['required'],
            'cheque' => ['nullable'],
            'reference_no' => ['nullable'],
            'total' => ['required'],
            'discount_percent' => ['required'],
            'discount' => ['required'],
            'tax_percent' => ['required'],
            'tax' => ['required'],
            'payable' => ['required'],
        ];
    }
}