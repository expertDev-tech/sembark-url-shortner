<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',

                // User should not already exist
                Rule::unique('users', 'email'),

                // Pending invitation should not already exist
                Rule::unique('invitations', 'email')
                    ->whereNull('accepted_at'),
            ],

            'role' => [
                'nullable',
                'in:Admin,Member',
            ],

            'company_name' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->sometimes(
            'company_name',
            ['required'],
            fn () => auth()->user()?->hasRole('SuperAdmin')
        );

        $validator->sometimes(
            'role',
            ['required'],
            fn () => auth()->user()?->hasRole('Admin')
        );
    }
}