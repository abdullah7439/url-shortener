<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_name' => ['required', 'string', 'max:255', 'unique:companies,name'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
                Rule::unique('invitations', 'email')->whereNull('accepted_at'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => 'Please enter the company name.',
            'company_name.max' => 'The company name may not be longer than 255 characters.',
            'company_name.unique' => 'A company with this name already exists.',
            'email.required' => 'Please enter the email of the first Admin.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email may not be longer than 255 characters.',
            'email.unique' => 'This email is already registered or already has a pending invitation.',
        ];
    }
}
