<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'code'  => ['required', 'string', 'size:6', 'regex:/^\d{6}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.size'  => 'رمز OTP يجب أن يكون 6 أرقام.',
            'code.regex' => 'رمز OTP يجب أن يحتوي على أرقام فقط.',
        ];
    }
}
