<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest; 

class EditUserAdminRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0][0-9]*$/|size:10',
            // 'username' => 'required|string|max:30|unique:users,username,'.$request->get('id'), 
            'email' => 'required|email|unique:users,email,'.$request->get('id'), 
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'First name must not be blank!',
            'last_name.required' =>  'Last name must not be blank!',
            'address.required' => 'Address must not be blank!',
            'email.required' => 'Email must not be blank!',
            'email.email' => 'Invalid email!',
            'email.unique' => 'Email already exists!',
            'phone.required' => 'Phone must not be blank!',
            'username.required' => 'Username must not be blank!',
            'username.unique' => 'Username already exists!',
            'username.max' => 'The username may not be greater than 30 characters!',
        ];
    }
}
