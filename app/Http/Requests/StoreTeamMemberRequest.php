<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeamMemberRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
                Rule::unique('invitations', 'email')->whereNull('accepted_at'),
            ],
            'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_MEMBER])],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter the name.',
            'name.max' => 'The name may not be longer than 255 characters.',
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email may not be longer than 255 characters.',
            'email.unique' => 'This email is already registered or already has a pending invitation.',
            'role.required' => 'Please choose a role.',
            'role.in' => 'The role must be Admin or Member.',
        ];
    }
}
