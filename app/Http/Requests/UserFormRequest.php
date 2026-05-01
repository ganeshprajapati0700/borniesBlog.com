<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$this->route('user'),
            'mobile' => 'required|numeric|digits:10',
            'status' => 'required|in:1,0',
            'role' => 'required|in:1,0',
            'password' => [
                'nullable',
                'min:10',                  // must be at least 10 characters in length  \\
                'regex:/[a-z]/',          // must contain at least one lowercase letter  \\
                'regex:/[A-Z]/',         // must contain at least one uppercase letter    \\
                'regex:/[0-9]/',        // must contain at least one digit                 \\
                'regex:/[@$!%*#?&]/',  // must contain a special character                  \\
                'confirmed',
            ],
            // 'password_confirmation' => [
            //     'required',
            //     'min:10',                 // must be at least 10 characters in length \\
            //     'regex:/[a-z]/',         // must contain at least one lowercase letter \\
            //     'regex:/[A-Z]/',        // must contain at least one uppercase letter   \\
            //     'regex:/[0-9]/',       // must contain at least one digit                \\
            //     'regex:/[@$!%*#?&]/', // must contain a special character,                \\
            //     'same:password'
            // ]
        ];
    }
}
