<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceorderRequest extends FormRequest
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
        return [
            'first_name'   => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'Please Enter First Name.',
            'last_name.required' => 'Please Enter Last Name.',
            'address.required' => 'Please Enter Address.',
            'email.required' => 'Please Enter Email.',
            'phone.required' => 'Please Enter Phone.',
        ];
    }
}
