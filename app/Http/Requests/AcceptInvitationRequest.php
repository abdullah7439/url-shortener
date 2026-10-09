<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceptInvitationRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name.',
            'name.max' => 'The name may not be longer than 255 characters.',
            'password.required' => 'Please choose a password.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
