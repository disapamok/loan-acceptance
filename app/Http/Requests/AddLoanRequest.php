<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_name' => 'required',
            'duration' => 'required|numeric|between:0,120',
            'amount' => 'required|numeric|between:0,9999999999.99',
            'bankFile' => 'required|file'
        ];
    }
}
